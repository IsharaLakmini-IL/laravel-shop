@extends('admin.layout')

@section('content')
<div class="max-w-md">
    <h1 class="text-xl font-semibold mb-6">Edit Category</h1>
    <div class="bg-white border rounded-xl p-6">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block text-sm text-gray-600 mb-1">Category Name</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}"
                       class="w-full border rounded-lg px-3 py-2 text-sm">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <button class="w-full bg-blue-600 text-white py-2 rounded-lg text-sm">
                Update Category
            </button>
        </form>
    </div>
</div>
@endsection