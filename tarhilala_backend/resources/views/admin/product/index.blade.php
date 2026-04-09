@extends('layouts.admin')

@section('content')
<!-- Container Utama x-data Alpine.js -->
<div x-data="{
    openAdd: false,
    openEdit: false,
    openDelete: false,
    currProduct: { id: '', nama: '', kategori: '', harga_per_kg: '', deskripsi: '', gambar: '' }
}">

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-4xl font-bold text-gray-900">Product</h2>
        <!-- Tombol Tambah -->
        <button @click="openAdd = true" class="flex items-center space-x-3 bg-[#41D3BD] hover:opacity-80 text-gray-800 px-6 py-3 rounded-2xl transition-all shadow-sm font-bold text-lg">
            <i class="fa-solid fa-plus text-xl"></i>
            <span>Add Product</span>
        </button>
    </div>

    <!-- Feedback Berhasil -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-2xl font-bold border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Container -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 relative">
        <table class="w-full text-left">
            <thead class="bg-[#41D3BD]">
                <tr>
                    <th class="pl-20 py-6 w-32 rounded-tl-[2.5rem] text-black font-medium text-lg">Foto</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Nama</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Kategori</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Harga/Kg</th>
                    <th class="px-8 py-6 text-center rounded-tr-[2.5rem]">
                        <span class="bg-[#ffffff] px-5 py-1 rounded-lg text-xs font-bold text-black uppercase">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-black font-medium">
                @foreach($products as $product)
                <tr class="hover:bg-gray-50/50 transition-all">
                    <td class="pl-20 py-6">
                        <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center border border-gray-50 overflow-hidden">
                            @if($product->gambar)
                                <img src="{{ asset($product->gambar) }}" class="w-full h-full object-cover">
                            @else
                                <i class="fa-solid fa-image text-gray-300 text-2xl"></i>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-6 text-lg text-center font-semibold uppercase black">{{ $product->nama }}</td>
                    <td class="px-6 py-6 text-center text-lg">{{ $product->kategori }}</td>
                    <td class="px-6 py-6 text-center font-bold text-lg">Rp {{ number_format($product->harga_per_kg, 0, ',', '.') }}/kg</td>
                    <td class="px-8 py-6 text-center relative" x-data="{ dropdown: false }">
                        <button @click="dropdown = !dropdown" class="text-blue-600 hover:text-blue-800 focus:outline-none">
                            <i class="fa-solid fa-ellipsis text-3xl"></i>
                        </button>
                        <!-- Dropdown -->
                        <div x-show="dropdown" @click.away="dropdown = false" x-transition class="absolute right-0 mt-2 w-40 bg-white border border-gray-100 rounded-2xl shadow-xl z-[100] overflow-hidden text-left">
                            <button @click="currProduct = { id: '{{ $product->id }}', nama: '{{ $product->nama }}', kategori: '{{ $product->kategori }}', harga_per_kg: '{{ $product->harga_per_kg }}', deskripsi: `{{ $product->deskripsi }}` }; openEdit = true; dropdown = false"
                                    class="w-full px-5 py-3 text-sm hover:bg-blue-50 flex items-center space-x-3 transition-colors">
                                <i class="fa-solid fa-pen-to-square text-blue-500"></i><span class="font-bold">Update</span>
                            </button>
                            <button @click="currProduct = { id: '{{ $product->id }}', nama: '{{ $product->nama }}' }; openDelete = true; dropdown = false"
                                    class="w-full px-5 py-3 text-sm hover:bg-red-50 flex items-center space-x-3 text-red-600 border-t border-gray-50">
                                <i class="fa-solid fa-trash"></i><span class="font-bold">Delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="h-6"></div>
    </div>

    <!-- MODAL ADD PRODUCT -->
    <div x-show="openAdd" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-lg w-full p-8 shadow-2xl" @click.away="openAdd = false">
            <h3 class="text-2xl font-bold mb-6 text-gray-700">Add New Product</h3>
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Nama Produk</label><input name="nama" type="text" required class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400"></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Kategori</label><input name="kategori" type="text" required class="w-full px-4 py-2 border rounded-xl outline-none"></div>
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Harga/Kg</label><input name="harga_per_kg" type="number" required class="w-full px-4 py-2 border rounded-xl outline-none"></div>
                </div>
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi</label><textarea name="deskripsi" rows="3" class="w-full px-4 py-2 border rounded-xl outline-none"></textarea></div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1 text-blue-600">Upload Gambar Produk</label>
                    <input name="gambar" type="file" accept="image/*" class="w-full px-4 py-1.5 border rounded-xl outline-none bg-gray-50 text-sm">
                </div>
                <div class="flex justify-end space-x-3 pt-4 border-t"><button @click="openAdd = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold">Batal</button><button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold shadow-lg">Simpan Produk</button></div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT PRODUCT -->
    <div x-show="openEdit" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-lg w-full p-8 shadow-2xl" @click.away="openEdit = false">
            <h3 class="text-2xl font-bold mb-6 text-gray-700 italic">Update Product</h3>
            <form :action="'product/update/' + currProduct.id" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf @method('PUT')
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Nama Produk</label><input name="nama" type="text" x-model="currProduct.nama" required class="w-full px-4 py-2 border rounded-xl outline-none"></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Kategori</label><input name="kategori" type="text" x-model="currProduct.kategori" required class="w-full px-4 py-2 border rounded-xl outline-none"></div>
                    <div><label class="block text-sm font-bold text-gray-700 mb-1">Harga/Kg</label><input name="harga_per_kg" type="number" x-model="currProduct.harga_per_kg" required class="w-full px-4 py-2 border rounded-xl outline-none"></div>
                </div>
                <div><label class="block text-sm font-bold text-gray-700 mb-1">Deskripsi</label><textarea name="deskripsi" rows="3" x-model="currProduct.deskripsi" class="w-full px-4 py-2 border rounded-xl outline-none"></textarea></div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1 text-blue-600">Ganti Gambar (Opsional)</label>
                    <input name="gambar" type="file" accept="image/*" class="w-full px-4 py-1.5 border rounded-xl outline-none bg-gray-50 text-sm">
                </div>
                <div class="flex justify-end space-x-3 pt-4 border-t"><button @click="openEdit = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold">Batal</button><button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold">Simpan Perubahan</button></div>
            </form>
        </div>
    </div>

    <!-- MODAL DELETE -->
    <div x-show="openDelete" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-sm w-full p-8 text-center shadow-2xl">
            <div class="text-red-500 text-6xl mb-4"><i class="fa-solid fa-triangle-exclamation"></i></div>
            <h3 class="text-xl font-bold mb-2">Hapus Produk?</h3>
            <p class="text-gray-500 mb-6 text-sm">Menghapus <span class="font-bold text-red-600" x-text="currProduct.nama"></span> tidak dapat dibatalkan.</p>
            <form :action="'product/delete/' + currProduct.id" method="POST">
                @csrf @method('DELETE')
                <div class="flex justify-center space-x-3">
                    <button @click="openDelete = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold">Batal</button>
                    <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-xl font-bold shadow-lg">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style> [x-cloak] { display: none !important; } </style>
@endsection
