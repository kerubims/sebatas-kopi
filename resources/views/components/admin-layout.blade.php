<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel - {{ config('app.name', 'Sebatas Kopi') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600;700&family=Joan&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">
        
        {{-- ===== SIDEBAR ===== --}}
        <aside 
            class="fixed inset-y-0 left-0 z-50 w-64 bg-[#5C4033] text-white transition-transform duration-300 ease-in-out transform lg:translate-x-0 lg:static lg:inset-0"
            :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }">
            
            {{-- Logo --}}
            <div class="flex items-center justify-center h-16 bg-[#5C4033] ">
                <img src="{{ asset('images/logo-clear.png') }}" alt="Logo">
            </div>

            {{-- Navigation Menu --}}
            <nav class="mt-5 px-4 space-y-2 overflow-y-auto" style="max-height: calc(100vh - 140px);">
                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 
                          {{ request()->routeIs('admin.dashboard') ? 'bg-[#cbb593] text-[#5C4033]' : 'hover:bg-[#6d4c3d]' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                    Dashboard
                </a>

                {{-- Products --}}
                <a href="{{ route('admin.products.index') }}" 
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 
                          {{ request()->routeIs('admin.products.*') ? 'bg-[#cbb593] text-[#5C4033]' : 'hover:bg-[#6d4c3d]' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    Products
                </a>

                {{-- Categories --}}
                <a href="{{ route('admin.categories.index') }}" 
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 
                          {{ request()->routeIs('admin.categories.*') ? 'bg-[#cbb593] text-[#5C4033]' : 'hover:bg-[#6d4c3d]' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    Categories
                </a>

                {{-- Extras --}}
                <a href="{{ route('admin.extras.index') }}" 
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 
                          {{ request()->routeIs('admin.extras.*') ? 'bg-[#cbb593] text-[#5C4033]' : 'hover:bg-[#6d4c3d]' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                    Extras
                </a>

                {{-- Orders --}}
                <a href="{{ route('admin.orders.index') }}" 
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 
                          {{ request()->routeIs('admin.orders.*') ? 'bg-[#cbb593] text-[#5C4033]' : 'hover:bg-[#6d4c3d]' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                    </svg>
                    Orders
                </a>
            </nav>
            
            {{-- Logout Button --}}
            <div class="absolute bottom-0 w-full p-4 bg-[#4a332a]">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="flex items-center w-full px-4 py-2 text-sm font-medium text-white rounded-lg hover:bg-[#6d4c3d] transition-colors duration-200">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- ===== MAIN CONTENT AREA ===== --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            
            {{-- Topbar --}}
            <header class="flex items-center justify-between h-16 px-6 bg-white border-b border-gray-200 shadow-sm">
                {{-- Mobile Menu Toggle --}}
                <button @click="sidebarOpen = !sidebarOpen" 
                        class="text-gray-500 focus:outline-none lg:hidden hover:text-gray-700 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                
                {{-- User Info --}}
                <div class="flex items-center space-x-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">Administrator</p>
                    </div>
                    <div class="w-10 h-10 rounded-full bg-[#5C4033] flex items-center justify-center text-white font-bold shadow-md">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                {{ $slot }}
            </main>
        </div>
        
        {{-- Mobile Sidebar Overlay --}}
        <div x-show="sidebarOpen" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false" 
             class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden" 
             style="display: none;"></div>
    </div>
</body>
</html>
