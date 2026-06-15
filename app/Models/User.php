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

    protected $table = 'pengguna';
    
    // WAJIB: Kasih tahu Laravel primary key-nya (biasanya 'id')
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'nik', 'nama_lengkap', 'alamat', 'jenis_kelamin', 
        'pekerjaan', 'tanggal_lahir', 'disabilitas', 
        'nomor_wa', 'username', 'email', 'kata_sandi', 'role',
    ];

    protected $hidden = [
        'kata_sandi', 
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }

    // PENTING: Gunakan protected function casts() yang standar Laravel 11
    // Kalau Laravel kamu versi lama, gunakan $casts = [...]
    protected $casts = [
        'kata_sandi' => 'hashed',
    ];
}