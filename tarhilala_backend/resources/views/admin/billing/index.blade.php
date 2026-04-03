@extends('layouts.admin')

@section('content')
<div x-data="{ openEdit: false, openDelete: false }">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-4xl font-bold text-gray-900">Billing & Penarikan</h2>
        <button class="flex items-center space-x-3 bg-[#41D3BD] hover:bg-blue-100 text-gray-800 px-6 py-3 rounded-2xl transition-all shadow-sm">
            <i class="fa-solid fa-file-invoice-dollar text-xl font-bold"></i>
            <span class="text-lg font-bold">Export Report</span>
        </button>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 relative">
        <table class="w-full text-left">
            <thead class="bg-[#41D3BD]">
                <tr>
                    <th class="pl-20 py-6 text-black font-medium text-lg rounded-tl-[2.5rem]">Nasabah</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Jumlah</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Metode</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Tgl Pengajuan</th>
                    <th class="px-6 py-6 text-black font-medium text-lg text-center">Status</th>
                    <th class="px-8 py-6 text-center rounded-tr-[2.5rem]">
                        <span class="bg-[#ffffff] px-5 py-1 rounded-lg text-xs font-bold text-black uppercase">Action</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <!-- Contoh Data Berdasarkan Tabel Penarikan -->
                <tr class="hover:bg-gray-50/50 transition-all">
                    <td class="pl-20 py-8 text-black font-semibold italic text-lg">
                        <div class="flex flex-col">
                            <span>Siti Aminah</span>
                            <span class="text-xs text-blue-500 not-italic font-normal">#WD-2024-001</span>
                        </div>
                    </td>
                    <td class="px-6 py-8 text-black font-bold italic text-lg text-center">Rp 150.000</td>
                    <td class="px-6 py-8 text-black font-medium italic text-lg text-center uppercase">BCA - Transfer</td>
                    <td class="px-6 py-8 text-black font-medium italic text-lg text-center">05 Mar 2024</td>
                    <td class="px-6 py-8 text-center">
                        <!-- Badge Status Berdasarkan ENUM -->
                        <span class="px-4 py-1 rounded-full bg-yellow-100 text-yellow-700 font-bold italic text-sm uppercase">Menunggu</span>
                    </td>
                    <td class="px-8 py-8 text-center relative" x-data="{ dropdown: false }">
                        <button @click="dropdown = !dropdown" class="text-blue-600 hover:text-blue-800 focus:outline-none">
                            <i class="fa-solid fa-ellipsis text-3xl"></i>
                        </button>

                        <!-- Dropdown Menu (Z-index 100 agar tidak tenggelam) -->
                        <div x-show="dropdown" @click.away="dropdown = false" x-transition class="absolute right-0 mt-2 w-48 bg-white border border-gray-100 rounded-2xl shadow-xl z-[100] overflow-hidden">
                            <button @click="openEdit = true; dropdown = false" class="w-full text-left px-5 py-3 text-sm hover:bg-blue-50 flex items-center space-x-3 transition-colors border-b border-gray-50">
                                <i class="fa-solid fa-spinner text-blue-500"></i>
                                <span class="font-bold text-gray-700">Proses / Selesai</span>
                            </button>
                            <button @click="openDelete = true; dropdown = false" class="w-full text-left px-5 py-3 text-sm hover:bg-red-50 flex items-center space-x-3 text-red-600 transition-colors">
                                <i class="fa-solid fa-circle-xmark"></i>
                                <span class="font-bold">Tolak Penarikan</span>
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Spasi bawah simetris -->
        <div class="h-6"></div>
    </div>

    <!-- MODAL UPDATE STATUS PENARIKAN -->
    <div x-show="openEdit" class="fixed inset-0 z-[150] flex items-center justify-center bg-black bg-opacity-50 px-4" x-cloak>
        <div class="bg-white rounded-[2rem] max-w-lg w-full p-8 shadow-2xl" @click.away="openEdit = false">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold italic text-gray-700">Detail Penarikan</h3>
                <button @click="openEdit = false" class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>

            <form action="#" class="space-y-4">
                <div class="bg-gray-50 p-4 rounded-2xl border mb-4 italic text-sm text-gray-600">
                    <p><strong>Nasabah:</strong> Siti Aminah</p>
                    <p><strong>Jumlah:</strong> Rp 150.000</p>
                    <p><strong>Metode:</strong> BCA (1234567890)</p>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1 italic">Update Status</label>
                    <select class="w-full px-4 py-2 border rounded-xl outline-none focus:ring-2 focus:ring-blue-400 font-medium italic">
                        <option value="menunggu">Menunggu</option>
                        <option value="diproses">Sedang Diproses</option>
                        <option value="selesai">Selesai (Dana Terkirim)</option>
                        <option value="ditolak">Ditolak</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t">
                    <button @click="openEdit = false" type="button" class="px-6 py-2 bg-gray-200 rounded-xl font-bold text-gray-700">Tutup</button>
                    <button type="submit" class="px-6 py-2 bg-blue-600 rounded-xl font-bold text-white shadow-lg shadow-blue-200 transition-all">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style> [x-cloak] { display: none !important; } </style>
@endsection
