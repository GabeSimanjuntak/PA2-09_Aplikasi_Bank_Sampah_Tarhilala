@extends('layouts.admin')

@section('content')
<div x-data="{
    openAddRute: false, openEditRute: false, currRute: { id: '', nama_rute: '', wilayah: '' },
    openAddJadwal: false, openEditJadwal: false, currJadwal: { id: '', rute_id: '', driver_id: '', hari: '', jam_mulai: '', jam_selesai: '' },
    openDelete: false, deleteAction: '', deleteName: ''
}">

    <div class="flex justify-between items-center mb-10">
        <h2 class="text-4xl font-bold text-gray-900">Location & Schedules</h2>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-2xl font-bold border border-green-200">{{ session('success') }}</div>
    @endif

    <!-- SECTION 1: MASTER RUTE -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-black">Rute</h3>
        <button @click="openAddRute = true" class="bg-[#41D3BD] text-black px-6 py-3 rounded-2xl font-bold shadow-sm hover:opacity-80 transition-all">
            <i class="fa-solid fa-location-dot mr-2"></i>Add Route
        </button>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 relative mb-12">
        <table class="w-full text-left">
            <thead class="bg-[#41D3BD]">
                <tr>
                    <th class="pl-20 py-6 text-black font-medium text-lg rounded-tl-[2.5rem]">Nama Rute</th>
                    <th class="px-6 py-6 text-black font-medium text-lg">Wilayah Cakupan</th>
                    <th class="px-8 py-6 text-center rounded-tr-[2.5rem]"><span class="bg-white px-5 py-1 rounded-lg text-xs font-bold text-black uppercase">Action</span></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($routes as $r)
                <tr class="hover:bg-gray-50/50 transition-all text-black font-medium">
                    <td class="pl-20 py-6 font-bold uppercase text-black">{{ $r->nama_rute }}</td>
                    <td class="px-6 py-6">{{ $r->wilayah }}</td>
                    <td class="px-8 py-6 text-center relative" x-data="{ dropdown: false }">
                        <button @click="dropdown = !dropdown" class="text-blue-600 focus:outline-none"><i class="fa-solid fa-ellipsis text-3xl"></i></button>
                        <div x-show="dropdown" @click.away="dropdown = false" x-transition class="absolute right-0 mt-2 w-40 bg-white border border-gray-100 rounded-2xl shadow-xl z-[100] overflow-hidden text-left">
                            <!-- Tombol Update Rute -->
                            <button @click="currRute = { id: '{{ $r->id }}', nama_rute: '{{ $r->nama_rute }}', wilayah: '{{ $r->wilayah }}' }; openEditRute = true; dropdown = false"
                                    class="w-full px-5 py-3 text-sm hover:bg-blue-50 flex items-center space-x-3 transition-colors">
                                <i class="fa-solid fa-pen-to-square text-blue-500"></i><span class="font-bold">Update</span>
                            </button>
                            <button @click="deleteAction = 'rute/delete/{{ $r->id }}'; deleteName = '{{ $r->nama_rute }}'; openDelete = true; dropdown = false"
                                    class="w-full px-5 py-3 text-sm hover:bg-red-50 flex items-center space-x-3 text-red-600 border-t border-gray-50 font-bold">
                                <i class="fa-solid fa-trash"></i><span>Delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="h-6"></div>
    </div>

    <!-- SECTION 2: JADWAL PENJEMPUTAN -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-700">Jadwal Penjemputan</h3>
        <button @click="openAddJadwal = true" class="bg-[#41D3BD] text-black px-6 py-3 rounded-2xl font-bold shadow-sm hover:opacity-80 transition-all">
            <i class="fa-solid fa-calendar-plus mr-2"></i>Add Schedule
        </button>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 relative">
        <table class="w-full text-left text-black font-medium">
            <thead class="bg-[#41D3BD]">
                <tr>
                    <th class="pl-20 py-6 text-black font-medium text-lg rounded-tl-[2.5rem]">Rute</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Driver</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Hari</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Jam Kerja</th>
                    <th class="px-8 py-6 text-center rounded-tr-[2.5rem]"><span class="bg-white px-5 py-1 rounded-lg text-xs font-bold text-black uppercase">Action</span></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($schedules as $s)
                <tr class="hover:bg-gray-50/50 transition-all">
                    <td class="pl-20 py-8 font-bold text-black uppercase">{{ $s->rute->nama_rute }}</td>
                    <td class="px-6 py-8 text-center uppercase">{{ $s->driver->nama }}</td>
                    <td class="px-6 py-8 text-center uppercase font-bold">{{ $s->hari }}</td>
                    <td class="px-6 py-8 text-center text-sm font-bold">{{ substr($s->jam_mulai,0,5) }} - {{ substr($s->jam_selesai,0,5) }}</td>
                    <td class="px-8 py-8 text-center relative" x-data="{ dropdown: false }">
                        <button @click="dropdown = !dropdown" class="text-blue-600 focus:outline-none"><i class="fa-solid fa-ellipsis text-3xl"></i></button>
                        <div x-show="dropdown" @click.away="dropdown = false" x-transition class="absolute right-0 mt-2 w-40 bg-white border border-gray-100 rounded-2xl shadow-xl z-[100] overflow-hidden text-left">
                            <!-- Tombol Update Jadwal -->
                            <button @click="currJadwal = { id: '{{ $s->id }}', rute_id: '{{ $s->rute_id }}', driver_id: '{{ $s->driver_id }}', hari: '{{ $s->hari }}', jam_mulai: '{{ substr($s->jam_mulai,0,5) }}', jam_selesai: '{{ substr($s->jam_selesai,0,5) }}' }; openEditJadwal = true; dropdown = false"
                                    class="w-full px-5 py-3 text-sm hover:bg-blue-50 flex items-center space-x-3 transition-colors">
                                <i class="fa-solid fa-pen-to-square text-blue-500"></i><span class="font-bold">Update</span>
                            </button>
                            <button @click="deleteAction = 'jadwal/delete/{{ $s->id }}'; deleteName = 'Jadwal Hari {{ $s->hari }}'; openDelete = true; dropdown = false"
                                    class="w-full px-5 py-3 text-sm hover:bg-red-50 flex items-center space-x-3 text-red-600 border-t border-gray-50 font-bold">
                                <i class="fa-solid fa-trash"></i><span>Delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="h-6"></div>
    </div>

    <!-- ======================================
         MODAL UPDATE RUTE
         ====================================== -->
    <div x-show="openEditRute" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-lg w-full p-8 shadow-2xl" @click.away="openEditRute = false">
            <h3 class="text-2xl font-bold mb-6 text-gray-700">Update Route</h3>
            <form :action="'rute/update/' + currRute.id" method="POST" class="space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Nama Rute</label>
                    <input name="nama_rute" type="text" x-model="currRute.nama_rute" required class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Wilayah Cakupan</label>
                    <textarea name="wilayah" rows="3" x-model="currRute.wilayah" required class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                </div>
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button @click="openEditRute = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold text-gray-700">Batal</button>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-200 transition-all">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ======================================
         MODAL UPDATE JADWAL
         ====================================== -->
    <div x-show="openEditJadwal" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-lg w-full p-8 shadow-2xl" @click.away="openEditJadwal = false">
            <h3 class="text-2xl font-bold mb-6 text-gray-700">Update Schedule</h3>
            <form :action="'jadwal/update/' + currJadwal.id" method="POST" class="space-y-4">
                @csrf @method('PUT')
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Pilih Rute</label>
                        <select name="rute_id" x-model="currJadwal.rute_id" class="w-full px-4 py-2 border rounded-xl outline-none">
                            @foreach($routes as $route) <option value="{{ $route->id }}">{{ $route->nama_rute }}</option> @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Driver</label>
                        <select name="driver_id" x-model="currJadwal.driver_id" class="w-full px-4 py-2 border rounded-xl outline-none">
                            @foreach($drivers as $driver) <option value="{{ $driver->id }}">{{ $driver->nama }}</option> @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Hari</label>
                    <select name="hari" x-model="currJadwal.hari" class="w-full px-4 py-2 border rounded-xl outline-none uppercase font-bold text-gray-600">
                        <option value="senin">Senin</option><option value="selasa">Selasa</option><option value="rabu">Rabu</option><option value="kamis">Kamis</option><option value="jumat">Jumat</option><option value="sabtu">Sabtu</option><option value="minggu">Minggu</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Jam Mulai</label>
                        <input name="jam_mulai" type="time" x-model="currJadwal.jam_mulai" class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Jam Selesai</label>
                        <input name="jam_selesai" type="time" x-model="currJadwal.jam_selesai" class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                </div>
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button @click="openEditJadwal = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold text-gray-700">Batal</button>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-200 transition-all">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL ADD RUTE (Tetap Sama) -->
    <div x-show="openAddRute" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-lg w-full p-8 shadow-2xl" @click.away="openAddRute = false">
            <h3 class="text-2xl font-bold mb-6 text-gray-700 text-center">Add New Route</h3>
            <form action="{{ route('admin.rute.store') }}" method="POST" class="space-y-4">
                @csrf
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Nama Rute</label><input name="nama_rute" type="text" required class="w-full px-4 py-2 border rounded-xl outline-none"></div>
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Wilayah Cakupan</label><textarea name="wilayah" rows="3" required class="w-full px-4 py-2 border rounded-xl outline-none"></textarea></div>
                <div class="flex justify-end space-x-3 pt-4 border-t"><button @click="openAddRute = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold">Batal</button><button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold">Simpan Rute</button></div>
            </form>
        </div>
    </div>

    <!-- MODAL ADD JADWAL (Tetap Sama) -->
    <div x-show="openAddJadwal" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-lg w-full p-8 shadow-2xl" @click.away="openAddJadwal = false">
            <h3 class="text-2xl font-bold mb-6 text-gray-700 text-center">Add Schedule</h3>
            <form action="{{ route('admin.jadwal.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Pilih Rute</label>
                        <select name="rute_id" class="w-full px-4 py-2 border rounded-xl outline-none">
                            @foreach($routes as $route) <option value="{{ $route->id }}">{{ $route->nama_rute }}</option> @endforeach
                        </select>
                    </div>
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Driver</label>
                        <select name="driver_id" class="w-full px-4 py-2 border rounded-xl outline-none">
                            @foreach($drivers as $driver) <option value="{{ $driver->id }}">{{ $driver->nama }}</option> @endforeach
                        </select>
                    </div>
                </div>
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Hari</label>
                    <select name="hari" class="w-full px-4 py-2 border rounded-xl outline-none uppercase font-bold text-gray-600">
                        <option value="senin">Senin</option><option value="selasa">Selasa</option><option value="rabu">Rabu</option><option value="kamis">Kamis</option><option value="jumat">Jumat</option><option value="sabtu">Sabtu</option><option value="minggu">Minggu</option>
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Jam Mulai</label><input name="jam_mulai" type="time" class="w-full px-4 py-2 border rounded-xl outline-none"></div>
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Jam Selesai</label><input name="jam_selesai" type="time" class="w-full px-4 py-2 border rounded-xl outline-none"></div>
                </div>
                <div class="flex justify-end space-x-3 pt-4 border-t"><button @click="openAddJadwal = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold">Batal</button><button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold">Set Jadwal</button></div>
            </form>
        </div>
    </div>

    <!-- MODAL DELETE GLOBAL -->
    <div x-show="openDelete" class="fixed inset-0 z-[200] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-sm w-full p-8 text-center shadow-2xl">
            <div class="text-red-500 text-6xl mb-4"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <h3 class="text-xl font-bold mb-2 text-black text-center">Hapus Data?</h3>
            <p class="text-gray-500 mb-6 text-center">Menghapus <span class="font-bold text-red-600" x-text="deleteName"></span> tidak dapat dibatalkan.</p>
            <form :action="deleteAction" method="POST">
                @csrf @method('DELETE')
                <div class="flex justify-center space-x-3">
                    <button @click="openDelete = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold text-gray-700">Batal</button>
                    <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-xl font-bold">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style> [x-cloak] { display: none !important; } </style>
@endsection
