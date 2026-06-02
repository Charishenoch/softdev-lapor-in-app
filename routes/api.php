<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PengaduanController;
use Illuminate\Support\Facades\Route;

// Rute yang bebas diakses tanpa token
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rute yang wajib pakai token (dilindungi satpam Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/pengaduan', [PengaduanController::class, 'store']);
}); // <- Nah, ini kurung penutup yang tadi kamu lupa bro!