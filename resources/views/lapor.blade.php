@extends('layouts.app')

@section('title', 'Form Laporan - Lapor.in')

@section('content')
    <div class="max-w-4xl mx-auto">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-[#D32F0F] mb-2">Pusat Pengaduan & Laporan Masyarakat</h1>
            <h2 class="text-xl font-bold text-gray-800">Sampaikan Laporan Anda</h2>
        </div>

        <div class="bg-white p-6 md:p-10 rounded-2xl shadow-sm border border-gray-100">
            <form id="formPengaduan" enctype="multipart/form-data" class="space-y-6">
                
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-gray-700">Pilih Klasifikasi Laporan</label>
                    <div class="relative w-full md:w-1/2">
                        <select name="id_kategori" id="id_kategori" class="w-full bg-[#D32F0F] text-white border-none p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400 appearance-none font-medium cursor-pointer" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="1">Infrastruktur & Fasilitas</option>
                            <option value="2">Keamanan & Ketertiban</option>
                            <option value="3">Kebersihan & Lingkungan</option>
                            <option value="4">Aspirasi & Saran</option>
                            <option value="5">Administrasi & Pelayanan</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-white pointer-events-none"></i>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-gray-700">Judul Laporan</label>
                    <input type="text" name="judul" id="judul" placeholder="Isi Judul Laporan..." class="w-full border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F] text-gray-700" required>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-gray-700">Isi Laporan</label>
                    <textarea name="isi_laporan" id="isi_laporan" rows="4" placeholder="Isi Laporan Anda..." class="w-full border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F] text-gray-700 resize-none" required></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-gray-700">Tanggal Kejadian</label>
                        <input type="date" name="tanggal_kejadian" id="tanggal_kejadian" class="w-full border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F] text-gray-500" required>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-gray-700">Waktu Kejadian</label>
                        <input type="time" name="waktu_kejadian" id="waktu_kejadian" class="w-full border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F] text-gray-500" required>
                    </div>

                    <div class="flex flex-col gap-2 relative">
                        <label class="text-sm font-semibold text-gray-700">Lokasi Kejadian</label>
                        <div class="relative flex items-center">
                            <input type="text" name="lokasi" id="input_lokasi" placeholder="Isi Lokasi Kejadian..." class="w-full border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F] text-gray-700 pr-12" required>
                            
                            <button type="button" id="btn_get_location" class="absolute right-2 p-2 rounded-md hover:bg-gray-100 transition group" title="Ambil Lokasi Saat Ini">
                                <i id="icon_location" class="fa-solid fa-location-crosshairs text-[#D32F0F] text-lg group-hover:scale-110 transition-transform"></i>
                            </button>
                        </div>
                    </div>

                </div> 

                <div class="flex flex-col gap-2 mt-4">
                    <label class="text-sm font-semibold text-gray-700">Upload Bukti Laporan</label>
                    <div class="w-full md:w-1/2 border-2 border-dashed border-gray-300 rounded-xl p-6 flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 transition cursor-pointer relative group">
                        <input type="file" name="bukti_lampiran" id="bukti_lampiran" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/jpeg, image/png, image/jpg" required>
                        
                        <div class="w-12 h-12 bg-[#D32F0F] bg-opacity-10 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-cloud-arrow-up text-[#D32F0F] text-2xl"></i>
                        </div>
                        <p class="text-sm text-gray-500 text-center px-4" id="nama_file">
                            Klik atau drag & drop gambar ke area ini (Maks 2MB)
                        </p>
                    </div>
                </div>

                <div class="flex justify-end mt-8 border-t pt-6">
                    <button type="submit" id="btnSubmitLaporan" class="w-full md:w-auto bg-gradient-to-r from-[#F75702] to-[#B91408] text-white font-bold px-10 py-3.5 rounded-xl shadow-lg hover:shadow-xl hover:opacity-95 transition transform hover:-translate-y-0.5">
                        Kirim Laporan Sekarang
                    </button>
                </div>

            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@vite('resources/js/lapor.js')
@endsection