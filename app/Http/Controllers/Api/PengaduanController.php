<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan; // Pastikan model ini ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengaduanController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validasi Input dari Front-End
        $validator = Validator::make($request->all(), [
            'id_kategori'      => 'required|integer', // Dari dropdown Klasifikasi
            'judul'            => 'required|string|max:255',
            'isi_laporan'      => 'required|string',
            'tanggal_kejadian' => 'required|date',
            'waktu_kejadian'   => 'required',
            'lokasi'           => 'required|string',
            'bukti_lampiran'   => 'required|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // 2. Handle Upload File Bukti
        // File akan otomatis masuk ke folder storage/app/public/bukti_laporan
        $pathLampiran = $request->file('bukti_lampiran')->store('bukti_laporan', 'public');

        // 3. Simpan ke Database
        $pengaduan = Pengaduan::create([
            'id_pengguna'      => $request->user()->id, 
            'id_kategori'      => $request->id_kategori,
            'judul'            => $request->judul,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'waktu_kejadian'   => $request->waktu_kejadian,
            'lokasi_kejadian'  => $request->lokasi,         // Dari request 'lokasi' masuk ke 'lokasi_kejadian'
            'deskripsi_rsa'    => $request->isi_laporan,    // Dari 'isi_laporan' masuk ke 'deskripsi_rsa'
            'bukti_foto'       => $pathLampiran,            // Foto masuk ke 'bukti_foto'
            'status_laporan'   => 'terkirim',               // Pakai 'terkirim' sesuai enum di databasemu
        ]);

        return response()->json([
            'message' => 'Laporan berhasil dikirim boss!',
            'data'    => $pengaduan
        ], 201);
    }
}