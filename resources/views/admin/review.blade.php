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
                    <select class="w-full bg-white border border-gray-300 text-gray-700 text-sm rounded-full focus:ring-[#D32F0F] focus:border-[#D32F0F] block p-2.5 px-4 appearance-none outline-none cursor-pointer transition shadow-sm">
                        <option value="" selected>Semua Status</option>
                        <option value="terkirim">Terkirim</option>
                        <option value="proses">Proses Review</option>
                        <option value="penanganan">Penanganan</option>
                        <option value="selesai">Selesai</option>
                    </select>
                    <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
                </div>

                <div class="relative w-full sm:w-64">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    </div>
                    <input type="text" placeholder="Cari ID atau Keterangan..." class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-[#D32F0F] focus:border-[#D32F0F] block pl-10 p-2.5 outline-none transition shadow-sm">
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-bold">Timestamp</th>
                        <th scope="col" class="px-6 py-4 font-bold">Keterangan</th>
                        <th scope="col" class="px-6 py-4 font-bold">Lokasi</th>
                        <th scope="col" class="px-6 py-4 font-bold">Status</th>
                        <th scope="col" class="px-6 py-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b hover:bg-red-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800">12/05/26 - 14.30</td>
                        <td class="px-6 py-4 max-w-xs truncate" title="Pohon tumbang menghalangi jalan utama...">Pohon tumbang menghalangi jalan uta...</td>
                        <td class="px-6 py-4">Jl. Veteran, Kediri</td>
                        <td class="px-6 py-4">
                            <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full border border-yellow-200">Proses Review</span>
                        </td>
                        <td class="px-6 py-4 flex justify-center gap-2">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white w-8 h-8 rounded flex items-center justify-center transition tooltip" title="Lihat Detail"><i class="fa-solid fa-eye"></i></button>
                            <button class="bg-green-500 hover:bg-green-600 text-white w-8 h-8 rounded flex items-center justify-center transition tooltip" title="Tindak Lanjut"><i class="fa-solid fa-check"></i></button>
                        </td>
                    </tr>

                    <tr class="bg-white border-b hover:bg-red-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800">12/05/26 - 09.15</td>
                        <td class="px-6 py-4 max-w-xs truncate">Kebakaran kecil di area tempat sampah...</td>
                        <td class="px-6 py-4">Pasar Pahing</td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full border border-blue-200">Penanganan</span>
                        </td>
                        <td class="px-6 py-4 flex justify-center gap-2">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white w-8 h-8 rounded flex items-center justify-center transition tooltip" title="Lihat Detail"><i class="fa-solid fa-eye"></i></button>
                            <button class="bg-[#D32F0F] hover:bg-red-700 text-white w-8 h-8 rounded flex items-center justify-center transition tooltip" title="Selesaikan Laporan"><i class="fa-solid fa-flag-checkered"></i></button>
                        </td>
                    </tr>

                    <tr class="bg-white border-b hover:bg-red-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800">11/05/26 - 22.00</td>
                        <td class="px-6 py-4 max-w-xs truncate">Kecelakaan lalu lintas ringan, butuh...</td>
                        <td class="px-6 py-4">Perempatan Alun-alun</td>
                        <td class="px-6 py-4">
                            <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full border border-green-200">Selesai</span>
                        </td>
                        <td class="px-6 py-4 flex justify-center gap-2">
                            <button class="bg-gray-500 hover:bg-gray-600 text-white w-8 h-8 rounded flex items-center justify-center transition tooltip" title="Lihat Arsip"><i class="fa-solid fa-eye"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-gray-50 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-600">
            <span>Menampilkan 1 sampai 10 dari 357.</span>
            
            <div class="flex items-center gap-1">
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-300 hover:bg-gray-200"><i class="fa-solid fa-chevron-left text-xs"></i></button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-300 bg-white font-medium hover:bg-gray-100">1</button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-300 bg-[#D32F0F] text-white font-bold shadow">2</button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-300 bg-white font-medium hover:bg-gray-100">3</button>
                <span class="w-8 h-8 flex items-center justify-center">...</span>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-300 hover:bg-gray-200"><i class="fa-solid fa-chevron-right text-xs"></i></button>
            </div>

            <a href="#" class="text-[#D32F0F] hover:underline font-semibold transition">Close list.</a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex justify-between items-center hover:border-red-300 transition cursor-pointer group">
        <div>
            <h2 class="text-2xl font-bold text-[#D32F0F] tracking-wide group-hover:text-red-700 transition">Infrastruktur & Fasilitas</h2>
            <p class="text-[#D32F0F] text-sm font-medium mt-1">Data laporan kejadian "Infrastruktur & Fasilitas" di wilayah Anda.<br>
            terdapat <span class="font-bold text-lg">67</span> laporan dalam daftar.</p>
        </div>
        <div class="flex flex-col items-center gap-1">
            <div class="bg-[#D32F0F] text-white rounded-full w-12 h-12 flex items-center justify-center shadow-md">
                <i class="fa-solid fa-exclamation text-2xl"></i>
            </div>
            <span class="text-[#D32F0F] text-xs font-bold uppercase mt-1 underline">Open list.</span>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex justify-between items-center hover:border-red-300 transition cursor-pointer group">
        <div>
            <h2 class="text-2xl font-bold text-[#D32F0F] tracking-wide group-hover:text-red-700 transition">Keamanan & Ketertiban</h2>
            <p class="text-[#D32F0F] text-sm font-medium mt-1">Data laporan kejadian "Keamanan & Ketertiban" di wilayah Anda.<br>
            terdapat <span class="font-bold text-lg">23</span> laporan dalam daftar.</p>
        </div>
        <div class="flex flex-col items-center gap-1">
            <div class="bg-[#D32F0F] text-white rounded-full w-12 h-12 flex items-center justify-center shadow-md">
                <i class="fa-solid fa-exclamation text-2xl"></i>
            </div>
            <span class="text-[#D32F0F] text-xs font-bold uppercase mt-1 underline">Open list.</span>
        </div>
    </div>

</div>
@endsection