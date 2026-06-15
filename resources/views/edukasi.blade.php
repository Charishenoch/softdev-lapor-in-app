@extends('layouts.app')

@section('title', 'Pusat Edukasi - Lapor.in')

@section('content')
<div class="max-w-6xl mx-auto mb-16">
    
    <div class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-[#D32F0F] mb-3">Pusat Edukasi & Informasi Lingkungan</h1>
        <p class="text-gray-600 text-lg">Temukan panduan pelaporan, tips keamanan, dan berita terbaru RT/RW kita.</p>
    </div>

    <div class="flex flex-col md:flex-row gap-4 justify-center items-center mb-12">
        <div class="relative w-full md:w-1/2 group">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <i class="fa-solid fa-magnifying-glass text-gray-400 group-focus-within:text-[#D32F0F] transition-colors"></i>
            </div>
            <input type="text" id="search-input" placeholder="Cari artikel atau panduan..." class="w-full border border-gray-300 pl-12 py-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D32F0F] pr-32 shadow-sm transition-all">
            <button id="btn-search" class="absolute right-2 top-1/2 -translate-y-1/2 bg-gradient-to-r from-[#F75702] to-[#B91408] text-white px-5 py-2 rounded-lg font-bold text-sm hover:shadow-md hover:opacity-95 transition">
                Cari
            </button>
        </div>
    </div>

    <div class="flex flex-wrap justify-center gap-3 mb-10" id="category-filters">
        <button class="filter-btn px-6 py-2 rounded-full bg-[#D32F0F] text-white font-bold shadow-md shadow-red-200 transition-all" data-kategori="Semua">Semua</button>
        <button class="filter-btn px-6 py-2 rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition-all" data-kategori="Keamanan">Keamanan</button>
        <button class="filter-btn px-6 py-2 rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition-all" data-kategori="Panduan Lapor">Panduan Lapor</button>
        <button class="filter-btn px-6 py-2 rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition-all" data-kategori="Kesehatan">Kesehatan</button>
    </div>

    <div id="list-artikel" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        </div>

</div>

@vite('resources/js/edukasi.js')
@endsection