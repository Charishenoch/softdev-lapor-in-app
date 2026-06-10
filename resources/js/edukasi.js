let currentPage = 1;
let currentCategory = '';
let currentSearch = '';

async function loadEdukasi(page = 1, search = '', kategori = '') {
    const response = await fetch(`/api/edukasi?page=${page}&search=${search}&kategori=${kategori}`);
    const result = await response.json();
    const data = result.data.data;
    
    // Render Artikel
    const container = document.getElementById('artikel-container');
    container.innerHTML = data.map(artikel => `
        <div class="bg-white rounded-2xl shadow-sm border overflow-hidden hover:shadow-lg transition flex flex-col cursor-pointer">
            <div class="h-44 bg-gray-200 overflow-hidden relative">
                <img src="${artikel.thumbnail}" class="w-full h-full object-cover">
            </div>
            <div class="p-5 flex-grow">
                <span class="text-[10px] font-black text-[#D32F0F] uppercase">${artikel.kategori}</span>
                <h3 class="font-bold text-gray-800 leading-snug">${artikel.judul}</h3>
            </div>
        </div>
    `).join('');

    renderPagination(result.data);
}

// Event Listener Search
document.querySelector('input[type="text"]').addEventListener('input', (e) => {
    currentSearch = e.target.value;
    loadEdukasi(1, currentSearch, currentCategory);
});

// Event Listener Filter (klik tombol kategori)
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', (e) => {
        currentCategory = e.target.innerText === 'Semua' ? '' : e.target.innerText;
        loadEdukasi(1, currentSearch, currentCategory);
    });
});

// Jalankan saat pertama kali dimuat
loadEdukasi();