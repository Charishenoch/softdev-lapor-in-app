<?php

namespace App\Http\Controllers\Api; // Sesuaikan dengan namespace kamu

use App\Http\Controllers\Controller;
use App\Models\Artikel; // PENTING: Jangan lupa import Model Artikel
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArtikelController extends Controller
{
    public function store(Request $request) 
    {
        // 1. Validasi Input (Super Penting!)
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'kategori' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Pastikan gambar, max 2MB
            'status' => 'required|in:publish,draft'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak lengkap atau format gambar salah!',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // 2. Handle Upload Foto dengan Aman
            $path = null;
            if ($request->hasFile('thumbnail')) {
                // Simpan ke folder storage/app/public/thumbnails
                $path = $request->file('thumbnail')->store('thumbnails', 'public');
            }

            // 3. Simpan Data ke Database
            $artikel = Artikel::create([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'kategori' => $request->kategori,
                'thumbnail' => $path,
                'status' => $request->status // 'publish' atau 'draft'
            ]);

            // 4. Kembalikan Response Sukses ke Frontend
            return response()->json([
                'success' => true,
                'message' => 'Mantap! Artikel edukasi berhasil disimpan.',
                'data' => $artikel
            ], 201);

        } catch (\Exception $e) {
            // 5. Tangkap Error (Misal database putus atau storage penuh)
            return response()->json([
                'success' => false,
                'message' => 'Waduh, gagal menyimpan artikel. Coba lagi lek!',
                'error' => $e->getMessage() // Cuma buat debugging, nanti kalau udah live bisa dihilangkan
            ], 500);
        }
    }

    public function index(Request $request)
    {
        // Tarik data yang statusnya 'publish', urutkan dari yang paling baru
        $query = Artikel::where('status', 'publish')->orderBy('created_at', 'desc');

        // (Opsional) Kalau nanti kamu mau fungsikan fitur pencarian & filter kategori
        if ($request->has('kategori') && $request->kategori !== 'Semua') {
            $query->where('kategori', $request->kategori);
        }
        if ($request->has('search') && $request->search !== '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $artikel = $query->get();

        return response()->json([
            'success' => true,
            'data' => $artikel
        ], 200);
    }

}