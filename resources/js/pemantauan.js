/**
 * FUNGSI GLOBAL
 */
window.updateStatus = async function(id, statusBaru) {
    const token = localStorage.getItem('token_laporin');
    try {
        const res = await fetch(`/api/admin/update-status/${id}`, {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status: statusBaru })
        });
        if ((await res.json()).success) window.refreshTabel();
    } catch (e) { console.error(e); }
};

window.togglePenting = async function(id) {
    const token = localStorage.getItem('token_laporin');
    try {
        const res = await fetch(`/api/admin/laporan/${id}/tandai-penting`, {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
        if ((await res.json()).success) window.refreshTabel();
    } catch (e) { console.error(e); }
};

// FUNGSI TOGGLE DROPDOWN KATEGORI - FIXED DENGAN DEKRIPSI RSA FRONTEND JIKA PERLU
window.toggleDropdown = async function(idKategori, btnElement) {
    const container = document.getElementById(`dropdown-${idKategori}`);
    if (!container) return;

    if (container.style.display === 'block') {
        container.style.display = 'none';
        btnElement.innerText = "OPEN LIST.";
        return;
    }

    const token = localStorage.getItem('token_laporin');
    container.innerHTML = '<p class="p-4 text-center text-gray-500 italic">Memuat data...</p>';
    container.style.display = 'block';
    btnElement.innerText = "CLOSE LIST.";

    try {
        const res = await fetch(`/api/admin/laporan-kategori/${idKategori}`, {
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json'
            }
        });
        const result = await res.json();

        if (result.success) {
            if (result.data.length === 0) {
                container.innerHTML = '<p class="p-4 text-center text-gray-500">Tidak ada laporan di kategori ini.</p>';
            } else {
                container.innerHTML = `
                    <table class="w-full mt-4 bg-white rounded-lg shadow-sm border text-sm">
                        <thead class="bg-gray-50 border-b">
                            <tr>
                                <th class="p-3 text-left">Tanggal</th>
                                <th class="p-3 text-left">Judul</th>
                                <th class="p-3 text-left">Deskripsi Kejadian (Terdekripsi)</th>
                                <th class="p-3 text-left">Lokasi</th>
                                <th class="p-3 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${result.data.map(item => `
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3 whitespace-nowrap">${new Date(item.created_at).toLocaleDateString('id-ID')}</td>
                                    <td class="p-3 font-medium">${item.judul || '-'}</td>
                                    <td class="p-3 text-gray-600 max-w-xs truncate" title="${item.deskripsi_asli || 'Data terenkripsi'}">
                                        ${item.deskripsi_asli || '<i class="text-red-500">[Butuh Dekripsi Server]</i>'}
                                    </td>
                                    <td class="p-3">${item.lokasi_kejadian || '-'}</td>
                                    <td class="p-3 font-bold text-xs uppercase ${item.status_laporan === 'selesai' ? 'text-green-600' : 'text-orange-500'}">${item.status_laporan}</td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                `;
            }
        }
    } catch (e) {
        console.error(e);
        container.innerHTML = '<p class="p-4 text-center text-red-500">Gagal memuat data.</p>';
    }
};

/**
 * FUNGSI MENGAMBIL ANGKA STATISTIK KATEGORI
 */
const ambilAngkaKategori = async () => {
    const token = localStorage.getItem('token_laporin');
    try {
        const res = await fetch('/api/admin/dashboard/statistik', {
            headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
        });
        const result = await res.json();
        
        if (result.success && result.data.kategori_stats) {
            // Ngeset angka ke masing-masing span ID kat-1 sampai kat-5
            const stats = result.data.kategori_stats;
            document.getElementById('kat-1').innerText = stats.find(k => k.id === 'inf')?.jumlah || 0;
            document.getElementById('kat-2').innerText = stats.find(k => k.id === 'kea')?.jumlah || 0;
            document.getElementById('kat-3').innerText = stats.find(k => k.id === 'keb')?.jumlah || 0;
            document.getElementById('kat-4').innerText = stats.find(k => k.id === 'asp')?.jumlah || 0;
            document.getElementById('kat-5').innerText = stats.find(k => k.id === 'adm')?.jumlah || 0;
        }
    } catch (e) {
        console.error('Gagal mengambil angka statistik kategori:', e);
    }
};


/**
 * DOMContentLoaded
 */
document.addEventListener('DOMContentLoaded', () => {
    const tbody = document.getElementById('table-darurat-body');
    const nav = document.getElementById('pagination-nav');
    const info = document.getElementById('pagination-info');
    const filter = document.getElementById('filter-status');
    let currentPage = 1;

    window.refreshTabel = () => ambilData(currentPage, filter ? filter.value : 'all');

    if (filter) {
        filter.addEventListener('change', (e) => ambilData(1, e.target.value));
    }

    const renderTabel = (data) => {
        if (!tbody) return;
        if (!data || data.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" class="p-6 text-center text-gray-400">Tidak ada laporan.</td></tr>';
            return;
        }

        tbody.innerHTML = data.map(item => `
            <tr class="bg-white border-b hover:bg-red-50 transition">
                <td class="px-6 py-4 text-sm">${new Date(item.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })}</td>
                <td class="px-6 py-4 text-sm truncate max-w-[150px]">${item.judul || '-'}</td>
                <td class="px-6 py-4 text-sm">${item.lokasi_kejadian || '-'}</td>
                <td class="px-6 py-4">
                    <select onchange="updateStatus(${item.id}, this.value)"
                            class="${item.status_laporan === 'selesai' ? 'bg-green-100 text-green-700' : item.status_laporan === 'penanganan' ? 'bg-orange-100 text-orange-700' : item.status_laporan === 'proses' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700'} border-none text-xs font-bold rounded-full p-2 outline-none cursor-pointer">
                        <option value="terkirim" ${item.status_laporan === 'terkirim' ? 'selected' : ''}>Terkirim</option>
                        <option value="proses" ${item.status_laporan === 'proses' ? 'selected' : ''}>Proses Review</option>
                        <option value="penanganan" ${item.status_laporan === 'penanganan' ? 'selected' : ''}>Penanganan</option>
                        <option value="selesai" ${item.status_laporan === 'selesai' ? 'selected' : ''}>Selesai</option>
                    </select>
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="flex justify-center gap-2">
                        <button class="bg-blue-500 text-white w-8 h-8 rounded hover:bg-blue-600"><i class="fa-solid fa-eye"></i></button>
                        <button onclick="togglePenting(${item.id})"
                                class="${item.status_penting == 1 ? 'bg-yellow-400' : 'bg-gray-300'} text-white w-8 h-8 rounded hover:bg-yellow-500 transition-colors duration-300">
                            <i class="fa-solid fa-star"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');
    };

    const renderPagination = (totalPages) => {
        if (!nav) return;
        nav.innerHTML = '';
        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement('button');
            btn.innerText = i;
            btn.className = `w-8 h-8 rounded border transition ${i === currentPage ? 'bg-[#D32F0F] text-white border-[#D32F0F]' : 'bg-white border-gray-300 hover:bg-gray-100'}`;
            btn.onclick = () => ambilData(i, filter ? filter.value : 'all');
            nav.appendChild(btn);
        }
    };

    const ambilData = async (page = 1, status = 'all') => {
        currentPage = page;
        const token = localStorage.getItem('token_laporin');
        let url = `/api/admin/laporan-darurat?page=${page}`;
        if (status !== 'all') url += `&status=${status}`;
        try {
            const res = await fetch(url, { headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' } });
            const result = await res.json();
            if (result.success) {
                renderTabel(result.data);
                renderPagination(result.total_pages);
                if (info) info.innerText = `Menampilkan halaman ${currentPage} dari ${result.total_pages}.`;
            }
        } catch (e) { console.error(e); }
    };

    // Jalankan saat halaman pertama kali diload
    ambilData(1);
    ambilAngkaKategori(); // Panggil fungsi buat narik angka 0 jadi jumlah asli
});