@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h2 class="text-4xl font-bold text-gray-900">Messages</h2>
</div>

@if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-2xl font-bold border border-green-200">{{ session('success') }}</div>
@endif

<div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-[#41D3BD]">
            <tr>
                <th class="pl-20 py-6 text-black font-medium text-lg rounded-tl-[2.5rem]">Nasabah</th>
                <th class="px-6 py-6 text-black font-medium text-lg">Pesan Terakhir</th>
                <th class="px-6 py-6 text-black font-medium text-lg text-center">Status Room</th>
                <th class="px-8 py-6 text-center rounded-tr-[2.5rem]">
                    <span class="bg-white px-5 py-1 rounded-lg text-xs font-bold text-black uppercase">Action</span>
                </th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 text-black font-medium">
            @foreach($rooms as $room)
            <tr class="hover:bg-gray-50/50 transition-all">
                <td class="pl-20 py-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-600 uppercase border border-gray-300">
                            {{ substr($room->nasabah->nama, 0, 1) }}
                        </div>
                        <span class="font-bold text-lg uppercase text-black">{{ $room->nasabah->nama }}</span>
                    </div>
                </td>
                <td class="px-6 py-6">
                    <p class="text-gray-700 line-clamp-1 italic">{{ $room->messages->first()->pesan ?? 'Belum ada pesan' }}</p>
                    <div class="text-[10px] text-gray-400 mt-1 font-bold italic">{{ $room->messages->first()->waktu_kirim ?? '' }}</div>
                </td>
                <td class="px-6 py-6 text-center">
                    <span class="px-4 py-1 rounded-full text-xs font-bold uppercase {{ $room->status == 'open' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $room->status }}
                    </span>
                </td>
                <td class="px-8 py-6 text-center relative" x-data="{ dropdown: false }">
                    <button @click="dropdown = !dropdown" class="text-blue-600 hover:text-blue-800 focus:outline-none">
                        <i class="fa-solid fa-ellipsis text-3xl"></i>
                    </button>
                    <!-- Dropdown Menu -->
                    <div x-show="dropdown" @click.away="dropdown = false" x-transition
                         class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-2xl shadow-xl z-[100] overflow-hidden text-left">
                        <a href="{{ route('admin.message.show', $room->id) }}" class="w-full block px-5 py-3 text-sm hover:bg-blue-50 flex items-center space-x-3 transition-colors border-b">
                            <i class="fa-regular fa-comment-dots text-blue-500"></i>
                            <span class="font-bold text-gray-700">Buka Chat</span>
                        </a>
                        <form action="{{ route('admin.message.updateStatus', $room->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <button type="submit" class="w-full text-left px-5 py-3 text-sm hover:bg-gray-50 flex items-center space-x-3 transition-colors">
                                <i class="fa-solid {{ $room->status == 'open' ? 'fa-lock text-red-500' : 'fa-lock-open text-green-500' }}"></i>
                                <span class="font-bold text-gray-700">{{ $room->status == 'open' ? 'Close Conversation' : 'Re-open Chat' }}</span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="h-6"></div>
</div>
@endsection
