<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Services\RsaService;

class AdminDashboardController extends Controller
{
    public function getSemuaLaporan()
    {
        $laporans = Pengaduan::select('pengaduan.*', 'pengguna.nama_lengkap as nama_warga')
            ->leftJoin('pengguna', 'pengaduan.id_pengguna', '=', 'pengguna.id')
            ->orderBy('pengaduan.created_at', 'desc')
            ->get();

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
            'message' => 'Data laporan ditarik dan gembok RSA sukses dibuka!',
            'data' => $laporans
        ], 200);
    }
}