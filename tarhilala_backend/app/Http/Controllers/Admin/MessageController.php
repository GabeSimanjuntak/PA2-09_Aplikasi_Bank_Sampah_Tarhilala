<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class MessageController extends Controller {
    public function index() {
        // Ambil semua chat room yang terhubung dengan nasabah
        $rooms = ChatRoom::with(['nasabah', 'messages' => function($q) {
            $q->latest('waktu_kirim')->limit(1);
        }])->get();

        return view('admin.message.index', compact('rooms'));
    }

    public function show($id) {
        $room = ChatRoom::with(['nasabah', 'messages.pengirim'])->findOrFail($id);
        // Tandai pesan nasabah sebagai terbaca saat admin buka
        ChatMessage::where('chat_room_id', $id)
                   ->where('pengirim_id', '!=', session('admin_id'))
                   ->update(['is_read' => true]);

        return view('admin.message.show', compact('room'));
    }

    public function updateStatus(Request $request, $id) {
    $room = ChatRoom::findOrFail($id);

    // Toggle status: jika open jadi closed, jika closed jadi open
    $room->status = ($room->status == 'open') ? 'closed' : 'open';
    $room->save();

    return back()->with('success', 'Status chat berhasil diperbarui');
    }

    public function store(Request $request, $id) {
    // Cek apakah room masih open
    $room = ChatRoom::findOrFail($id);
    if($room->status == 'closed') {
        return back()->with('error', 'Chat room sudah ditutup.');
    }

    ChatMessage::create([
        'chat_room_id' => $id,
        'pengirim_id' => session('admin_id'),
        'pesan' => $request->pesan,
        'waktu_kirim' => now()
    ]);
    return back();
}
}
