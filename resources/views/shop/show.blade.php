@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white border rounded-xl p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}"
                     class="w-full rounded-xl object-cover">
            @else
                <div class="w-full h-64 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400">
                    No Image
                </div>
            @endif
        </div>
        <div>
            <p class="text-sm text-gray-400 mb-1">{{ $product->category->name }}</p>
            <h1 class="text-2xl font-semibold mb-2">{{ $product->name }}</h1>
            <p class="text-gray-500 text-sm mb-4">{{ $product->description }}</p>
            <p class="text-2xl font-bold text-blue-600 mb-2">LKR {{ number_format($product->price, 2) }}</p>
            <p class="text-sm mb-4 {{ $product->stock > 0 ? 'text-green-600' : 'text-red-500' }}">
                {{ $product->stock > 0 ? 'In Stock ('.$product->stock.' left)' : 'Out of Stock' }}
            </p>
            @if($product->stock > 0)
                <form method="POST" action="{{ route('cart.add', $product) }}">
                    @csrf
                    <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                        Add to Cart
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection