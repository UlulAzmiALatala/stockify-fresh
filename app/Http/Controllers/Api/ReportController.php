<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\StockTransactionResource;
use App\Models\Product;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Laporan status stok semua produk.
     */
    public function stockStatus(Request $request)
    {
        $products = Product::with(['category', 'supplier'])
            ->orderBy('stock', 'asc')
            ->get();

        return ProductResource::collection($products);
    }

    /**
     * Laporan riwayat transaksi dengan filter.
     */
    public function transactionHistory(Request $request)
    {
        $request->validate([
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'type' => 'nullable|in:Masuk,Keluar',
            'product_id' => 'nullable|exists:products,id',
        ]);

        $query = StockTransaction::with(['product', 'user']);

        // Terapkan filter jika ada
        $query->when($request->start_date, function ($q) use ($request) {
            $q->whereDate('created_at', '>=', $request->start_date);
        });

        $query->when($request->end_date, function ($q) use ($request) {
            $q->whereDate('created_at', '<=', $request->end_date);
        });

        $query->when($request->type, function ($q) use ($request) {
            $q->where('type', $request->type);
        });

        $query->when($request->product_id, function ($q) use ($request) {
            $q->where('product_id', $request->product_id);
        });

        $transactions = $query->latest()->paginate(20);

        return StockTransactionResource::collection($transactions);
    }
}
