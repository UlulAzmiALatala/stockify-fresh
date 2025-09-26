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
     * Menampilkan riwayat transaksi stok berdasarkan peran.
     */
    public function index(Request $request)
    {
        $query = StockTransaction::with(['product', 'user'])->latest();

        // Filter berdasarkan pencarian nama produk
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->whereHas('product', function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filter berdasarkan tipe transaksi
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter berdasarkan rentang tanggal
        if ($request->filled('date_range')) {
            $dates = explode(' to ', $request->date_range);
            if (count($dates) > 0) {
                $startDate = Carbon::createFromFormat('d-m-Y', $dates[0])->startOfDay();
                // Jika hanya ada satu tanggal, gunakan tanggal itu sebagai akhir
                $endDate = isset($dates[1]) ? Carbon::createFromFormat('d-m-Y', $dates[1])->endOfDay() : $startDate->copy()->endOfDay();

                $query->whereBetween('date', [$startDate, $endDate]);
            }
        }

        $transactions = $query->paginate(15)->appends($request->query());

        // Cek peran untuk menampilkan view yang benar
        if (Auth::user()->hasRole('admin')) {
            // PERBAIKAN: Admin juga diarahkan ke view riwayat transaksi milik manajer
            return view('app.pages.manager.transactions.index', compact('transactions'));
        }

        if (Auth::user()->hasRole('manager')) {
            return view('app.pages.manager.transactions.index', compact('transactions'));
        }

        return abort(403, 'Akses Ditolak');
    }

    /**
     * Menampilkan form untuk mencatat barang masuk.
     */
    public function createStockIn()
    {
        $products = Product::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        return view('app.pages.manager.transactions.stock-in', compact('products', 'suppliers'));
    }

    /**
     * Menyimpan transaksi barang masuk.
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
                    'supplier_id' => $request->supplier_id,
                    'status' => 'Selesai', // Status awal, nanti dikonfirmasi staf
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
     * Menyimpan transaksi barang keluar.
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
                    'status' => 'Selesai', // Status awal, nanti dikonfirmasi staf
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
