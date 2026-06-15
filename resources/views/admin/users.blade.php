@extends('layouts.admin')

@section('title', 'Control User - Lapor.in')

@section('content')
<div class="space-y-8">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition">
            <h3 class="text-xl font-bold text-gray-800 leading-tight">Admin<br>Lapor.in</h3>
            <div id="count-admin" class="bg-[#D32F0F] text-white text-4xl font-black w-20 h-20 flex items-center justify-center rounded-xl shadow-inner">0</div>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition">
            <h3 class="text-xl font-bold text-gray-800 leading-tight">Pegawai<br>Kelurahan</h3>
            <div id="count-pegawai" class="bg-[#D32F0F] text-white text-4xl font-black w-20 h-20 flex items-center justify-center rounded-xl shadow-inner">0</div>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition">
            <h3 class="text-xl font-bold text-gray-800 leading-tight">Warga<br>Ambarejo</h3>
            <div id="count-warga" class="bg-[#D32F0F] text-white text-4xl font-black w-20 h-20 flex items-center justify-center rounded-xl shadow-inner">0</div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
            <h2 class="text-2xl sm:text-3xl font-bold text-[#D32F0F]">Data USER aplikasi Lapor.in</h2>
            <div class="flex flex-col sm:flex-row w-full lg:w-auto items-center gap-3">
                <div class="relative w-full sm:w-72">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    </div>
                    <input type="text" placeholder="Cari Nama atau E-mail..." class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-full focus:ring-[#D32F0F] focus:border-[#D32F0F] block pl-10 p-2.5 outline-none transition">
                </div>
                <button type="button" onclick="document.getElementById('modal-tambah-user').classList.remove('hidden')" class="w-full sm:w-auto bg-[#D32F0F] hover:bg-red-700 text-white font-bold py-2.5 px-5 rounded-full flex items-center justify-center gap-2 transition shadow-sm whitespace-nowrap">
                    <i class="fa-solid fa-plus"></i> Tambah User
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 font-bold">Nama</th>
                        <th class="px-6 py-4 font-bold">E-mail</th>
                        <th class="px-6 py-4 font-bold">Status (Pekerjaan)</th>
                        <th class="px-6 py-4 font-bold">Role</th>
                        <th class="px-6 py-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="user-table-body">
                    <tr><td colspan="5" class="p-10 text-center text-gray-500 italic">Memuat data user...</td></tr>
                </tbody>
            </table>
        </div>

        <div class="p-4 bg-gray-50 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-600">
            <span id="info-pagination">Menampilkan data...</span> <div class="flex items-center gap-1"></div>
        </div>
    </div>

</div>

<div id="modal-edit-user" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-2xl w-96">
        <h3 class="font-bold text-lg mb-4">Edit Role User</h3>
        <select id="edit-role-select" class="w-full p-2 border rounded-lg mb-4">
            <option value="superadmin">Superadmin</option>
            <option value="pegawai_kelurahan">Pegawai Kelurahan</option>
            <option value="warga">Warga</option>
        </select>
        <div class="flex justify-end gap-2">
            <button onclick="document.getElementById('modal-edit-user').classList.add('hidden')" class="px-4 py-2 bg-gray-200 rounded-full">Batal</button>
            <button id="save-role-btn" class="px-4 py-2 bg-[#D32F0F] text-white rounded-full">Simpan</button>
        </div>
    </div>
</div>

<div id="modal-tambah-user" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 overflow-y-auto p-4">
    <div class="bg-white p-6 rounded-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto">
        <h3 class="font-bold text-xl mb-6 text-[#D32F0F]">Tambah User Baru</h3>
        
        <form id="form-tambah-user" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700">NIK</label>
                    <input type="text" name="nik" placeholder="NIK" class="w-full p-2 border rounded-lg" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700">Alamat</label>
                    <input type="text" name="alamat" placeholder="Alamat Tempat Tinggal" class="w-full p-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700">Pekerjaan</label>
                    <input type="text" name="pekerjaan" placeholder="Pekerjaan" class="w-full p-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700">Penyandang Disabilitas?</label>
                    <select name="disabilitas" class="w-full p-2 border rounded-lg">
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700">Username</label>
                    <input type="text" name="username" placeholder="Username" class="w-full p-2 border rounded-lg" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700">Password</label>
                    <input type="password" name="kata_sandi" placeholder="********" class="w-full p-2 border rounded-lg" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700">Konfirmasi Password</label>
                    <input type="password" name="kata_sandi_confirmation" placeholder="********" class="w-full p-2 border rounded-lg" required>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" class="w-full p-2 border rounded-lg" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="w-full p-2 border rounded-lg">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="w-full p-2 border rounded-lg" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700">Nomor Telp (WA)</label>
                    <input type="text" name="nomor_wa" placeholder="08xxxxxxx" class="w-full p-2 border rounded-lg" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700">Email Aktif</label>
                    <input type="email" name="email" placeholder="example@gmail.com" class="w-full p-2 border rounded-lg" required>
                </div>
            </div>

            <div class="col-span-1 md:col-span-2">
                <label class="block text-sm font-bold text-gray-700">Role Akses</label>
                <select name="role" class="w-full p-2 border rounded-lg" required>
                    <option value="warga">Warga</option>
                    <option value="pegawai_kelurahan">Pegawai Kelurahan</option>
                    <option value="superadmin">Superadmin</option>
                </select>
            </div>

            <div class="col-span-1 md:col-span-2 flex justify-end gap-2 mt-4">
                <button type="button" onclick="document.getElementById('modal-tambah-user').classList.add('hidden')" class="px-6 py-2 bg-gray-200 rounded-full hover:bg-gray-300">Batal</button>
                <button type="submit" class="px-6 py-2 bg-[#D32F0F] text-white rounded-full hover:bg-red-700">Simpan User</button>
            </div>
        </form>
    </div>
</div>

@vite(['resources/js/control-user.js'])
@endsection