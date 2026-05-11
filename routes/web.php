<?php

use Illuminate\Support\Facades\Route;

// Ubah rute default '/' agar menampilkan register.blade.php
Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/lapor', function () {
    return view('lapor');
});

Route::get('/riwayat', function () {
    return view('riwayat');
});

Route::get('/edukasi', function () {
    return view('edukasi');
});
