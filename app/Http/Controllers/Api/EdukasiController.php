<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Edukasi;
use Illuminate\Http\Request;

class EdukasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Edukasi::query();

        // 1. Fitur Search Artikel (berdasarkan judul/isi)
        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        // 2. Fitur Filter Kategori
        if ($request->has('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // 3. Pagination (Tampil 6 artikel per halaman)
        $artikel = $query->latest()->paginate(6);

        return response()->json([
            'success' => true,
            'data' => $artikel
        ]);
    }

    // 4. Fitur Bookmark/Save
    public function toggleBookmark(Request $request, $id)
    {
        $user = $request->user();
        
        // Cek apakah sudah di-bookmark, kalau sudah hapus, kalau belum tambah
        $user->bookmarks()->toggle($id);

        return response()->json(['message' => 'Bookmark berhasil diupdate!']);
    }
}