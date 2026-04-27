@extends('admin.layout')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-xl font-semibold mb-6">Edit Product</h1>
    <div class="bg-white border rounded-xl p-6">
        <form method="POST" action="{{ route('admin.products.update', $product) }}"
              enctype="multipart/form-data" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm text-gray-600 mb-1">Product Name</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                       class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Category</label>
                <select name="category_id" class="w-full border rounded-lg px-3 py-2 text-sm">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Price (LKR)</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01"
                           class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>
                <div>
                    <label class="block text-sm text-gray-600 mb-1">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                           class="w-full border rounded-lg px-3 py-2 text-sm">
                </div>
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Description</label>
                <textarea name="description" rows="3"
                          class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('description', $product->description) }}</textarea>
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Product Image</label>
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}"
                         class="w-24 h-24 object-cover rounded-lg mb-2">
                @endif
                <input type="file" name="image" accept="image/*"
                       class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_active" id="is_active"
                       {{ $product->is_active ? 'checked' : '' }}>
                <label for="is_active" class="text-sm text-gray-600">Active (visible in shop)</label>
            </div>
            <button class="w-full bg-blue-600 text-white py-2 rounded-lg text-sm hover:bg-blue-700">
                Update Product
            </button>
        </form>
    </div>
</div>
@endsection