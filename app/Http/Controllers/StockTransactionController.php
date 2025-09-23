<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockTransactionController extends Controller
{
    /**
     * Menampilkan riwayat semua transaksi stok.
     */
    public function index(Request $request)
    {
        $query = StockTransaction::with(['product', 'user'])->latest();

        // Logika pencarian berdasarkan nama produk
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->whereHas('product', function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%');
            });
        }

        $transactions = $query->paginate(15);

        // PENYESUAIAN: Path view diubah ke folder manager
        return view('app.pages.manager.transactions.index', compact('transactions'));
    }

    /**
     * Menampilkan form untuk mencatat barang masuk.
     */
    public function createStockIn()
    {
        $products = Product::orderBy('name')->get();
        // PENYESUAIAN: Path view diubah ke folder manager
        return view('app.pages.manager.transactions.stock-in', compact('products'));
    }

    /**
     * Menyimpan transaksi barang masuk dan memperbarui stok produk.
     */
    public function storeStockIn(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // 1. Cari produk
                $product = Product::find($request->product_id);

                // 2. Buat catatan transaksi
                StockTransaction::create([
                    'product_id' => $request->product_id,
                    'user_id' => Auth::id(),
                    'type' => 'Masuk',
                    'quantity' => $request->quantity,
                    'date' => $request->date,
                    'status' => 'Diterima', // Atau 'Menunggu Konfirmasi' jika perlu alur staff
                    'notes' => $request->notes,
                ]);

                // 3. Update stok di tabel produk secara atomik
                $product->increment('stock', $request->quantity);
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('transactions.index')->with('success', 'Transaksi barang masuk berhasil dicatat.');
    }

    /**
     * Menampilkan form untuk mencatat barang keluar.
     */
    public function createStockOut()
    {
        $products = Product::orderBy('name')->get();
        // PENYESUAIAN: Path view diubah ke folder manager
        return view('app.pages.manager.transactions.stock-out', compact('products'));
    }

    /**
     * Menyimpan transaksi barang keluar dan memperbarui stok produk.
     */
    public function storeStockOut(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                // 1. Cari produk dan kunci barisnya untuk mencegah race condition
                $product = Product::lockForUpdate()->find($request->product_id);

                // 2. Validasi apakah stok mencukupi
                if ($product->stock < $request->quantity) {
                    // Melemparkan exception akan otomatis membatalkan (rollback) transaksi
                    throw new \Exception('Stok produk tidak mencukupi.');
                }

                // 3. Buat catatan transaksi
                StockTransaction::create([
                    'product_id' => $request->product_id,
                    'user_id' => Auth::id(),
                    'type' => 'Keluar',
                    'quantity' => $request->quantity,
                    'date' => $request->date,
                    'status' => 'Dikeluarkan', // Atau 'Disiapkan' jika perlu alur staff
                    'notes' => $request->notes,
                ]);

                // 4. Update stok di tabel produk secara atomik
                $product->decrement('stock', $request->quantity);
            });
        } catch (\Exception $e) {
            // Tangkap pesan error dari validasi stok atau kesalahan database lainnya
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage())->withInput();
        }


        return redirect()->route('transactions.index')->with('success', 'Transaksi barang keluar berhasil dicatat.');
    }
}
