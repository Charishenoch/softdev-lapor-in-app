<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengguna')->insert([
            'nik' => '0000000000000000',
            'nama_lengkap' => 'Super Admin Lapor.in',
            'alamat' => 'Pusat Komando Lapor.in',
            'jenis_kelamin' => 'Laki-laki',
            'pekerjaan' => 'PNS',
            'tanggal_lahir' => '1990-01-01',
            'disabilitas' => 'Tidak',
            'nomor_wa' => '080000000000',
            'username' => 'admin_super',
            'email' => 'admin@lapor.in', // Ini Email buat Login
            'kata_sandi' => Hash::make('masambakuat123'), // Ini Password buat Login
            'role' => 'admin', 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}