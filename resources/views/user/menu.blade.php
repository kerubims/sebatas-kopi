<x-app-layout>
    <div class="min-h-screen bg-white pt-24 pb-12" x-data="menuHandler()">
        <div class="container mx-auto px-6">
            
            <!-- Search Bar -->
            <div class="flex justify-end mb-8">
                <div class="relative w-full max-w-md">
                    <input type="text" 
                           x-model="search"
                           placeholder="Search More" 
                           class="w-full bg-[#5C4033] text-white placeholder-gray-300 rounded-full py-3 px-6 pr-12 focus:outline-none focus:ring-2 focus:ring-amber-600 font-serif">
                    <div class="absolute right-4 top-1/2 transform -translate-y-1/2 text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="flex flex-wrap justify-center gap-4 mb-16">
                <button @click="activeCategory = 'all'"
                        :class="activeCategory === 'all' ? 'bg-[#cba678] text-[#5C4033] border-[#cba678]' : 'bg-white text-gray-700 border-gray-400 hover:border-[#cba678]'"
                        class="px-8 py-2 rounded-full border-2 font-semibold transition-all duration-300 font-serif">
                    All
                </button>
                @foreach($categories as $category)
                    <button @click="activeCategory = {{ $category->id }}"
                            :class="activeCategory == {{ $category->id }} ? 'bg-[#cba678] text-[#5C4033] border-[#cba678]' : 'bg-white text-gray-700 border-gray-400 hover:border-[#cba678]'"
                            class="px-8 py-2 rounded-full border-2 font-semibold transition-all duration-300 font-serif">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12">
                <template x-for="product in filteredProducts" :key="product.id">
                    <div @click="openModal(product)" 
                         class="relative bg-white rounded-[2rem] border-2 border-gray-800 p-6 flex flex-col items-center h-full transition-transform hover:scale-105 duration-300 cursor-pointer">
                        
                        <!-- Price Badge -->
                        <div class="absolute -top-6 -right-6 w-16 h-16 bg-[#4A332A] rounded-full flex items-center justify-center border-4 border-white shadow-md z-10">
                            <span class="text-white font-serif font-bold text-lg" x-text="formatPrice(product.price)"></span>
                        </div>

                        <!-- Image -->
                        <div class="w-48 h-48 mb-4 relative">
                            <img :src="product.image ? '/storage/' + product.image : 'https://via.placeholder.com/400x400?text=' + product.name" 
                                 :alt="product.name" 
                                 class="w-full h-full object-contain drop-shadow-xl">
                        </div>

                        <!-- Product Name -->
                        <h3 class="text-center font-serif font-bold text-gray-800 text-lg leading-tight mt-auto" x-text="product.name"></h3>
                        
                        <!-- Optional: Description or Add to Cart could go here, but keeping it minimal as per design -->
                    </div>
                </template>
            </div>

            <!-- Empty State -->
            <div x-show="filteredProducts.length === 0" class="text-center py-20" style="display: none;">
                <p class="text-gray-500 text-xl font-serif">No products found.</p>
            </div>

        </div>

        <!-- Product Detail Modal -->
        <div x-show="showModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="closeModal" 
             class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-2 sm:p-4"
             style="display: none;">
            
            <div @click.stop 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="bg-white rounded-2xl sm:rounded-[2rem] border-2 sm:border-4 border-gray-800 max-w-5xl w-full max-h-[95vh] overflow-y-auto shadow-2xl">
                
                <div class="p-4 sm:p-6 md:p-8">
                    <!-- Header with Close Button -->
                    <div class="flex items-center justify-between mb-4 sm:mb-6">
                        <h2 class="text-2xl sm:text-3xl font-serif font-bold text-[#cba678]">Pemesanan</h2>
                        <button @click="closeModal" 
                                class="w-8 h-8 sm:w-10 sm:h-10 rounded-full hover:bg-gray-100 flex items-center justify-center transition">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 md:gap-8">
                        <!-- Left: Product Image -->
                        <div class="flex items-center justify-center order-1">
                            <template x-if="selectedProduct">
                                <img :src="selectedProduct.image ? '/storage/' + selectedProduct.image : 'https://via.placeholder.com/400x400'" 
                                     :alt="selectedProduct.name"
                                     class="w-full max-w-xs sm:max-w-md h-auto object-contain drop-shadow-2xl rounded-lg">
                            </template>
                        </div>

                        <!-- Right: Product Details -->
                        <div class="flex flex-col justify-center space-y-3 sm:space-y-4 order-2">
                            <template x-if="selectedProduct">
                                <div>
                                    <!-- Category -->
                                    <p class="text-xs sm:text-sm text-gray-600 font-serif mb-1" x-text="getCategoryName(selectedProduct.category_id)"></p>
                                    
                                    <!-- Product Name -->
                                    <h3 class="text-xl sm:text-2xl font-serif font-bold text-gray-800 mb-2" x-text="selectedProduct.name"></h3>
                                    
                                    <!-- Price -->
                                    <p class="text-lg sm:text-xl font-bold text-[#5C4033] mb-3 sm:mb-4" 
                                       x-text="new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(selectedProduct.price)">
                                    </p>
                                    
                                    <!-- Description (if available) -->
                                    <template x-if="selectedProduct.description">
                                        <p class="text-gray-600 text-xs sm:text-sm mb-3 sm:mb-4" x-text="selectedProduct.description"></p>
                                    </template>

                                    <!-- Extras Section -->
                                    <div class="mb-4 sm:mb-6">
                                        <p class="font-semibold text-gray-700 mb-2 text-sm sm:text-base">Extra:</p>
                                        <div class="space-y-1.5 sm:space-y-2 max-h-32 sm:max-h-none overflow-y-auto">
                                            <template x-for="extra in extras" :key="extra.id">
                                                <label class="flex items-center space-x-2 cursor-pointer">
                                                    <input type="checkbox" 
                                                           :value="extra.id"
                                                           @change="toggleExtra(extra)"
                                                           class="w-4 h-4 rounded border-gray-300 text-[#5C4033] focus:ring-[#5C4033]">
                                                    <span class="text-gray-700 text-sm sm:text-base" x-text="extra.name + ' — ' + (extra.price / 1000) + 'K'"></span>
                                                </label>
                                            </template>
                                        </div>
                                    </div>

                                    <!-- Quantity Selector -->
                                    <div class="flex items-center space-x-3 sm:space-x-4 text-black mb-4 sm:mb-6">
                                        <button @click="decrementQuantity" 
                                                class="w-10 h-10 sm:w-12 sm:h-12 rounded-full border-2 border-gray-800 flex items-center justify-center hover:bg-gray-100 transition">
                                            <span class="text-lg sm:text-xl font-bold">-</span>
                                        </button>
                                        <span class="text-lg sm:text-xl font-semibold min-w-[2rem] text-center" x-text="quantity"></span>
                                        <button @click="incrementQuantity" 
                                                class="w-10 h-10 sm:w-12 sm:h-12 rounded-full border-2 border-gray-800 flex items-center justify-center hover:bg-gray-100 transition">
                                            <span class="text-lg sm:text-xl font-bold">+</span>
                                        </button>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                                        <button @click="addToCart" 
                                                class="flex-1 bg-[#cba678] text-[#5C4033] font-bold py-2.5 sm:py-3 px-4 sm:px-6 rounded-full hover:bg-[#b08d5f] transition duration-300 shadow-md text-sm sm:text-base">
                                            Add To Cart
                                        </button>
                                        <button @click="buyNow" 
                                                class="flex-1 bg-[#5C4033] text-white font-bold py-2.5 sm:py-3 px-4 sm:px-6 rounded-full hover:bg-[#4a332a] transition duration-300 shadow-md text-sm sm:text-base">
                                            Buy Now
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function menuHandler() {
            return {
                search: @json($search ?? ''),
                activeCategory: @json($selectedCategory ?? 'all') === 'all' ? 'all' : parseInt(@json($selectedCategory ?? 'all')),
                products: @json($products),
                categories: @json($categories),
                extras: @json($extras),
                
                // Modal state
                showModal: false,
                selectedProduct: null,
                selectedExtras: [],
                quantity: 1,
                
                get filteredProducts() {
                    return this.products.filter(product => {
                        const matchesSearch = product.name.toLowerCase().includes(this.search.toLowerCase());
                        const matchesCategory = this.activeCategory === 'all' || product.category_id == this.activeCategory;
                        return matchesSearch && matchesCategory;
                    });
                },

                formatPrice(price) {
                    // Convert to 'k' format (e.g., 25000 -> 25k)
                    if (price >= 1000) {
                        return Math.floor(price / 1000) + 'k';
                    }
                    return price;
                },

                getCategoryName(categoryId) {
                    const category = this.categories.find(c => c.id === categoryId);
                    return category ? category.name : '';
                },

                openModal(product) {
                    this.selectedProduct = product;
                    this.selectedExtras = [];
                    this.quantity = 1;
                    this.showModal = true;
                    document.body.style.overflow = 'hidden';
                },

                closeModal() {
                    this.showModal = false;
                    this.selectedProduct = null;
                    this.selectedExtras = [];
                    this.quantity = 1;
                    document.body.style.overflow = 'auto';
                },

                toggleExtra(extra) {
                    const index = this.selectedExtras.findIndex(e => e.id === extra.id);
                    if (index > -1) {
                        this.selectedExtras.splice(index, 1);
                    } else {
                        this.selectedExtras.push(extra);
                    }
                },

                incrementQuantity() {
                    this.quantity++;
                },

                decrementQuantity() {
                    if (this.quantity > 1) {
                        this.quantity--;
                    }
                },

                calculateTotal() {
                    if (!this.selectedProduct) return 0;
                    
                    let total = this.selectedProduct.price * this.quantity;
                    this.selectedExtras.forEach(extra => {
                        total += extra.price * this.quantity;
                    });
                    return total;
                },

                async addToCart() {
                    if (!this.selectedProduct) return;

                    try {
                        const response = await fetch('/cart/add', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                product_id: this.selectedProduct.id,
                                product_name: this.selectedProduct.name,
                                price: parseInt(this.selectedProduct.price),
                                quantity: this.quantity,
                                image: this.selectedProduct.image,
                                extras: this.selectedExtras
                            })
                        });

                        const data = await response.json();

                        if (response.ok && data.success) {
                            // Show success message
                            alert('✅ Produk berhasil ditambahkan ke cart!');
                            this.closeModal();
                        } else {
                            console.error('Server response:', data);
                            if (response.status === 422) {
                                let errorMessage = 'Gagal menambahkan ke cart:\n';
                                if (data.errors) {
                                    for (const [field, messages] of Object.entries(data.errors)) {
                                        errorMessage += `- ${messages.join(', ')}\n`;
                                    }
                                } else {
                                    errorMessage += data.message || 'Validation error';
                                }
                                alert(errorMessage);
                            } else {
                                alert('❌ ' + (data.message || 'Gagal menambahkan ke cart. Silakan coba lagi.'));
                            }
                        }
                    } catch (error) {
                        console.error('Error adding to cart:', error);
                        alert('❌ Terjadi kesalahan sistem. Silakan coba lagi.');
                    }
                },

                async buyNow() {
    if (!this.selectedProduct) return;

    try {
        // UBAH URL KE /checkout/init
        const response = await fetch('/checkout/init', { 
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                direct_buy: true,
                product_id: this.selectedProduct.id,
                product_name: this.selectedProduct.name,
                price: parseInt(this.selectedProduct.price),
                quantity: this.quantity,
                extras: this.selectedExtras
            })
        });

        const data = await response.json();

        if (response.ok && data.success) {
            // Redirect menggunakan URL yang diberikan backend
            window.location.href = data.redirect_url;
                        } else {
                            console.error('Server response:', data);
                            if (response.status === 422) {
                                let errorMessage = 'Gagal checkout:\n';
                                if (data.errors) {
                                    for (const [field, messages] of Object.entries(data.errors)) {
                                        errorMessage += `- ${messages.join(', ')}\n`;
                                    }
                                } else {
                                    errorMessage += data.message || 'Validation error';
                                }
                                alert(errorMessage);
                            } else {
                                alert('❌ ' + (data.message || 'Gagal checkout. Silakan coba lagi.'));
                            }
                        }
                    } catch (error) {
                        console.error('Error in buy now:', error);
                        alert('❌ Terjadi kesalahan sistem. Silakan coba lagi.');
                    }
                }
            }
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const menuEl = document.querySelector('[x-data]');
                if (menuEl && menuEl.__x) {
                    menuEl.__x.$data.closeModal();
                }
            }
        });
    </script>
</x-app-layout>
