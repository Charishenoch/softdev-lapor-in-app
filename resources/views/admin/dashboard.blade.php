@extends('layouts.admin')

@section('title', 'Dashboard Admin - Lapor.in')

@section('content')
<div class="space-y-8">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
            <div class="bg-[#D32F0F] text-white p-4 text-center">
                <h2 class="text-2xl font-bold">Statistik Laporan</h2>
            </div>
            <div class="p-6 flex-grow flex flex-col items-center justify-center">
                <div class="relative w-48 h-24 overflow-hidden mb-6 mt-4">
                    <div class="absolute top-0 left-0 w-48 h-48 rounded-full border-[30px] border-[#D32F0F] border-b-transparent border-l-[#800000] border-r-[#FF4500] transform -rotate-45"></div>
                    <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 flex flex-col items-center">
                        <span class="text-3xl font-black text-gray-800">42</span>
                        <span class="text-[10px] text-gray-500 font-bold uppercase">Total</span>
                    </div>
                </div>
                
                <div class="w-full space-y-3 mt-4">
                    <div class="flex items-center text-sm font-semibold text-gray-700">
                        <span class="w-3 h-3 bg-[#800000] rounded-sm mr-3"></span> Laporan Masuk
                        <span class="ml-auto">15</span>
                    </div>
                    <div class="flex items-center text-sm font-semibold text-gray-700">
                        <span class="w-3 h-3 bg-[#FFDAB9] rounded-sm mr-3"></span> Laporan dalam proses
                        <span class="ml-auto">12</span>
                    </div>
                    <div class="flex items-center text-sm font-semibold text-gray-700">
                        <span class="w-3 h-3 bg-[#FF4500] rounded-sm mr-3"></span> Laporan Selesai
                        <span class="ml-auto">15</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 bg-gray-50 rounded-2xl p-6 border border-gray-100">
            <h2 class="text-3xl font-bold text-[#D32F0F] mb-6 text-center lg:text-left">Laporan Penting</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @for ($i = 0; $i < 6; $i++)
                <div class="bg-[#B91408] text-white rounded-xl p-4 flex gap-3 hover:bg-[#990F05] transition cursor-pointer shadow-sm">
                    <div class="flex-shrink-0 mt-1">
                        <div class="bg-white text-[#B91408] rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold">
                            <i class="fa-solid fa-exclamation"></i>
                        </div>
                    </div>
                    <div class="w-full">
                        <h3 class="font-bold text-sm tracking-wide">NAMA LAPORAN DARURAT</h3>
                        <div class="flex justify-between items-end mt-2">
                            <span class="text-[11px] text-white/80 font-medium">00.00 WIB [DD/MM/YYYY]</span>
                            <span class="text-[10px] bg-white/20 px-2 py-0.5 rounded font-medium">Nama Kategori</span>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>

    <div class="mt-10">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-6 border-b pb-4 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-[#D32F0F] mb-1">Rincian Laporan</h2>
                <p class="text-[#D32F0F] font-medium text-sm">Data laporan masuk pada tiap-tiap kategori dalam rentang waktu :</p>
            </div>
            
            <div class="flex items-center gap-3">
                <div class="relative">
                    <input type="text" value="12 Mar 2026" class="border border-gray-300 rounded-lg px-4 py-2 text-sm font-semibold text-gray-700 focus:ring-2 focus:ring-[#D32F0F] outline-none w-36 cursor-pointer bg-white" readonly>
                    <i class="fa-regular fa-calendar absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                </div>
                <span class="text-gray-400 font-bold">-</span>
                <div class="relative">
                    <input type="text" value="12 Apr 2026" class="border border-gray-300 rounded-lg px-4 py-2 text-sm font-semibold text-gray-700 focus:ring-2 focus:ring-[#D32F0F] outline-none w-36 cursor-pointer bg-white" readonly>
                    <i class="fa-regular fa-calendar absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap justify-center gap-4 md:gap-6">
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center justify-between w-full sm:w-64 hover:shadow-md transition">
                <span class="font-bold text-gray-800 leading-tight">Infrastruktur<br>& Fasilitas</span>
                <div class="bg-[#D32F0F] text-white text-3xl font-black px-4 py-2 rounded-lg">23</div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center justify-between w-full sm:w-64 hover:shadow-md transition">
                <span class="font-bold text-gray-800 leading-tight">Keamanan<br>& Ketertiban</span>
                <div class="bg-[#D32F0F] text-white text-3xl font-black px-4 py-2 rounded-lg">7</div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center justify-between w-full sm:w-64 hover:shadow-md transition">
                <span class="font-bold text-gray-800 leading-tight">Kebersihan<br>& Lingkungan</span>
                <div class="bg-[#D32F0F] text-white text-3xl font-black px-4 py-2 rounded-lg">12</div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center justify-between w-full sm:w-64 hover:shadow-md transition">
                <span class="font-bold text-gray-800 leading-tight">Aspirasi<br>& Saran</span>
                <div class="bg-[#D32F0F] text-white text-3xl font-black px-4 py-2 rounded-lg">17</div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 flex items-center justify-between w-full sm:w-64 hover:shadow-md transition">
                <span class="font-bold text-gray-800 leading-tight">Administrasi<br>& Pelayanan</span>
                <div class="bg-[#D32F0F] text-white text-3xl font-black px-4 py-2 rounded-lg">3</div>
            </div>

        </div>
    </div>

</div>
@endsection