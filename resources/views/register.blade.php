<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Lapor.in</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .bg-laporin { background-color: #D32F0F; }
        .btn-gradient { background: linear-gradient(to bottom, #E63917, #B22206); }
        .rounded-left-curve { border-top-left-radius: 250px; border-bottom-left-radius: 250px; }
    </style>
</head>
<body class="bg-white min-h-screen flex items-center justify-center overflow-x-hidden">

    <div class="flex w-full min-h-screen">
        <!-- Form Section -->
        <div class="w-full lg:w-3/5 p-8 lg:p-16">
            <h1 class="text-5xl font-bold text-gray-800 mb-10">Daftar</h1>

            <form class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- NIK -->
                <div class="flex flex-col gap-2">
                    <label class="text-xl font-medium text-gray-700">NIK</label>
                    <input type="text" placeholder="Nomor Induk Kependudukan (KTP)" class="border border-gray-400 p-3 rounded-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <!-- Nama Lengkap -->
                <div class="flex flex-col gap-2">
                    <label class="text-xl font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" placeholder="Nama Lengkap" class="border border-gray-400 p-3 rounded-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <!-- Alamat -->
                <div class="flex flex-col gap-2">
                    <label class="text-xl font-medium text-gray-700">Alamat Tempat Tinggal</label>
                    <input type="text" placeholder="Alamat Tempat Tinggal Saat Ini" class="border border-gray-400 p-3 rounded-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <!-- Jenis Kelamin -->
                <div class="flex flex-col gap-2">
                    <label class="text-xl font-medium text-gray-700">Jenis Kelamin</label>
                    <div class="relative">
                        <select class="w-full border border-gray-400 p-3 rounded-sm focus:outline-none focus:ring-2 focus:ring-orange-500 appearance-none bg-white pr-10">
                            <option value="" disabled selected>Jenis Kelamin</option>
                            <option>Laki-laki</option>
                            <option>Perempuan</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"></i>
                    </div>
                </div>

                <!-- Pekerjaan -->
               <div class="flex flex-col gap-2">
                    <label class="text-xl font-medium text-gray-700">Pekerjaan</label>
                    <div class="relative">
                        <select class="w-full border border-gray-400 p-3 rounded-sm focus:outline-none focus:ring-2 focus:ring-orange-500 appearance-none bg-white pr-10">
                            <option value="" disabled selected>Pilih Pekerjaan</option>
                            <option>Pegawai Swasta</option>
                            <option>PNS</option>
                            <option>Wiraswasta</option>
                            <option>Lainnya</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"></i>
                    </div>
                </div>

                <!-- Tanggal Lahir -->
                <div class="flex flex-col gap-2">
                    <label class="text-xl font-medium text-gray-700">Tanggal Lahir</label>
                    <input type="date" class="border border-gray-400 p-3 rounded-sm focus:outline-none focus:ring-2 focus:ring-orange-500 text-gray-500">
                </div>

                <!-- Penyandang Disabilitas -->
                <div class="flex flex-col gap-2">
                    <label class="text-xl font-medium text-gray-700">Penyandang Disabilitas?</label>
                    <div class="relative">
                        <select class="w-full border border-gray-400 p-3 rounded-sm focus:outline-none focus:ring-2 focus:ring-orange-500 appearance-none bg-white pr-10">
                            <option value="" disabled selected>Pilih Status</option>
                            <option>Ya</option>
                            <option>Tidak</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"></i>
                    </div>
                </div>

                <!-- Nomor Telp -->
                <div class="flex flex-col gap-2">
                    <label class="text-xl font-medium text-gray-700">Nomor. telp Aktif</label>
                    <input type="tel" placeholder="Minimal 8-14 Angka" class="border border-gray-400 p-3 rounded-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <!-- Username -->
                <div class="flex flex-col gap-2">
                    <label class="text-xl font-medium text-gray-700">Username</label>
                    <input type="text" placeholder="Username" class="border border-gray-400 p-3 rounded-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <!-- Email -->
                <div class="flex flex-col gap-2">
                    <label class="text-xl font-medium text-gray-700">Email Aktif</label>
                    <input type="email" placeholder="Laporin@gmail.com" class="border border-gray-400 p-3 rounded-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>

                <!-- Password -->
                <div class="flex flex-col gap-2 relative">
                    <label class="text-xl font-medium text-gray-700">Password</label>
                    <div class="relative">
                        <input type="password" id="password" placeholder="*********" class="w-full border border-gray-400 p-3 rounded-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <i onclick="togglePass('password', this)" class="fa-solid fa-eye-slash absolute right-3 top-4 text-gray-500 cursor-pointer"></i>
                    </div>
                    <p class="text-xs text-gray-500 leading-tight">Minimal 8 karakter dan harus berisi kombinasi huruf kapital, huruf kecil, angka dan karakter khusus (@$!%*#?&).</p>
                </div>

                <!-- Konfirmasi Password -->
                <div class="flex flex-col gap-2">
                    <label class="text-xl font-medium text-gray-700">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" id="confirm_password" placeholder="*********" class="w-full border border-gray-400 p-3 rounded-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <i onclick="togglePass('confirm_password', this)" class="fa-solid fa-eye-slash absolute right-3 top-4 text-gray-500 cursor-pointer"></i>
                    </div>
                </div>

                <!-- Agreement -->
                <div class="md:col-span-2 flex items-center gap-3 mt-4">
                    <input type="checkbox" id="terms" class="w-5 h-5 border-gray-400 rounded">
                    <label for="terms" class="text-sm text-gray-700">Saya telah membaca dan menyetujui <a href="#" class="underline font-semibold">Syarat dan Ketentuan Layanan</a></label>
                </div>

                <!-- Submit Button -->
                <div class="md:col-span-2 flex justify-center md:justify-start mt-4">
                    <button type="submit" class="w-full md:w-80 btn-gradient text-white font-bold text-4xl py-3 rounded-xl shadow-lg hover:opacity-90 transition">
                        DAFTAR
                    </button>
                </div>
            </form>
        </div>

        <!-- Right Section (Hero) -->
        <div class="hidden lg:flex w-2/5 bg-laporin rounded-left-curve items-center justify-center text-white flex-col px-10 relative overflow-hidden">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Laporin" class="w-64 mb-6">            <h3 class="text-5xl font-semibold mb-8">Selamat Datang</h3>
            <p class="text-2xl mb-6">Sudah Punya Akun?</p>
            <a href="#" class="border-2 border-white text-white px-16 py-3 rounded-2xl text-2xl font-bold hover:bg-white hover:text-red-700 transition">
                Masuk
            </a>
        </div>
    </div>

    <script>
        function togglePass(id, el) {
            const input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
                el.classList.replace('fa-eye-slash', 'fa-eye');
            } else {
                input.type = "password";
                el.classList.replace('fa-eye', 'fa-eye-slash');
            }
        }
    </script>
</body>
</html>