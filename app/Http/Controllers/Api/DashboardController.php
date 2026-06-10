<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan; // Ingat, nama modelmu Pengaduan bukan Laporan
use Illuminate\Http\Request;
use App\Services\RsaService;

class DashboardController extends Controller
{
    // 1. GET /api/dashboard -> Menampilkan User Greeting
    public function index(Request $request)
        {
            $user = $request->user();

            return response()->json([
                'success' => true,
                // Ubah di sini lek, pakai username
                'message' => 'Selamat Datang, ' . $user->username, 
                'data' => [
                    'user' => [
                        'nama_lengkap' => $user->nama_lengkap,
                        'username' => $user->username,
                        'email' => $user->email,
                        'role' => $user->role
                    ]
                ]
            ], 200);
        }

    // 2. GET /api/dashboard/stats -> Statistik laporan milik user yang login
    public function stats(Request $request)
    {
        $userId = $request->user()->id;

        // Hitung-hitungan laporan khusus buat user ini aja
        $total = Pengaduan::where('id_pengguna', $userId)->count();
        $terkirim = Pengaduan::where('id_pengguna', $userId)->where('status_laporan', 'terkirim')->count();
        $diproses = Pengaduan::where('id_pengguna', $userId)->where('status_laporan', 'proses')->count();
        $selesai = Pengaduan::where('id_pengguna', $userId)->where('status_laporan', 'selesai')->count();

        return response()->json([
            'success' => true,
            'message' => 'Statistik laporan berhasil ditarik',
            'data' => [
                'total_laporan' => $total,
                'terkirim' => $terkirim,
                'diproses' => $diproses,
                'selesai' => $selesai
            ]
        ], 200);
    }

    // 3. GET /api/dashboard/ongoing -> Menampilkan maks 2 laporan yang sedang diproses
    public function ongoing(Request $request)
    {
        $userId = $request->user()->id;

        // Tarik maksimal 2 data terbaru yang statusnya 'proses'
        $laporans = Pengaduan::where('id_pengguna', $userId)
            ->where('status_laporan', 'proses')
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        // Buka gembok RSA biar FE bisa nampilin deskripsi aslinya
        $laporans->transform(function ($item) {
            try {
                $item->deskripsi_asli = RsaService::decrypt($item->deskripsi_rsa);
            } catch (\Exception $e) {
                $item->deskripsi_asli = "[Data gagal didekripsi]";
            }
            return $item;
        });

        return response()->json([
            'success' => true,
            'message' => 'Data laporan berjalan berhasil ditarik',
            'data' => $laporans
        ], 200);
    }
}