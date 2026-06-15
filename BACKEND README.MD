# 🛡️ Lapor.in - Backend Implementation (Progress Hari Ini)

Repositori ini berisi progres pengembangan API untuk sistem pengaduan **Lapor.in**. Fokus hari ini adalah pada pengaturan database, autentikasi pengguna, dan penyediaan alat pengujian API sederhana.

## 🚀 Fitur yang Selesai Hari Ini
1.  **Konfigurasi Database Localhost**:
    - Setup koneksi MySQL lewat XAMPP.
    - Penanganan error *collation* (`utf8mb4_unicode_ci`) untuk kompatibilitas MariaDB/MySQL versi lama.
2.  **Sistem Migration**:
    - Pembuatan skema tabel `pengguna` kustom (NIK, Alamat, Disabilitas, dll).
    - Implementasi tabel `kategori` dan `pengaduan`.
3.  **API Autentikasi (Auth)**:
    - **Register**: Validasi data lengkap (12 field) dengan hashing password otomatis.
    - **Login**: Autentikasi berbasis email dan password.
4.  **Security & Token**:
    - Integrasi **Laravel Sanctum** untuk sistem *Token-based Authentication*.
    - Penerbitan *Access Token* sebagai syarat akses fitur terproteksi nantinya.
5.  **UI API Testers**:
    - Pembuatan halaman `tes-ui-register` dan `tes-ui-login` menggunakan Blade & JavaScript Fetch API untuk mempermudah testing tanpa Postman.

## 🛠️ Tech Stack & Library
- **Framework**: Laravel 11
- **PHP**: 8.2.12 (Environment compatibility handled)
- **Database**: MySQL via XAMPP
- **Auth**: Laravel Sanctum

## ⚙️ Instruksi Instalasi untuk Tim (Localhost)

Jika kamu baru saja melakukan `git pull`, ikuti langkah ini:

1. **Install Dependencies**:
   ```powershell
   composer install --ignore-platform-reqs

2. **Setup Environment**:
   - Copy file `.env.example` menjadi `.env`.
   - Sesuaikan `DB_DATABASE=lapor_in_db`.
   - Pastikan `DB_COLLATION=utf8mb4_unicode_ci`.
3. **Generate Key & Install Sanctum**:
   ```powershell
   php artisan key:generate
   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
   ```
4. **Jalankan Migration**:
   ```powershell
   php artisan migrate
   ```
5. **Run Server**:
   ```powershell
   php artisan serve
   ```

## 🧪 Testing API
Kamu bisa mencoba API yang sudah dibuat melalui browser di:
- `http://127.0.0.1:8000/tes-ui-register`
- `http://127.0.0.1:8000/tes-ui-login`

## 📝 Catatan Implementasi (Ivan)
- Kolom `deskripsi_rsa` pada tabel `pengaduan` sudah disiapkan untuk menampung *ciphertext* hasil enkripsi RSA di tahap selanjutnya.
- Model `User.php` sudah di-override untuk menggunakan tabel `pengguna` sesuai rancangan ERD awal.

---
*Last Update: 24 April 2026 - Backend Developer: Ivan Farrel Nanda K.*
```