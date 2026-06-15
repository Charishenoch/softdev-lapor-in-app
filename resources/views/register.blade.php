<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Lapor.in</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .bg-laporin { background-color: #D32F0F; }
        .btn-gradient { background: linear-gradient(to right, #F75702, #B91408); } 
        .rounded-left-curve { border-top-left-radius: 150px; border-bottom-left-radius: 150px; }
    </style>
</head>
<body class="bg-white min-h-screen flex items-center justify-center overflow-x-hidden">

    <div class="flex w-full min-h-screen">
        
        <div class="w-full lg:w-3/5 p-6 sm:p-10 lg:p-16 flex flex-col justify-center">
            
            <div class="mb-8">
                <h1 class="text-3xl md:text-5xl font-bold text-gray-800 mb-2">Daftar Akun</h1>
                <p class="text-gray-500 text-sm md:text-base">Lengkapi formulir di bawah ini untuk bergabung dengan Lapor.in</p>
            </div>

            <form id="formRegister" class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">
                @csrf 
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-gray-700">NIK</label>
                    <input type="text" name="nik" placeholder="Nomor Induk Kependudukan (KTP)" required class="border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F]">
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-gray-700">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required class="border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F]">
                </div>

                <div class="flex flex-col gap-2 md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700">Alamat Tempat Tinggal</label>
                    <input type="text" name="alamat" placeholder="Alamat Tempat Tinggal Saat Ini" required class="border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F]">
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-gray-700">Jenis Kelamin</label>
                    <div class="relative">
                        <select name="jenis_kelamin" required class="w-full border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F] appearance-none bg-white pr-10 cursor-pointer">
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-gray-700">Pekerjaan</label>
                    <div class="relative">
                        <select name="pekerjaan" required class="w-full border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F] appearance-none bg-white pr-10 cursor-pointer">
                            <option value="" disabled selected>Pilih Pekerjaan</option>
                            <option value="Swasta">Pegawai Swasta</option>
                            <option value="PNS">PNS</option>
                            <option value="Wiraswasta">Wiraswasta</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-gray-700">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" required class="border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F] text-gray-600">
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-gray-700">Penyandang Disabilitas?</label>
                    <div class="relative">
                        <select name="disabilitas" required class="w-full border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F] appearance-none bg-white pr-10 cursor-pointer">
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="Ya">Ya</option>
                            <option value="Tidak">Tidak</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-gray-700">Nomor Telp Aktif</label>
                    <input type="tel" name="nomor_wa" placeholder="Minimal 8-14 Angka" required class="border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F]">
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-gray-700">Username</label>
                    <input type="text" name="username" placeholder="Username" required class="border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F]">
                </div>

                <div class="flex flex-col gap-2 md:col-span-2">
                    <label class="text-sm font-semibold text-gray-700">Email Aktif</label>
                    <input type="email" name="email" placeholder="contoh@gmail.com" required class="border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F]">
                </div>

                <div class="flex flex-col gap-2 relative">
                    <label class="text-sm font-semibold text-gray-700">Password</label>
                    <div class="relative">
                        <input type="password" name="kata_sandi" id="password" placeholder="••••••••" required class="w-full border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F] pr-12">
                        <button type="button" onclick="togglePass('password', this)" class="absolute right-0 top-0 h-full px-4 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i class="fa-solid fa-eye-slash"></i>
                        </button>
                    </div>
                    <p class="text-[11px] text-gray-500 leading-tight">Min. 8 karakter.</p>
                </div>

                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-gray-700">Konfirmasi Password</label>
                    <div class="relative">
                        <input type="password" name="kata_sandi_confirmation" id="confirm_password" placeholder="••••••••" required class="w-full border border-gray-300 p-3.5 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F] pr-12">
                        <button type="button" onclick="togglePass('confirm_password', this)" class="absolute right-0 top-0 h-full px-4 text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i class="fa-solid fa-eye-slash"></i>
                        </button>
                    </div>
                </div>

                <div class="md:col-span-2 flex items-start gap-3 mt-2">
                    <input type="checkbox" name="terms" id="terms" class="mt-1 w-4 h-4 border-gray-300 rounded text-[#D32F0F] focus:ring-[#D32F0F]">
                    <label for="terms" class="text-sm text-gray-600">Saya telah membaca dan menyetujui <a href="#" class="text-[#D32F0F] hover:underline font-semibold">Syarat dan Ketentuan Layanan</a></label>
                </div>

                <div class="md:col-span-2 mt-4">
                    <button type="submit" id="btnRegister" class="w-full btn-gradient text-white font-bold text-lg py-3.5 rounded-xl shadow-md hover:shadow-lg hover:opacity-95 transition transform hover:-translate-y-0.5">
                        DAFTAR SEKARANG
                    </button>
                </div>
                
                <div class="md:col-span-2 text-center mt-4 lg:hidden relative z-20">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun? 
                        <a href="{{ url('/login') }}" class="text-[#D32F0F] font-bold hover:underline py-2 px-1 block inline-block">Masuk di sini</a>
                    </p>
                </div>
            </form>
        </div>

        <div class="hidden lg:flex w-2/5 bg-gradient-to-br from-[#E63917] to-[#8B0000] rounded-left-curve items-center justify-center text-white flex-col px-12 relative overflow-hidden shadow-2xl">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-5 rounded-full -mr-20 -mt-20 blur-2xl"></div>
            <div class="absolute bottom-0 left-0 w-40 h-40 bg-black opacity-10 rounded-full -ml-10 -mb-10 blur-xl"></div>
            
            <div class="z-10 flex flex-col items-center text-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Laporin" class="h-16 w-auto mb-10">            
                <h3 class="text-4xl font-bold mb-4">Selamat Datang!</h3>
                <p class="text-lg text-white/80 mb-10 max-w-sm">Tetap terhubung dan bantu tingkatkan kenyamanan lingkungan bersama kami.</p>
                
                <p class="text-sm font-medium mb-3">Sudah Punya Akun?</p>
                <a href="{{ url('/login') }}" class="border-2 border-white/80 text-white px-14 py-3 rounded-xl text-lg font-bold hover:bg-white hover:text-[#D32F0F] transition duration-300">
                    Masuk
                </a>
            </div>
        </div>
    </div>

    <div id="modalSuccess" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-40 backdrop-blur-sm transition-opacity">
        <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-sm w-full mx-4 text-center transform scale-95 transition-transform duration-300" id="modalContent">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                <i class="fa-solid fa-check text-4xl text-green-500"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Mantap Boss!</h2>
            <p class="text-gray-600 mb-8">Akun kamu berhasil dibuat. Silakan lanjut login untuk masuk ke dashboard.</p>
            <button id="btnModalOk" class="w-full btn-gradient text-white font-bold py-3.5 rounded-xl shadow-md hover:opacity-95 transition transform hover:-translate-y-0.5">
                OK, Lanjut Login
            </button>
        </div>
    </div>
    @vite('resources/js/auth.js')
</body>
</html>