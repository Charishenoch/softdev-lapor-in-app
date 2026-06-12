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

    // 3. Fungsi buat Admin ngubah status laporan (Request Charis)
    public function updateStatus(Request $request, $id)
    {
        // Validasi, pastikan status yang dikirim FE sesuai sama enum di database
        $request->validate([
            'status_laporan' => 'required|in:terkirim,proses,selesai'
        ]);

        // Cari laporan berdasarkan ID-nya
        $laporan = Pengaduan::find($id);

        if (!$laporan) {
            return response()->json([
                'success' => false, 
                'message' => 'Waduh, Laporan tidak ditemukan boss!'
            ], 404);
        }

        // Update statusnya dan simpan ke database
        $laporan->status_laporan = $request->status_laporan;
        $laporan->save();

        return response()->json([
            'success' => true,
            'message' => 'Mantap! Status laporan berhasil diubah jadi ' . $request->status_laporan,
            'data' => $laporan
        ], 200);
    }
}