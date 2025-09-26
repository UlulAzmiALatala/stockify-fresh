<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
    /**
     * Menampilkan halaman Laporan Stok untuk Admin.
     * Menampilkan semua produk, stok saat ini, dan status stok.
     */
    public function adminStockReport(Request $request)
    {
        $query = Product::with('category')->latest();

        // Logika pencarian
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter untuk stok menipis
        if ($request->has('low_stock')) {
            $query->whereColumn('stock', '<=', 'minimum_stock');
        }

        $products = $query->paginate(15)->appends($request->query());

        return view('app.pages.admin.stock.index', compact('products'));
    }

    /**
     * Menampilkan halaman Stock Opname untuk Manajer.
     */
    public function managerStockOpname()
    {
        $products = Product::orderBy('name')->get();
        return view('app.pages.manager.stock.opname', compact('products'));
    }

    /**
     * Memproses formulir Stock Opname dari Manajer.
     */
    public function storeStockOpname(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'physical_stock' => 'required|integer|min:0',
            'notes' => 'required|string|max:255',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $product = Product::lockForUpdate()->find($request->product_id);
                $systemStock = $product->stock;
                $physicalStock = (int) $request->physical_stock;
                $difference = $physicalStock - $systemStock;

                if ($difference != 0) {
                    // Buat transaksi penyesuaian
                    StockTransaction::create([
                        'product_id' => $product->id,
                        'user_id' => Auth::id(),
                        'type' => $difference > 0 ? 'Masuk' : 'Keluar',
                        'quantity' => abs($difference),
                        'date' => now(),
                        'status' => 'Penyesuaian Stok',
                        'notes' => '[Stock Opname] ' . $request->notes,
                    ]);

                    // Update stok produk
                    $product->stock = $physicalStock;
                    $product->save();
                }
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal melakukan penyesuaian stok: ' . $e->getMessage());
        }

        return redirect()->route('manager.stock.opname')->with('success', 'Penyesuaian stok berhasil dicatat.');
    }

    /**
     * Menampilkan halaman Konfirmasi Barang Masuk untuk Staf.
     */
    public function staffConfirmIn()
    {
        $transactions = StockTransaction::where('type', 'Masuk')
            ->where('status', '!=', 'Diterima')
            ->latest()
            ->paginate(10);

        return view('app.pages.staff.transactions.confirm-in', compact('transactions'));
    }

    /**
     * Menampilkan halaman Siapkan Barang Keluar untuk Staf.
     */
    public function staffPrepareOut()
    {
        $transactions = StockTransaction::where('type', 'Keluar')
            ->where('status', '!=', 'Dikirim')
            ->latest()
            ->paginate(10);

        return view('app.pages.staff.transactions.prepare-out', compact('transactions'));
    }
}
