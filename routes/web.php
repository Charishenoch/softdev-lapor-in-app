<?php

use Illuminate\Support\Facades\Route;

// Ubah rute default '/' agar menampilkan register.blade.php
Route::get('/', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/lapor', function () {
    return view('lapor');
});