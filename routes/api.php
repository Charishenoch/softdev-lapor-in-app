<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PengaduanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminDashboardController;

// Rute yang bebas diakses tanpa token
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login'); 

// Rute Admin dikeluarin untuk cek laporan
Route::get('/admin/laporan', [AdminDashboardController::class, 'getSemuaLaporan']);

// Rute yang wajib pakai token (dilindungi satpam Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/pengaduan', [PengaduanController::class, 'store']);
});