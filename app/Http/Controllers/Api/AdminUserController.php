<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User; // <-- INI YANG KURANG
use Illuminate\Http\Request; // <-- INI YANG KURANG

class AdminUserController extends Controller 
{
    public function index() {
        // Ambil data user dengan pagination
        $users = User::paginate(10);
        return response()->json(['success' => true, 'data' => $users]);
    }

    public function updateRole(Request $request, $id) {
        $user = User::find($id);
        if (!$user) return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 404);

        $user->role = $request->role; 
        $user->save();
        
        return response()->json(['success' => true, 'message' => 'Role berhasil diupdate']);
    }

    public function destroy($id) {
        $user = User::find($id);
        if (!$user) return response()->json(['success' => false], 404);
        
        $user->delete();
        return response()->json(['success' => true, 'message' => 'User berhasil dihapus']);
    }
}