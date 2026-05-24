<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Lapor.in')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #F8F9FA; }
    </style>
</head>
<body class="min-h-screen flex flex-col overflow-x-hidden">

    <header class="bg-gradient-to-r from-[#F75702] to-[#B91408] text-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">
                
                <a href="{{ url('admin/dashboard') }}" class="flex-shrink-0 flex items-center cursor-pointer">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo Lapor.in" class="h-10 w-auto">
                </a>

                <nav class="hidden md:flex space-x-8">
                    <a href="{{ url('/admin/dashboard') }}" class="text-sm md:text-base {{ request()->is('admin/dashboard') ? 'font-bold border-b-[3px] border-white pb-1' : 'font-medium text-white/80 hover:text-white transition' }}">Dashboard</a>
                    <a href="{{ url('/admin/review') }}" class="text-sm md:text-base {{ request()->is('admin/review') ? 'font-bold border-b-[3px] border-white pb-1' : 'font-medium text-white/80 hover:text-white transition' }}">Review</a>
                    <a href="{{ url('/admin/users') }}" class="text-sm md:text-base {{ request()->is('admin/users') ? 'font-bold border-b-[3px] border-white pb-1' : 'font-medium text-white/80 hover:text-white transition' }}">Control User</a>
                    <a href="{{ url('/admin/edukasi') }}" class="text-sm md:text-base {{ request()->is('admin/edukasi') ? 'font-bold border-b-[3px] border-white pb-1' : 'font-medium text-white/80 hover:text-white transition' }}">Edukasi</a>
                </nav>

                <div class="flex items-center space-x-4">
                    <button class="text-xl relative hover:text-gray-200 transition">
                        <i class="fa-regular fa-bell"></i>
                        <span class="absolute -top-1 -right-1 block h-2 w-2 rounded-full bg-yellow-400"></span>
                    </button>
                    
                    <button class="flex items-center gap-2 bg-white/20 hover:bg-white/30 transition px-4 py-1.5 rounded-lg border border-white/10">
                        <span class="text-sm font-semibold">Admin</span>
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow w-full max-w-7xl mx-auto p-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

</body>
</html>