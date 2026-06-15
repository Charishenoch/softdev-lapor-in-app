<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\PengaduanController;
use App\Http\Controllers\Api\AdminDashboardController;
use App\Http\Controllers\Api\AdminUserController;
use App\Http\Controllers\Api\RiwayatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArtikelController;

// --- RUTE PUBLIK ---
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/auth/reset-password', [AuthController::class, 'resetPassword']);

// --- RUTE PRIVATE ---
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);

    // Dashboard & Pengaduan User
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/stats', [DashboardController::class, 'stats']);
    Route::get('/dashboard/ongoing', [DashboardController::class, 'ongoing']);
    Route::post('/pengaduan', [PengaduanController::class, 'store']);
    Route::get('/riwayat', [RiwayatController::class, 'index']);

    // RUTE ARTIKEL EDUKASI 
    // (Udah dikeluarin dari prefix admin biar Warga & Admin bisa akses lewat /api/artikel)
    Route::post('/artikel', [ArtikelController::class, 'store']);
    Route::get('/artikel', [ArtikelController::class, 'index']);

    // Rute Admin (Prefix 'admin' akan otomatis menambahkan /admin di depan semua route di bawah ini)
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard/statistik', [AdminDashboardController::class, 'getStatistik']);
        
        // Rute untuk update statistik card di Control User
        Route::get('/statistik-user', [AdminDashboardController::class, 'getStatistikUser']);
        
        Route::get('/laporan', [AdminDashboardController::class, 'getSemuaLaporan']);
        Route::get('/laporan-darurat', [AdminDashboardController::class, 'getLaporanDarurat']);
        
        // Rute update status
        Route::post('/update-status/{id}', [AdminDashboardController::class, 'updateStatus']);

        // Rute save laporan penting
        Route::post('/laporan/{id}/tandai-penting', [AdminDashboardController::class, 'togglePenting']);

        // Rute laporan by kategori
        Route::get('/laporan-kategori/{id_kategori}', [AdminDashboardController::class, 'getLaporanByCategory']);

        // Rute User Control
        Route::get('/users', [AdminUserController::class, 'index']);
        Route::post('/users/{id}/update-role', [AdminUserController::class, 'updateRole']);
        Route::delete('/users/{id}', [AdminUserController::class, 'destroy']);
    });
});