<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tester API Pengaduan Lapor.in</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; padding: 20px; }
        .container { max-width: 600px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); margin: auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px; }
        input, select, textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        textarea { resize: vertical; height: 100px; }
        button { width: 100%; padding: 10px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold;}
        button:hover { background-color: #c82333; }
        .token-box { background-color: #e9ecef; padding: 15px; border-radius: 4px; margin-bottom: 20px; border: 1px dashed #6c757d;}
        #hasilBox { margin-top: 20px; padding: 15px; border-radius: 4px; display: none; white-space: pre-wrap; font-family: monospace; font-size: 12px; word-wrap: break-word;}
        .sukses { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .gagal { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Tester Pengaduan</h2>
    
    <!-- Kolom khusus untuk KTP Virtual (Token) -->
    <div class="token-box">
        <label style="color: #495057;">🔑 Masukkan Access Token (Dari hasil Login):</label>
        <input type="text" id="apiToken" placeholder="Paste token panjang di sini..." required>
    </div>

    <!-- Form Data Laporan -->
    <form id="formPengaduan">
        <div class="form-group">
            <label>ID Kategori Klasifikasi</label>
            <input type="number" name="id_kategori" placeholder="Contoh: 1" required>
            <small style="color: gray;">*Pastikan angka 1 ini sudah ada di tabel 'kategori' phpMyAdmin ya.</small>
        </div>
        <div class="form-group">
            <label>Judul Laporan</label>
            <input type="text" name="judul" placeholder="Ketik Judul Laporan Anda" required>
        </div>
        <div class="form-group">
            <label>Isi Laporan</label>
            <textarea name="isi_laporan" placeholder="Isi Laporan Anda..." required></textarea>
        </div>
        <div class="form-group">
            <label>Tanggal Kejadian</label>
            <input type="date" name="tanggal_kejadian" required>
        </div>
        <div class="form-group">
            <label>Waktu Kejadian</label>
            <input type="time" name="waktu_kejadian" required>
        </div>
        <div class="form-group">
            <label>Lokasi Kejadian</label>
            <input type="text" name="lokasi" placeholder="Isi Lokasi Kejadian" required>
        </div>
        <div class="form-group">
            <label>Upload Bukti Laporan (Maks 2MB, JPG/PNG)</label>
            <input type="file" name="bukti_lampiran" accept="image/png, image/jpeg" required>
        </div>
        
        <button type="submit" id="btnSubmit">Kirim Laporan Sekarang</button>
    </form>

    <div id="hasilBox"></div>
</div>

<script>
    document.getElementById('formPengaduan').addEventListener('submit', async function(e) {
        e.preventDefault(); 
        
        const btn = document.getElementById('btnSubmit');
        const hasilBox = document.getElementById('hasilBox');
        const token = document.getElementById('apiToken').value.trim();

        if(!token) {
            alert("Bos! Token loginnya diisi dulu di kotak abu-abu atas!");
            return;
        }
        
        btn.innerText = "Mengirim Laporan & Upload Foto...";
        hasilBox.style.display = "none";
        hasilBox.className = "";

        // Karena ada file foto, kita WAJIB pakai FormData (bukan JSON)
        const formData = new FormData(this);

        try {
            const response = await fetch('/api/pengaduan', {
                method: 'POST',
                headers: {
                    // Berikan KTP Virtualnya ke satpam (Sanctum)
                    'Authorization': `Bearer ${token}`,
                    // Penting: Agar Laravel balas pakai pesan JSON kalau ada error
                    'Accept': 'application/json'
                    // Catatan: Jangan set Content-Type secara manual kalau pakai FormData!
                },
                body: formData
            });

            const result = await response.json();

            hasilBox.style.display = "block";
            hasilBox.innerText = JSON.stringify(result, null, 2);

            if (response.ok) {
                hasilBox.classList.add("sukses"); 
                this.reset(); // Kosongkan form kalau sukses
            } else {
                hasilBox.classList.add("gagal"); 
            }
        } catch (error) {
            hasilBox.style.display = "block";
            hasilBox.classList.add("gagal");
            hasilBox.innerText = "Error Sistem: " + error.message;
        } finally {
            btn.innerText = "Kirim Laporan Sekarang";
        }
    });
</script>

</body>
</html>