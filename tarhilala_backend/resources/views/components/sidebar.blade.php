<aside class="w-64 bg-[#41D3BD] flex flex-col h-full">
    <!-- Logo Section -->
   <div class="p-6 flex justify-center items-center">
        <img src="{{ asset('assets/img/Logo1.png') }}" alt="Logo Tarhilala" class="w-full h-auto object-contain">
    </div>

    <!-- Navigation -->
<nav class="flex-1 px-4 space-y-2 overflow-y-auto">
    @php
        $menus = [
            ['name' => 'Dashboard', 'icon' => 'fa-solid fa-table-cells-large', 'route' => 'admin.dashboard'],
            ['name' => 'Message', 'icon' => 'fa-regular fa-comment-dots', 'route' => '#'],
            ['name' => 'Product', 'icon' => 'fa-solid fa-box-archive', 'route' => 'admin.product.index'],
            ['name' => 'Pick-Up', 'icon' => 'fa-solid fa-truck-pickup', 'route' => 'admin.setoran.index'],
            ['name' => 'Billing', 'icon' => 'fa-solid fa-file-invoice-dollar', 'route' => 'admin.billing.index'],
            ['name' => 'Employee', 'icon' => 'fa-solid fa-user-tie', 'route' => 'admin.employee.index'],
            ['name' => 'Customers', 'icon' => 'fa-solid fa-users', 'route' => 'admin.customers.index'],
            ['name' => 'Location', 'icon' => 'fa-solid fa-location-dot', 'route' => 'admin.location.index'],
            ['name' => 'Library', 'icon' => 'fa-solid fa-images', 'route' => 'admin.library.index'],
            ['name' => 'Reward', 'icon' => 'fa-solid fa-award', 'route' => 'admin.reward.index'],
        ];
    @endphp

    @foreach($menus as $menu)
    {{-- Perbaikan 1: Cek apakah route ada, jika ada gunakan route(), jika '#' tetap '#' --}}
    @php
        $url = ($menu['route'] !== '#') ? route($menu['route']) : '#';

        // Perbaikan 2: Cek apakah route ini sedang aktif agar warna background berubah otomatis
        $isActive = ($menu['route'] !== '#' && request()->routeIs($menu['route']));
    @endphp

    <a href="{{ $url }}"
       class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-200
       {{ $isActive ? 'bg-white shadow-sm text-gray-800' : 'text-gray-700 hover:bg-white/50' }}">
        <i class="{{ $menu['icon'] }} w-6"></i>
        <span class="font-semibold">{{ $menu['name'] }}</span>
    </a>
    @endforeach
</nav>

    <!-- Logout Button -->
    <div class="p-4 mt-auto">
        <a href="#" class="flex items-center space-x-3 px-6 py-3 bg-white/40 hover:bg-white rounded-xl transition-all text-gray-800 font-bold border border-white/20">
            <i class="fa-solid fa-right-from-bracket rotate-180"></i>
            <span>Logout</span>
        </a>
    </div>
</aside>
