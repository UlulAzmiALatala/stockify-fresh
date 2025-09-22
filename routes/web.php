<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sinilah kita mendefinisikan semua rute untuk aplikasi web kita
| yang menggunakan pendekatan Server-Side Rendering (SSR).
|
*/

// Halaman utama diarahkan ke halaman login
Route::get('/', function () {
    return view('auth.sign-in');
})->name('login');

// Grup route yang butuh autentikasi dan status terverifikasi
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('app.pages.dashboard');
    })->name('dashboard'); // Nama route lebih sederhana

    // --- MANAJEMEN DATA MASTER ---

    // Manajemen Kategori (Sudah kita buat)
    Route::resource('categories', CategoryController::class);

    // Manajemen Supplier
    Route::resource('suppliers', SupplierController::class);

    // Manajemen Produk
    Route::resource('products', ProductController::class);

    // --- MANAJEMEN PENGGUNA (Hanya Admin) ---
    // Route::middleware(['role:Admin'])->group(function() {
    Route::resource('users', UserController::class);
    // });
    // Catatan: Middleware role akan kita aktifkan nanti saat manajemen user dibuat

    // --- MANAJEMEN STOK & TRANSAKSI ---

    // Halaman utama transaksi
    Route::get('/transactions', [StockTransactionController::class, 'index'])->name('transactions.index');
    // Form untuk barang masuk
    Route::get('/stock/in', [StockTransactionController::class, 'createStockIn'])->name('stock.in.create');
    // Proses penyimpanan barang masuk
    Route::post('/stock/in', [StockTransactionController::class, 'storeStockIn'])->name('stock.in.store');
    // Form untuk barang keluar
    Route::get('/stock/out', [StockTransactionController::class, 'createStockOut'])->name('stock.out.create');
    // Proses penyimpanan barang keluar
    Route::post('/stock/out', [StockTransactionController::class, 'storeStockOut'])->name('stock.out.store');


    // --- LAPORAN ---
    Route::get('/reports/stock-status', [ReportController::class, 'stockStatus'])->name('reports.stock_status');
    Route::get('/reports/transactions', [ReportController::class, 'transactionHistory'])->name('reports.transactions');


    // --- PROFIL PENGGUNA (Bawaan Breeze) ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute autentikasi bawaan Breeze
require __DIR__ . '/auth.php';
