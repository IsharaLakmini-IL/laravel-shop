@extends('admin.layout')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-xl font-semibold">Products</h1>
    <a href="{{ route('admin.products.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">+ Add Product</a>
</div>

<div class="bg-white border rounded-xl overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-4 py-3 font-medium text-gray-500">Product</th>
                <th class="text-left px-4 py-3 font-medium text-gray-500">Category</th>
                <th class="text-left px-4 py-3 font-medium text-gray-500">Price</th>
                <th class="text-left px-4 py-3 font-medium text-gray-500">Stock</th>
                <th class="text-left px-4 py-3 font-medium text-gray-500">Status</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr class="border-b last:border-0">
                <td class="px-4 py-3 font-medium">{{ $product->name }}</td>
                <td class="px-4 py-3 text-gray-400">{{ $product->category->name }}</td>
                <td class="px-4 py-3">LKR {{ number_format($product->price, 2) }}</td>
                <td class="px-4 py-3">{{ $product->stock }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs {{ $product->is_active ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-500' }}">
                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </td>
                <td class="px-4 py-3 flex gap-3 justify-end">
                    <a href="{{ route('admin.products.edit', $product) }}"
                       class="text-blue-600 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this product?')"
                                class="text-red-400 hover:text-red-600">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-8 text-gray-400">No products yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $products->links() }}</div>
@endsection