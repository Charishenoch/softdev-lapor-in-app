@extends('layouts.admin')

@section('title', 'Pemantauan Laporan - Lapor.in')

@section('content')
<div class="space-y-6">

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        
        <div class="p-6 border-b border-gray-200 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
            <div>
                <h2 class="text-2xl font-bold text-[#D32F0F] uppercase tracking-wide">DARURAT</h2>
                <p class="text-[#D32F0F] text-sm font-medium">Data laporan kejadian "DARURAT" di wilayah Anda.</p>
            </div>
            
            <div class="flex flex-col sm:flex-row w-full lg:w-auto items-center gap-3">
                <div class="relative w-full sm:w-48">
                <select id="filter-status" class="w-full md:w-48 p-2 border border-gray-300 rounded-lg outline-none">
                    <option value="all">Semua Status</option>
                    <option value="terkirim">Terkirim</option>
                    <option value="proses">Proses Review</option>
                    <option value="penanganan">Penanganan</option>
                    <option value="selesai">Selesai</option>
                </select>
                </div>
                <div class="relative w-full sm:w-64">
                    <input type="text" placeholder="Cari ID atau Keterangan..." class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-[#D32F0F] focus:border-[#D32F0F] block pl-10 p-2.5 outline-none transition shadow-sm">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 font-bold">Timestamp</th>
                        <th class="px-6 py-4 font-bold">Keterangan</th>
                        <th class="px-6 py-4 font-bold">Lokasi</th>
                        <th class="px-6 py-4 font-bold">Status</th>
                        <th class="px-6 py-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-darurat-body">
                    <!-- Data realtime akan muncul di sini -->
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-gray-50 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-600">
            <span id="pagination-info">Menampilkan semua data.</span>
            
            <div class="flex items-center gap-1" id="pagination-nav">
                <!-- Tombol navigasi bakal muncul di sini -->
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-300 bg-white">1</button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-300 bg-white">2</button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-300 bg-white">3</button>
            </div>

            <a href="#" class="text-[#D32F0F] hover:underline font-semibold transition">Close list.</a>
        </div>
    </div>

    <!-- Kategori Cards -->
    <div class="bg-white rounded-2xl p-6 border flex flex-col">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-[#D32F0F]">Infrastruktur & Fasilitas</h2>
                <p class="text-[#D32F0F] text-sm mt-1">
                    Terdapat <span id="kat-1" class="font-bold text-lg">0</span> laporan.
                </p>
            </div>
            <button onclick="toggleDropdown(1, this)" class="text-[#D32F0F] font-bold underline">OPEN LIST.</button>
        </div>
        <div id="dropdown-1" class="hidden w-full overflow-x-auto"></div>
    </div>

    <div class="bg-white rounded-2xl p-6 border flex flex-col">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-[#D32F0F]">Keamanan & Ketertiban</h2>
                <p class="text-[#D32F0F] text-sm mt-1">
                    Terdapat <span id="kat-2" class="font-bold text-lg">0</span> laporan.
                </p>
            </div>
            <button onclick="toggleDropdown(2, this)" class="text-[#D32F0F] font-bold underline">OPEN LIST.</button>
        </div>
        <div id="dropdown-2" class="hidden w-full overflow-x-auto"></div>
    </div>

    <div class="bg-white rounded-2xl p-6 border flex flex-col">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-[#D32F0F]">Kebersihan & Lingkungan</h2>
                <p class="text-[#D32F0F] text-sm mt-1">
                    Terdapat <span id="kat-3" class="font-bold text-lg">0</span> laporan.
                </p>
            </div>
            <button onclick="toggleDropdown(3, this)" class="text-[#D32F0F] font-bold underline">OPEN LIST.</button>
        </div>
        <div id="dropdown-3" class="hidden w-full overflow-x-auto"></div>
    </div>

    <div class="bg-white rounded-2xl p-6 border flex flex-col">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-[#D32F0F]">Aspirasi & Saran</h2>
                <p class="text-[#D32F0F] text-sm mt-1">
                    Terdapat <span id="kat-4" class="font-bold text-lg">0</span> laporan.
                </p>
            </div>
            <button onclick="toggleDropdown(4, this)" class="text-[#D32F0F] font-bold underline">OPEN LIST.</button>
        </div>
        <div id="dropdown-4" class="hidden w-full overflow-x-auto"></div>
    </div>

    <div class="bg-white rounded-2xl p-6 border flex flex-col">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-[#D32F0F]">Administrasi & Pelayanan</h2>
                <p class="text-[#D32F0F] text-sm mt-1">
                    Terdapat <span id="kat-5" class="font-bold text-lg">0</span> laporan.
                </p>
            </div>
            <button onclick="toggleDropdown(5, this)" class="text-[#D32F0F] font-bold underline">OPEN LIST.</button>
        </div>
        <div id="dropdown-5" class="hidden w-full overflow-x-auto"></div>
    </div>

</div>
@vite(['resources/js/pemantauan.js'])
@endsection