<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - Lapor.in')</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Inter', sans-serif; background-color: #F8F9FA; }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>
<body class="min-h-screen flex text-gray-800 antialiased selection:bg-[#D32F0F] selection:text-white">

    <!-- Overlay Gelap untuk Mobile (Muncul saat sidebar terbuka) -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden transition-opacity cursor-pointer"></div>

    <!-- SIDEBAR -->
    <!-- Tambahan: -translate-x-full (Sembunyi di HP), md:translate-x-0 (Muncul di Desktop) -->
    <aside id="adminSidebar" class="fixed inset-y-0 left-0 w-64 bg-gradient-to-b from-[#B91408] to-[#F75702] text-white shadow-2xl z-50 flex flex-col transform -translate-x-full md:translate-x-0 transition-transform duration-300">
        
        <!-- Logo Area -->
        <div class="flex items-center justify-between md:justify-center h-20 border-b border-white/10 px-4 md:px-0">
            <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-2 hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('img/logo.png') }}" alt="Logo Lapor.in" class="h-10 w-auto">
            </a>
            <!-- Tombol Close (X) Khusus Mobile -->
            <button id="closeSidebarBtn" class="md:hidden text-white hover:text-gray-200">
                <i class="fa-solid fa-xmark text-2xl"></i>
            </button>
        </div>

        <!-- Menu Navigasi -->
        <nav class="flex-grow px-4 pt-6 space-y-1.5 overflow-y-auto">
            <p class="px-2 text-[11px] font-extrabold text-white/50 uppercase tracking-widest mb-3">Menu Utama</p>
            
            <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->is('admin/dashboard') ? 'bg-white text-[#B91408] font-bold shadow-md translate-x-1' : 'font-medium text-white/80 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">
                <i class="fa-solid fa-chart-pie w-5 text-center"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ url('/admin/review') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->is('admin/review') ? 'bg-white text-[#B91408] font-bold shadow-md translate-x-1' : 'font-medium text-white/80 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">
                <i class="fa-solid fa-clipboard-list w-5 text-center"></i>
                <span>Pemantauan</span>
            </a>

            <a href="{{ url('/admin/users') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->is('admin/users') ? 'bg-white text-[#B91408] font-bold shadow-md translate-x-1' : 'font-medium text-white/80 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">
                <i class="fa-solid fa-users-gear w-5 text-center"></i>
                <span>Control User</span>
            </a>

            <a href="{{ url('/admin/edukasi') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 {{ request()->is('admin/edukasi*') ? 'bg-white text-[#B91408] font-bold shadow-md translate-x-1' : 'font-medium text-white/80 hover:bg-white/10 hover:text-white hover:translate-x-1' }}">
                <i class="fa-solid fa-book-open w-5 text-center"></i>
                <span>Edukasi</span>
            </a>
        </nav>

        <!-- Profil Bawah -->
        <div class="p-4 border-t border-white/10">
            <a href="{{ url('/login') }}" class="flex items-center gap-3 w-full p-3 rounded-xl hover:bg-white/10 transition-all duration-300 text-left group">
                <div class="bg-white/20 min-w-[2.5rem] w-10 h-10 rounded-full flex items-center justify-center font-bold text-white group-hover:bg-white group-hover:text-[#B91408] transition-colors">
                    A
                </div>
                <div class="flex-grow overflow-hidden">
                    <p class="text-sm font-bold text-white leading-tight truncate">Admin Kelurahan</p>
                    <p class="text-xs text-white/70 mt-0.5 truncate">admin@lapor.in</p>
                </div>
                <i class="fa-solid fa-right-from-bracket text-white/70 group-hover:text-white transition-colors"></i>
            </a>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <!-- Tambahan: ml-0 (Khusus Mobile), md:ml-64 (Desktop) -->
    <main class="ml-0 md:ml-64 flex-1 flex flex-col min-h-screen transition-all duration-300 w-full">
        
        <!-- Topbar Dinamis (Sticky) -->
        <header class="bg-white/80 backdrop-blur-md shadow-sm border-b border-gray-100 h-20 px-4 md:px-8 flex items-center justify-between md:justify-end sticky top-0 z-30 transition-all">
            
            <!-- Tombol Hamburger (Hanya muncul di Mobile) -->
            <button id="openSidebarBtn" class="md:hidden text-[#D32F0F] hover:bg-red-50 p-2 rounded-lg transition-colors focus:outline-none">
                <i class="fa-solid fa-bars text-2xl"></i>
            </button>

            <!-- Aksesori Kanan -->
            <div class="flex items-center gap-4">
                <button class="w-10 h-10 rounded-full bg-gray-50 hover:bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-600 transition-all relative shadow-sm hover:shadow">
                    <i class="fa-regular fa-bell"></i>
                    <!-- Indikator Notif -->
                    <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white animate-pulse"></span>
                </button>
            </div>
        </header>

        <!-- Container Konten Utama -->
        <div class="p-4 md:p-8 flex-grow overflow-x-hidden">
            <!-- Efek Fade In -->
            <div class="animate-[fadeIn_0.5s_ease-in-out]">
                @yield('content')
            </div>
        </div>

        <!-- Footer Admin -->
        <footer class="bg-white border-t border-gray-200 text-center py-4 text-xs font-medium text-gray-400">
            &copy; {{ date('Y') }} Sistem Informasi Lapor.in &mdash; Ambarejo
        </footer>
    </main>

    <!-- Script untuk Toggle Sidebar Mobile -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById('adminSidebar');
            const openBtn = document.getElementById('openSidebarBtn');
            const closeBtn = document.getElementById('closeSidebarBtn');
            const overlay = document.getElementById('sidebarOverlay');

            // Fungsi Buka Sidebar
            openBtn.addEventListener('click', () => {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                document.body.classList.add('overflow-hidden'); // Kunci scroll background
            });

            // Fungsi Tutup Sidebar
            const closeSidebar = () => {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden'); // Buka scroll background
            };

            closeBtn.addEventListener('click', closeSidebar);
            overlay.addEventListener('click', closeSidebar);
        });
    </script>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>