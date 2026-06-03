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
                            <option value="2">Kebersihan & Lingkungan</option>
                            <option value="3">Keamanan & Ketertiban</option>
                            <option value="4">Lainnya</option>
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

<script>
    // --- SCRIPT 1: LOKASI GPS (Tetap Sama) ---
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
                    inputLokasi.value = position.coords.latitude + ", " + position.coords.longitude;
                    resetIcon();
                },
                function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal mendapatkan lokasi. Pastikan GPS/Izin Lokasi aktif ya!',
                        confirmButtonText: 'Tutup',
                        customClass: { confirmButton: 'bg-[#D32F0F] text-white font-bold px-6 py-2.5 rounded-xl' },
                        buttonsStyling: false
                    });
                    resetIcon();
                }
            );
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Browser Jadul',
                text: 'Browser kamu tidak mendukung fitur deteksi lokasi.',
                confirmButtonText: 'Tutup',
                customClass: { confirmButton: 'bg-[#D32F0F] text-white font-bold px-6 py-2.5 rounded-xl' },
                buttonsStyling: false
            });
        }

        function resetIcon() {
            iconLocation.classList.remove('fa-spinner', 'fa-spin', 'text-gray-500');
            iconLocation.classList.add('fa-location-crosshairs', 'text-[#D32F0F]');
            inputLokasi.placeholder = "Isi Lokasi Kejadian...";
        }
    });

    // --- SCRIPT 2: PREVIEW NAMA FILE (Tetap Sama) ---
    document.getElementById('bukti_lampiran').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name;
        if(fileName) {
            document.getElementById('nama_file').innerText = "File terpilih: " + fileName;
            document.getElementById('nama_file').classList.add('text-[#D32F0F]', 'font-semibold');
        }
    });

    // --- SCRIPT 3: INTEGRASI API SUBMIT LAPORAN (Di-Upgrade pakai SweetAlert) ---
    document.getElementById('formPengaduan').addEventListener('submit', async function(e) {
        e.preventDefault();

        const token = localStorage.getItem('api_token');
        if (!token) {
            Swal.fire({
                icon: 'warning',
                title: 'Akses Ditolak!',
                text: 'Silakan login terlebih dahulu untuk mengirim laporan.',
                confirmButtonText: 'Ke Halaman Login',
                customClass: { confirmButton: 'bg-gradient-to-r from-[#F75702] to-[#B91408] text-white font-bold px-8 py-3 rounded-xl shadow-lg' },
                buttonsStyling: false
            }).then(() => {
                window.location.href = '/login';
            });
            return;
        }

        const btn = document.getElementById('btnSubmitLaporan');
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> MENGIRIM...';
        btn.disabled = true;

        const formData = new FormData(this);

        try {
            const response = await fetch('/api/pengaduan', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': 'Bearer ' + token
                },
                body: formData 
            });

            const result = await response.json();

            if (response.ok) {
                // Notif Sukses ala Jo
                Swal.fire({
                    icon: 'success',
                    title: 'Mantap Djiwa!',
                    text: 'Laporan berhasil meluncur ke server.',
                    confirmButtonText: 'Kembali ke Dashboard',
                    customClass: { confirmButton: 'bg-gradient-to-r from-[#F75702] to-[#B91408] text-white font-bold px-8 py-3 rounded-xl shadow-lg hover:opacity-95' },
                    buttonsStyling: false
                }).then(() => {
                    window.location.href = '/dashboard'; 
                });
            } else {
                if (response.status === 422) {
                    // Kumpulin error dan bikin jadi list HTML biar rapi
                    let pesanError = '<ul class="text-left text-sm text-gray-600 list-disc pl-5 mt-2">';
                    for (const key in result) {
                        pesanError += `<li>${result[key][0]}</li>`;
                    }
                    pesanError += '</ul>';

                    Swal.fire({
                        icon: 'error',
                        title: 'Data Belum Lengkap Bro!',
                        html: pesanError,
                        confirmButtonText: 'Perbaiki',
                        customClass: { confirmButton: 'bg-[#D32F0F] text-white font-bold px-8 py-3 rounded-xl' },
                        buttonsStyling: false
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: result.message || 'Gagal mengirim laporan.',
                        confirmButtonText: 'Tutup',
                        customClass: { confirmButton: 'bg-[#D32F0F] text-white font-bold px-8 py-3 rounded-xl' },
                        buttonsStyling: false
                    });
                }
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Server Bermasalah!',
                text: 'Terjadi kesalahan sistem: ' + error.message,
                confirmButtonText: 'Tutup',
                customClass: { confirmButton: 'bg-[#D32F0F] text-white font-bold px-8 py-3 rounded-xl' },
                buttonsStyling: false
            });
        } finally {
            btn.innerText = "Kirim Laporan Sekarang";
            btn.disabled = false;
        }
    });
</script>
@endsection