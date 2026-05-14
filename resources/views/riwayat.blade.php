@extends('layouts.app')

@section('title', 'Riwayat Laporan - Lapor.in')

@section('content')
<div class="max-w-4xl mx-auto">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#D32F0F] mb-2">Riwayat Laporan Saya</h1>
        <p class="text-gray-500">Pantau status dan progres laporan yang telah Anda kirimkan.</p>
    </div>

    <div class="space-y-4">

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300">
            <div class="bg-gradient-to-r from-[#F75702] to-[#B91408] p-4 flex justify-between items-center cursor-pointer text-white" onclick="toggleDetail('detail-1', this)">
                <div class="flex items-center gap-4">
                    <div class="bg-white text-[#D32F0F] rounded-full w-10 h-10 flex items-center justify-center font-bold flex-shrink-0">
                        <i class="fa-solid fa-exclamation text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg leading-tight">Selokan Mampet</h3>
                        <p class="text-xs text-white/80 mt-0.5"><i class="fa-regular fa-clock"></i> 11:20 AM | 11/05/2026</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 md:gap-6">
                    <span class="hidden md:inline text-sm font-medium opacity-90"><i class="fa-solid fa-road border-r border-white/30 pr-2 mr-2"></i>Infrastruktur & Fasilitas</span>
                    <span class="bg-yellow-400 text-yellow-900 text-xs font-black px-3 py-1.5 rounded-full uppercase tracking-wider shadow-sm">
                        Diproses
                    </span>
                    <i class="fa-solid fa-chevron-up transition-transform duration-300 text-white/80 icon-chevron"></i>
                </div>
            </div>

            <div id="detail-1" class="p-6">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">ID Laporan: <span class="text-gray-800">LPR-20260511-001</span></p>
                        <p class="text-gray-700 mt-2 text-sm italic">"Ada genangan air yang sangat banyak dikarenakan selokan mampet di jalan Ngadirejo..."</p>
                    </div>
                    <button class="flex items-center gap-2 border border-[#D32F0F] text-[#D32F0F] px-4 py-2 rounded-lg text-sm font-bold hover:bg-red-50 transition">
                        <i class="fa-regular fa-comment-dots"></i> Chat Admin
                    </button>
                </div>

                <div class="relative pl-4 sm:pl-6 border-l-2 border-gray-200 space-y-6 mt-6 ml-2 sm:ml-4">
                    
                    <div class="relative">
                        <div class="absolute -left-[25px] sm:-left-[33px] bg-green-500 w-4 h-4 rounded-full border-4 border-white shadow"></div>
                        <h4 class="font-bold text-gray-800 text-sm">Menunggu Evaluasi</h4>
                        <p class="text-xs text-gray-500 mt-1">Laporan berhasil diterima oleh sistem.</p>
                    </div>

                    <div class="relative">
                        <div class="absolute -left-[25px] sm:-left-[33px] bg-yellow-400 w-4 h-4 rounded-full border-4 border-white shadow ring-2 ring-yellow-200 animate-pulse"></div>
                        <h4 class="font-bold text-[#D32F0F] text-sm">Sedang Diproses</h4>
                        <p class="text-xs text-gray-600 mt-1">Admin Lapor.in (RT 02) sedang mengecek ke lokasi.</p>
                        <p class="text-[10px] text-gray-400 mt-0.5">12:30 PM | 11/05/2026</p>
                    </div>

                    <div class="relative">
                        <div class="absolute -left-[25px] sm:-left-[33px] bg-gray-300 w-4 h-4 rounded-full border-4 border-white"></div>
                        <h4 class="font-semibold text-gray-400 text-sm">Laporan Selesai</h4>
                        <p class="text-xs text-gray-400 mt-1">Menunggu konfirmasi penyelesaian dari admin.</p>
                    </div>

                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden transition-all duration-300">
            <div class="bg-gradient-to-r from-[#F75702] to-[#B91408] p-4 flex justify-between items-center cursor-pointer text-white" onclick="toggleDetail('detail-2', this)">
                <div class="flex items-center gap-4">
                    <div class="bg-white text-[#D32F0F] rounded-full w-10 h-10 flex items-center justify-center font-bold flex-shrink-0">
                        <i class="fa-solid fa-check text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg leading-tight">Lampu Jalan Mati</h3>
                        <p class="text-xs text-white/80 mt-0.5"><i class="fa-regular fa-clock"></i> 18:45 PM | 08/05/2026</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 md:gap-6">
                    <span class="hidden md:inline text-sm font-medium opacity-90"><i class="fa-solid fa-lightbulb border-r border-white/30 pr-2 mr-2"></i>Infrastruktur & Fasilitas</span>
                    <span class="bg-green-500 text-white text-xs font-black px-3 py-1.5 rounded-full uppercase tracking-wider shadow-sm">
                        Selesai
                    </span>
                    <i class="fa-solid fa-chevron-down transition-transform duration-300 text-white/80 icon-chevron"></i>
                </div>
            </div>

            <div id="detail-2" class="p-6 hidden">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <p class="text-sm text-gray-500 font-medium">ID Laporan: <span class="text-gray-800">LPR-20260508-012</span></p>
                        <p class="text-gray-700 mt-2 text-sm italic">"Lampu PJU di pertigaan gang 3 mati total, mohon segera diganti..."</p>
                    </div>
                </div>

                <div class="relative pl-4 sm:pl-6 border-l-2 border-green-500 space-y-6 mt-6 ml-2 sm:ml-4">
                    <div class="relative">
                        <div class="absolute -left-[25px] sm:-left-[33px] bg-green-500 w-4 h-4 rounded-full border-4 border-white shadow"></div>
                        <h4 class="font-bold text-gray-800 text-sm">Menunggu Evaluasi</h4>
                    </div>
                    <div class="relative">
                        <div class="absolute -left-[25px] sm:-left-[33px] bg-green-500 w-4 h-4 rounded-full border-4 border-white shadow"></div>
                        <h4 class="font-bold text-gray-800 text-sm">Sedang Diproses</h4>
                        <p class="text-xs text-gray-500 mt-1">Petugas PLN sudah dihubungi dan sedang menuju lokasi.</p>
                    </div>
                    <div class="relative">
                        <div class="absolute -left-[25px] sm:-left-[33px] bg-green-500 w-4 h-4 rounded-full border-4 border-white shadow ring-2 ring-green-200"></div>
                        <h4 class="font-bold text-green-600 text-sm">Laporan Selesai</h4>
                        <p class="text-xs text-gray-600 mt-1">Lampu sudah berhasil diganti dan menyala normal. Terima kasih laporannya!</p>
                        <p class="text-[10px] text-gray-400 mt-0.5">09:00 AM | 09/05/2026</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    // Fungsi untuk membuka/menutup detail laporan (Accordion)
    function toggleDetail(id, element) {
        const detailDiv = document.getElementById(id);
        const icon = element.querySelector('.icon-chevron');

        if (detailDiv.classList.contains('hidden')) {
            // Jika sedang tertutup, maka buka
            detailDiv.classList.remove('hidden');
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        } else {
            // Jika sedang terbuka, maka tutup
            detailDiv.classList.add('hidden');
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    }
</script>
@endsection