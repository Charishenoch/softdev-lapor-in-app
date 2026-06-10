// 1. Ambil token dari storage (hasil login)
const token = localStorage.getItem('token_laporin');

// Kalau nggak ada token, tendang ke login
if(!token) {
    window.location.href = '/login';
} else {
    // Kalau ada token, siapkan Header buat nembak API
    const headers = {
        'Authorization': 'Bearer ' + token,
        'Accept': 'application/json'
    };

    // 2. Tarik Data Greeting
    fetch('/api/dashboard', { headers })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                // Pastikan ID elemennya bener-bener 'greeting-text' di blade-nya Jo
                const greetingEl = document.getElementById('greeting-text');
                if(greetingEl) greetingEl.innerText = data.message;
            }
        })
        .catch(err => console.error('Error Greeting:', err));

    // 3. Tarik Data Statistik
    fetch('/api/dashboard/stats', { headers })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                const totalEl = document.getElementById('angka-total');
                const prosesEl = document.getElementById('angka-proses');
                const selesaiEl = document.getElementById('angka-selesai');

                if(totalEl) totalEl.innerText = data.data.total_laporan < 10 ? '0'+data.data.total_laporan : data.data.total_laporan;
                if(prosesEl) prosesEl.innerText = data.data.diproses < 10 ? '0'+data.data.diproses : data.data.diproses;
                if(selesaiEl) selesaiEl.innerText = data.data.selesai < 10 ? '0'+data.data.selesai : data.data.selesai;
            }
        })
        .catch(err => console.error('Error Stats:', err));

    // 4. Tarik Data Laporan Ongoing
    fetch('/api/dashboard/ongoing', { headers })
        .then(res => res.json())
        .then(data => {
            const cardEl = document.getElementById('ongoing-card');
            if(data.success && data.data.length > 0) {
                const report = data.data[0]; 
                
                const judulEl = document.getElementById('ongoing-judul');
                const descEl = document.getElementById('ongoing-deskripsi');

                if(judulEl) judulEl.innerText = report.judul;
                if(descEl) descEl.innerText = report.deskripsi_asli.length > 90 ? report.deskripsi_asli.substring(0, 90) + '...' : report.deskripsi_asli;
            } else {
                if(cardEl) {
                    cardEl.innerHTML = '<p class="text-gray-500 text-center py-4">Belum ada laporan yang sedang diproses saat ini.</p>';
                }
            }
        })
        .catch(err => console.error('Error Ongoing:', err));
}