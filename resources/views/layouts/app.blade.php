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

<body class="bg-gray-50 min-h-screen flex flex-col antialiased">

    <header class="bg-gradient-to-r from-[#F75702] to-[#B91408] text-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="{{ url('/dashboard') }}" class="flex-shrink-0">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Lapor.in" class="h-10 w-auto">
                </a>

                @php
                    $navLinks = [
                        ['url' => '/dashboard', 'label' => 'Dashboard'],
                        ['url' => '/lapor', 'label' => 'Lapor'],
                        ['url' => '/riwayat', 'label' => 'Riwayat'],
                        ['url' => '/edukasi', 'label' => 'Edukasi'],
                    ];
                @endphp
                <nav class="hidden md:flex space-x-8">
                    @foreach($navLinks as $link)
                        <a href="{{ url($link['url']) }}" 
                           class="text-lg pb-1 transition-all {{ request()->is(ltrim($link['url'], '/')) ? 'font-bold border-b-2 border-white' : 'font-medium text-white/80 hover:text-white hover:border-b-2 hover:border-white/50' }}">
                           {{ $link['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="flex items-center gap-4">
                    <button class="text-xl hover:text-yellow-300 transition relative">
                        <i class="fa-regular fa-bell"></i>
                        <span class="absolute top-0 right-0 block h-2.5 w-2.5 rounded-full bg-yellow-400 ring-2 ring-red-600"></span>
                    </button>

                    <div class="hidden sm:block relative group">
                        <button class="flex items-center bg-white/20 hover:bg-white/30 px-5 py-2 rounded-xl border border-white/10 gap-2 transition">
                            <span class="font-medium tracking-wide">User</span>
                            <i class="fa-solid fa-chevron-down text-xs"></i>
                        </button>
                        <div class="absolute right-0 top-full pt-2 w-40 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                            <div class="bg-white rounded-xl shadow-xl overflow-hidden">
                                <form action="{{ url('/logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 font-bold flex items-center gap-2">
                                        <i class="fa-solid fa-right-from-bracket"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <button id="mobile-menu-btn" class="md:hidden text-2xl p-2 focus:outline-none">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>

        <div id="mobile-menu" class="hidden md:hidden bg-[#990F05] border-t border-white/10 px-4 py-4 space-y-2">
            @foreach($navLinks as $link)
                <a href="{{ url($link['url']) }}" 
                   class="block px-3 py-2 rounded-lg font-medium {{ request()->is(ltrim($link['url'], '/')) ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10' }}">
                   {{ $link['label'] }}
                </a>
            @endforeach
            <hr class="border-white/10 my-2">
            <form action="{{ url('/logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 text-red-200 font-bold flex items-center gap-2">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar Akun
                </button>
            </form>
        </div>
    </header>

    <main class="flex-grow w-full max-w-7xl mx-auto p-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <footer class="bg-white text-center p-4 border-t mt-auto text-sm text-gray-500">
        &copy; {{ date('Y') }} Lapor.in
    </footer>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
    @vite(['resources/js/app.js'])
</body>
</html>