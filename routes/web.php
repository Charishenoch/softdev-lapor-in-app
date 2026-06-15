<?php

use Illuminate\Support\Facades\Route;

// ==========================================
// 🛠️ ROUTE TESTER API BACKEND (Buatan Ivan)
// ==========================================
Route::get('/tes-ui-register', function () {
    return view('tes-register');
});

Route::get('/tes-ui-login', function () {
    return view('tes-login');
});

Route::get('/tes-ui-pengaduan', function () {
    return view('tes-pengaduan');
});


// ==========================================
// 🎨 ROUTE UI FRONTEND (Buatan Jo / Yehosyua)
// ==========================================

// Halaman Auth
Route::get('/', function () { return view('login'); }); // Halaman awal langsung ke Login
Route::get('/login', function () { return view('login'); });
// Tambahkan di routes/web.php
Route::post('/logout', function () {
    // Rute ini cuma buat ngelempar user balik ke halaman login secara visual
    return redirect('/login');
})->name('logout');
Route::get('/register', function () { return view('register'); });

// Halaman Utama Lapor.in
Route::get('/dashboard', function () { return view('dashboard'); });
Route::get('/lapor', function () { return view('lapor'); });
Route::get('/riwayat', function () { return view('riwayat'); });
Route::get('/edukasi', function () { return view('edukasi'); });

// Route Panel Admin
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () { return view('admin.dashboard'); });
    Route::get('/review', function () { return view('admin.review'); });
    Route::get('/users', function () { return view('admin.users'); });
    
    // Rute Manajemen Edukasi
    Route::get('/edukasi', function () { return view('admin.edukasi'); }); 
});