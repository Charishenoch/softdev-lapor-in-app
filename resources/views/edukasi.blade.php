@extends('layouts.app')

@section('title', 'Pusat Edukasi - Lapor.in')

@section('content')
<div class="max-w-6xl mx-auto">
    
    <div class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-[#D32F0F] mb-3">Pusat Edukasi & Informasi Lingkungan</h1>
        <p class="text-gray-600 text-lg">Temukan panduan pelaporan, tips keamanan, dan berita terbaru RT/RW kita.</p>
    </div>

    <div class="flex flex-col md:flex-row gap-4 justify-center items-center mb-12">
        <div class="relative w-full md:w-1/2 group">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <i class="fa-solid fa-magnifying-glass text-gray-400 group-focus-within:text-[#D32F0F] transition-colors"></i>
            </div>
            <input type="text" placeholder="Cari artikel atau panduan..." class="w-full border border-gray-300 pl-12 py-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D32F0F] pr-32 shadow-sm transition-all">
            <button class="absolute right-2 top-1/2 -translate-y-1/2 bg-gradient-to-r from-[#F75702] to-[#B91408] text-white px-5 py-2 rounded-lg font-bold text-sm hover:shadow-md hover:opacity-95 transition">
                Cari
            </button>
        </div>
    </div>

    <div class="flex flex-wrap justify-center gap-3 mb-10" id="category-filters">
        <button class="filter-btn px-6 py-2 rounded-full bg-[#D32F0F] text-white font-bold shadow-md shadow-red-200 transition-all">Semua</button>
        <button class="filter-btn px-6 py-2 rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition-all">Keamanan</button>
        <button class="filter-btn px-6 py-2 rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition-all">Panduan Lapor</button>
        <button class="filter-btn px-6 py-2 rounded-full bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition-all">Kesehatan</button>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition group flex flex-col cursor-pointer">
            <div class="h-44 bg-gray-200 overflow-hidden relative">
                <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?q=80&w=500" alt="Edukasi" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm p-1.5 rounded-lg shadow-sm">
                    <i class="fa-regular fa-bookmark text-gray-500 hover:text-[#D32F0F] transition"></i>
                </div>
            </div>
            <div class="p-5 flex flex-col flex-grow">
                <span class="text-[10px] font-black text-[#D32F0F] tracking-widest uppercase mb-2 block">Panduan Lapor</span>
                <h3 class="font-bold text-gray-800 leading-snug mb-3 line-clamp-2 flex-grow group-hover:text-[#D32F0F] transition-colors">Cara Menjadi Pelapor yang Aktif & Bijak di Lingkungan</h3>
                
                <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                    <div class="flex items-center gap-2 text-[11px] text-gray-500">
                        <img src="https://ui-avatars.com/api/?name=Admin+Laporin&background=random" class="w-6 h-6 rounded-full">
                        <span class="font-medium">Admin</span>
                    </div>
                    <div class="flex items-center gap-1 text-[11px] text-gray-400 font-medium">
                        <i class="fa-regular fa-clock"></i> 10 Mei 2026
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition group flex flex-col cursor-pointer">
            <div class="h-44 bg-gray-200 overflow-hidden relative">
                <img src="https://images.unsplash.com/photo-1506784983877-45594efa4cbe?q=80&w=500" alt="Edukasi" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm p-1.5 rounded-lg shadow-sm">
                    <i class="fa-regular fa-bookmark text-gray-500 hover:text-[#D32F0F] transition"></i>
                </div>
            </div>
            <div class="p-5 flex flex-col flex-grow">
                <span class="text-[10px] font-black text-[#D32F0F] tracking-widest uppercase mb-2 block">Keamanan</span>
                <h3 class="font-bold text-gray-800 leading-snug mb-3 line-clamp-2 flex-grow group-hover:text-[#D32F0F] transition-colors">Tips Menjaga Keamanan Lingkungan Saat Musim Liburan</h3>
                
                <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                    <div class="flex items-center gap-2 text-[11px] text-gray-500">
                        <img src="https://ui-avatars.com/api/?name=Humas+Kediri&background=random" class="w-6 h-6 rounded-full">
                        <span class="font-medium">Humas</span>
                    </div>
                    <div class="flex items-center gap-1 text-[11px] text-gray-400 font-medium">
                        <i class="fa-regular fa-clock"></i> 08 Mei 2026
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition group flex flex-col cursor-pointer">
            <div class="h-44 bg-gray-200 overflow-hidden relative">
                <img src="https://images.unsplash.com/photo-1532996122724-e3c354a0b15b?q=80&w=500" alt="Edukasi" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm p-1.5 rounded-lg shadow-sm">
                    <i class="fa-regular fa-bookmark text-gray-500 hover:text-[#D32F0F] transition"></i>
                </div>
            </div>
            <div class="p-5 flex flex-col flex-grow">
                <span class="text-[10px] font-black text-[#D32F0F] tracking-widest uppercase mb-2 block">Kesehatan</span>
                <h3 class="font-bold text-gray-800 leading-snug mb-3 line-clamp-2 flex-grow group-hover:text-[#D32F0F] transition-colors">Pentingnya Kerja Bakti Membersihkan Selokan Warga</h3>
                
                <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                    <div class="flex items-center gap-2 text-[11px] text-gray-500">
                        <img src="https://ui-avatars.com/api/?name=Puskesmas&background=random" class="w-6 h-6 rounded-full">
                        <span class="font-medium">Kader</span>
                    </div>
                    <div class="flex items-center gap-1 text-[11px] text-gray-400 font-medium">
                        <i class="fa-regular fa-clock"></i> 05 Mei 2026
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition group flex flex-col cursor-pointer">
            <div class="h-44 bg-gray-200 overflow-hidden relative">
                <img src="https://images.unsplash.com/photo-1577962917302-cd874c4e31d2?q=80&w=500" alt="Edukasi" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm p-1.5 rounded-lg shadow-sm">
                    <i class="fa-regular fa-bookmark text-gray-500 hover:text-[#D32F0F] transition"></i>
                </div>
            </div>
            <div class="p-5 flex flex-col flex-grow">
                <span class="text-[10px] font-black text-[#D32F0F] tracking-widest uppercase mb-2 block">Infrastruktur</span>
                <h3 class="font-bold text-gray-800 leading-snug mb-3 line-clamp-2 flex-grow group-hover:text-[#D32F0F] transition-colors">Alur Pelaporan Lampu Jalan Mati ke Pihak Terkait</h3>
                
                <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                    <div class="flex items-center gap-2 text-[11px] text-gray-500">
                        <img src="https://ui-avatars.com/api/?name=Admin+Laporin&background=random" class="w-6 h-6 rounded-full">
                        <span class="font-medium">Admin</span>
                    </div>
                    <div class="flex items-center gap-1 text-[11px] text-gray-400 font-medium">
                        <i class="fa-regular fa-clock"></i> 01 Mei 2026
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="flex justify-center items-center gap-2 mt-12">
        <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-400 hover:bg-gray-50"><i class="fa-solid fa-chevron-left"></i></button>
        <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-[#D32F0F] text-white font-bold shadow-md shadow-red-100">1</button>
        <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium">2</button>
        <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-600 hover:bg-gray-50 font-medium">3</button>
        <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-400 hover:bg-gray-50"><i class="fa-solid fa-chevron-right"></i></button>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterBtns = document.querySelectorAll('.filter-btn');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Hapus styling aktif dari semua tombol
                filterBtns.forEach(b => {
                    b.classList.remove('bg-[#D32F0F]', 'text-white', 'shadow-md', 'shadow-red-200', 'font-bold');
                    b.classList.add('bg-white', 'text-gray-600', 'border', 'border-gray-200');
                });

                // Tambahkan styling aktif ke tombol yang baru saja diklik
                this.classList.remove('bg-white', 'text-gray-600', 'border', 'border-gray-200');
                this.classList.add('bg-[#D32F0F]', 'text-white', 'shadow-md', 'shadow-red-200', 'font-bold');
            });
        });
    });
</script>
@endsection