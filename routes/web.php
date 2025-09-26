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
use App\Http\Controllers\StockController; // <-- Import StockController baru

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
Route::middleware(['auth'])->group(function () {

    // Rute Dashboard utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- RUTE UNTUK MASTER DATA (HANYA ADMIN) ---
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('users', UserController::class);
    Route::resource('attributes', AttributeController::class);

    // --- RUTE UNTUK TRANSAKSI (MANAJER & STAF) ---
    Route::get('/transactions', [StockTransactionController::class, 'index'])->name('transactions.index');
    Route::get('/stock/in', [StockTransactionController::class, 'createStockIn'])->name('stock.in.create');
    Route::post('/stock/in', [StockTransactionController::class, 'storeStockIn'])->name('stock.in.store');
    Route::get('/stock/out', [StockTransactionController::class, 'createStockOut'])->name('stock.out.create');
    Route::post('/stock/out', [StockTransactionController::class, 'storeStockOut'])->name('stock.out.store');

    // --- RUTE UNTUK FITUR STOK (ADMIN, MANAJER, STAF) ---
    // Admin
    Route::get('/stock/report', [StockController::class, 'adminStockReport'])->name('admin.stock.report');
    // Manager
    Route::get('/stock/opname', [StockController::class, 'managerStockOpname'])->name('manager.stock.opname');
    Route::post('/stock/opname', [StockController::class, 'storeStockOpname'])->name('manager.stock.opname.store');
    // Staff
    Route::get('/stock/confirm-in', [StockController::class, 'staffConfirmIn'])->name('staff.stock.confirm-in');
    Route::get('/stock/prepare-out', [StockController::class, 'staffPrepareOut'])->name('staff.stock.prepare-out');

    // --- RUTE UNTUK LAPORAN (TIDAK DIGUNAKAN LAGI, DIHANDLE DI ATAS) ---
    // Route::get('/reports/stock-status', [ReportController::class, 'stockStatus'])->name('reports.stock_status');
    // Route::get('/reports/transactions', [ReportController::class, 'transactionHistory'])->name('reports.transactions');

    // --- RUTE PROFIL PENGGUNA ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Memuat rute-rute autentikasi
require __DIR__ . '/auth.php';
