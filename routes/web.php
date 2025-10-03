<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\ProductImportExportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- RUTE MASTER DATA (HANYA ADMIN) ---
    Route::resource('categories', CategoryController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('attributes', AttributeController::class);
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);

    // --- RUTE IMPORT & EXPORT (HANYA ADMIN) ---
    Route::get('products-export', [ProductImportExportController::class, 'export'])->name('products.export');
    Route::post('products-import', [ProductImportExportController::class, 'import'])->name('products.import');

    // --- RUTE MANAJEMEN STOK ---
    // Manajer: Membuat Transaksi
    Route::get('/stock/in', [StockTransactionController::class, 'createStockIn'])->name('stock.in.create');
    Route::post('/stock/in', [StockTransactionController::class, 'storeStockIn'])->name('stock.in.store');
    Route::get('/stock/out', [StockTransactionController::class, 'createStockOut'])->name('stock.out.create');
    Route::post('/stock/out', [StockTransactionController::class, 'storeStockOut'])->name('stock.out.store');
    // Manajer: Stock Opname
    Route::get('/stock/opname', [StockController::class, 'managerStockOpname'])->name('manager.stock.opname');
    Route::post('/stock/opname', [StockController::class, 'storeStockOpname'])->name('manager.stock.opname.store');
    // Staf: Konfirmasi Tugas
    Route::get('/stock/confirm-in', [StockController::class, 'staffConfirmIn'])->name('staff.stock.confirm-in');
    Route::patch('/stock/confirm-in/{transaction}', [StockController::class, 'processConfirmIn'])->name('staff.stock.confirm-in.process');
    Route::get('/stock/prepare-out', [StockController::class, 'staffPrepareOut'])->name('staff.stock.prepare-out');
    Route::patch('/stock/prepare-out/{transaction}', [StockController::class, 'processPrepareOut'])->name('staff.stock.prepare-out.process');

    // --- RUTE LAPORAN & PENGATURAN ---
    // Admin & Manajer
    Route::get('/transactions', [StockTransactionController::class, 'index'])->name('transactions.index');
    // Admin
    Route::get('/stock/report', [StockController::class, 'adminStockReport'])->name('admin.stock.report');
    Route::get('/reports/activity-log', [ActivityLogController::class, 'index'])->name('admin.reports.activity-log');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::patch('/settings', [SettingsController::class, 'update'])->name('settings.update');

    // --- RUTE PROFIL PENGGUNA ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
