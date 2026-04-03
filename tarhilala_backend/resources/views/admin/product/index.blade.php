@extends('layouts.admin')

@section('content')
<div x-data="{ openEdit: false, openDelete: false }">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-4xl font-bold text-gray-900">Product</h2>
        <button class="flex items-center space-x-3 bg-[#41D3BD] hover:bg-blue-100 text-gray-800 px-6 py-3 rounded-2xl transition-all shadow-sm">
            <i class="fa-solid fa-plus text-xl font-bold"></i>
            <span class="text-lg font-bold">Add Product</span>
        </button>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 relative">
        <table class="w-full text-left">
            <thead class="bg-[#41D3BD]">
                <tr>
                    <th class="pl-20 py-6 w-40 text-black font-medium text-lg rounded-tl-[2.5rem]">Foto</th>
                    <th class="px-6 py-6 text-black font-medium text-lg">Nama</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Kategori</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Harga/Kg</th>
                    <th class="px-8 py-6 text-center rounded-tr-[2.5rem]">
                        <span class="bg-[#FFFFFF] px-5 py-1 rounded-lg text-xs font-bold text-black uppercase">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr class="hover:bg-gray-50/50 transition-all">
                    <td class="pl-20 py-6">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center border border-gray-50">
                            <i class="fa-solid fa-image text-gray-300 text-2xl"></i>
                        </div>
                    </td>
                    <td class="px-6 py-6 text-black font-semibold italic text-lg text-black">Botol Plastik</td>
                    <td class="px-6 py-6 text-black font-medium italic text-lg text-center">Plastik</td>
                    <td class="px-6 py-6 text-black font-bold italic text-lg text-center">Rp 1.200/kg</td>
                    <td class="px-8 py-6 text-center relative" x-data="{ dropdown: false }">
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
        <!-- Spasi bawah yang lebih kecil agar simetris -->
        <div class="h-6"></div>
    </div>

    <!-- MODAL UPDATE PRODUCT -->
    <div x-show="openEdit" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-lg w-full p-8 shadow-2xl" @click.away="openEdit = false">
            <h3 class="text-2xl font-bold mb-6">Update Product</h3>
            <form action="#" class="space-y-4">
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Nama Produk</label><input type="text" value="Botol Plastik" class="w-full px-4 py-2 border rounded-xl outline-none"></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Kategori</label><input type="text" value="Plastik" class="w-full px-4 py-2 border rounded-xl outline-none"></div>
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Harga/Kg</label><input type="number" value="1200" class="w-full px-4 py-2 border rounded-xl outline-none"></div>
                </div>
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi</label><textarea rows="3" class="w-full px-4 py-2 border rounded-xl outline-none">Deskripsi produk sampah...</textarea></div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button @click="openEdit = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold text-gray-700">Batal</button>
                    <button type="submit" class="px-6 py-2 bg-blue-600 rounded-xl font-bold text-white">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
