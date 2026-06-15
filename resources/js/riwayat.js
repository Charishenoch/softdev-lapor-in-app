document.addEventListener('DOMContentLoaded', async function() {
    const token = localStorage.getItem('token_laporin');
    const container = document.getElementById('riwayat-container');

    try {
        const response = await fetch('/api/riwayat', {
            headers: { 'Authorization': 'Bearer ' + token }
        });
        const result = await response.json();

        if (result.success) {
            container.innerHTML = result.data.map((item, index) => `
                <div class="mb-4">
                    <div class="bg-red-700 p-5 rounded-xl flex justify-between items-center cursor-pointer text-white shadow-lg" onclick="toggleDetail('detail-${index}')">
                        <div class="flex items-center gap-4">
                            <i class="fa-solid fa-circle-exclamation text-2xl"></i>
                            <div>
                                <h3 class="font-bold text-lg">${item.judul}</h3>
                                <p class="text-sm opacity-80">${item.waktu_kejadian} WIB [${item.tanggal_kejadian}]</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6">
                            <span class="italic opacity-70">-- Infrastruktur & Fasilitas</span>
                            <span class="bg-yellow-300 text-black px-4 py-1.5 rounded-full font-bold text-sm">
                                ${item.status_laporan}
                            </span>
                        </div>
                    </div>

                    <div id="detail-${index}" class="hidden bg-gray-100 p-6 rounded-b-xl border-x border-b shadow-inner">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h3 class="font-bold text-lg text-gray-800">${item.judul}</h3>
                                <p class="text-sm text-gray-500">ID Laporan: ${item.id_laporan}</p>
                            </div>
                            <button class="bg-orange-200 text-orange-800 px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2">
                                <i class="fa-regular fa-comment-dots"></i> Chat Admint
                            </button>
                        </div>
                        
                        <p class="text-gray-600 bg-white p-4 rounded-lg mb-6 text-sm italic border">
                            "${item.deskripsi_asli}"
                        </p>

                        <div class="pl-4 border-l-2 border-gray-300 space-y-6">
                           ${renderStepper(item.status_laporan)}
                        </div>
                    </div>
                </div>
            `).join('');
        }
    } catch (e) { console.error(e); }
});

// Fungsi Stepper agar visualnya sama dengan screenshot
function renderStepper(status) {
    return `
        <div class="relative">
            <div class="absolute -left-[25px] w-4 h-4 rounded-full bg-blue-500 border-4 border-white"></div>
            <h4 class="font-bold text-sm text-gray-800">Laporan Terkirim</h4>
        </div>
        <div class="relative">
            <div class="absolute -left-[25px] w-4 h-4 rounded-full bg-yellow-400 border-4 border-white"></div>
            <h4 class="font-bold text-sm text-gray-800">Sedang Diproses</h4>
            <p class="text-xs text-gray-500">Admin sedang mengecek lokasi...</p>
        </div>
    `;
}

window.toggleDetail = function(id) {
    document.getElementById(id).classList.toggle('hidden');
};