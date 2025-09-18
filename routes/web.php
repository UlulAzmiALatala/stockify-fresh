<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama akan mengarahkan ke halaman login jika belum terautentikasi
Route::get('/', function () {
    return view('auth.sign-in'); // Menggunakan view login dari template Anda
});

// Grup rute untuk semua halaman aplikasi yang memerlukan login
Route::middleware(['auth', 'verified'])->group(function () {

    // Rute Dashboard Utama
    Route::get('/dashboard', function () {
        return view('app.pages.dashboard');
    })->name('dashboard'); // Nama default dari Breeze, bisa juga 'admin.dashboard'

    // Rute Manajemen Produk
    Route::get('/products', function () {
        return view('app.pages.products.index');
    })->name('admin.products.index');

    // Rute Manajemen Kategori
    Route::get('/categories', function () {
        return view('app.pages.categories.index');
    })->name('admin.categories.index');

    // Rute Manajemen Supplier
    Route::get('/suppliers', function () {
        return view('app.pages.suppliers.index');
    })->name('admin.suppliers.index');

    // Rute Manajemen Pengguna
    Route::get('/users', function () {
        return view('app.pages.users.index');
    })->name('admin.users.index');

    // Rute Transaksi
    Route::get('/transactions', function () {
        return view('app.pages.transactions.index');
    })->name('admin.transactions.index');

    Route::get('/transactions/stock-in', function () {
        return view('app.pages.transactions.stock-in');
    })->name('admin.transactions.stockin');

    Route::get('/transactions/stock-out', function () {
        return view('app.pages.transactions.stock-out');
    })->name('admin.transactions.stockout');

    // Rute Profil (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Memuat rute-rute autentikasi (login, register, dll.) dari Breeze
require __DIR__ . '/auth.php';
