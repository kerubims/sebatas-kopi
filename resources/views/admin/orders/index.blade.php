<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Orders</h2>
    </div>

    <!-- Search & Filters -->
    <div class="mb-6 bg-white p-4 rounded-xl shadow-sm border border-gray-100">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <!-- Search -->
            <div class="flex-1">
                <label for="search" class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Search</label>
                <input type="text" 
                       id="search"
                       name="search" 
                       value="{{ $search ?? '' }}" 
                       placeholder="Order number or table..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5C4033] focus:border-transparent">
            </div>
            
            <!-- Filter Status -->
            <div class="w-full md:w-48">
                <label for="status" class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Status</label>
                <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5C4033] focus:border-transparent bg-white">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ ($status ?? '') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ ($status ?? '') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="processing" {{ ($status ?? '') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ ($status ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="failed" {{ ($status ?? '') == 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="cancelled" {{ ($status ?? '') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <!-- Filter Date -->
            <div class="w-full md:w-48">
                <label for="date" class="block text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Date</label>
                <input type="date" 
                       id="date"
                       name="date" 
                       value="{{ $date ?? '' }}" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5C4033] focus:border-transparent">
            </div>

            <!-- Buttons -->
            <div class="flex items-end gap-2">
                <button type="submit" class="bg-[#5C4033] text-white px-6 py-2 rounded-lg hover:bg-[#4a332a] transition h-[42px] font-medium flex items-center justify-center">
                    Filter
                </button>
                @if($search || $status || $date)
                    <a href="{{ route('admin.orders.index') }}" class="bg-gray-100 text-gray-600 border border-gray-300 px-4 py-2 rounded-lg hover:bg-gray-200 transition h-[42px] flex items-center justify-center" title="Clear Filters">
                        <span class="material-symbols-outlined" style="font-size: 20px;">close</span>
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                    <th class="px-6 py-3 font-medium">Order ID</th>
                    <th class="px-6 py-3 font-medium">Customer</th>
                    <th class="px-6 py-3 font-medium">Date</th>
                    <th class="px-6 py-3 font-medium">Total</th>
                    <th class="px-6 py-3 font-medium">Payment Status</th>
                    <th class="px-6 py-3 font-medium">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm text-gray-800 font-medium">#{{ $order->order_number }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">Meja {{ $order->table_number }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $order->created_at->format('M d, Y H:i') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800 font-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($order->payment_type)
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-600">
                                    Unknown
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-4">
                                <!-- View Details Icon -->
                                <a href="{{ route('admin.orders.show', $order) }}" title="Lihat Detail Pesanan" class="text-[#5C4033] hover:text-[#4a332a] transition transform hover:scale-110">
                                    <span class="material-symbols-outlined">visibility</span>
                                </a>

                                <!-- Quick Action: Proses (if paid) -->
                                @if($order->status === 'paid')
                                    <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="processing">
                                        <button type="submit" title="Proses Pesanan" class="text-blue-600 hover:text-blue-800 transition transform hover:scale-110">
                                            <span class="material-symbols-outlined">coffee_maker</span>
                                        </button>
                                    </form>
                                @endif

                                <!-- Quick Action: Selesai (if processing) -->
                                @if($order->status === 'processing')
                                    <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit" title="Pesanan Selesai" class="text-green-600 hover:text-green-800 transition transform hover:scale-110">
                                            <span class="material-symbols-outlined">check_circle</span>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $orders->links() }}
        </div>
    </div>
</x-admin-layout>
