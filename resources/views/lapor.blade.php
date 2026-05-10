@extends('layouts.app')

@section('title', 'Form Laporan - Lapor.in')

@section('content')
    <div class="max-w-4xl mx-auto">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-[#D32F0F] mb-2">Pusat Pengaduan & Laporan Masyarakat</h1>
            <h2 class="text-xl font-bold text-gray-800">Sampaikan Laporan Anda</h2>
        </div>

        <div class="bg-white p-6 md:p-10 rounded-2xl shadow-sm border border-gray-100">
            <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf 
                
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-gray-700">Pilih Klasifikasi Laporan</label>
                    <div class="relative w-full md:w-1/2">
                        <select class="w-full bg-[#D32F0F] text-white border-none p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400 appearance-none font-medium cursor-pointer">
                            <option value="infrastruktur">Infrastruktur & Fasilitas</option>
                            <option value="lingkungan">Kebersihan & Lingkungan</option>
                            <option value="keamanan">Keamanan & Ketertiban</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-white pointer-events-none"></i>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-gray-700">Judul Laporan</label>
                    <input type="text" placeholder="Isi Judul Laporan..." class="w-full border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F] text-gray-700">
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-gray-700">Isi Laporan</label>
                    <textarea rows="4" placeholder="Isi Laporan Anda..." class="w-full border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F] text-gray-700 resize-none"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-gray-700">Tanggal Kejadian</label>
                        <input type="date" class="w-full border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F] text-gray-500">
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-sm font-semibold text-gray-700">Waktu Kejadian</label>
                        <input type="time" class="w-full border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F] text-gray-500">
                    </div>

                    <div class="flex flex-col gap-2 relative">
                        <label class="text-sm font-semibold text-gray-700">Lokasi Kejadian</label>
                        <div class="relative flex items-center">
                            <input type="text" id="input_lokasi" placeholder="Isi Lokasi Kejadian..." class="w-full border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F] text-gray-700 pr-12">
                            
                            <button type="button" id="btn_get_location" class="absolute right-2 p-2 rounded-md hover:bg-gray-100 transition group" title="Ambil Lokasi Saat Ini">
                                <i id="icon_location" class="fa-solid fa-location-crosshairs text-[#D32F0F] text-lg group-hover:scale-110 transition-transform"></i>
                            </button>
                        </div>
                    </div>

                </div> <div class="flex flex-col gap-2 mt-4">
                    <label class="text-sm font-semibold text-gray-700">Upload Bukti Laporan</label>
                    <div class="w-full md:w-1/2 border-2 border-dashed border-gray-300 rounded-xl p-6 flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 transition cursor-pointer relative group">
                        <input type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*, .pdf, .doc, .docx" multiple>
                        
                        <div class="w-12 h-12 bg-[#D32F0F] bg-opacity-10 rounded-full flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                            <i class="fa-solid fa-cloud-arrow-up text-[#D32F0F] text-2xl"></i>
                        </div>
                        <p class="text-sm text-gray-500 text-center px-4">
                            Klik atau drag & drop file ke area ini
                        </p>
                    </div>
                </div>

                <div class="flex justify-end mt-8 border-t pt-6">
                    <button type="submit" class="w-full md:w-auto bg-gradient-to-r from-[#F75702] to-[#B91408] text-white font-bold px-10 py-3.5 rounded-xl shadow-lg hover:shadow-xl hover:opacity-95 transition transform hover:-translate-y-0.5">
                        Kirim Laporan Sekarang
                    </button>
                </div>

            </form>
        </div>
    </div>

<script>
    document.getElementById('btn_get_location').addEventListener('click', function() {
        const inputLokasi = document.getElementById('input_lokasi');
        const iconLocation = document.getElementById('icon_location');

        if (navigator.geolocation) {
            iconLocation.classList.replace('fa-location-crosshairs', 'fa-spinner');
            iconLocation.classList.add('fa-spin', 'text-gray-500');
            iconLocation.classList.remove('text-[#D32F0F]');
            inputLokasi.placeholder = "Mencari lokasi...";

            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    
                    inputLokasi.value = lat + ", " + lng;
                    resetIcon();
                },
                function(error) {
                    alert("Gagal mendapatkan lokasi. Pastikan GPS/Izin Lokasi aktif.");
                    resetIcon();
                }
            );
        } else {
            alert("Browser kamu tidak mendukung fitur deteksi lokasi.");
        }

        function resetIcon() {
            iconLocation.classList.remove('fa-spinner', 'fa-spin', 'text-gray-500');
            iconLocation.classList.add('fa-location-crosshairs', 'text-[#D32F0F]');
            inputLokasi.placeholder = "Isi Lokasi Kejadian...";
        }
    });
</script>
@endsection