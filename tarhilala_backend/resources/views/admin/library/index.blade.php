@extends('layouts.admin')

@section('content')
<div x-data="{ openEdit: false, openDelete: false }">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-4xl font-bold text-gray-900">Library</h2>
        <button class="flex items-center space-x-3 bg-[#41D3BD] hover:bg-blue-100 text-gray-800 px-6 py-3 rounded-2xl transition-all shadow-sm">
            <i class="fa-solid fa-plus text-xl font-bold"></i>
            <span class="text-lg font-bold">Add Content</span>
        </button>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 relative">
        <table class="w-full text-left">
            <thead class="bg-[#41D3BD]">
                <tr>
                    <th class="pl-20 py-6 w-40 text-black font-medium text-lg rounded-tl-[2.5rem]">Thumbnail</th>
                    <th class="px-6 py-6 text-black font-medium text-lg">Judul Konten</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Penulis</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Status</th>
                    <th class="px-8 py-6 text-center rounded-tr-[2.5rem]">
                        <span class="bg-[#FFFFFF] px-5 py-1 rounded-lg text-xs font-bold text-black uppercase">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <!-- Baris Data 1 -->
                <tr class="hover:bg-gray-50/50 transition-all">
                    <td class="pl-20 py-6">
                        <div class="w-20 h-14 bg-gray-100 rounded-xl flex items-center justify-center border border-gray-100 overflow-hidden">
                            <i class="fa-solid fa-image text-gray-300 text-xl"></i>
                        </div>
                    </td>
                    <td class="px-6 py-6 text-gray-700 font-semibold italic text-lg truncate max-w-xs">Cara Mengolah Sampah Plastik</td>
                    <td class="px-6 py-6 text-gray-600 font-medium italic text-lg text-center">Admin 1</td>
                    <td class="px-6 py-6 text-center">
                        <span class="px-4 py-1 rounded-full bg-green-100 text-green-700 font-bold italic text-sm">Published</span>
                    </td>
                    <td class="px-8 py-6 text-center relative" x-data="{ dropdown: false }">
                        <button @click="dropdown = !dropdown" class="text-blue-600 hover:text-blue-800 focus:outline-none">
                            <i class="fa-solid fa-ellipsis text-3xl"></i>
                        </button>
                        <!-- Dropdown Menu -->
                        <div x-show="dropdown" @click.away="dropdown = false" x-transition class="absolute right-0 mt-2 w-40 bg-white border border-gray-100 rounded-2xl shadow-xl z-[100] overflow-hidden">
                            <button @click="openEdit = true; dropdown = false" class="w-full text-left px-5 py-3 text-sm hover:bg-blue-50 flex items-center space-x-3">
                                <i class="fa-solid fa-pen-to-square text-blue-500"></i>
                                <span class="font-bold text-gray-700">Update</span>
                            </button>
                            <button @click="openDelete = true; dropdown = false" class="w-full text-left px-5 py-3 text-sm hover:bg-red-50 flex items-center space-x-3 text-red-600 border-t border-gray-50">
                                <i class="fa-solid fa-trash"></i>
                                <span class="font-bold">Delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Footer spacing simetris -->
        <div class="h-6"></div>
    </div>

    <!-- MODAL UPDATE LIBRARY -->
    <div x-show="openEdit" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-2xl w-full p-8 shadow-2xl overflow-y-auto max-h-[90vh]" @click.away="openEdit = false">
            <h3 class="text-2xl font-bold mb-6">Update Edukasi</h3>
            <form action="#" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Judul Konten</label>
                        <input type="text" value="Cara Mengolah Sampah Plastik" class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Status</label>
                        <select class="w-full px-4 py-2 border rounded-xl outline-none">
                            <option value="published">Published</option>
                            <option value="draft">Draft</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Thumbnail URL / Path</label>
                        <input type="text" class="w-full px-4 py-2 border rounded-xl outline-none" placeholder="image.png">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Isi Konten (Text)</label>
                    <textarea rows="6" class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">Tulis isi konten edukasi di sini sesuai database...</textarea>
                </div>
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button @click="openEdit = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold text-gray-700">Batal</button>
                    <button type="submit" class="px-6 py-2 bg-blue-600 rounded-xl font-bold text-white shadow-lg shadow-blue-200">Simpan Konten</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL DELETE CONFIRMATION -->
    <div x-show="openDelete" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-sm w-full p-8 text-center shadow-2xl">
            <div class="text-red-500 text-6xl mb-4"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <h3 class="text-xl font-bold mb-2">Hapus Konten?</h3>
            <p class="text-gray-500 mb-6">Artikel ini akan dihapus permanen dari library.</p>
            <div class="flex justify-center space-x-3">
                <button @click="openDelete = false" class="px-6 py-2 bg-gray-200 rounded-xl font-bold text-gray-700">Batal</button>
                <button class="px-6 py-2 bg-red-600 rounded-xl font-bold text-white shadow-lg shadow-red-200">Ya, Hapus</button>
            </div>
        </div>
    </div>
</div>

<style> [x-cloak] { display: none !important; } </style>
@endsection
