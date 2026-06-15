<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pastikan nama tabelnya 'artikel'
        Schema::create('artikel', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('isi'); // Pake text karena isi artikel biasanya panjang
            $table->string('kategori');
            $table->string('thumbnail'); // Buat nyimpen path/nama file foto
            $table->enum('status', ['publish', 'draft'])->default('draft'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikel');
    }
};