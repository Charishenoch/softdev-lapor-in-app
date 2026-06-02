<?php

use Illuminate\Support\Facades\Route;

//test Ui
Route::get('/tes-ui-register', function () {
    return view('tes-register');
});

//login
Route::get('/tes-ui-login', function () {
    return view('tes-login');
});

// UI Tester buat Pengaduan
Route::get('/tes-ui-pengaduan', function () {
    return view('tes-pengaduan');
});
