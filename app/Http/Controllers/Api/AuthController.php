<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // 1. REGISTER
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|digits:16|unique:pengguna',
            'nama_lengkap' => 'required|string|max:255',
            'alamat' => 'required',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pekerjaan' => 'required',
            'tanggal_lahir' => 'required|date',
            'disabilitas' => 'required|in:Ya,Tidak',
            'nomor_wa' => 'required',
            'username' => 'required|unique:pengguna',
            'email' => 'required|email|unique:pengguna',
            'kata_sandi' => 'required|min:8|confirmed', 
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pekerjaan' => $request->pekerjaan,
            'tanggal_lahir' => $request->tanggal_lahir,
            'disabilitas' => $request->disabilitas,
            'nomor_wa' => $request->nomor_wa,
            'username' => $request->username,
            'email' => $request->email,
            'kata_sandi' => Hash::make($request->kata_sandi), 
            'role' => 'warga', // Default pasti warga
        ]);

        return response()->json([
            'message' => 'Registrasi Berhasil lek!',
            'user' => $user
        ], 201);
    }

   // 2. LOGIN (Upgrade: Tahan Banting Tangkap Email/Username)
    public function login(Request $request)
    {
        // 1. Tangkap inputan FE secara cerdas (kalau FE ngirim 'email', kita tangkap. Kalau ngirim 'login_id', kita tangkap juga)
        $loginInput = $request->input('login_id') ?? $request->input('email') ?? $request->input('username');

        // 2. Validasi manual
        if (!$loginInput || !$request->kata_sandi) {
            return response()->json([
                'success' => false,
                'message' => 'Email/Username dan Kata Sandi wajib diisi lek!'
            ], 422);
        }

        // 3. Deteksi otomatis apakah yang diketik itu format email atau username
        $loginType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // 4. Cari pengguna di database
        $user = User::where($loginType, $loginInput)->first();

        // 5. Cek ketersediaan user dan kecocokan password
        if (!$user || !Hash::check($request->kata_sandi, $user->kata_sandi)) {
            return response()->json([
                'success' => false,
                'message' => 'Email/Username atau Kata Sandi salah bosku!'
            ], 401); 
        }

        // 6. Jika lolos, Cetak Token API
        $token = $user->createToken('token_laporin')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login Berhasil!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user 
        ], 200);
    }

    // 4. FORGOT PASSWORD (Minta Token Reset)
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Cek apakah email terdaftar
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Waduh, email tidak terdaftar bosku!'
            ], 404);
        }

        // Bikin token acak sepanjang 60 karakter
        $token = Str::random(60);

        // Simpan ke tabel password_reset_tokens (Tabel bawaan Laravel)
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );

        // CATATAN: Idealnya di sini ada kodingan buat ngirim email beneran (butuh setting SMTP di .env)
        // Sementara kita balikin tokennya di response JSON biar bisa dites langsung di Postman/Thunder Client
        return response()->json([
            'success' => true,
            'message' => 'Token reset password berhasil dibuat! (Nanti disambung ke fitur kirim Email)',
            'token' => $token 
        ], 200);
    }

    // 5. RESET PASSWORD (Simpan Password Baru)
    public function resetPassword(Request $request)
    {
        // Validasi inputan (FE harus ngirim kata_sandi dan kata_sandi_confirmation)
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'kata_sandi' => 'required|min:8|confirmed' 
        ]);

        // Cari tokennya di database
        $resetData = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        // Kalau token nggak ketemu atau salah
        if (!$resetData) {
            return response()->json([
                'success' => false,
                'message' => 'Token tidak valid atau sudah kadaluarsa lek!'
            ], 400);
        }

        // Kalau valid, Timpa password lama sama yang baru
        $user = User::where('email', $request->email)->first();
        $user->kata_sandi = Hash::make($request->kata_sandi);
        $user->save();

        // Hapus token dari database biar nggak bisa dipakai dua kali (Keamanan)
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Mantap! Password berhasil direset. Silakan login pakai password baru.'
        ], 200);
    }
}