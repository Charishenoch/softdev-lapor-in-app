<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // 1. Kasih tahu Laravel kalau kita pakai tabel "pengguna", bukan "users"
    protected $table = 'pengguna';

    // 2. Daftarkan semua kolom yang boleh diisi dari form (Mass Assignment)
    protected $fillable = [
        'nik',
        'nama_lengkap',
        'alamat',
        'jenis_kelamin',
        'pekerjaan',
        'tanggal_lahir',
        'disabilitas',
        'nomor_wa',
        'username',
        'email',
        'kata_sandi',
        'role',
    ];

    // 3. Sembunyikan kata sandi saat data diambil biar aman
    protected $hidden = [
        'kata_sandi', // Ganti 'password' jadi 'kata_sandi'
        'remember_token',
    ];

    // 4. Beri tahu Laravel kalau kolom password kita namanya 'kata_sandi'
    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'kata_sandi' => 'hashed', // Hash otomatis untuk kata_sandi
        ];
    }
}