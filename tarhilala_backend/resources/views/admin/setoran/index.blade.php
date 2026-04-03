@extends('layouts.admin')

@section('content')
<div x-data="{ openEdit: false, openDelete: false }">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-4xl font-bold text-gray-900">Pick-up Request</h2>
        <button class="flex items-center space-x-3 bg-[#41D3BD] hover:bg-blue-100 text-black px-6 py-3 rounded-2xl transition-all shadow-sm">
            <i class="fa-solid fa-file-export text-xl font-bold"></i>
            <span class="text-lg font-bold">Export Report</span>
        </button>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 relative">
        <table class="w-full text-left">
            <thead class="bg-[#41D3BD]">
                <tr>
                    <th class="pl-20 py-6 text-black font-medium text-lg rounded-tl-[2.5rem]">Nasabah</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Tgl Pengajuan</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Estimasi</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Metode</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Status</th>
                    <th class="px-8 py-6 text-center rounded-tr-[2.5rem]">
                        <span class="bg-[#ffffff] px-5 py-1 rounded-lg text-xs font-bold text-black uppercase">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <!-- Baris Data 1 -->
                <tr class="hover:bg-gray-50/50 transition-all">
                    <td class="pl-20 py-8 text-gray-700 font-semibold italic text-lg">
                        <div class="flex flex-col">
                            <span>Andi Wijaya</span>
                            <span class="text-xs text-blue-500 not-italic font-normal">#STR-00124</span>
                        </div>
                    </td>
                    <td class="px-6 py-8 text-black font-medium italic text-lg text-center">24 Feb 2024</td>
                    <td class="px-6 py-8 text-black font-bold italic text-lg text-center">12.5 Kg</td>
                    <td class="px-6 py-8 text-black font-medium italic text-lg text-center uppercase">Saldo</td>
                    <td class="px-6 py-8 text-center">
                        <span class="px-4 py-1 rounded-full bg-yellow-100 text-yellow-700 font-bold italic text-sm">Menunggu</span>
                    </td>
                    <td class="px-8 py-8 text-center relative" x-data="{ dropdown: false }">
                        <button @click="dropdown = !dropdown" class="text-blue-600 hover:text-blue-800 focus:outline-none">
                            <i class="fa-solid fa-ellipsis text-3xl"></i>
                        </button>
                        <!-- Dropdown Menu -->
                        <div x-show="dropdown" @click.away="dropdown = false" x-transition class="absolute right-0 mt-2 w-40 bg-white border border-gray-100 rounded-2xl shadow-xl z-[100] overflow-hidden">
                            <button @click="openEdit = true; dropdown = false" class="w-full text-left px-5 py-3 text-sm hover:bg-blue-50 flex items-center space-x-3">
                                <i class="fa-solid fa-route text-blue-500"></i>
                                <span class="font-bold text-black">Update Status</span>
                            </button>
                            <button @click="openDelete = true; dropdown = false" class="w-full text-left px-5 py-3 text-sm hover:bg-red-50 flex items-center space-x-3 text-red-600 border-t border-gray-50">
                                <i class="fa-solid fa-ban"></i>
                                <span class="font-bold">Batalkan</span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Spasi bawah simetris -->
        <div class="h-6"></div>
    </div>

    <!-- MODAL UPDATE STATUS SETORAN -->
    <div x-show="openEdit" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-lg w-full p-8 shadow-2xl" @click.away="openEdit = false">
            <h3 class="text-2xl font-bold mb-6 italic text-black">Update Pick-up Status</h3>
            <form action="#" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2 italic text-sm text-gray-500 bg-gray-50 p-4 rounded-xl border">
                        <p><strong>Nasabah:</strong> Andi Wijaya</p>
                        <p><strong>Lokasi:</strong> <a href="#" class="text-blue-500 underline">Lihat di Maps</a></p>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Status Penjemputan</label>
                        <select class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="menunggu">Menunggu</option>
                            <option value="dijadwalkan">Dijadwalkan</option>
                            <option value="dalam_penjemputan">Dalam Penjemputan</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Berat Final (Kg)</label>
                        <input type="number" step="0.01" placeholder="0.00" class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Catatan Admin/Driver</label>
                    <textarea rows="3" class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400" placeholder="Tambahkan instruksi penjemputan..."></textarea>
                </div>
                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button @click="openEdit = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold text-gray-700">Batal</button>
                    <button type="submit" class="px-6 py-2 bg-blue-600 rounded-xl font-bold text-white shadow-lg shadow-blue-200">Simpan Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style> [x-cloak] { display: none !important; } </style>
@endsection
