@extends('admin.layout')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-xl font-semibold">Categories</h1>
    <a href="{{ route('admin.categories.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">+ Add Category</a>
</div>

<div class="bg-white border rounded-xl overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-4 py-3 font-medium text-gray-500">Name</th>
                <th class="text-left px-4 py-3 font-medium text-gray-500">Slug</th>
                <th class="text-left px-4 py-3 font-medium text-gray-500">Products</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr class="border-b last:border-0">
                <td class="px-4 py-3">{{ $category->name }}</td>
                <td class="px-4 py-3 text-gray-400">{{ $category->slug }}</td>
                <td class="px-4 py-3">{{ $category->products_count }}</td>
                <td class="px-4 py-3 flex gap-3 justify-end">
                    <a href="{{ route('admin.categories.edit', $category) }}"
                       class="text-blue-600 hover:underline">Edit</a>
                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this category?')"
                                class="text-red-400 hover:text-red-600">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center py-8 text-gray-400">No categories yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
