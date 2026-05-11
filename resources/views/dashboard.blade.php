@extends('layouts.app')

@section('title', 'Dashboard - Lapor.in')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-bold text-[#D32F0F]">Selamat Datang, Mas Amba</h1>
        <p class="text-gray-500 mt-2 text-lg">Mari pantau dan tingkatkan kenyamanan lingkungan kita hari ini.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-6">
            
            <div class="flex justify-between items-end border-b pb-2">
                <h2 class="text-2xl font-bold text-gray-800">Laporan Sedang Berjalan</h2>
                <a href="{{ url('/riwayat') }}" class="text-sm font-semibold text-[#F75702] hover:underline">Lihat Semua Riwayat</a>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col gap-4 hover:shadow-md transition duration-300">
                <div class="flex justify-between items-start">
                    <div class="flex gap-4">
                        <div class="w-12 h-12 rounded-full bg-gray-100 border flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-user text-gray-400 text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-gray-800">Selokan Mampet</h3>
                            <p class="text-gray-500 text-sm mt-1 leading-relaxed max-w-lg">
                                Ada genangan air yang sangat banyak dikarenakan selokan mampet di Jalan Ngadirejo, Kediri...
                            </p>
                        </div>
                    </div>
                    <span class="bg-yellow-100 text-yellow-700 px-4 py-1.5 rounded-full text-sm font-bold tracking-wide">
                        Diproses
                    </span>
                </div>
                
                <div class="flex justify-between items-center mt-2 border-t pt-4">
                    <div class="flex items-center gap-2 text-gray-500 text-sm">
                        <i class="fa-regular fa-clock"></i>
                        <span>Update terakhir 2 jam yang lalu</span>
                    </div>
                    <a href="#" class="text-[#D32F0F] font-bold hover:underline text-sm flex items-center gap-1">
                        Lacak Progres <i class="fa-solid fa-chevron-right text-xs"></i>
                    </a>
                </div>
            </div>

            <a href="{{ url('/lapor') }}" class="w-full bg-gradient-to-r from-[#F75702] to-[#B91408] text-white font-bold text-xl py-4 rounded-xl shadow-lg hover:shadow-xl hover:opacity-95 transition transform hover:-translate-y-0.5 mt-4 flex items-center justify-center gap-2">
                <i class="fa-solid fa-plus"></i> Buat Laporan Baru
            </a>

        </div>

        <div class="space-y-8">
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-5">
                
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center text-2xl font-bold border border-blue-100">
                        19
                    </div>
                    <div class="font-bold text-gray-700 tracking-wide">TOTAL LAPORAN</div>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center text-2xl font-bold border border-orange-100">
                        12
                    </div>
                    <div class="font-bold text-gray-700 tracking-wide">DALAM PROSES</div>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-green-50 text-green-500 flex items-center justify-center text-2xl font-bold border border-green-100">
                        07
                    </div>
                    <div class="font-bold text-gray-700 tracking-wide">SELESAI</div>
                </div>

            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-2">Info & Edukasi</h2>
                <div class="bg-gradient-to-br from-[#F75702] to-[#B91408] rounded-2xl p-6 text-white shadow-md relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 w-24 h-24 bg-white opacity-10 rounded-full blur-2xl"></div>
                    
                    <span class="bg-white text-[#D32F0F] text-xs font-black px-2.5 py-1 rounded-md mb-4 inline-block tracking-widest">
                        UPDATE
                    </span>
                    <h3 class="font-bold text-xl mb-2 leading-tight">Prosedur Pengamanan Data di Lapor.in</h3>
                    <p class="text-sm text-white/90 mb-5 leading-relaxed">
                        Pelajari bagaimana sistem kami mengenkripsi laporan Anda agar privasi tetap terjaga dan aman.
                    </p>
                    <a href="{{ url('/edukasi') }}" class="block text-center bg-white text-[#B91408] w-full py-3 rounded-xl font-bold text-sm hover:bg-gray-50 transition shadow-sm">
                        Baca Panduan
                    </a>
                </div>
            </div>

        </div>
        
    </div>
@endsection