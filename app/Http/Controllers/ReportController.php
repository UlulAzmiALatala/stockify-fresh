<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Menampilkan laporan status stok barang.
     * Fokus pada stok menipis dan data stok keseluruhan.
     */
    public function stockStatus(Request $request)
    {
        // Query dasar untuk produk
        $query = Product::with(['category', 'supplier'])->orderBy('name');

        // Filter berdasarkan kategori jika ada
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter untuk menampilkan hanya stok menipis
        if ($request->has('show_low_stock')) {
            $query->whereColumn('stock', '<=', 'minimum_stock');
        }

        $products = $query->get();

        // Mengambil semua kategori untuk filter dropdown
        $categories = \App\Models\Category::orderBy('name')->get();

        return view('app.pages.reports.stock-status', compact('products', 'categories'));
    }

    /**
     * Menampilkan laporan riwayat transaksi barang.
     * Dapat difilter berdasarkan rentang tanggal dan tipe transaksi.
     */
    public function transactionHistory(Request $request)
    {
        // Validasi input filter
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'type' => 'nullable|in:Masuk,Keluar',
        ]);

        $query = StockTransaction::with(['product', 'user'])->latest();

        // Filter berdasarkan tipe transaksi
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter berdasarkan rentang tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('date', '<=', $request->end_date);
        }

        $transactions = $query->paginate(20)->appends($request->query());

        return view('app.pages.reports.transaction-history', compact('transactions'));
    }
}
