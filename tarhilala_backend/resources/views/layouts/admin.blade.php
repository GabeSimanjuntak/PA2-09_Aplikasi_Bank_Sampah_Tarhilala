<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Tarhilala</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f3f4f6; }
    </style>
</head>
<body class="flex h-screen overflow-hidden">

    <!-- Sidebar -->
    @include('components.sidebar')

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- Top Navbar -->
        <header class="bg-white border-b flex items-center justify-between px-8 py-4">
            <div class="flex items-center">
                <h1 class="text-xl font-bold">Welcome Back, Admin!! 👋</h1>
            </div>

            <div class="flex items-center space-x-6">
                <!-- Search Bar -->
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                    </span>
                    <input type="text" class="block w-64 pl-10 pr-3 py-2 border border-transparent bg-gray-100 rounded-lg focus:bg-white focus:ring-0 sm:text-sm" placeholder="Search">
                </div>

                <button class="text-gray-600 hover:text-blue-600"><i class="fa-regular fa-comment-dots text-xl"></i></button>
                <button class="flex items-center space-x-2 bg-gray-100 px-4 py-2 rounded-lg text-sm font-semibold">
                    <i class="fa-solid fa-arrow-up-from-bracket"></i>
                    <span>export</span>
                </button>

                <div class="flex items-center space-x-2 border-l pl-6">
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-user text-gray-600"></i>
                    </div>
                    <span class="font-bold">Admin</span>
                </div>
            </div>
        </header>

        <!-- Dynamic Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-8">
            @yield('content')
        </main>
    </div>

</body>
</html>
