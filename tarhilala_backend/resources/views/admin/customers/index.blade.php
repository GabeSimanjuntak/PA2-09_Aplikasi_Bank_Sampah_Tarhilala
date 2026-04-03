@extends('layouts.admin')

@section('content')
<div x-data="{ openEdit: false, openDelete: false }">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-4xl font-bold text-gray-900">Customers</h2>
        <button class="flex items-center space-x-3 bg-[#41D3BD] hover:bg-blue-100 text-gray-800 px-6 py-3 rounded-2xl transition-all shadow-sm">
            <i class="fa-solid fa-users-plus text-xl font-bold"></i>
            <span class="text-lg font-bold">Add Customer</span>
        </button>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 relative">
        <table class="w-full text-left">
            <thead class="bg-[#41D3BD]">
                <tr>
                    <th class="pl-20 py-6 text-black font-medium text-lg rounded-tl-[2.5rem]">Nama Nasabah</th>
                    <th class="px-6 py-6 text-black font-medium text-lg">Email</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">No. Telepon</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Registrasi</th>
                    <th class="px-8 py-6 text-center rounded-tr-[2.5rem]">
                        <span class="bg-[#FFFFFF] px-5 py-1 rounded-lg text-xs font-bold text-black uppercase">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <tr class="hover:bg-gray-50/50 transition-all">
                    <td class="pl-20 py-8 text-black font-semibold italic text-lg">Andi Wijaya</td>
                    <td class="px-6 py-8 text-black font-medium italic text-lg">andi@gmail.com</td>
                    <td class="px-6 py-8 text-black font-medium italic text-lg text-center">08998877665</td>
                    <td class="px-6 py-8 text-black font-medium italic text-lg text-center">05 Feb 2024</td>
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
        <div class="h-6"></div>
    </div>

    <!-- Modal Update Customer (Identik dengan Employee namun disesuaikan judulnya) -->
    <!-- ... -->
</div>
@endsection
