<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\PengaduanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminDashboardController;
use App\Http\Controllers\Api\RiwayatController;

// Rute yang bebas diakses tanpa token
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login'])->name('login'); 

// Rute Admin dikeluarin untuk cek laporan
Route::get('/admin/laporan', [AdminDashboardController::class, 'getSemuaLaporan']);
Route::post('/admin/laporan/{id}/status', [AdminDashboardController::class, 'updateStatus']);

// Rute yang wajib pakai token (dilindungi satpam Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/pengaduan', [PengaduanController::class, 'store']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);

// Rute Forget dan Reset PW
Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/auth/reset-password', [AuthController::class, 'resetPassword']);

// Rute Dashboard User
Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/stats', [DashboardController::class, 'stats']);
    Route::get('/dashboard/ongoing', [DashboardController::class, 'ongoing']);

// Rute Riwayat Laporan
Route::get('/riwayat', [RiwayatController::class, 'index']);
});