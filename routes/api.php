<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\StockTransactionController;
use App\Http\Controllers\Api\ReportController;

// routes/api.php

// ... (semua baris import di atas)

// Rute Publik (tidak perlu login)
Route::post('/auth/login', [AuthController::class, 'login']);

// Rute Terproteksi (perlu login/token)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Rute hanya untuk Admin
    Route::middleware('role:Admin')->group(function () {
        Route::apiResource('users', UserController::class);
        Route::apiResource('categories', CategoryController::class);
        Route::apiResource('suppliers', SupplierController::class);
    });

    // Rute untuk Admin & Manajer Gudang
    Route::middleware('role:Admin|Manajer Gudang')->group(function () {
        Route::apiResource('products', ProductController::class);
        Route::get('/stock/transactions', [StockTransactionController::class, 'index']);
        Route::get('/reports/stock-status', [ReportController::class, 'stockStatus']);
        Route::get('/reports/transactions', [ReportController::class, 'transactionHistory']);
    });

    // Rute untuk aksi stok (Manajer & Staff) <-- BLOK INI YANG PERLU ANDA TAMBAHKAN
    Route::middleware('role:Manajer Gudang|Staff Gudang')->group(function () {
        Route::post('/stock/in', [StockTransactionController::class, 'stockIn']); // <-- INI YANG HILANG
        Route::post('/stock/out', [StockTransactionController::class, 'stockOut']);
    });
});
