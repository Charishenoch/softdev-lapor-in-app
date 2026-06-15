document.addEventListener('DOMContentLoaded', () => {
    const listArtikel = document.getElementById('list-artikel');
    const searchInput = document.getElementById('search-input');
    const btnSearch = document.getElementById('btn-search');
    const filterBtns = document.querySelectorAll('.filter-btn');

    // Simpan status filter saat ini
    let currentCategory = 'Semua';
    let searchQuery = '';

    // Fungsi utama buat narik data
    const ambilArtikelUser = async () => {
        const token = localStorage.getItem('token_laporin');
        
        // Munculin loading spinner
        if (listArtikel) {
            listArtikel.innerHTML = '<div class="col-span-full text-center text-gray-500 py-10"><i class="fa-solid fa-spinner fa-spin text-3xl mb-3"></i><p>Memuat pusat edukasi...</p></div>';
        }

        try {
            // Susun URL dengan parameter (buat fitur search & filter)
            let url = '/api/artikel?';
            if (currentCategory !== 'Semua') url += `kategori=${currentCategory}&`;
            if (searchQuery !== '') url += `search=${searchQuery}`;

            const res = await fetch(url, {
                method: 'GET',
                headers: { 
                    'Authorization': 'Bearer ' + token, 
                    'Accept': 'application/json' 
                }
            });
            
            const result = await res.json();
            
            if (result.success && listArtikel) {
                const data = result.data;
                
                // Looping data dan cetak ke HTML
                listArtikel.innerHTML = data.length ? data.map(item => `
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition duration-300 cursor-pointer flex flex-col h-full group">
                        <div class="relative overflow-hidden h-48 bg-gray-100">
                            <img src="${item.thumbnail_url || '/storage/'+item.thumbnail}" alt="${item.judul}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" onerror="this.src='https://via.placeholder.com/400x200?text=Lapor.in'">
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <span class="text-xs font-bold text-[#D32F0F] bg-red-50 px-3 py-1 rounded-full w-max mb-3 border border-red-100">${item.kategori}</span>
                            <h3 class="text-xl font-bold text-gray-800 leading-tight mb-3 line-clamp-2">${item.judul}</h3>
                            <p class="text-sm text-gray-600 line-clamp-3 mb-4 flex-grow">${item.isi}</p>
                            
                            <div class="mt-auto pt-4 border-t border-gray-100 flex justify-between items-center">
                                <span class="text-[#D32F0F] text-sm font-bold group-hover:underline">Baca panduan <i class="fa-solid fa-arrow-right text-xs ml-1"></i></span>
                            </div>
                        </div>
                    </div>
                `).join('') : `
                    <div class="col-span-full text-center text-gray-500 py-10 bg-white rounded-2xl border border-gray-100 shadow-sm">
                        <i class="fa-regular fa-folder-open text-4xl mb-3 text-gray-300"></i><br>
                        ${searchQuery ? `Tidak ada artikel untuk pencarian "<b>${searchQuery}</b>"` : 'Belum ada artikel edukasi untuk kategori ini.'}
                    </div>
                `;
            }
        } catch (error) {
            console.error('Gagal ambil artikel:', error);
            if(listArtikel) {
                listArtikel.innerHTML = '<div class="col-span-full text-center text-red-500 py-10 font-bold bg-red-50 rounded-2xl border border-red-100">Gagal memuat artikel. Cek koneksi atau muat ulang halaman.</div>';
            }
        }
    };

    // --- EVENT LISTENER UNTUK FILTER KATEGORI ---
    filterBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            // 1. Reset warna semua tombol jadi putih (inactive)
            filterBtns.forEach(b => {
                b.classList.remove('bg-[#D32F0F]', 'text-white', 'shadow-md', 'shadow-red-200');
                b.classList.add('bg-white', 'text-gray-600');
            });

            // 2. Kasih warna merah ke tombol yang diklik (active)
            const clickedBtn = e.target;
            clickedBtn.classList.remove('bg-white', 'text-gray-600');
            clickedBtn.classList.add('bg-[#D32F0F]', 'text-white', 'shadow-md', 'shadow-red-200');

            // 3. Update kategori dan tarik data lagi
            currentCategory = clickedBtn.getAttribute('data-kategori');
            ambilArtikelUser();
        });
    });

    // --- EVENT LISTENER UNTUK PENCARIAN (SEARCH) ---
    if (btnSearch && searchInput) {
        // Kalau tombol cari diklik
        btnSearch.addEventListener('click', () => {
            searchQuery = searchInput.value.trim();
            ambilArtikelUser();
        });

        // Kalau user tekan tombol "Enter" di keyboard
        searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchQuery = searchInput.value.trim();
                ambilArtikelUser();
            }
        });
    }

    // Panggil fungsi pertama kali saat halaman baru dibuka
    ambilArtikelUser();
});