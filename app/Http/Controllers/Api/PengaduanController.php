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
            'id_pengguna'      => $request->user()->id, // Otomatis ambil ID dari Token Login!
            'id_kategori'      => $request->id_kategori,
            'judul'            => $request->judul,
            'isi_laporan'      => $request->isi_laporan, // Catatan: Nanti ini yang bakal kita Enkripsi RSA
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'waktu_kejadian'   => $request->waktu_kejadian,
            'lokasi'           => $request->lokasi,
            'bukti_lampiran'   => $pathLampiran,
            'status'           => 'Pending', // Status awal laporan
        ]);

        return response()->json([
            'message' => 'Laporan berhasil dikirim boss!',
            'data'    => $pengaduan
        ], 201);
    }
}