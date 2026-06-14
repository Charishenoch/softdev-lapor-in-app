document.addEventListener('DOMContentLoaded', () => {
    const tableBody = document.getElementById('user-table-body');
    const paginationContainer = document.querySelector('.flex.items-center.gap-1');
    const infoFooter = document.querySelector('span:not([class*="w-8"])');
    const modalEdit = document.getElementById('modal-edit-user');
    const modalTambah = document.getElementById('modal-tambah-user');
    const saveRoleBtn = document.getElementById('save-role-btn');
    const formTambah = document.getElementById('form-tambah-user');
    let editUserId = null;

    // 1. AMBIL DATA USER
    const ambilUser = async (page = 1) => {
        const token = localStorage.getItem('token_laporin');
        try {
            const res = await fetch(`/api/admin/users?page=${page}`, {
                headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
            });
            const result = await res.json();
            if (result.success) {
                renderTable(result.data.data);
                renderPagination(result.data);
                if (infoFooter) infoFooter.innerText = `Menampilkan ${result.data.from || 0} sampai ${result.data.to || 0} dari ${result.data.total}.`;
            }
        } catch (e) { console.error('Gagal ambil data:', e); }
    };

    // 2. UPDATE STATISTIK CARD
    const updateStatistik = async () => {
        const token = localStorage.getItem('token_laporin');
        try {
            const res = await fetch('/api/admin/statistik-user', {
                headers: { 'Authorization': 'Bearer ' + token, 'Accept': 'application/json' }
            });
            const result = await res.json();
            if (result.success) {
                document.getElementById('count-admin').innerText = result.data.admin || 0;
                document.getElementById('count-pegawai').innerText = result.data.pegawai || 0;
                document.getElementById('count-warga').innerText = result.data.warga || 0;
            }
        } catch (e) { console.error('Gagal update statistik:', e); }
    };

    // 3. RENDER TABEL
    const renderTable = (users) => {
        tableBody.innerHTML = users.length ? users.map(user => `
            <tr class="bg-white border-b hover:bg-red-50 transition">
                <td class="px-6 py-4 font-bold text-gray-800">${user.nama_lengkap}</td>
                <td class="px-6 py-4 text-gray-500">${user.email}</td>
                <td class="px-6 py-4">${user.pekerjaan || '-'}</td>
                <td class="px-6 py-4">
                    <span class="text-xs font-bold px-3 py-1 rounded-full border ${getRoleBadge(user.role)}">
                        ${user.role ? user.role.replace('_', ' ').toUpperCase() : 'WARGA'}
                    </span>
                </td>
                <td class="px-6 py-4 flex justify-center gap-2">
                    <button onclick="bukaModalEdit(${user.id})" class="bg-blue-500 text-white w-8 h-8 rounded hover:bg-blue-600"><i class="fa-solid fa-pen"></i></button>
                    <button onclick="hapusUser(${user.id})" class="bg-red-500 text-white w-8 h-8 rounded hover:bg-red-600"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>
        `).join('') : '<tr><td colspan="5" class="p-6 text-center text-gray-500">Data tidak ditemukan.</td></tr>';
    };

    // 4. PAGINATION
    const renderPagination = (meta) => {
        if (!paginationContainer) return;
        paginationContainer.innerHTML = '';
        const prev = document.createElement('button');
        prev.innerHTML = '<i class="fa-solid fa-chevron-left text-xs"></i>';
        prev.className = `w-8 h-8 flex items-center justify-center rounded border border-gray-300 ${meta.current_page === 1 ? 'opacity-50' : 'hover:bg-gray-100'}`;
        prev.onclick = () => { if(meta.current_page > 1) ambilUser(meta.current_page - 1); };
        paginationContainer.appendChild(prev);

        for(let i = 1; i <= meta.last_page; i++) {
            if(i > 5) break;
            const btn = document.createElement('button');
            btn.innerText = i;
            btn.className = `w-8 h-8 flex items-center justify-center rounded border border-gray-300 ${i === meta.current_page ? 'bg-[#D32F0F] text-white' : 'bg-white hover:bg-gray-100'}`;
            btn.onclick = () => ambilUser(i);
            paginationContainer.appendChild(btn);
        }

        const next = document.createElement('button');
        next.innerHTML = '<i class="fa-solid fa-chevron-right text-xs"></i>';
        next.className = `w-8 h-8 flex items-center justify-center rounded border border-gray-300 ${meta.current_page === meta.last_page ? 'opacity-50' : 'hover:bg-gray-100'}`;
        next.onclick = () => { if(meta.current_page < meta.last_page) ambilUser(meta.current_page + 1); };
        paginationContainer.appendChild(next);
    };

    // 5. HELPER
    const getRoleBadge = (role) => {
        if (role === 'superadmin') return 'bg-red-100 text-red-800 border-red-200';
        if (role === 'pegawai_kelurahan') return 'bg-blue-100 text-blue-800 border-blue-200';
        return 'bg-gray-100 text-gray-800 border-gray-300';
    };

    // 6. MODAL & FORM LOGIC
    window.bukaModalEdit = (id) => { editUserId = id; modalEdit.classList.remove('hidden'); };

    saveRoleBtn.addEventListener('click', async () => {
        const role = document.getElementById('edit-role-select').value;
        const token = localStorage.getItem('token_laporin');
        try {
            const res = await fetch(`/api/admin/users/${editUserId}/update-role`, {
                method: 'POST',
                headers: { 'Authorization': 'Bearer ' + token, 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content },
                body: JSON.stringify({ role: role })
            });
            const result = await res.json();
            if (result.success) { modalEdit.classList.add('hidden'); ambilUser(); updateStatistik(); }
            else alert(result.message || 'Gagal update role');
        } catch (e) { console.error(e); }
    });

    formTambah.addEventListener('submit', async (e) => {
        e.preventDefault();
        const token = localStorage.getItem('token_laporin');
        const data = Object.fromEntries(new FormData(formTambah).entries());
        try {
            const res = await fetch('/api/auth/register', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Authorization': 'Bearer ' + token },
                body: JSON.stringify(data)
            });
            const result = await res.json();
            if (result.success) {
                modalTambah.classList.add('hidden');
                formTambah.reset();
                ambilUser();
                updateStatistik();
                alert('User berhasil didaftarkan!');
            } else {
                alert(result.message || 'Gagal mendaftar user');
            }
        } catch (e) { console.error(e); }
    });

    window.hapusUser = async (id) => {
        if (!confirm('Hapus user ini?')) return;
        const token = localStorage.getItem('token_laporin');
        try {
            const res = await fetch(`/api/admin/users/${id}`, { method: 'DELETE', headers: { 'Authorization': 'Bearer ' + token } });
            if ((await res.json()).success) { ambilUser(); updateStatistik(); }
        } catch (e) { console.error(e); }
    };

    ambilUser();
    updateStatistik();
});