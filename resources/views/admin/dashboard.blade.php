@extends('layouts.admin')

@section('content')
<div class="space-y-8 p-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col h-[400px]">
            <div class="bg-[#D32F0F] text-white p-6">
                <h2 class="text-3xl font-extrabold tracking-tight">Statistik Laporan</h2>
            </div>
            <div class="p-6 flex-grow flex flex-col items-center justify-center">
                <div class="w-full flex justify-center items-center mb-6" style="height: 180px;">
                    <canvas id="statistikChart" ></canvas>
                </div>
                <div class="space-y-3 w-full px-4">
                    <div class="flex items-center text-sm font-bold text-gray-800"><span class="w-4 h-4 bg-[#4A0404] mr-3 rounded-sm"></span>Laporan Masuk</div>
                    <div class="flex items-center text-sm font-bold text-gray-800"><span class="w-4 h-4 bg-[#B91C1C] mr-3 rounded-sm"></span>Laporan dalam proses</div>
                    <div class="flex items-center text-sm font-bold text-gray-800"><span class="w-4 h-4 bg-[#FF4500] mr-3 rounded-sm"></span>Laporan Selesai</div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 flex flex-col">
            <div class="mb-6 flex justify-center">
                <h2 class="text-3xl font-bold text-[#D32F0F]">Laporan Penting</h2>
            </div>
            <div id="laporan-penting-container" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                </div>
        </div>
    </div> <div class="mt-10">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-[#D32F0F]">Rincian Laporan</h2>
                <p class="text-[#D32F0F]">Data laporan masuk pada tiap-tiap kategori dalam rentang waktu :</p>
            </div>
            <div class="flex items-center gap-2">
                <input type="date" id="tgl-mulai" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <span>sampai</span>
                <input type="date" id="tgl-akhir" class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                <button onclick="filterLaporan()" class="bg-[#D32F0F] text-white px-4 py-2 rounded-lg font-bold hover:bg-[#b0270c]">Filter</button>
            </div>
        </div>

        <div class="flex flex-wrap justify-center gap-6 mt-8">
            @foreach([
                ['nama' => 'Infrastruktur<br>& Fasilitas', 'id' => 'inf'],
                ['nama' => 'Keamanan<br>& Ketertiban', 'id' => 'kea'],
                ['nama' => 'Kebersihan<br>& Lingkungan', 'id' => 'keb'],
                ['nama' => 'Aspirasi<br>& Saran', 'id' => 'asp'],
                ['nama' => 'Administrasi<br>& Pelayanan', 'id' => 'adm']
            ] as $kat)
            <div class="bg-white p-4 rounded-2xl shadow-lg border border-gray-100 flex items-center justify-between w-full md:w-[320px]">
                <h3 class="font-bold text-gray-800 text-lg leading-tight w-2/3">
                    {!! $kat['nama'] !!}
                </h3>
                <div id="kat-{{ $kat['id'] }}" class="bg-[#D32F0F] text-white font-black text-3xl px-6 py-4 rounded-xl">
                    0
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@vite(['resources/js/dashboard-admin.js'])
@endsection