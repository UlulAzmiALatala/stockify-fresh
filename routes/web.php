<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama akan dialihkan ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Grup rute untuk semua halaman yang memerlukan login
Route::middleware('auth')->group(function () {

    // Rute Dashboard utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rute Profil Pengguna (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // ===================================================================
    // RUTE UNTUK SEMUA FITUR MANAJEMEN APLIKASI
    // ===================================================================

    // Route::resource secara otomatis membuat rute untuk index, create, store, show, edit, update, destroy
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('users', UserController::class);
    
    // Rute untuk Transaksi Stok
    Route::get('/stock/in', [StockTransactionController::class, 'createStockIn'])->name('stock.in.create');
    Route::get('/stock/out', [StockTransactionController::class, 'createStockOut'])->name('stock.out.create');
    Route::get('/transactions', [StockTransactionController::class, 'index'])->name('transactions.index');
    
    // Rute untuk Laporan
    Route::get('/reports/stock-status', [ReportController::class, 'stockStatus'])->name('reports.stock_status');
    Route::get('/reports/transactions', [ReportController::class, 'transactionHistory'])->name('reports.transactions');

});

// Memuat rute-rute autentikasi dari Breeze
require __DIR__.'/auth.php';