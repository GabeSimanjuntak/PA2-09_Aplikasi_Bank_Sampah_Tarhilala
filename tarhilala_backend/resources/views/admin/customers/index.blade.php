@extends('layouts.admin')

@section('content')
<!-- Container Utama x-data Alpine.js -->
<div x-data="{ openAdd: false, openEdit: false, openDelete: false, currUser: {} }">

    <div class="flex justify-between items-center mb-8">
        <h2 class="text-4xl font-bold text-gray-900">Customers</h2>
        <!-- Tombol Tambah -->
        <button @click="openAdd = true" class="flex items-center space-x-3 bg-[#41D3BD] hover:opacity-80 text-gray-800 px-6 py-3 rounded-2xl transition-all shadow-sm">
            <i class="fa-solid fa-user-plus text-xl font-bold"></i>
            <span class="text-lg font-bold">Add Customer</span>
        </button>
    </div>

    <!-- Feedback Berhasil -->
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-2xl font-bold border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Container (Tanpa overflow-hidden agar dropdown melayang) -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 relative">
        <table class="w-full text-left">
            <thead class="bg-[#41D3BD]">
                <tr>
                    <th class="pl-20 py-6 text-black font-medium text-lg rounded-tl-[2.5rem]">Nama Nasabah</th>
                    <th class="px-6 py-6 text-black font-medium text-lg ">Email</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">No. Telepon</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Registrasi</th>
                    <th class="px-8 py-6 text-center rounded-tr-[2.5rem]">
                        <span class="bg-[#ffffff] px-5 py-1 rounded-lg text-xs font-bold text-black uppercase">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($customers as $customer)
                <tr class="hover:bg-gray-50/50 transition-all">
                    <td class="pl-20 py-6 text-black font-semibold text-lg uppercase text-black">{{ $customer->nama }}</td>
                    <td class="px-6 py-6 text-black font-medium text-lg">{{ $customer->email }}</td>
                    <td class="px-6 py-6 text-black font-medium text-lg text-center">{{ $customer->nomor_telepon }}</td>
                    <td class="px-6 py-6 text-black font-medium text-lg text-center">{{ $customer->created_at->format('d M Y') }}</td>
                    <td class="px-8 py-6 text-center relative" x-data="{ dropdown: false }">
                        <button @click="dropdown = !dropdown" class="text-blue-600 hover:text-blue-800 focus:outline-none">
                            <i class="fa-solid fa-ellipsis text-3xl"></i>
                        </button>
                        <!-- Dropdown -->
                        <div x-show="dropdown" @click.away="dropdown = false" x-transition class="absolute right-0 mt-2 w-40 bg-white border border-gray-100 rounded-2xl shadow-xl z-[100] overflow-hidden">
                            <button @click="currUser = {{ $customer }}; openEdit = true; dropdown = false" class="w-full text-left px-5 py-3 text-sm hover:bg-blue-50 flex items-center space-x-3">
                                <i class="fa-solid fa-user-pen text-blue-500"></i><span class="font-bold text-black">Update</span>
                            </button>
                            <button @click="currUser = {{ $customer }}; openDelete = true; dropdown = false" class="w-full text-left px-5 py-3 text-sm hover:bg-red-50 flex items-center space-x-3 text-red-600 border-t border-gray-50">
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

    <!-- MODAL ADD CUSTOMER -->
    <div x-show="openAdd" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-lg w-full p-8 shadow-2xl" @click.away="openAdd = false">
            <h3 class="text-2xl font-bold mb-6 text-gray-700">Add New Customer</h3>
            <form action="{{ route('admin.customers.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap</label>
                    <input name="nama" type="text" required class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Email</label>
                        <input name="email" type="email" required class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">No. Telp</label>
                        <input name="nomor_telepon" type="text" class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Password</label>
                    <input name="password" type="password" required class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
                </div>
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button @click="openAdd = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold text-gray-700">Batal</button>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-200">Simpan Nasabah</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL EDIT CUSTOMER -->
    <div x-show="openEdit" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-lg w-full p-8 shadow-2xl" @click.away="openEdit = false">
            <h3 class="text-2xl font-bold mb-6 text-gray-700">Update Customer</h3>
            <form :action="'customers/update/' + currUser.id" method="POST" class="space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap</label>
                    <input name="nama" type="text" x-model="currUser.nama" required class="w-full px-4 py-2 border rounded-xl outline-none">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Email</label>
                        <input name="email" type="email" x-model="currUser.email" required class="w-full px-4 py-2 border rounded-xl outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">No. Telp</label>
                        <input name="nomor_telepon" type="text" x-model="currUser.nomor_telepon" class="w-full px-4 py-2 border rounded-xl outline-none">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Ganti Password (Kosongkan jika tidak diubah)</label>
                    <input name="password" type="password" class="w-full px-4 py-2 border rounded-xl outline-none">
                </div>
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button @click="openEdit = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold text-gray-700">Batal</button>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- MODAL DELETE -->
    <div x-show="openDelete" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-sm w-full p-8 text-center shadow-2xl">
            <div class="text-red-500 text-6xl mb-4"><i class="fa-solid fa-circle-exclamation"></i></div>
            <h3 class="text-xl font-bold mb-2">Hapus Nasabah?</h3>
            <p class="text-gray-500 mb-6">Menghapus nasabah <span class="font-bold" x-text="currUser.nama"></span> akan menghapus seluruh data transaksi mereka.</p>
            <form :action="'customers/delete/' + currUser.id" method="POST">
                @csrf @method('DELETE')
                <div class="flex justify-center space-x-3">
                    <button @click="openDelete = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold">Batal</button>
                    <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-xl font-bold shadow-lg shadow-red-200">Ya, Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style> [x-cloak] { display: none !important; } </style>
@endsection
