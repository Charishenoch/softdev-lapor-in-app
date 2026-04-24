<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User; // Pastikan modelnya sudah ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // 1. Validasi Input
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
            'kata_sandi' => 'required|min:8|confirmed', // 'confirmed' butuh field kata_sandi_confirmation
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // 2. Simpan ke Database
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
            'kata_sandi' => Hash::make($request->kata_sandi), // Hash password hukumnya wajib!
            'role' => 'warga',
        ]);

        return response()->json([
            'message' => 'Registrasi Berhasil lek!',
            'user' => $user
        ], 201);
    }

    public function login(Request $request)
    {
        // 1. Validasi Input (Cukup butuh Email dan Kata Sandi)
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'kata_sandi' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // 2. Cari pengguna berdasarkan email
        $user = User::where('email', $request->email)->first();

        // 3. Cek apakah email ada dan kata sandi cocok
        if (!$user || !Hash::check($request->kata_sandi, $user->kata_sandi)) {
            return response()->json([
                'message' => 'Email atau Kata Sandi salah lek!'
            ], 401); // 401 = Unauthorized (Ditolak)
        }

        // 4. Jika sukses, cetak Token API
        $token = $user->createToken('token_laporin')->plainTextToken;

        return response()->json([
            'message' => 'Login Berhasil!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ], 200);
    }
}