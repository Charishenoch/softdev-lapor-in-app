<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\RsaService;

class PengaduanController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kategori'      => 'required|integer', 
            'judul'            => 'required|string|max:255',
            'isi_laporan'      => 'required|string',
            'tanggal_kejadian' => 'required|date',
            'waktu_kejadian'   => 'required',
            'lokasi'           => 'required|string',
            'bukti_lampiran'   => 'required|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $pathLampiran = $request->file('bukti_lampiran')->store('bukti_laporan', 'public');

        $teksAman = RsaService::encrypt($request->isi_laporan);

        $pengaduan = Pengaduan::create([
            'id_pengguna'      => $request->user()->id, 
            'id_kategori'      => $request->id_kategori,
            'judul'            => $request->judul,
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'waktu_kejadian'   => $request->waktu_kejadian,
            'lokasi_kejadian'  => $request->lokasi,         
            'deskripsi_rsa'    => $teksAman,    
            'bukti_foto'       => $pathLampiran,            
            'status_laporan'   => 'terkirim',               
        ]);

        return response()->json([
            'message' => 'Laporan berhasil dikirim boss!',
            'data'    => $pengaduan
        ], 201);
    }
}