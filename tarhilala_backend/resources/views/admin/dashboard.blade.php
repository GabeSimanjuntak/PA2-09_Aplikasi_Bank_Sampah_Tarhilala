@extends('layouts.admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Customers Card -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <p class="text-gray-500 text-sm mb-2">Customers</p>
            <h3 class="text-3xl font-bold text-gray-800">1.456</h3>
        </div>
        <div class="text-gray-400 text-4xl"><i class="fa-solid fa-users"></i></div>
    </div>

    <!-- Invoices Card -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <p class="text-gray-500 text-sm mb-2">Invoices</p>
            <h3 class="text-3xl font-bold text-gray-800">1.110</h3>
        </div>
        <div class="text-gray-400 text-4xl"><i class="fa-solid fa-file-invoice"></i></div>
    </div>

    <!-- Profit Card -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <p class="text-gray-500 text-sm mb-2">Profit</p>
            <h3 class="text-3xl font-bold text-gray-800">65%</h3>
        </div>
        <div class="text-gray-400 text-4xl"><i class="fa-solid fa-chart-line"></i></div>
    </div>

    <!-- Revenue Card -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div>
            <p class="text-gray-500 text-sm mb-2">Revenue</p>
            <h3 class="text-3xl font-bold text-gray-800">$3.476</h3>
        </div>
        <div class="text-gray-400 text-4xl"><i class="fa-solid fa-hand-holding-dollar"></i></div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Chart Left -->
    <div class="bg-white p-6 rounded-2xl shadow-sm h-80 flex flex-col">
        <h4 class="font-bold text-gray-600 mb-4">Invoice Statistik</h4>
        <div class="flex-1 bg-gray-50 rounded-lg border-2 border-dashed flex items-center justify-center text-gray-400 italic text-sm">
            [ Area Grafik Pie Disini ]
        </div>
    </div>

    <!-- Chart Right -->
    <div class="bg-white p-6 rounded-2xl shadow-sm h-80 flex flex-col">
        <div class="flex justify-between items-center mb-4">
            <h4 class="font-bold text-gray-600">Sales Analystic</h4>
            <span class="text-xs font-bold text-gray-400">Rainfall vs Evaporation</span>
        </div>
        <div class="flex-1 bg-gray-50 rounded-lg border-2 border-dashed flex items-center justify-center text-gray-400 italic text-sm">
            [ Area Grafik Bar Disini ]
        </div>
    </div>
</div>

<!-- Recent Invoices Table Area -->
<div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100">
    <div class="p-6 border-b">
        <h4 class="font-bold text-gray-700">Recent Invoices</h4>
    </div>
    <div class="p-6">
        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 mb-3">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Invoice ID</p>
                    <p class="text-sm font-bold text-gray-700">INV/20260225/JSH/1356DA0FA377</p>
                    <p class="text-xs text-gray-400 mt-2">Email: tarhilala032026@gmail.com</p>
                </div>
                <div class="text-right text-xs">
                    <p class="text-gray-400">Tanggal Penjemputan : <span class="text-gray-700 font-semibold">26/02/2026</span></p>
                    <p class="text-gray-400">Tanggal Transaksi : <span class="text-gray-700 font-semibold">25/02/2026</span></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
