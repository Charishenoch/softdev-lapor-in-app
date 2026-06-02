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
        'isi_laporan',
        'tanggal_kejadian',
        'waktu_kejadian',
        'lokasi',
        'bukti_lampiran',
        'status'
    ];
}