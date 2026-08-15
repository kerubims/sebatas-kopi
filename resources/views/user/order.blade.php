<x-app-layout>
    <div class="min-h-screen bg-gradient-to-b from-amber-50 to-white pt-20">
        <div class="container mx-auto px-6 py-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-8 text-center">Pesan Sekarang</h1>
            
            <div class="max-w-6xl mx-auto">
                <div class="bg-white rounded-lg shadow-md p-8 mb-8">
                    <h2 class="text-2xl font-semibold text-gray-700 mb-6">Pilih Menu Favorit Anda</h2>
                    
                    @if($categories->count() > 0)
                        <div class="space-y-8">
                            @foreach($categories as $category)
                                <div>
                                    <h3 class="text-xl font-semibold text-amber-600 mb-4">{{ $category->name }}</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        @forelse($category->products as $product)
                                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-shadow duration-300">
                                                <div class="flex items-start space-x-4">
                                                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/100?text='.$product->name }}" 
                                                         alt="{{ $product->name }}" 
                                                         class="w-20 h-20 object-cover rounded-lg">
                                                    <div class="flex-1">
                                                        <h4 class="font-semibold text-gray-800">{{ $product->name }}</h4>
                                                        <p class="text-sm text-gray-600 mb-2 line-clamp-2">{{ $product->description }}</p>
                                                        <p class="text-lg font-bold text-amber-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                                        @if($product->is_available)
                                                            <button class="mt-2 bg-amber-600 text-white px-4 py-1 rounded-full text-sm hover:bg-amber-700 transition-colors">
                                                                Pesan
                                                            </button>
                                                        @else
                                                            <span class="mt-2 inline-block text-red-600 text-sm">Habis</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-gray-500 col-span-3">Belum ada produk.</p>
                                        @endforelse
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-12">Belum ada menu tersedia untuk dipesan.</p>
                    @endif
                </div>
                
                <div class="bg-gray-50 rounded-lg p-6 text-center">
                    <p class="text-gray-600 mb-4">Butuh bantuan? Hubungi kami di:</p>
                    <p class="text-xl font-semibold text-amber-600">081212908737</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
