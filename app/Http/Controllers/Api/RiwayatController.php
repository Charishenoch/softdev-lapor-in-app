<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Services\RsaService;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil semua laporan berdasarkan ID User yang lagi login
        $laporans = Pengaduan::where('id_pengguna', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Dekripsi pesan dan decode JSON foto
        $laporans->transform(function ($item) {
            try {
                // Proses dekripsi normal
                $hasilDekripsi = RsaService::decrypt($item->deskripsi_rsa);
                
                // OBAT ANTI ERROR UTF-8
                $item->deskripsi_asli = mb_convert_encoding($hasilDekripsi, 'UTF-8', 'UTF-8');
                
            } catch (\Exception $e) {
                $item->deskripsi_asli = "[Data gagal didekripsi]";
            }
            
            $item->bukti_foto = json_decode($item->bukti_foto, true) ?? [];
            return $item;
        });

        return response()->json([
            'success' => true,
            'data' => $laporans
        ]);
    }
}