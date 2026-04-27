@extends('admin.layout')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-xl font-semibold mb-6">Add Product</h1>
    <div class="bg-white border rounded-xl p-6">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data"
              class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm text-gray-600 mb-1">Product Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border rounded-lg px-3 py-2 text-sm">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Category</label>
                <select name="category_id" class="w-full border rounded-lg px-3 py-2 text-sm">
                    <option value="">Select category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Price (LKR)</label>
                    <input type="number" name="price" value="{{ old('price') }}" step="0.01"
                           class="w-full border rounded-lg px-3 py-2 text-sm">
                    @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm">
                    @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Description</label>
                <textarea name="description" rows="3"
                          class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('description') }}</textarea>
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Product Image</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full border rounded-lg px-3 py-2 text-sm">
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" id="is_active" checked>
                <label for="is_active" class="text-sm text-gray-600">Active (visible in shop)</label>
            </div>
            <button class="w-full bg-blue-600 text-white py-2 rounded-lg text-sm hover:bg-blue-700">
                Create Product
            </button>
        </form>
    </div>
</div>
@endsection