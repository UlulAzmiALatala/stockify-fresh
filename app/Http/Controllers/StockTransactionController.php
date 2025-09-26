<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier; 
use App\Models\StockTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StockTransactionController extends Controller
{
    /**
     * Menampilkan riwayat semua transaksi stok.
     */
    public function index(Request $request)
    {
        $query = StockTransaction::with(['product', 'user'])->latest();

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->whereHas('product', function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%');
            });
        }

        $transactions = $query->paginate(15);

        return view('app.pages.manager.transactions.index', compact('transactions'));
    }

    /**
     * Menampilkan form untuk mencatat barang masuk.
     */
    public function createStockIn()
    {
        // PERBAIKAN: Ambil data produk DAN supplier
        $products = Product::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get(); // <-- 2. Ambil semua supplier

        // PERBAIKAN: Kirim kedua variabel ke view
        return view('app.pages.manager.transactions.stock-in', compact('products', 'suppliers'));
    }

    /**
     * Menyimpan transaksi barang masuk dan memperbarui stok produk.
     */
    public function storeStockIn(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date_format:d-m-Y',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'notes' => 'nullable|string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $product = Product::find($request->product_id);

                StockTransaction::create([
                    'product_id' => $request->product_id,
                    'user_id' => Auth::id(),
                    'type' => 'Masuk',
                    'quantity' => $request->quantity,
                    'date' => Carbon::createFromFormat('d-m-Y', $request->date),
                    'supplier_id' => $request->supplier_id, // Simpan supplier_id jika ada
                    'status' => 'Selesai',
                    'notes' => $request->notes,
                ]);

                $product->increment('stock', $request->quantity);
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('transactions.index')->with('success', 'Transaksi barang masuk berhasil dicatat.');
    }

    /**
     * Menampilkan form untuk mencatat barang keluar.
     */
    public function createStockOut()
    {
        $products = Product::orderBy('name')->get();
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
            'date' => 'required|date_format:d-m-Y',
            'notes' => 'nullable|string',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $product = Product::lockForUpdate()->find($request->product_id);

                if ($product->stock < $request->quantity) {
                    throw new \Exception('Stok produk tidak mencukupi.');
                }

                StockTransaction::create([
                    'product_id' => $request->product_id,
                    'user_id' => Auth::id(),
                    'type' => 'Keluar',
                    'quantity' => $request->quantity,
                    'date' => Carbon::createFromFormat('d-m-Y', $request->date),
                    'status' => 'Selesai',
                    'notes' => $request->notes,
                ]);

                $product->decrement('stock', $request->quantity);
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage())->withInput();
        }

        return redirect()->route('transactions.index')->with('success', 'Transaksi barang keluar berhasil dicatat.');
    }
}
