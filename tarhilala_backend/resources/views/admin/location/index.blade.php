@extends('layouts.admin')

@section('content')
<div x-data="{ openEditRoute: false, openEditJadwal: false, openDelete: false }">
    <h2 class="text-4xl font-bold text-gray-900 mb-10">Location & Schedules</h2>

    <!-- SECTION 1: MASTER RUTE -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-700">Rute</h3>
        <button class="flex items-center space-x-3 bg-[#41D3BD] hover:bg-blue-100 text-gray-800 px-6 py-3 rounded-2xl transition-all shadow-sm">
            <i class="fa-solid fa-plus text-xl font-bold"></i>
            <span class="text-lg font-bold">Add Route</span>
        </button>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 relative mb-12">
        <table class="w-full text-left">
            <thead class="bg-[#41D3BD]">
                <tr>
                    <th class="pl-20 py-6 text-black font-medium text-lg rounded-tl-[2.5rem]">Nama Rute</th>
                    <th class="px-6 py-6 text-black font-medium text-lg">Wilayah Cakupan</th>
                    <th class="px-8 py-6 text-center rounded-tr-[2.5rem]">
                        <span class="bg-[#FFFFFF] px-5 py-1 rounded-lg text-xs font-bold text-black uppercase">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr class="hover:bg-gray-50/50 transition-all">
                    <td class="pl-20 py-6 text-gray-700 font-semibold italic text-lg">Rute Medan Kota</td>
                    <td class="px-6 py-6 text-gray-600 font-medium italic text-lg">Kec. Medan Baru, Medan Petisah, Medan Polonia</td>
                    <td class="px-8 py-6 text-center relative" x-data="{ dropdown: false }">
                        <button @click="dropdown = !dropdown" class="text-blue-600 hover:text-blue-800 focus:outline-none">
                            <i class="fa-solid fa-ellipsis text-3xl"></i>
                        </button>
                        <div x-show="dropdown" @click.away="dropdown = false" class="absolute right-0 mt-2 w-40 bg-white border border-gray-100 rounded-2xl shadow-xl z-[100] overflow-hidden">
                            <button @click="openEditRoute = true; dropdown = false" class="w-full text-left px-5 py-3 text-sm hover:bg-blue-50 flex items-center space-x-3"><i class="fa-solid fa-pen-to-square text-blue-500"></i><span class="font-bold text-gray-700">Update</span></button>
                            <button @click="openDelete = true; dropdown = false" class="w-full text-left px-5 py-3 text-sm hover:bg-red-50 flex items-center space-x-3 text-red-600 border-t border-gray-50"><i class="fa-solid fa-trash"></i><span class="font-bold text-gray-700">Delete</span></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="h-6"></div>
    </div>


    <!-- SECTION 2: JADWAL PENJEMPUTAN -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-2xl font-bold text-gray-700">Jadwal Penjemputan</h3>
        <button class="flex items-center space-x-3 bg-[#41D3BD] hover:bg-blue-100 text-gray-800 px-6 py-3 rounded-2xl transition-all shadow-sm">
            <i class="fa-solid fa-plus text-xl font-bold"></i>
            <span class="text-lg font-bold">Add Schedule</span>
        </button>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 relative">
        <table class="w-full text-left">
            <thead class="bg-[#41D3BD]">
                <tr>
                    <th class="pl-20 py-6 text-black font-medium text-lg rounded-tl-[2.5rem]">Rute</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Driver</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Hari</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Jam Kerja</th>
                    <th class="px-8 py-6 text-center rounded-tr-[2.5rem]">
                        <span class="bg-[#FFFFFF] px-5 py-1 rounded-lg text-xs font-bold text-black uppercase">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr class="hover:bg-gray-50/50 transition-all">
                    <td class="pl-20 py-8 text-gray-700 font-semibold italic text-lg text-blue-600">Rute Medan Kota</td>
                    <td class="px-6 py-8 text-gray-600 font-medium italic text-lg text-center">Budi Santoso</td>
                    <td class="px-6 py-8 text-gray-700 font-bold italic text-lg text-center">Senin</td>
                    <td class="px-6 py-8 text-gray-700 font-medium italic text-lg text-center uppercase text-sm">08:00 - 16:00</td>
                    <td class="px-8 py-8 text-center relative" x-data="{ dropdown: false }">
                        <button @click="dropdown = !dropdown" class="text-blue-600 hover:text-blue-800 focus:outline-none">
                            <i class="fa-solid fa-ellipsis text-3xl"></i>
                        </button>
                        <div x-show="dropdown" @click.away="dropdown = false" class="absolute right-0 mt-2 w-40 bg-white border border-gray-100 rounded-2xl shadow-xl z-[100] overflow-hidden">
                            <button @click="openEditJadwal = true; dropdown = false" class="w-full text-left px-5 py-3 text-sm hover:bg-blue-50 flex items-center space-x-3"><i class="fa-solid fa-pen-to-square text-blue-500"></i><span class="font-bold text-gray-700">Update</span></button>
                            <button @click="openDelete = true; dropdown = false" class="w-full text-left px-5 py-3 text-sm hover:bg-red-50 flex items-center space-x-3 text-red-600 border-t border-gray-50"><i class="fa-solid fa-trash"></i><span class="font-bold">Delete</span></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="h-6"></div>
    </div>

    <!-- MODAL UPDATE RUTE -->
    <div x-show="openEditRoute" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-lg w-full p-8 shadow-2xl" @click.away="openEditRoute = false">
            <h3 class="text-2xl font-bold mb-6 italic text-gray-700">Update Rute</h3>
            <form action="#" class="space-y-4">
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Nama Rute</label><input type="text" value="Rute Medan Kota" class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400"></div>
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Wilayah (Wilayah 1, Wilayah 2...)</label><textarea rows="3" class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">Medan Baru, Petisah, Polonia</textarea></div>
                <div class="flex justify-end space-x-3 pt-4"><button @click="openEditRoute = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold">Batal</button><button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold">Simpan</button></div>
            </form>
        </div>
    </div>

    <!-- MODAL UPDATE JADWAL -->
    <div x-show="openEditJadwal" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-lg w-full p-8 shadow-2xl" @click.away="openEditJadwal = false">
            <h3 class="text-2xl font-bold mb-6 italic text-gray-700">Update Jadwal</h3>
            <form action="#" class="space-y-4">
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Pilih Rute</label><select class="w-full px-4 py-2 border rounded-xl outline-none"><option>Rute Medan Kota</option></select></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Hari</label><select class="w-full px-4 py-2 border rounded-xl outline-none"><option>Senin</option><option>Selasa</option></select></div>
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Driver</label><select class="w-full px-4 py-2 border rounded-xl outline-none"><option>Budi Santoso</option></select></div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Jam Mulai</label><input type="time" value="08:00" class="w-full px-4 py-2 border rounded-xl outline-none"></div>
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Jam Selesai</label><input type="time" value="16:00" class="w-full px-4 py-2 border rounded-xl outline-none"></div>
                </div>
                <div class="flex justify-end space-x-3 pt-4"><button @click="openEditJadwal = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold">Batal</button><button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold">Simpan</button></div>
            </form>
        </div>
    </div>
</div>

<style> [x-cloak] { display: none !important; } </style>
@endsection
