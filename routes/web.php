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
use App\Http\Controllers\AttributeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama diarahkan ke halaman login
// Catatan: Rute 'login' utama akan ditangani oleh auth.php
Route::get('/', function () {
    return view('auth.sign-in');
});

// =========================================================================
// PERBAIKAN: Middleware 'verified' dihapus untuk sementara
// =========================================================================
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- MANAJEMEN DATA MASTER ---
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('attributes', AttributeController::class);
    Route::resource('products', ProductController::class);

    // --- MANAJEMEN PENGGUNA ---
    Route::resource('users', UserController::class)->names('admin.users');

    // --- MANAJEMEN STOK & TRANSAKSI ---
    Route::get('/transactions', [StockTransactionController::class, 'index'])->name('transactions.index');
    Route::get('/stock/in', [StockTransactionController::class, 'createStockIn'])->name('stock.in.create');
    Route::post('/stock/in', [StockTransactionController::class, 'storeStockIn'])->name('stock.in.store');
    Route::get('/stock/out', [StockTransactionController::class, 'createStockOut'])->name('stock.out.create');
    Route::post('/stock/out', [StockTransactionController::class, 'storeStockOut'])->name('stock.out.store');

    // --- LAPORAN ---
    Route::get('/reports/stock-status', [ReportController::class, 'stockStatus'])->name('reports.stock_status');
    Route::get('/reports/transactions', [ReportController::class, 'transactionHistory'])->name('reports.transactions');

    // --- PROFIL PENGGUNA ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute autentikasi bawaan
require __DIR__ . '/auth.php';
