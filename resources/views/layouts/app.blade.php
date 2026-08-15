<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sebatas Kopi') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <style>
        .material-symbols-outlined {
            font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
        }
        .material-symbols-outlined.fill {
            font-variation-settings: "FILL" 1, "wght" 400, "GRAD" 0, "opsz" 24;
        }
        @keyframes pulse-ring {
            0% { transform: scale(0.8); box-shadow: 0 0 0 0 rgba(62, 39, 35, 0.4); }
            70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(62, 39, 35, 0); }
            100% { transform: scale(0.8); box-shadow: 0 0 0 0 rgba(62, 39, 35, 0); }
        }
        .pulse-active { animation: pulse-ring 2s infinite; }
    </style>    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Metal+Mania&family=Inter:wght@300;400;500;600;700;800&family=Hanken+Grotesk:wght@300;400;500;600;700;800&family=Joan&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Midtrans Snap.js -->
    <script type="text/javascript" 
            src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" 
            data-client-key="{{ config('midtrans.client_key') }}"></script>
    
    <style>
        body {
            font-family: 'Hanken Grotesk', 'Inter', sans-serif;
        }
    </style>
</head>
<body class="font-sans antialiased text-white bg-black" 
      x-data="{ toasts: [] }" 
      @notify.window="
          let id = Date.now();
          toasts.push({ id: id, message: $event.detail.message, type: $event.detail.type || 'info', show: false });
          // Trigger transition enter by setting show to true in next tick
          $nextTick(() => {
              let toast = toasts.find(t => t.id === id);
              if (toast) toast.show = true;
          });
          // Remove after delay
          setTimeout(() => { 
              let toast = toasts.find(t => t.id === id);
              if (toast) {
                  toast.show = false; // Trigger leave transition
                  setTimeout(() => {
                      toasts = toasts.filter(t => t.id !== id);
                  }, 300); // Wait for animation to finish
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
                     'bg-green-600 border-green-500': toast.type === 'success',
                     'bg-red-600 border-red-500': toast.type === 'error',
                     'bg-amber-500 text-amber-950 border-amber-400': toast.type === 'warning',
                     'bg-[#5C4033] border-[#4a332a]': toast.type === 'info' || !toast.type
                 }"
                 class="px-5 py-4 rounded-xl shadow-2xl flex items-center gap-4 min-w-[300px] max-w-[400px] border border-white/20 font-sans pointer-events-auto">
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
         class="fixed inset-0 z-[10000] flex items-center justify-center bg-black bg-opacity-60 p-4">
        
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
    
    @include('layouts.navigation')

    <main>
        {{ $slot }}
    </main>

</body>
</html>