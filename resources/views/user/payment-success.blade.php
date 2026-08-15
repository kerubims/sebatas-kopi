<x-app-layout>
    <div class="min-h-screen bg-white flex flex-col items-center justify-center pt-20 pb-12">
        
        <!-- Success Animation Container -->
        <div class="text-center animate-fade-in-up">
            
            <!-- Icon Circle (Sesuai Referensi Gambar) -->
            <div class="relative inline-flex items-center justify-center mb-8">
                <!-- Outer Ring (Opacity Rendah) -->
                <div class="w-40 h-40 bg-[#5C4033] rounded-full opacity-20 absolute animate-ping-slow"></div>
                
                <!-- Middle Ring -->
                <div class="w-32 h-32 bg-[#8B5A2B] rounded-full opacity-40 absolute"></div>
                
                <!-- Inner Circle -->
                <div class="w-24 h-24 bg-[#5C4033] rounded-full flex items-center justify-center relative z-10 shadow-xl">
                    <!-- Checkmark SVG -->
                    <svg class="w-12 h-12 text-white animate-draw-check" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>

            <!-- Main Text -->
            <h1 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 mb-4 tracking-wide">
                Pembayaran Berhasil
            </h1>
            
            <p class="text-gray-500 text-lg mb-8 max-w-md mx-auto leading-relaxed">
                Terima kasih! Pesanan Anda 
                <span class="font-bold text-[#5C4033]">{{ $order->order_number }}</span> 
                telah kami terima dan akan segera diproses.
            </p>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('history') }}" 
                   class="px-8 py-3 bg-[#5C4033] text-white font-bold rounded-full hover:bg-[#4a332a] transition shadow-lg transform hover:-translate-y-1">
                    Lihat Riwayat Pesanan
                </a>
                
                <a href="{{ route('menu') }}" 
                   class="px-8 py-3 bg-white text-[#5C4033] border-2 border-[#5C4033] font-bold rounded-full hover:bg-gray-50 transition transform hover:-translate-y-1">
                    Kembali ke Menu
                </a>
            </div>
        </div>

    </div>

    <!-- Custom CSS untuk Animasi Sederhana -->
    <style>
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
        }

        .animate-ping-slow {
            animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        @keyframes draw-check {
            0% { stroke-dasharray: 100; stroke-dashoffset: 100; }
            100% { stroke-dashoffset: 0; }
        }
    </style>
</x-app-layout>