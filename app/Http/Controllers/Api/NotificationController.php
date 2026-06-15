<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // 1. Get semua notifikasi user
    public function index(Request $request)
    {
        return response()->json([
            'success' => true,
            'data' => $request->user()->notifications // Laravel otomatis nge-link ke user
        ]);
    }

    // 2. Mark sebagai dibaca (Read)
    public function markAsRead(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();
        return response()->json(['message' => 'Semua notifikasi sudah dibaca.']);
    }

    // 3. Delete notifikasi
    public function destroy(Request $request, $id)
    {
        $request->user()->notifications()->where('id', $id)->delete();
        return response()->json(['message' => 'Notifikasi dihapus.']);
    }
}