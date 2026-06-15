document.addEventListener('DOMContentLoaded', () => {
    const formArtikel = document.getElementById('form-artikel');
    const thumbnailInput = document.getElementById('thumbnail-upload');
    const imagePreview = document.getElementById('image-preview');
    const uploadPlaceholder = document.getElementById('upload-placeholder');
    const btnSubmit = formArtikel.querySelector('button[type="submit"]');

    // 1. Fitur Preview Gambar
    if (thumbnailInput) {
        thumbnailInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden'); // Munculin gambar
                    uploadPlaceholder.classList.add('hidden'); // Sembunyiin icon awan
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // 2. Fitur Kirim Data ke API
    if (formArtikel) {
        formArtikel.addEventListener('submit', async (e) => {
            e.preventDefault(); // Cegah reload halaman

            const token = localStorage.getItem('token_laporin');
            if (!token) {
                alert('Sesi kamu habis, silakan login lagi lek!');
                return;
            }

            // Ganti teks tombol biar keliatan lagi loading
            const originalBtnText = btnSubmit.innerHTML;
            btnSubmit.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';
            btnSubmit.disabled = true;

            try {
                // FormData otomatis ngambil semua input, termasuk file gambar dan hidden input status
                const formData = new FormData(formArtikel);

                // FIX RUTE: /admin dihapus biar sinkron sama web.php
                const res = await fetch('/api/artikel', {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json'
                        // INGAT: Jangan set Content-Type kalau pakai FormData, biarin browser yang atur (multipart/form-data)
                    },
                    body: formData
                });

                const result = await res.json();

                if (res.ok && result.success) {
                    alert(result.message || 'Artikel berhasil disimpan!');
                    // Redirect kembali ke halaman list edukasi admin
                    window.location.href = '/admin/edukasi'; 
                } else {
                    console.log("Error Validasi:", result.errors);
                    alert(result.message || 'Gagal menyimpan artikel. Cek inputanmu lek!');
                }
            } catch (error) {
                console.error('Fetch Error:', error);
                alert('Terjadi kesalahan sistem, coba lagi nanti!');
            } finally {
                // Kembalikan tombol seperti semula
                btnSubmit.innerHTML = originalBtnText;
                btnSubmit.disabled = false;
            }
        });
    }
});