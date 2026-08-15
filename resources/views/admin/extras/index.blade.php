<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Extras (Toppings)</h2>
        <a href="{{ route('admin.extras.create') }}" class="bg-[#5C4033] text-white px-4 py-2 rounded-lg hover:bg-[#4a332a] transition">Add New Extra</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Search Bar -->
    <div class="mb-4">
        <form action="{{ route('admin.extras.index') }}" method="GET" class="flex gap-2">
            <input type="text" 
                   name="search" 
                   value="{{ $search ?? '' }}" 
                   placeholder="Search extras..." 
                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5C4033] focus:border-transparent">
            <button type="submit" class="bg-[#5C4033] text-white px-6 py-2 rounded-lg hover:bg-[#4a332a] transition">
                Search
            </button>
            @if($search)
                <a href="{{ route('admin.extras.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-300 transition">
                    Clear
                </a>
            @endif
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                    <th class="px-6 py-3 font-medium">Name</th>
                    <th class="px-6 py-3 font-medium">Price</th>
                    <th class="px-6 py-3 font-medium">Status</th>
                    <th class="px-6 py-3 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($extras as $extra)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm text-gray-800 font-medium">{{ $extra->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">Rp {{ number_format($extra->price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @if($extra->is_available)
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Available</span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Unavailable</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.extras.edit', $extra) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                <form action="{{ route('admin.extras.destroy', $extra) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No extras found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
