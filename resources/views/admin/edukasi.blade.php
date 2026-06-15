@extends('layouts.admin')

@section('title', 'Tambah Artikel Edukasi - Lapor.in')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-200 pb-4">
        <div>
            <h2 class="text-2xl sm:text-3xl font-bold text-[#D32F0F]">Tambah Artikel Edukasi</h2>
            <p class="text-gray-500 text-sm mt-1">Tulis dan publikasikan informasi atau panduan baru untuk warga.</p>
        </div>
        <a href="{{ url('/admin/edukasi') }}" class="text-gray-500 hover:text-[#D32F0F] font-medium transition flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <form id="form-artikel" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-6">
        @csrf

        <div class="w-full lg:w-2/3 space-y-6">
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                <input type="text" name="judul" id="judul" placeholder="Masukkan judul artikel..." class="w-full border border-gray-300 px-4 py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D32F0F] text-lg font-medium transition" required>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col h-[500px]">
                <label class="block text-sm font-bold text-gray-700 p-6 pb-2">Isi Artikel <span class="text-red-500">*</span></label>
                
                <div class="bg-gray-50 border-y border-gray-200 px-4 py-2 flex flex-wrap gap-2 items-center">
                    <button type="button" class="w-8 h-8 rounded hover:bg-gray-200 text-gray-700 transition"><i class="fa-solid fa-bold"></i></button>
                    <button type="button" class="w-8 h-8 rounded hover:bg-gray-200 text-gray-700 transition"><i class="fa-solid fa-italic"></i></button>
                    <button type="button" class="w-8 h-8 rounded hover:bg-gray-200 text-gray-700 transition"><i class="fa-solid fa-underline"></i></button>
                    <div class="w-px h-5 bg-gray-300 mx-1"></div>
                    <button type="button" class="w-8 h-8 rounded hover:bg-gray-200 text-gray-700 transition"><i class="fa-solid fa-list-ul"></i></button>
                    <button type="button" class="w-8 h-8 rounded hover:bg-gray-200 text-gray-700 transition"><i class="fa-solid fa-list-ol"></i></button>
                </div>

                <textarea name="isi" id="isi" placeholder="Tulis isi artikel di sini..." class="w-full flex-grow p-6 focus:outline-none resize-none leading-relaxed text-gray-700" required></textarea>
            </div>
        </div>

        <div class="w-full lg:w-1/3 space-y-6">
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Pengaturan</h3>
                
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-gray-700">Kategori Artikel</label>
                    <div class="relative">
                        <select name="kategori" id="kategori" class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#D32F0F] appearance-none bg-white pr-10 cursor-pointer" required>
                            <option value="" disabled selected>Pilih Kategori...</option>
                            <option value="Keamanan">Keamanan</option>
                            <option value="Panduan Lapor">Panduan Lapor</option>
                            <option value="Kesehatan">Kesehatan</option>
                            <option value="Infrastruktur">Infrastruktur</option>
                        </select>
                        <i class="fa-solid fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Foto Sampul (Thumbnail)</h3>
                
                <div class="relative">
                    <label for="thumbnail-upload" id="upload-area" class="border-2 border-dashed border-gray-300 rounded-xl p-8 flex flex-col items-center justify-center text-center hover:bg-gray-50 hover:border-[#D32F0F] transition cursor-pointer group h-48 overflow-hidden">
                        
                        <div id="upload-placeholder" class="flex flex-col items-center">
                            <div class="bg-red-50 text-[#D32F0F] rounded-full w-14 h-14 flex items-center justify-center mb-3 group-hover:scale-110 transition">
                                <i class="fa-solid fa-cloud-arrow-up text-2xl"></i>
                            </div>
                            <p class="text-sm font-bold text-gray-700">Klik untuk upload foto</p>
                            <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG (Maks 2MB)</p>
                        </div>

                        <img id="image-preview" src="" alt="Preview" class="hidden absolute inset-0 w-full h-full object-cover">
                    </label>
                    
                    <input type="file" name="thumbnail" id="thumbnail-upload" accept="image/*" class="hidden" required>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col gap-3">
                <button type="submit" onclick="document.getElementById('status-input').value = 'publish';" class="w-full bg-[#D32F0F] hover:bg-red-700 text-white font-bold py-3 rounded-xl shadow-md hover:shadow-lg transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-paper-plane"></i> Publikasikan Sekarang
                </button>
                
                <button type="submit" onclick="document.getElementById('status-input').value = 'draft';" class="w-full bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-bold py-3 rounded-xl transition">
                    Simpan sebagai Draf
                </button>

                <input type="hidden" name="status" id="status-input" value="publish">
            </div>

        </div>
    </form>

</div>

@vite(['resources/js/ambilartikel.js'])
@endsection