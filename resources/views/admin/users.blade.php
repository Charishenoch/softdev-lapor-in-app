@extends('layouts.admin')

@section('title', 'Control User - Lapor.in')

@section('content')
<div class="space-y-8">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition">
            <h3 class="text-xl sm:text-2xl font-bold text-gray-800 leading-tight">Admin<br>Lapor.in</h3>
            <div class="bg-[#D32F0F] text-white text-4xl font-black w-20 h-20 flex items-center justify-center rounded-xl shadow-inner">
                3
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition">
            <h3 class="text-xl sm:text-2xl font-bold text-gray-800 leading-tight">Pegawai<br>Kelurahan</h3>
            <div class="bg-[#D32F0F] text-white text-4xl font-black w-20 h-20 flex items-center justify-center rounded-xl shadow-inner">
                12
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex items-center justify-between hover:shadow-md transition">
            <h3 class="text-xl sm:text-2xl font-bold text-gray-800 leading-tight">Warga<br>Ambarejo</h3>
            <div class="bg-[#D32F0F] text-white text-4xl font-black w-20 h-20 flex items-center justify-center rounded-xl shadow-inner">
                108
            </div>
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
                
                <button class="w-full sm:w-auto bg-[#D32F0F] hover:bg-red-700 text-white font-bold py-2.5 px-5 rounded-full flex items-center justify-center gap-2 transition shadow-sm whitespace-nowrap">
                    <i class="fa-solid fa-plus"></i> Tambah User
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-bold">Nama</th>
                        <th scope="col" class="px-6 py-4 font-bold">E-mail</th>
                        <th scope="col" class="px-6 py-4 font-bold">Status (Pekerjaan)</th>
                        <th scope="col" class="px-6 py-4 font-bold">Role</th>
                        <th scope="col" class="px-6 py-4 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b hover:bg-red-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-800">Budi Santoso</td>
                        <td class="px-6 py-4 text-gray-500">budi.admin@lapor.in</td>
                        <td class="px-6 py-4">Bekerja</td>
                        <td class="px-6 py-4">
                            <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full border border-red-200"><i class="fa-solid fa-shield-halved mr-1"></i> Admin</span>
                        </td>
                        <td class="px-6 py-4 flex justify-center gap-2">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white w-8 h-8 rounded flex items-center justify-center transition tooltip" title="Edit Data"><i class="fa-solid fa-pen"></i></button>
                            <button class="bg-gray-400 cursor-not-allowed text-white w-8 h-8 rounded flex items-center justify-center tooltip" title="Tidak bisa hapus sesama Admin" disabled><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>

                    <tr class="bg-white border-b hover:bg-red-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800">Siti Rahmawati</td>
                        <td class="px-6 py-4 text-gray-500">siti.pns@gmail.com</td>
                        <td class="px-6 py-4">PNS</td>
                        <td class="px-6 py-4">
                            <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full border border-blue-200"><i class="fa-solid fa-user-tie mr-1"></i> Pelayan Publik</span>
                        </td>
                        <td class="px-6 py-4 flex justify-center gap-2">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white w-8 h-8 rounded flex items-center justify-center transition tooltip" title="Edit Data"><i class="fa-solid fa-pen"></i></button>
                            <button class="bg-red-500 hover:bg-red-600 text-white w-8 h-8 rounded flex items-center justify-center transition tooltip" title="Hapus Akun"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>

                    <tr class="bg-white border-b hover:bg-red-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800">Ahmad Sujatmiko</td>
                        <td class="px-6 py-4 text-gray-500">ahmad.petani@yahoo.com</td>
                        <td class="px-6 py-4">Petani</td>
                        <td class="px-6 py-4">
                            <span class="bg-gray-100 text-gray-800 text-xs font-bold px-3 py-1 rounded-full border border-gray-300"><i class="fa-solid fa-user mr-1"></i> Warga</span>
                        </td>
                        <td class="px-6 py-4 flex justify-center gap-2">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white w-8 h-8 rounded flex items-center justify-center transition tooltip" title="Edit Data"><i class="fa-solid fa-pen"></i></button>
                            <button class="bg-red-500 hover:bg-red-600 text-white w-8 h-8 rounded flex items-center justify-center transition tooltip" title="Hapus Akun"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    
                    <tr class="bg-white border-b hover:bg-red-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800">Rini Susanti</td>
                        <td class="px-6 py-4 text-gray-500">rinisusanti@gmail.com</td>
                        <td class="px-6 py-4">Pegawai Swasta</td>
                        <td class="px-6 py-4">
                            <span class="bg-gray-100 text-gray-800 text-xs font-bold px-3 py-1 rounded-full border border-gray-300"><i class="fa-solid fa-user mr-1"></i> Warga</span>
                        </td>
                        <td class="px-6 py-4 flex justify-center gap-2">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white w-8 h-8 rounded flex items-center justify-center transition tooltip" title="Edit Data"><i class="fa-solid fa-pen"></i></button>
                            <button class="bg-red-500 hover:bg-red-600 text-white w-8 h-8 rounded flex items-center justify-center transition tooltip" title="Hapus Akun"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="p-4 bg-gray-50 border-t border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-600">
            <span>Menampilkan 1 sampai 10 dari 357.</span>
            
            <div class="flex items-center gap-1">
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-300 hover:bg-gray-200"><i class="fa-solid fa-chevron-left text-xs"></i></button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-300 bg-[#D32F0F] text-white font-bold shadow">1</button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-300 bg-white font-medium hover:bg-gray-100">2</button>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-300 bg-white font-medium hover:bg-gray-100">3</button>
                <span class="w-8 h-8 flex items-center justify-center">...</span>
                <button class="w-8 h-8 flex items-center justify-center rounded border border-gray-300 hover:bg-gray-200"><i class="fa-solid fa-chevron-right text-xs"></i></button>
            </div>
        </div>
    </div>

</div>
@endsection