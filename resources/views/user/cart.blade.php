<x-app-layout>
    <div class="min-h-screen bg-white pt-24 pb-12" x-data="cartHandler()">
        <div class="container mx-auto px-6">
            
            <!-- Page Title -->
            <div class="mb-8">
                <h1 class="text-4xl font-serif font-bold text-[#5C4033] mb-2">Shopping Cart</h1>
                <p class="text-gray-600">Review your items before checkout</p>
            </div>

            <!-- Cart Items -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Cart Items List -->
                <div class="lg:col-span-2">
                    @if(count($cartItems) > 0)
                        <div class="space-y-4">
                            @foreach($cartItems as $itemKey => $item)
                                <div class="bg-white border-2 border-gray-800 rounded-2xl p-4 sm:p-6 flex flex-col sm:flex-row gap-4">
                                    
                                    <!-- Product Image -->
                                    <div class="w-full sm:w-24 h-24 bg-gray-200 rounded-lg flex-shrink-0 overflow-hidden border border-gray-200">
                                        @if(isset($item['image']) && $item['image'])
                                            <img src="{{ asset('storage/' . $item['image']) }}" 
                                                 alt="{{ $item['product_name'] }}" 
                                                 class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-gray-50 text-gray-400">
                                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Product Details -->
                                    <div class="flex-grow">
                                        <h3 class="text-lg font-bold text-gray-800 mb-1">{{ $item['product_name'] }}</h3>
                                        <p class="text-sm text-gray-600 mb-2">
                                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                                        </p>

                                        <!-- Extras -->
                                        @if(count($item['extras']) > 0)
                                            <div class="mb-2">
                                                <p class="text-xs text-gray-500 font-semibold mb-1">Extras:</p>
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach($item['extras'] as $extra)
                                                        <span class="text-xs bg-[#cba678] text-[#5C4033] px-2 py-1 rounded-full">
                                                            {{ $extra['name'] }} (+{{ number_format($extra['price'], 0, ',', '.') }})
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Quantity Controls -->
                                        <div class="flex items-center text-black gap-3 mt-3">
                                            <button @click="updateQuantity('{{ $itemKey }}', {{ $item['quantity'] - 1 }})"
                                                    class="w-8 h-8 rounded-full border-2 border-gray-800 flex items-center justify-center hover:bg-gray-100 transition">
                                                <span class="text-lg font-bold">-</span>
                                            </button>
                                            <span class="text-lg font-semibold min-w-[2rem] text-center">{{ $item['quantity'] }}</span>
                                            <button @click="updateQuantity('{{ $itemKey }}', {{ $item['quantity'] + 1 }})"
                                                    class="w-8 h-8 rounded-full border-2 border-gray-800 flex items-center justify-center hover:bg-gray-100 transition">
                                                <span class="text-lg font-bold">+</span>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Price & Remove -->
                                    <div class="flex sm:flex-col items-center sm:items-end justify-between sm:justify-start gap-2">
                                        <p class="text-xl font-bold text-[#5C4033]">
                                            Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                        </p>
                                        <button @click="removeItem('{{ $itemKey }}')"
                                                class="text-red-600 hover:text-red-800 transition p-2">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Clear Cart Button -->
                        <div class="mt-6 text-right">
                            <button @click="clearCart()"
                                    class="text-red-600 hover:text-red-800 font-semibold transition text-sm flex items-center justify-end gap-2 ml-auto">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Clear All Items
                            </button>
                        </div>
                    @else
                        <!-- Empty Cart -->
                        <div class="text-center py-16 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-300">
                            <div class="w-20 h-20 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-serif font-bold text-gray-800 mb-2">Keranjang Kosong</h3>
                            <p class="text-gray-600 mb-6">Sepertinya Anda belum memesan kopi hari ini.</p>
                            <a href="{{ route('menu') }}" 
                               class="inline-block bg-[#5C4033] text-white font-bold py-3 px-8 rounded-full hover:bg-[#4a332a] transition shadow-lg">
                                Lihat Menu
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Order Summary -->
                @if(count($cartItems) > 0)
                    <div class="lg:col-span-1">
                        <div class="bg-white border-2 border-gray-800 rounded-2xl p-6 sticky top-24">
                            <h2 class="text-2xl font-serif font-bold text-gray-800 mb-6">Order Summary</h2>

                            <!-- Summary Details -->
                            <div class="space-y-3 mb-6">
                                <div class="flex justify-between text-gray-600">
                                    <span>Items ({{ $itemCount }})</span>
                                    <span>Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                                </div>
                                <div class="border-t-2 border-gray-200 pt-3">
                                    <div class="flex justify-between text-xl font-bold text-[#5C4033]">
                                        <span>Total</span>
                                        <span>Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Checkout Button -->
                            <button @click="proceedToCheckout" 
                                    class="w-full bg-[#5C4033] text-white font-bold py-4 px-6 rounded-full hover:bg-[#4a332a] transition duration-300 shadow-md mb-3 flex justify-center items-center gap-2">
                                <span>Proceed to Checkout</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>

                            <!-- Continue Shopping -->
                            <a href="{{ route('menu') }}" 
                               class="block text-center text-[#5C4033] font-semibold hover:underline text-sm">
                                ← Tambah Menu Lain
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function cartHandler() {
            return {
                async updateQuantity(itemKey, newQuantity) {
                    if (newQuantity < 1) {
                        window.showConfirm('Hapus item ini dari keranjang?', () => {
                            this.removeItem(itemKey);
                        });
                        return;
                    }

                    try {
                        const response = await fetch(`/cart/${itemKey}`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({ quantity: newQuantity })
                        });

                        const data = await response.json();

                        if (data.success) {
                            location.reload();
                        } else {
                            window.showToast('Gagal update jumlah item', 'error');
                        }
                    } catch (error) {
                        console.error('Error updating quantity:', error);
                        window.showToast('Terjadi kesalahan sistem.', 'error');
                    }
                },

                async removeItem(itemKey) {
                    window.showConfirm('Yakin ingin menghapus item ini?', async () => {
                        try {
                            const response = await fetch(`/cart/${itemKey}`, {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                },
                            });

                            const data = await response.json();

                            if (data.success) {
                                location.reload();
                            } else {
                                window.showToast('Gagal menghapus item', 'error');
                            }
                        } catch (error) {
                            console.error('Error removing item:', error);
                            window.showToast('Terjadi kesalahan sistem.', 'error');
                        }
                    });
                },

                async clearCart() {
                    window.showConfirm('Kosongkan seluruh keranjang?', async () => {
                        try {
                            const response = await fetch('/cart', {
                                method: 'DELETE',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                }
                            });

                            const data = await response.json();

                            if (data.success) {
                                location.reload();
                            } else {
                                window.showToast('Gagal mengosongkan keranjang', 'error');
                            }
                        } catch (error) {
                            console.error('Error clearing cart:', error);
                            window.showToast('Terjadi kesalahan sistem.', 'error');
                        }
                    });
                },

                // FUNGSI CHECKOUT YANG DIPERBAIKI
                async proceedToCheckout() {
                    try {
                        // Memanggil route checkout/init yang sudah didaftarkan di web.php
                        const response = await fetch('/checkout/init', { 
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            }
                        });

                        const data = await response.json();

                        if (response.ok && data.success) {
                            // Redirect ke halaman review (bukan checkout ID order lagi)
                            window.location.href = data.redirect_url;
                        } else {
                            window.showToast(data.message || 'Gagal memproses checkout.', 'error');
                        }
                    } catch (error) {
                        console.error('Error during checkout:', error);
                        window.showToast('Terjadi kesalahan sistem. Pastikan route web.php sudah diupdate.', 'error');
                    }
                }
            }
        }
    </script>
</x-app-layout>