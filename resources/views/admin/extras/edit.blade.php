<x-admin-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Extra</h2>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 max-w-2xl">
        <form action="{{ route('admin.extras.update', $extra) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Extra Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $extra->name) }}" required
                       class="w-full rounded-lg border-gray-300 focus:border-[#5C4033] focus:ring focus:ring-[#5C4033] focus:ring-opacity-50">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price (Rp)</label>
                <input type="number" name="price" id="price" value="{{ old('price', $extra->price) }}" required min="0" step="100"
                       class="w-full rounded-lg border-gray-300 focus:border-[#5C4033] focus:ring focus:ring-[#5C4033] focus:ring-opacity-50">
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_available" id="is_available" value="1" {{ old('is_available', $extra->is_available) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-[#5C4033] shadow-sm focus:border-[#5C4033] focus:ring focus:ring-[#5C4033] focus:ring-opacity-50">
                <label for="is_available" class="ml-2 block text-sm text-gray-900">Available for order</label>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.extras.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-[#5C4033] text-white rounded-lg hover:bg-[#4a332a] transition">Update Extra</button>
            </div>
        </form>
    </div>
</x-admin-layout>
