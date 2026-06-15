<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Lapor.in</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .bg-laporin { background-color: #D32F0F; }
        .btn-gradient { background: linear-gradient(to bottom, #E63917, #B22206); }
        .rounded-right-curve { border-top-right-radius: 250px; border-bottom-right-radius: 250px; }
        .input-gray { background-color: #DDE2E5; }
    </style>
</head>
<body class="bg-white min-h-screen flex items-center justify-center overflow-x-hidden">

    <div class="flex w-full min-h-screen">
        <div class="hidden lg:flex w-1/2 bg-laporin rounded-right-curve items-center justify-center text-white flex-col px-10 relative overflow-hidden">
            <img src="{{ asset('img/logo.png') }}" alt="Logo Laporin" class="w-80 mb-6">
            <h3 class="text-5xl font-semibold mb-8 text-center">Hallo, Selamat Datang!</h3>
            <p class="text-2xl mb-6">Belum Punya Akun?</p>
            <a href="{{ url('/register') }}" class="border-2 border-white text-white px-16 py-2 rounded-2xl text-2xl font-bold hover:bg-white hover:text-red-700 transition">
                Daftar
            </a>
        </div>

        <div class="w-full lg:w-1/2 p-8 lg:p-16 flex flex-col justify-center items-center">
            
            <img src="{{ asset('img/logo-dark.png') }}" alt="Laporin" class="w-32 mb-8 lg:hidden block">

            <h1 class="text-5xl lg:text-6xl font-bold text-gray-800 mb-12 lg:mb-16">Masuk</h1>

            <form action="{{ url('/login') }}" method="POST" id="formLogin" class="w-full max-w-md flex flex-col gap-6">
                @csrf
                
                <div class="relative">
                    <input type="email" id="email" name="email" placeholder="Email, No. telp, atau username" required
                           class="w-full input-gray p-4 rounded-xl focus:outline-none pr-12 text-gray-700 placeholder-gray-500">
                    <i class="fa-regular fa-user absolute right-4 top-1/2 -translate-y-1/2 text-2xl text-gray-600"></i>
                </div>

                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="Password" required
                           class="w-full input-gray p-4 rounded-xl focus:outline-none pr-12 text-gray-700 placeholder-gray-500">
                    <i class="fa-solid fa-lock absolute right-4 top-1/2 -translate-y-1/2 text-2xl text-gray-600"></i>
                </div>

                <div class="flex justify-start">
                    <a href="#" class="text-lg font-medium text-gray-700 hover:underline">Lupa Password!</a>
                </div>

                <div class="mt-8">
                    <button type="submit" id="btnLogin" class="w-full btn-gradient text-white font-bold text-4xl lg:text-5xl py-4 rounded-2xl shadow-lg hover:opacity-90 transition tracking-wider">
                        MASUK
                    </button>
                </div>

                <div class="mt-6 text-center lg:hidden">
                    <p class="text-gray-600 text-lg">
                        Belum punya akun? 
                        <a href="{{ url('/register') }}" class="text-[#D32F0F] font-bold hover:underline transition">
                            Daftar sekarang
                        </a>
                    </p>
                </div>

            </form>
        </div>
    </div>
    
    @vite('resources/js/auth.js')
</body>
</html>