async function loadDashboardData() {
    const token = localStorage.getItem('token_laporin');
    
    const namaKategori = { 
        1: 'Infrastruktur', 
        2: 'Keamanan', 
        3: 'Kebersihan', 
        4: 'Aspirasi', 
        5: 'Administrasi' 
    };

    try {
        const res = await fetch('/api/admin/dashboard/statistik', {
            headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
        });

        if (!res.ok) return;

        const result = await res.json();
        if (result.success) {
            const data = result.data;

            // 1. CHART
            const ctx = document.getElementById('statistikChart')?.getContext('2d');
            if (ctx) {
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        datasets: [{
                            data: [data.laporan_masuk || 0, data.laporan_proses || 0, data.laporan_selesai || 0],
                            backgroundColor: ['#4A0404', '#B91C1C', '#FF4500'],
                            borderWidth: 0
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, rotation: -90, circumference: 180, cutout: '75%', plugins: { legend: { display: false } } }
                });
            }

            // 2. PERBAIKAN: LAPORAN PENTING (Ganti dari laporan_terbaru ke laporan_penting)
            const container = document.getElementById('laporan-penting-container');
            if (container) {
                if (data.laporan_penting && data.laporan_penting.length > 0) {
                    container.innerHTML = data.laporan_penting.map(item => `
                        <div class="bg-[#D32F0F] text-white p-4 rounded-xl shadow-lg">
                            <div class="flex items-start gap-2">
                                <span class="text-lg">!</span>
                                <div>
                                    <h3 class="font-bold text-sm truncate">${item.judul || 'Tanpa Judul'}</h3>
                                    <p class="text-[10px] opacity-80 mt-1">
                                        ${item.created_at ? new Date(item.created_at).toLocaleDateString() : '-'} — ${namaKategori[item.id_kategori] || 'Umum'}
                                    </p>
                                </div>
                            </div>
                        </div>
                    `).join('');
                } else {
                    // Ini pesan kalau belum ada laporan penting
                    container.innerHTML = '<p class="text-gray-400 text-sm italic p-4">Belum ada laporan penting.</p>';
                }
            }

            // 3. UPDATE RINCIAN LAPORAN
            if (data.kategori_stats && Array.isArray(data.kategori_stats)) {
                data.kategori_stats.forEach(item => {
                    const el = document.getElementById(`kat-${item.id}`); 
                    if (el) el.innerText = item.jumlah || 0;
                });
            }
        }
    } catch (error) {
        console.error("Error:", error);
    }
}

document.addEventListener('DOMContentLoaded', loadDashboardData);