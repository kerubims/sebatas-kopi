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
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <style>
        .material-symbols-outlined {
            font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
        }
        .material-symbols-outlined.fill {
            font-variation-settings: "FILL" 1, "wght" 400, "GRAD" 0, "opsz" 24;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100" 
      x-data="{ sidebarOpen: false, toasts: [] }" 
      @notify.window="
          let id = Date.now();
          toasts.push({ id: id, message: $event.detail.message, type: $event.detail.type || 'info', show: false });
          $nextTick(() => {
              let toast = toasts.find(t => t.id === id);
              if (toast) toast.show = true;
          });
          setTimeout(() => { 
              let toast = toasts.find(t => t.id === id);
              if (toast) {
                  toast.show = false;
                  setTimeout(() => {
                      toasts = toasts.filter(t => t.id !== id);
                  }, 300);
              }
          }, 3500);
      ">

    <!-- Global Toast Container -->
    <div class="fixed bottom-5 right-5 z-[9999] flex flex-col gap-3 pointer-events-none">
        <template x-for="toast in toasts" :key="toast.id">
            <div x-show="toast.show"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-x-full scale-95"
                 x-transition:enter-end="opacity-100 translate-x-0 scale-100"
                 x-transition:leave="transition ease-in duration-300 transform"
                 x-transition:leave-start="opacity-100 translate-x-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-x-full scale-95"
                 :class="{
                     'bg-green-600 border-green-500 text-white': toast.type === 'success',
                     'bg-red-600 border-red-500 text-white': toast.type === 'error',
                     'bg-amber-500 border-amber-400 text-amber-950': toast.type === 'warning',
                     'bg-[#5C4033] border-[#4a332a] text-white': toast.type === 'info' || !toast.type
                 }"
                 class="px-5 py-4 rounded-xl shadow-2xl flex items-center gap-4 min-w-[300px] max-w-[400px] border border-opacity-20 font-sans pointer-events-auto">
                <span class="material-symbols-outlined text-2xl shrink-0" 
                      x-text="toast.type === 'success' ? 'check_circle' : 
                             (toast.type === 'error' ? 'error' : 
                             (toast.type === 'warning' ? 'warning' : 'info'))">
                </span>
                <span class="font-medium flex-1 text-sm leading-snug whitespace-pre-line" x-text="toast.message"></span>
            </div>
        </template>
    </div>

    <script>
        window.showToast = function(message, type = 'info') {
            window.dispatchEvent(new CustomEvent('notify', { detail: { message, type } }));
        };

        window.showConfirm = function(message, onConfirm, onCancel = null) {
            window.dispatchEvent(new CustomEvent('confirm', { 
                detail: { message, onConfirm, onCancel } 
            }));
        };
    </script>

    <!-- Global Confirm Modal -->
    <div x-data="{ 
            isOpen: false, 
            message: '', 
            onConfirm: null, 
            onCancel: null 
         }" 
         @confirm.window="
            message = $event.detail.message; 
            onConfirm = $event.detail.onConfirm; 
            onCancel = $event.detail.onCancel; 
            isOpen = true;
         "
         x-show="isOpen"
         x-transition.opacity
         style="display: none;"
         class="fixed inset-0 z-[10000] flex items-center justify-center bg-black bg-opacity-60 p-4 text-black">
        
        <div @click.away="if(onCancel) onCancel(); isOpen = false;"
             x-show="isOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="bg-white rounded-2xl shadow-2xl max-w-sm w-full p-6 text-center font-sans border border-gray-200 pointer-events-auto">
             
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-amber-100 mb-5 border-4 border-amber-50 text-amber-600">
                <span class="material-symbols-outlined text-3xl">help</span>
            </div>
            
            <h3 class="text-xl font-bold text-gray-900 mb-2 font-serif">Konfirmasi</h3>
            <p class="text-gray-600 mb-6 leading-relaxed" x-text="message"></p>
            
            <div class="flex flex-col sm:flex-row gap-3">
                <button @click="isOpen = false; if(onCancel) onCancel();" 
                        class="flex-1 px-4 py-2.5 border-2 border-gray-300 text-gray-700 rounded-full font-semibold hover:bg-gray-50 transition">
                    Batal
                </button>
                <button @click="isOpen = false; if(onConfirm) onConfirm();" 
                        class="flex-1 px-4 py-2.5 bg-red-600 text-white rounded-full font-semibold hover:bg-red-700 transition shadow-md">
                    Ya, Lanjutkan
                </button>
            </div>
        </div>
    </div>

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
