<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // <-- 1. Pastikan ini di-import
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\User;
use App\Models\Supplier;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard berdasarkan peran pengguna yang login.
     */
    public function index(Request $request) // <-- 2. Tambahkan Request $request di sini
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->roles->isEmpty()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login')->with('error', 'Akun Anda tidak memiliki peran. Silakan hubungi administrator.');
        }

        if ($user->hasRole('admin')) {
            $totalProducts = Product::count();
            $totalSuppliers = Supplier::count();
            $totalUsers = User::count();
            $latestUsers = User::latest()->take(5)->get();

            return view('app.pages.admin.dashboard', compact('totalProducts', 'totalSuppliers', 'totalUsers', 'latestUsers'));
        }

        if ($user->hasRole('manager')) {
            $today = Carbon::today();
            $totalProducts = Product::count();
            $lowStockProducts = Product::whereColumn('stock', '<=', 'minimum_stock')->count();
            $stockInToday = StockTransaction::where('type', 'Masuk')->whereDate('date', $today)->sum('quantity');
            $stockOutToday = StockTransaction::where('type', 'Keluar')->whereDate('date', $today)->sum('quantity');

            return view('app.pages.manager.dashboard', compact('totalProducts', 'lowStockProducts', 'stockInToday', 'stockOutToday'));
        }

        if ($user->hasRole('staff')) {
            $pendingStockIn = StockTransaction::where('type', 'Masuk')->where('status', 'Menunggu Konfirmasi')->count();
            $pendingStockOut = StockTransaction::where('type', 'Keluar')->where('status', 'Disiapkan')->count();

            return view('app.pages.staff.dashboard', compact('pendingStockIn', 'pendingStockOut'));
        }

        return redirect()->route('login');
    }
}
