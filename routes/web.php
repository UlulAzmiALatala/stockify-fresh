<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama diarahkan ke halaman login
Route::get('/', function () {
    return view('auth.sign-in');
})->name('login');

// Grup route yang butuh autentikasi
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('app.pages.dashboard');
    })->name('admin.dashboard');

    // Produk
    Route::get('/products', function () {
        return view('app.pages.products.index');
    })->name('admin.products.index');

    // Kategori
    Route::get('/categories', function () {
        return view('app.pages.categories.index');
    })->name('admin.categories.index');

    Route::get('/categories/create', function () {
        return view('app.pages.categories.create');
    })->name('admin.categories.create');

    // Supplier
    Route::get('/suppliers', function () {
        return view('app.pages.suppliers.index');
    })->name('admin.suppliers.index');

    // Users
    Route::get('/users', function () {
        return view('app.pages.users.index');
    })->name('admin.users.index');

    // Transaksi
    Route::get('/transactions', function () {
        return view('app.pages.transactions.index');
    })->name('admin.transactions.index');

    Route::get('/transactions/stock-in', function () {
        return view('app.pages.transactions.stock-in');
    })->name('admin.transactions.stockin');

    Route::get('/transactions/stock-out', function () {
        return view('app.pages.transactions.stock-out');
    })->name('admin.transactions.stockout');

    // Profil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute autentikasi bawaan Breeze
require __DIR__.'/auth.php';
