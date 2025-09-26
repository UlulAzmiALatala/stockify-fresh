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
     */
    public function adminStockReport(Request $request)
    {
        $query = Product::with('category')->latest();
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
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
                    StockTransaction::create([
                        'product_id' => $product->id,
                        'user_id' => Auth::id(),
                        'type' => $difference > 0 ? 'Masuk' : 'Keluar',
                        'quantity' => abs($difference),
                        'date' => now(),
                        'status' => 'Penyesuaian Stok',
                        'notes' => '[Stock Opname] ' . $request->notes,
                    ]);
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
        // Menampilkan transaksi yang statusnya 'Selesai' (dibuat manajer) tapi perlu dikonfirmasi
        $transactions = StockTransaction::where('type', 'Masuk')
            ->where('status', 'Selesai')
            ->latest()
            ->paginate(10);

        return view('app.pages.staff.transactions.confirm-in', compact('transactions'));
    }

    /**
     * Method baru untuk memproses konfirmasi barang masuk dari Staf.
     */
    public function processConfirmIn(StockTransaction $transaction)
    {
        $transaction->status = 'Diterima';
        $transaction->save();

        return redirect()->route('staff.stock.confirm-in')->with('success', 'Barang masuk berhasil dikonfirmasi.');
    }

    /**
     * Menampilkan halaman Siapkan Barang Keluar untuk Staf.
     */
    public function staffPrepareOut()
    {
        $transactions = StockTransaction::where('type', 'Keluar')
            ->where('status', 'Selesai')
            ->latest()
            ->paginate(10);

        return view('app.pages.staff.transactions.prepare-out', compact('transactions'));
    }

    /**
     * Method baru untuk memproses konfirmasi barang keluar dari Staf.
     */
    public function processPrepareOut(StockTransaction $transaction)
    {
        $transaction->status = 'Dikirim';
        $transaction->save();

        return redirect()->route('staff.stock.prepare-out')->with('success', 'Barang keluar berhasil dikonfirmasi.');
    }
}
