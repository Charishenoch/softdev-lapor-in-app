<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Lapor.in - Sistem Pelaporan Masyarakat')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col overflow-x-hidden">

    <header class="bg-gradient-to-r from-[#F75702] to-[#B91408] text-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                
                <a href="{{ url('/dashboard') }}" class="flex-shrink-0 flex items-center cursor-pointer">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Lapor.in" class="h-10 w-auto">
                </a>

                <nav class="hidden md:flex space-x-10">
                    <a href="{{ url('/dashboard') }}" class="text-lg {{ request()->is('dashboard') ? 'font-bold border-b-[3px] border-white pb-1' : 'font-medium text-white/80 hover:text-white hover:border-b-[3px] hover:border-white/50 pb-1 transition-all' }}">Dashboard</a>
                    <a href="{{ url('/lapor') }}" class="text-lg {{ request()->is('lapor') ? 'font-bold border-b-[3px] border-white pb-1' : 'font-medium text-white/80 hover:text-white hover:border-b-[3px] hover:border-white/50 pb-1 transition-all' }}">Lapor</a>
                    <a href="{{ url('/riwayat') }}" class="text-lg {{ request()->is('riwayat') ? 'font-bold border-b-[3px] border-white pb-1' : 'font-medium text-white/80 hover:text-white hover:border-b-[3px] hover:border-white/50 pb-1 transition-all' }}">Riwayat</a>
                    <a href="{{ url('/edukasi') }}" class="text-lg {{ request()->is('edukasi') ? 'font-bold border-b-[3px] border-white pb-1' : 'font-medium text-white/80 hover:text-white hover:border-b-[3px] hover:border-white/50 pb-1 transition-all' }}">Edukasi</a>
                </nav>

                <div class="flex items-center space-x-4 md:space-x-6">
                    <button class="text-2xl text-white/90 hover:text-white transition relative">
                        <i class="fa-regular fa-bell"></i>
                        <span class="absolute top-0 right-0 block h-2.5 w-2.5 rounded-full bg-yellow-400 ring-2 ring-red-600"></span>
                    </button>

                    <button class="hidden sm:flex items-center bg-white/20 hover:bg-white/30 transition-colors px-6 py-2 rounded-xl border border-white/10">
                        <span class="text-lg font-medium tracking-wide">User</span>
                    </button>

                    <button id="mobile-menu-btn" class="md:hidden text-2xl text-white p-2 focus:outline-none">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden bg-[#990F05] shadow-inner">
            <div class="px-4 pt-2 pb-4 space-y-2">
                <a href="{{ url('/dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('dashboard') ? 'bg-white/20 text-white font-bold' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">Dashboard</a>
                <a href="{{ url('/lapor') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('lapor') ? 'bg-white/20 text-white font-bold' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">Lapor</a>
                <a href="{{ url('/riwayat') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('riwayat') ? 'bg-white/20 text-white font-bold' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">Riwayat</a>
                <a href="{{ url('/edukasi') }}" class="block px-3 py-2 rounded-md text-base font-medium {{ request()->is('edukasi') ? 'bg-white/20 text-white font-bold' : 'text-white/80 hover:bg-white/10 hover:text-white' }}">Edukasi</a>
            </div>
        </div>
    </header>

    <main class="flex-grow w-full max-w-7xl mx-auto p-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <footer class="bg-white text-center p-4 border-t mt-auto">
        <p class="text-sm text-gray-500">&copy; 2026 Lapor.in</p>
    </footer>

    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        const icon = btn.querySelector('i');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
            
            // Mengubah ikon garis tiga menjadi 'X' saat terbuka
            if (menu.classList.contains('hidden')) {
                icon.classList.remove('fa-xmark');
                icon.classList.add('fa-bars');
            } else {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-xmark');
            }
        });
    </script>
</body>
</html>