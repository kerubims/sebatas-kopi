<x-admin-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Edit Product</h2>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 max-w-2xl">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select name="category_id" id="category_id" required
                        class="w-full rounded-lg border-gray-300 focus:border-[#5C4033] focus:ring focus:ring-[#5C4033] focus:ring-opacity-50">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                       class="w-full rounded-lg border-gray-300 focus:border-[#5C4033] focus:ring focus:ring-[#5C4033] focus:ring-opacity-50">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="3"
                          class="w-full rounded-lg border-gray-300 focus:border-[#5C4033] focus:ring focus:ring-[#5C4033] focus:ring-opacity-50">{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price (Rp)</label>
                <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" required min="0" step="100"
                       class="w-full rounded-lg border-gray-300 focus:border-[#5C4033] focus:ring focus:ring-[#5C4033] focus:ring-opacity-50">
                @error('price')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
                @if($product->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" class="w-20 h-20 object-cover rounded-lg">
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#f3e9dc] file:text-[#5C4033] hover:file:bg-[#e6dccf]">
                <p class="text-xs text-gray-500 mt-1">Leave empty to keep current image.</p>
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_available" id="is_available" value="1" {{ old('is_available', $product->is_available) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-[#5C4033] shadow-sm focus:border-[#5C4033] focus:ring focus:ring-[#5C4033] focus:ring-opacity-50">
                <label for="is_available" class="ml-2 block text-sm text-gray-900">Available for order</label>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.products.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-[#5C4033] text-white rounded-lg hover:bg-[#4a332a] transition">Update Product</button>
            </div>
        </form>
    </div>
</x-admin-layout>
