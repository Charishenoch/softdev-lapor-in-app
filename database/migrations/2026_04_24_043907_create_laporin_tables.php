<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Tabel Kategori [cite: 109, 111]
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori');
            $table->timestamps();
        });

        // 2. Tabel Pengguna [cite: 110]
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16)->unique();
            $table->string('nama_lengkap');
            $table->string('nomor_wa');
            $table->string('email')->unique();
            $table->string('kata_sandi');
            $table->enum('role', ['warga', 'admin', 'superadmin']);
            $table->timestamps();
        });

        // 3. Tabel Pengaduan (RSA) [cite: 111, 124]
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengguna')->constrained('pengguna');
            $table->foreignId('id_kategori')->constrained('kategori');
            $table->text('lokasi_kejadian');
            $table->text('deskripsi_rsa'); // Implementasi RSA Backend 
            $table->string('bukti_foto')->nullable();
            $table->enum('status_laporan', ['terkirim', 'proses', 'selesai', 'ditolak'])->default('terkirim');
            $table->boolean('apakah_anonim')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporin_tables');
    }
};
