<x-admin-layout>
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.orders.index') }}" class="text-gray-500 hover:text-[#5C4033]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="text-2xl font-bold text-gray-800">Order #{{ $order->order_number }}</h2>
        </div>
        <div class="text-sm text-gray-500">
            Placed on {{ $order->created_at->format('M d, Y H:i') }}
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Details -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-4 flex justify-between border-b border-gray-100 bg-gray-50">
                    <h3 class="font-bold text-gray-800">Order Items</h3>
                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                    </span>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach($order->orderItems as $item)
                        <div class="p-6 flex items-start space-x-4">
                            <div class="flex-shrink-0 w-20 h-20 bg-gray-100 rounded-lg overflow-hidden">
                                @if($item->product->image)
                                    <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-800">{{ $item->product->name }}</h4>
                                <p class="text-sm text-gray-500">Quantity: {{ $item->quantity }}</p>
                                @if($item->extras->count() > 0)
                                    <div class="mt-1 text-sm text-gray-600">
                                        <span class="font-medium">Extras:</span>
                                        {{ $item->extras->pluck('name')->join(', ') }}
                                    </div>
                                @endif
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-800">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-500">Rp {{ number_format($item->price, 0, ',', '.') }} / item</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                    <span class="font-bold text-gray-800 text-lg">Total Amount</span>
                    <span class="font-bold text-[#5C4033] text-xl">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Customer & Status -->
        <div class="space-y-6">
            <!-- Customer Info -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="font-bold text-gray-800 mb-4">Customer Information</h3>
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-[#5C4033] flex items-center justify-center text-white font-bold">
                        {{ substr($order->user->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-medium text-gray-800">{{ $order->user->name }}</p>
                        <p class="text-sm text-gray-500">{{ $order->user->email }}</p>
                    </div>
                </div>
                @if($order->user->phone)
                    <div class="text-sm text-gray-600">
                        <span class="font-medium">Phone:</span> {{ $order->user->phone }}
                    </div>
                @endif
            </div>

            <!-- Update Status -->
            <!-- <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="font-bold text-gray-800 mb-4">Update Status</h3>
                <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Payment Status</label>
                        <select name="status" id="status" class="w-full rounded-lg border-gray-300 focus:border-[#5C4033] focus:ring focus:ring-[#5C4033] focus:ring-opacity-50">
                            <option value="unpaid" {{ $order->status === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                            <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $order->status === 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div>
                        <label for="payment_status" class="block text-sm font-medium text-gray-700 mb-1">Payment Status</label>
                        <select name="payment_status" id="payment_status" class="w-full rounded-lg border-gray-300 focus:border-[#5C4033] focus:ring focus:ring-[#5C4033] focus:ring-opacity-50">
                            <option value="unpaid" {{ $order->status === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                            <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $order->status === 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-[#5C4033] text-white py-2 rounded-lg hover:bg-[#4a332a] transition">
                        Update Order
                    </button>
                </form>
            </div> -->
        </div>
    </div>
</x-admin-layout>
