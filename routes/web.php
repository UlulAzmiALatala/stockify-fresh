<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app.pages.dashboard');
})->name('admin.dashboard');

Route::get('/users', function () {
    return view('app.pages.users.index');
})->name('admin.users.index');

Route::get('/products', function () {
    return view('app.pages.products.index');
})->name('admin.products.index');

Route::get('/transactions/stock-in', function () {
    return view('app.pages.transactions.stock-in');
})->name('admin.transactions.stockin');

Route::get('/transactions/stock-out', function () {
    return view('app.pages.transactions.stock-out');
})->name('admin.transactions.stockout');

Route::get('/categories', function () {
    return view('app.pages.categories.index');
})->name('admin.categories.index');

Route::get('/suppliers', function () {
    return view('app.pages.suppliers.index');
})->name('admin.suppliers.index');
