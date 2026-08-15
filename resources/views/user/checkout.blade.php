<x-app-layout>
    <div class="min-h-screen bg-white pt-24 pb-12">
        <div class="container mx-auto px-6 max-w-4xl">
            
            <!-- Page Title -->
            <div class="mb-8">
                <h1 class="text-4xl font-serif font-bold text-[#5C4033] mb-2">Checkout</h1>
                <p class="text-gray-600">Review pesanan Anda sebelum melakukan pembayaran.</p>
            </div>

            <!-- Order Details Card -->
            <div class="bg-white border-2 border-gray-800 rounded-2xl p-6 mb-6 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-serif font-bold text-gray-800">Rincian Pesanan</h2>
                    <!-- Tampilkan nomor order dummy atau label Preview -->
                    <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">DRAFT PREVIEW</span>
                </div>

                <!-- Order Items List -->
                <div class="space-y-4 mb-6">
                    @foreach($order->orderItems as $item)
                        <div class="flex gap-4 pb-4 border-b border-gray-200 last:border-0">
                            
                            <!-- Product Image -->
                            <div class="w-20 h-20 bg-gray-100 rounded-lg flex-shrink-0 overflow-hidden border border-gray-200">
                                @if(isset($item->product) && $item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" 
                                         alt="{{ $item->product_name }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Product Details -->
                            <div class="flex-grow">
                                <h3 class="font-bold text-gray-800 mb-1">
                                    {{ $item->product_name ?? 'Produk' }}
                                </h3>
                                
                                <p class="text-sm text-gray-600 mb-2">
                                    Rp {{ number_format($item->price, 0, ',', '.') }} × {{ $item->quantity }}
                                </p>

                                <!-- Extras -->
                                @if(isset($item->extras) && count($item->extras) > 0)
                                    <div class="flex flex-wrap gap-1 mt-1">
                                        @foreach($item->extras as $extra)
                                            <span class="text-xs bg-[#cba678] text-[#5C4033] px-2 py-1 rounded-full font-medium">
                                                <!-- Handle both object formats (DB or Session Mock) -->
                                                + {{ $extra->extra_name ?? $extra->name ?? 'Extra' }} 
                                                (Rp {{ number_format($extra->price, 0, ',', '.') }})
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <!-- Item Subtotal -->
                            <div class="text-right">
                                <p class="font-bold text-[#5C4033]">
                                    <!-- Fallback calculation -->
                                    Rp {{ number_format($item->subtotal > 0 ? $item->subtotal : ($item->price * $item->quantity), 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Order Summary Total -->
                <div class="border-t-2 border-gray-800 pt-4">
                    <div class="flex justify-between text-2xl font-bold text-[#5C4033]">
                        <span>Total Pembayaran</span>
                        <span>Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <!-- Table Number Input -->
                <div class="mt-6 border-t border-gray-200 pt-4">
                    <label for="table_number" class="block text-sm font-medium text-gray-700 mb-1 font-bold">Nomor Meja <span class="text-red-500">*</span></label>
                    <input type="text" id="table_number" name="table_number" required 
                           class="w-full px-4 py-2 text-gray-900 bg-white border border-gray-300 rounded-md shadow-sm focus:border-[#5C4033] focus:ring focus:ring-[#5C4033] focus:ring-opacity-50 focus:outline-none" 
                           placeholder="Contoh: 12">
                    <p class="text-xs text-gray-500 mt-1">Silakan isi nomor meja tempat Anda duduk.</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('menu') }}" 
                   class="flex-1 bg-gray-200 text-gray-800 font-bold py-4 px-6 rounded-full hover:bg-gray-300 transition duration-300 text-center">
                    ← Kembali ke Menu
                </a>
                <button id="payButton" 
                        class="flex-1 bg-[#5C4033] text-white font-bold py-4 px-6 rounded-full hover:bg-[#4a332a] transition duration-300 shadow-md flex justify-center items-center gap-2">
                    <span>Bayar Sekarang</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Midtrans Snap Script -->
    <!-- Note: Ubah client-key sesuai key sandbox/production Anda -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script>
        // 1. Variabel Global
        let existingSnapToken = null;
        let createdOrderNumber = null; // <-- Variabel baru untuk menyimpan Order ID asli

        document.getElementById('payButton').addEventListener('click', async function() {
            const btn = this;
            const originalText = btn.innerHTML;
            
            // SKENARIO A: Token sudah ada (User menutup popup sebelumnya)
            if (existingSnapToken) {
                console.log('Using existing token:', existingSnapToken);
                openMidtransPopup(existingSnapToken);
                return;
            }

            // SKENARIO B: Token belum ada (Order Baru)
            
            const tableNumber = document.getElementById('table_number').value.trim();
            if (!tableNumber) {
                window.showToast('Silakan isi Nomor Meja terlebih dahulu.', 'warning');
                document.getElementById('table_number').focus();
                return;
            }

            btn.disabled = true;
            btn.innerText = 'Memproses Order...';

            try {
                // Panggil endpoint /checkout/process
                const response = await fetch('/checkout/process', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        table_number: tableNumber
                    })
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    // BERHASIL: 
                    // 1. Simpan token
                    existingSnapToken = data.snap_token;
                    
                    // 2. SIMPAN ORDER NUMBER DARI DATABASE (PENTING!)
                    createdOrderNumber = data.order_number; 
                    
                    // 3. Buka Popup Midtrans
                    openMidtransPopup(existingSnapToken);
                } else {
                    window.showToast(data.message || 'Gagal memproses pesanan.', 'error');
                    resetButton(btn, originalText);
                }
            } catch (error) {
                console.error('Error processing payment:', error);
                window.showToast('Terjadi kesalahan sistem.', 'error');
                resetButton(btn, originalText);
            }
        });

        // Fungsi Helper: Membuka Popup Midtrans
        function openMidtransPopup(token) {
            window.snap.pay(token, {
                // Jika pembayaran BERHASIL
                onSuccess: function(result) {
                    // GUNAKAN createdOrderNumber YANG KITA DAPAT DARI FETCH DI ATAS
                    if (createdOrderNumber) {
                        // Redirect ke route simulasi menggunakan Order Number yang valid
                        window.location.href = `/payment/simulate/${createdOrderNumber}/settlement`;
                    } else {
                        // Fallback jika terjadi error aneh
                        window.location.href = '/history';
                    }
                },
                
                // Jika pembayaran PENDING
                onPending: function(result) {
                    window.location.href = '/history';
                },
                
                // Jika pembayaran GAGAL
                onError: function(result) {
                    window.showToast('Pembayaran gagal.', 'error');
                    resetButton(document.getElementById('payButton'), 'Coba Bayar Lagi');
                },
                
                // Jika user MENUTUP popup
                onClose: function() {
                    console.log('Customer closed the popup');
                    const btn = document.getElementById('payButton');
                    btn.disabled = false;
                    btn.innerHTML = '<span>Lanjutkan Pembayaran</span>';
                    btn.classList.remove('bg-[#5C4033]', 'hover:bg-[#4a332a]');
                    btn.classList.add('bg-amber-600', 'hover:bg-amber-700');
                    window.showToast('Pembayaran belum selesai. Klik "Lanjutkan Pembayaran" untuk menyelesaikan pesanan Anda.', 'warning');
                }
            });
        }

        function resetButton(btn, text) {
            btn.disabled = false;
            btn.innerHTML = '<span>' + (text || 'Bayar Sekarang') + '</span>'; 
        }
    </script>
</x-app-layout>