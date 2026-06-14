<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;
use App\Services\RsaService;

class AdminDashboardController extends Controller
{
    // Fungsi untuk menarik semua laporan dan dekripsi RSA
    public function getSemuaLaporan()
    {
        $laporans = Pengaduan::select('pengaduan.*', 'pengguna.nama_lengkap as nama_warga')
            ->leftJoin('pengguna', 'pengaduan.id_pengguna', '=', 'pengguna.id')
            ->orderBy('pengaduan.created_at', 'desc')
            ->get();

        $laporans->transform(function ($item) {
            try {
                $item->deskripsi_asli = RsaService::decrypt($item->deskripsi_rsa);
            } catch (\Exception $e) {
                $item->deskripsi_asli = "[Data gagal didekripsi]";
            }
            return $item;
        });

        return response()->json([
            'success' => true,
            'data' => $laporans
        ], 200);
    }

    // Fungsi buat Admin ngubah status laporan
    public function updateStatus(Request $request, $id)
    {
        $pengaduan = Pengaduan::find($id);
        if (!$pengaduan) return response()->json(['success' => false], 404);

        $pengaduan->status_laporan = $request->status;
        $pengaduan->save(); 
        
        return response()->json(['success' => true]);
    }

    // Statistik untuk dashboard
    public function getStatistik()
    {
        try {
            $statistik = [
                'total' => Pengaduan::count(),
                'laporan_masuk' => Pengaduan::where('status_laporan', 'terkirim')->count(),
                'laporan_proses' => Pengaduan::where('status_laporan', 'proses')->count(),
                'laporan_selesai' => Pengaduan::where('status_laporan', 'selesai')->count(),
                
                // DATA PENTING: Hanya ambil yang ditandai bintang
                'laporan_penting' => Pengaduan::where('status_penting', 1)
                    ->latest()
                    ->get(),

                'kategori_stats' => [
                    ['id' => 'inf', 'jumlah' => Pengaduan::where('id_kategori', 1)->count()],
                    ['id' => 'kea', 'jumlah' => Pengaduan::where('id_kategori', 2)->count()],
                    ['id' => 'keb', 'jumlah' => Pengaduan::where('id_kategori', 3)->count()],
                    ['id' => 'asp', 'jumlah' => Pengaduan::where('id_kategori', 4)->count()],
                    ['id' => 'adm', 'jumlah' => Pengaduan::where('id_kategori', 5)->count()],
                ]
            ];

            return response()->json(['success' => true, 'data' => $statistik]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // Ambil data untuk tabel pemantauan
    public function getLaporanDarurat(Request $request)
    {
        $query = Pengaduan::query();

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status_laporan', $request->status);
        }

        $total = $query->count();
        $page = $request->query('page', 1);
        $perPage = 5;
        $offset = ($page - 1) * $perPage;

        $laporans = $query->latest()->offset($offset)->limit($perPage)->get();

        return response()->json([
            'success' => true, 
            'data' => $laporans,
            'total_pages' => ceil($total / $perPage)
        ]);
    }

    // Toggle bintang penting
    public function togglePenting($id)
    {
        $pengaduan = Pengaduan::find($id);
        if (!$pengaduan) return response()->json(['success' => false], 404);

        $pengaduan->status_penting = !$pengaduan->status_penting;
        $pengaduan->save();
        
        return response()->json(['success' => true]);
    }

    // laporan by kategori
    public function getLaporanByCategory($id_kategori)
    {
        $laporans = \App\Models\Pengaduan::where('id_kategori', $id_kategori)
                                        ->latest()
                                        ->get();
        // PROSES DEKRIPSI RSA DITAMBAHKAN DI SINI
        $laporans->transform(function ($item) {
            try {
                $item->deskripsi_asli = RsaService::decrypt($item->deskripsi_rsa);
            } catch (\Exception $e) {
                $item->deskripsi_asli = "[Data gagal didekripsi]";
            }
            return $item;
        });

        return response()->json([
            'success' => true,
            'data' => $laporans
        ]);
    }

        public function getStatistikUser() {
        // Ambil semua data user dulu
        $users = \App\Models\User::all();

        // Hitung secara manual di PHP supaya lebih aman
        $data = [
            'admin' => $users->where('role', 'superadmin')->count(),
            'pegawai' => $users->where('role', 'pegawai_kelurahan')->count(),
            'warga' => $users->where('role', 'warga')->count(),
        ];
        
        return response()->json(['success' => true, 'data' => $data]);
    }
}