<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app.pages.dashboard');
});

Route::get('/users', function () {
    return view('app.pages.users.index');
});
