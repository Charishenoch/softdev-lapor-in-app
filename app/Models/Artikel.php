<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    // 1. Kasih tau Laravel nama tabelnya (Opsional, tapi penting kalau nama tabelmu bahasa Indonesia)
    // Karena kalau nggak didefinisikan, Laravel bakal nyari tabel bernama "artikels" (pakai 's')
    protected $table = 'artikel';

    // 2. Daftar kolom yang BOLEH diisi lewat form (Mass Assignment)
    protected $fillable = [
        'judul',
        'isi',
        'kategori',
        'thumbnail',
        'status',
    ];

    // (Opsional) Kalau kamu mau bikin URL gambar langsung full, bisa tambah Accessor ini:
    // Nanti di JS kamu tinggal panggil item.thumbnail_url biar nggak ribet nambahin /storage/ manual
    protected $appends = ['thumbnail_url'];

    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        return null;
    }
}