<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini kita akan mendaftarkan semua rute untuk antarmuka web aplikasi Stockify.
|
*/

Route::get('/', function () {
    // Mengarahkan halaman utama ke view dashboard aplikasi Anda
    // Berdasarkan struktur folder views baru Anda
    return view('app.pages.dashboard');
});

// Anda bisa menambahkan rute web lain di sini nanti
// Contoh: Route::get('/profile', [ProfileController::class, 'show']);