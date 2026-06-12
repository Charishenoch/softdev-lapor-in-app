// 1. Import bawaan Laravel (jangan hapus ini)
import './bootstrap';

// 2. Fungsi Polling Notifikasi (ini hasil pindahan tadi)
async function checkNotifikasi() {
    const token = localStorage.getItem('token_laporin');
    if (!token) return;

    try {
        const response = await fetch('/api/notifications', {
            headers: { 'Authorization': 'Bearer ' + token }
        });
        const result = await response.json();

        if (result.success) {
            const unread = result.data.filter(n => !n.read_at).length;
            const notifSpan = document.getElementById('notif-count');
            
            if (notifSpan) {
                if (unread > 0) {
                    notifSpan.innerText = unread;
                    notifSpan.classList.remove('hidden');
                } else {
                    notifSpan.classList.add('hidden');
                }
            }
        }
    } catch (e) { console.error("Gagal polling notif:", e); }
}

// 3. Jalankan Polling
// Panggil sekali pas halaman dimuat
checkNotifikasi();
// Lalu cek lagi setiap 30 detik
setInterval(checkNotifikasi, 30000);