<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tester API Register Lapor.in</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f7f6; padding: 20px; }
        .container { max-width: 500px; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); margin: auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; font-size: 14px; }
        input, select { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 16px; font-weight: bold;}
        button:hover { background-color: #218838; }
        #hasilBox { margin-top: 20px; padding: 15px; border-radius: 4px; display: none; white-space: pre-wrap; font-family: monospace; font-size: 12px;}
        .sukses { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .gagal { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>

<div class="container">
    <h2>Tester API Register</h2>
    <form id="formRegister">
        <div class="form-group"><label>NIK</label><input type="number" name="nik" required></div>
        <div class="form-group"><label>Nama Lengkap</label><input type="text" name="nama_lengkap" required></div>
        <div class="form-group"><label>Alamat</label><input type="text" name="alamat" required></div>
        <div class="form-group"><label>Jenis Kelamin</label>
            <select name="jenis_kelamin">
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="form-group"><label>Pekerjaan</label><input type="text" name="pekerjaan" required></div>
        <div class="form-group"><label>Tanggal Lahir</label><input type="date" name="tanggal_lahir" required></div>
        <div class="form-group"><label>Disabilitas</label>
            <select name="disabilitas">
                <option value="Tidak">Tidak</option>
                <option value="Ya">Ya</option>
            </select>
        </div>
        <div class="form-group"><label>Nomor WA</label><input type="number" name="nomor_wa" required></div>
        <div class="form-group"><label>Username</label><input type="text" name="username" required></div>
        <div class="form-group"><label>Email</label><input type="email" name="email" required></div>
        <div class="form-group"><label>Kata Sandi</label><input type="password" name="kata_sandi" required></div>
        <div class="form-group"><label>Konfirmasi Kata Sandi</label><input type="password" name="kata_sandi_confirmation" required></div>
        
        <button type="submit" id="btnSubmit">Kirim Data Register (POST)</button>
    </form>

    <div id="hasilBox"></div>
</div>

<script>
    document.getElementById('formRegister').addEventListener('submit', async function(e) {
        e.preventDefault(); // Mencegah halaman reload
        
        const btn = document.getElementById('btnSubmit');
        const hasilBox = document.getElementById('hasilBox');
        
        btn.innerText = "Memproses...";
        hasilBox.style.display = "none";
        hasilBox.className = "";

        // Mengambil semua data dari form
        const formData = new FormData(this);
        const dataJson = Object.fromEntries(formData.entries());

        try {
            // Menembak API Laravel yang kamu buat
            const response = await fetch('/api/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(dataJson)
            });

            const result = await response.json();

            // Tampilkan hasil response dari API
            hasilBox.style.display = "block";
            hasilBox.innerText = JSON.stringify(result, null, 2);

            if (response.ok) {
                hasilBox.classList.add("sukses"); // Warna hijau kalau berhasil
            } else {
                hasilBox.classList.add("gagal"); // Warna merah kalau error/validasi gagal
            }
        } catch (error) {
            hasilBox.style.display = "block";
            hasilBox.classList.add("gagal");
            hasilBox.innerText = "Error Sistem: " + error.message;
        } finally {
            btn.innerText = "Kirim Data Register (POST)";
        }
    });
</script>

</body>
</html>