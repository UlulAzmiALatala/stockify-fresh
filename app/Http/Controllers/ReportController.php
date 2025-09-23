<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\Category;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Menampilkan laporan status stok barang.
     * Fokus pada stok menipis dan data stok keseluruhan.
     */
    public function stockStatus(Request $request)
    {
        $query = Product::with(['category', 'supplier'])->latest();

        // Filter berdasarkan kategori jika ada
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter untuk menampilkan hanya stok menipis
        if ($request->has('show_low_stock')) {
            $query->whereColumn('stock', '<=', 'minimum_stock');
        }

        // PENYEMPURNAAN: Menggunakan paginasi agar konsisten
        $products = $query->paginate(15)->appends($request->query());

        $categories = Category::orderBy('name')->get();

        // PENYESUAIAN: Path view diubah ke folder manager
        // Anda mungkin perlu membuat file view ini jika belum ada.
        return view('app.pages.manager.reports.stock', compact('products', 'categories'));
    }

    /**
     * Menampilkan laporan riwayat transaksi barang.
     * Dapat difilter berdasarkan rentang tanggal dan tipe transaksi.
     */
    public function transactionHistory(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'type' => 'nullable|in:Masuk,Keluar',
        ]);

        $query = StockTransaction::with(['product', 'user'])->latest();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('date', '<=', $request->end_date);
        }

        $transactions = $query->paginate(20)->appends($request->query());

        // PENYESUAIAN: Path view diubah ke folder manager
        // Anda mungkin perlu membuat file view ini jika belum ada.
        return view('app.pages.manager.reports.transaction-history', compact('transactions'));
    }
}
