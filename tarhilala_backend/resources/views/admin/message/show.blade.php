@extends('layouts.admin')

@section('content')
<div class="mb-6 flex items-center space-x-4">
    <a href="{{ route('admin.message.index') }}" class="text-gray-500 hover:text-black transition-colors">
        <i class="fa-solid fa-arrow-left text-2xl"></i>
    </a>
    <h2 class="text-3xl font-bold text-gray-900 uppercase tracking-tight">Chat: {{ $room->nasabah->nama }}</h2>
</div>

<div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 flex flex-col h-[75vh] overflow-hidden">

    <!-- Unified Chat Header -->
    <div class="bg-[#41D3BD] px-10 py-5 flex justify-between items-center text-black border-b border-black/5">
        <div class="flex items-center space-x-4">
            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center font-black text-lg text-[#41D3BD] border-2 border-white/50">
                {{ substr($room->nasabah->nama, 0, 1) }}
            </div>
            <div>
                <span class="font-bold text-xl block leading-tight">Customer Support</span>
                <span class="text-xs font-bold bg-white/40 px-2 py-0.5 rounded-md uppercase">Nasabah: {{ $room->nasabah->nama }}</span>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <div class="flex flex-col items-end mr-2">
                <span class="text-[10px] font-black uppercase opacity-60">Room Status</span>
                <span class="font-bold uppercase {{ $room->status == 'open' ? 'text-green-900' : 'text-red-900' }}">{{ $room->status }}</span>
            </div>

            <form action="{{ route('admin.message.updateStatus', $room->id) }}" method="POST">
                @csrf @method('PATCH')
                <button type="submit" class="bg-white/20 hover:bg-white text-black px-6 py-2 rounded-xl text-sm font-bold transition-all border border-white/40 shadow-sm">
                    {{ $room->status == 'open' ? 'Tutup Pecakapan' : 'Buka Percakapan' }}
                </button>
            </form>
        </div>
    </div>

    <!-- Messages Area -->
    <div class="flex-1 overflow-y-auto p-10 space-y-6 bg-gray-50/50" id="chatbox">
        @foreach($room->messages as $msg)
            @if($msg->pengirim_id == session('admin_id'))
                <!-- Pesan Admin (Kanan) -->
                <div class="flex justify-end">
                    <div class="bg-[#41D3BD] text-black p-5 rounded-2xl rounded-tr-none max-w-lg shadow-sm border border-black/5">
                        <p class="font-medium">{{ $msg->pesan }}</p>
                        <div class="flex items-center justify-end mt-2 space-x-2 opacity-60">
                            <span class="text-[10px] font-bold">{{ $msg->waktu_kirim }}</span>
                            <i class="fa-solid fa-check-double text-[10px]"></i>
                        </div>
                    </div>
                </div>
            @else
                <!-- Pesan Nasabah (Kiri) -->
                <div class="flex justify-start">
                    <div class="bg-white text-black p-5 rounded-2xl rounded-tl-none max-w-lg shadow-sm border border-gray-200">
                        <p class="font-medium">{{ $msg->pesan }}</p>
                        <span class="text-[10px] font-bold block mt-2 text-gray-400 italic">{{ $msg->waktu_kirim }}</span>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Input Area -->
    <div class="p-8 bg-white border-t border-gray-100">
        @if($room->status == 'open')
            <form action="{{ route('admin.message.store', $room->id) }}" method="POST" class="flex space-x-4">
                @csrf
                <input name="pesan" type="text" placeholder="Tulis balasan pesan untuk nasabah..." required autocomplete="off"
                       class="flex-1 px-8 py-4 border border-gray-200 rounded-2xl outline-none focus:ring-2 focus:ring-[#41D3BD] focus:border-transparent transition-all font-medium">
                <button type="submit" class="bg-[#41D3BD] text-black px-10 py-4 rounded-2xl font-black shadow-lg shadow-[#41D3BD]/30 hover:scale-105 active:scale-95 transition-all flex items-center">
                    Kirim <i class="fa-solid fa-paper-plane ml-3"></i>
                </button>
            </form>
        @else
            <div class="bg-red-50 border border-red-100 p-4 rounded-2xl text-center">
                <p class="text-red-700 font-bold italic">
                    <i class="fa-solid fa-lock mr-2"></i> Percakapan ini telah ditutup. Silakan buka kembali room untuk mengirim pesan.
                </p>
            </div>
        @endif
    </div>
</div>

<script>
    // Auto-scroll ke pesan terbawah saat halaman dibuka
    const chatbox = document.getElementById('chatbox');
    chatbox.scrollTop = chatbox.scrollHeight;
</script>

<style>
    /* Styling scrollbar chat agar lebih halus */
    #chatbox::-webkit-scrollbar { width: 6px; }
    #chatbox::-webkit-scrollbar-track { background: transparent; }
    #chatbox::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 10px; }
    #chatbox::-webkit-scrollbar-thumb:hover { background: #41D3BD; }
</style>
@endsection
