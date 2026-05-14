<?php

use Illuminate\Support\Facades\Route;

// Halaman Auth
Route::get('/', function () { return view('login'); }); // Halaman awal langsung ke Login
Route::get('/login', function () { return view('login'); });
Route::get('/register', function () { return view('register'); });

// Halaman Utama Lapor.in
Route::get('/dashboard', function () { return view('dashboard'); });
Route::get('/lapor', function () { return view('lapor'); });
Route::get('/riwayat', function () { return view('riwayat'); });
Route::get('/edukasi', function () { return view('edukasi'); });