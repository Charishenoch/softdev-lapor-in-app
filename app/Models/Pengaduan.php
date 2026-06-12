<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    // Pastikan nama tabel sesuai dengan yang ada di database kamu
    protected $table = 'pengaduan';

    // Daftarkan kolom yang boleh diisi
    protected $fillable = [
        'id_pengguna',
        'id_kategori',
        'judul',
        'tanggal_kejadian', // Yang baru ditambah
        'waktu_kejadian',   // Yang baru ditambah
        'lokasi_kejadian',  // Sesuai DB
        'deskripsi_rsa',    // Sesuai DB
        'bukti_foto',       // Sesuai DB
        'status_laporan'    // Sesuai DB
    ];

    protected $casts = [
    'bukti_foto' => 'array',
    ];
}