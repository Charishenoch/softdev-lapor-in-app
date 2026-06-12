document.addEventListener('DOMContentLoaded', function() {
    
    // --- SCRIPT 1: LOKASI GPS ---
    const btnLocation = document.getElementById('btn_get_location');
    if(btnLocation) {
        btnLocation.addEventListener('click', function() {
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
    }

    // --- SCRIPT 2: PREVIEW NAMA FILE ---
    const lampiran = document.getElementById('bukti_lampiran');
    if(lampiran) {
        lampiran.addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            if(fileName) {
                const namaFileEl = document.getElementById('nama_file');
                namaFileEl.innerText = "File terpilih: " + fileName;
                namaFileEl.classList.add('text-[#D32F0F]', 'font-semibold');
            }
        });
    }

    // --- SCRIPT 3: INTEGRASI API SUBMIT LAPORAN ---
    const formPengaduan = document.getElementById('formPengaduan');
    if(formPengaduan) {
        formPengaduan.addEventListener('submit', async function(e) {
            e.preventDefault();

            // REVISI KUNCI: Samain nama kunci tokennya
            const token = localStorage.getItem('token_laporin'); 
            
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
                // Pastikan Rutenya Bener ke Controller-mu
                const response = await fetch('/api/pengaduan', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + token
                        // JANGAN KASIH Content-Type kalau kirim FormData (Biar file fotonya bisa nempel)
                    },
                    body: formData 
                });

                const result = await response.json();

                if (response.ok) {
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
    }
});