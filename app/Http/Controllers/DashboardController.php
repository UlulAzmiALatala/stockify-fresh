<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard berdasarkan peran pengguna yang login,
     * lengkap dengan data ringkasan yang relevan.
     */
    public function index()
    {
        $user = Auth::user();

        // Tampilkan dashboard untuk Admin
        if ($user->hasRole('Admin')) {
            $data = [
                'productCount' => Product::count(),
                'supplierCount' => \App\Models\Supplier::count(),
                'transactionInToday' => StockTransaction::where('type', 'Masuk')->whereDate('date', today())->count(),
                'transactionOutToday' => StockTransaction::where('type', 'Keluar')->whereDate('date', today())->count(),
                'latestUsers' => User::latest()->take(5)->get(),
            ];
            return view('app.pages.admin.dashboard', $data);
        }

        // Tampilkan dashboard untuk Manajer Gudang
        if ($user->hasRole('Manajer Gudang')) {
            $data = [
                // Menghitung produk yang stoknya di bawah atau sama dengan stok minimum
                'lowStockProductsCount' => Product::whereColumn('stock', '<=', 'minimum_stock')->count(),
                'transactionInToday' => StockTransaction::where('type', 'Masuk')->whereDate('date', today())->count(),
                'transactionOutToday' => StockTransaction::where('type', 'Keluar')->whereDate('date', today())->count(),
                'totalProducts' => Product::count(),
            ];
            return view('app.pages.manager.dashboard', $data);
        }

        // Tampilkan dashboard untuk Staff Gudang
        if ($user->hasRole('Staff Gudang')) {
            // Asumsi status 'Menunggu Konfirmasi' untuk barang masuk & 'Siap Dikirim' untuk barang keluar
            // Anda bisa menyesuaikan status ini sesuai implementasi di database.
            $data = [
                'pendingConfirmationIn' => StockTransaction::where('type', 'Masuk')->where('status', 'Menunggu Konfirmasi')->count(),
                'readyForShipmentOut' => StockTransaction::where('type', 'Keluar')->where('status', 'Siap Dikirim')->count(),
            ];
            return view('app.pages.staff.dashboard', $data);
        }

        // Jika tidak memiliki peran yang sesuai, arahkan ke halaman login
        Auth::logout();
        return redirect()->route('login')->with('error', 'Anda tidak memiliki peran yang valid.');
    }
}
