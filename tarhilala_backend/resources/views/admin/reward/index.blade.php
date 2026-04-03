@extends('layouts.admin')

@section('content')
<div x-data="{ openEdit: false, openDelete: false }">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-4xl font-bold text-gray-900">Reward</h2>
        <button class="flex items-center space-x-3 bg-[#41D3BD] hover:bg-blue-100 text-gray-800 px-6 py-3 rounded-2xl transition-all shadow-sm">
            <i class="fa-solid fa-plus text-xl font-bold"></i>
            <span class="text-lg font-bold">Add Reward</span>
        </button>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 relative">
        <table class="w-full text-left">
            <thead class="bg-[#41D3BD]">
                <tr>
                    <th class="pl-20 py-6 text-black font-medium text-lg rounded-tl-[2.5rem]">Nama Reward</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Poin</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Stok</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Status</th>
                    <th class="px-8 py-6 text-center rounded-tr-[2.5rem]">
                        <span class="bg-[#FFFFFF] px-5 py-1 rounded-lg text-xs font-bold text-black uppercase">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr class="hover:bg-gray-50/50 transition-all">
                    <td class="pl-20 py-8 text-gray-700 font-semibold italic text-lg">Minyak 3Kg</td>
                    <td class="px-6 py-8 text-gray-600 font-medium italic text-lg text-center">1000 poin</td>
                    <td class="px-6 py-8 text-gray-700 font-medium italic text-lg text-center">5</td>
                    <td class="px-6 py-8 text-center italic text-green-600 font-bold text-lg">Tersedia</td>
                    <td class="px-8 py-8 text-center relative" x-data="{ dropdown: false }">
                        <button @click="dropdown = !dropdown" class="text-blue-600 hover:text-blue-800 focus:outline-none">
                            <i class="fa-solid fa-ellipsis text-3xl"></i>
                        </button>
                        <div x-show="dropdown" @click.away="dropdown = false" x-transition class="absolute right-0 mt-2 w-40 bg-white border border-gray-100 rounded-2xl shadow-xl z-[100] overflow-hidden">
                            <button @click="openEdit = true; dropdown = false" class="w-full text-left px-5 py-3 text-sm hover:bg-blue-50 flex items-center space-x-3"><i class="fa-solid fa-pen-to-square text-blue-500"></i><span class="font-bold text-gray-700">Update</span></button>
                            <button @click="openDelete = true; dropdown = false" class="w-full text-left px-5 py-3 text-sm hover:bg-red-50 flex items-center space-x-3 text-red-600 border-t border-gray-50"><i class="fa-solid fa-trash"></i><span class="font-bold">Delete</span></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Spasi bawah dikurangi dari h-10 menjadi h-6 agar simetris -->
        <div class="h-6"></div>
    </div>

    <!-- MODAL UPDATE REWARD (Tetap sama) -->
    <div x-show="openEdit" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-lg w-full p-8 shadow-2xl" @click.away="openEdit = false">
            <h3 class="text-2xl font-bold mb-6">Update Reward</h3>
            <form action="#" class="space-y-4">
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Nama Reward</label><input type="text" value="Minyak 3Kg" class="w-full px-4 py-2 border rounded-xl outline-none"></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Poin</label><input type="number" value="1000" class="w-full px-4 py-2 border rounded-xl outline-none"></div>
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Stok</label><input type="number" value="5" class="w-full px-4 py-2 border rounded-xl outline-none"></div>
                </div>
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi</label><textarea rows="3" class="w-full px-4 py-2 border rounded-xl outline-none">Deskripsi reward...</textarea></div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button @click="openEdit = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold text-gray-700">Batal</button>
                    <button type="submit" class="px-6 py-2 bg-blue-600 rounded-xl font-bold text-white">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style> [x-cloak] { display: none !important; } </style>
@endsection
