@extends('layouts.app')

@section('content')

<div class="flex gap-4 mb-6">
    <form method="GET" action="{{ route('home') }}" class="flex gap-2 flex-1">
        <input type="text" name="search" placeholder="Search products..."
               value="{{ request('search') }}"
               class="border rounded-lg px-3 py-2 text-sm flex-1">
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">Search</button>
    </form>
</div>

<div class="flex gap-2 mb-6 flex-wrap">
    <a href="{{ route('home') }}"
       class="px-3 py-1 rounded-full text-sm border {{ !request('category') ? 'bg-blue-600 text-white' : '' }}">
        All
    </a>
    @foreach($categories as $cat)
    <a href="{{ route('home', ['category' => $cat->slug]) }}"
       class="px-3 py-1 rounded-full text-sm border {{ request('category') == $cat->slug ? 'bg-blue-600 text-white' : '' }}">
        {{ $cat->name }}
    </a>
    @endforeach
</div>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @forelse($products as $product)
    <div class="bg-white border rounded-xl p-4">
        @if($product->image)
            <img src="{{ asset('storage/'.$product->image) }}"
                 class="w-full h-40 object-cover rounded-lg mb-3">
        @else
            <div class="w-full h-40 bg-gray-100 rounded-lg mb-3 flex items-center justify-center text-gray-400 text-sm">
                No Image
            </div>
        @endif
        <p class="text-xs text-gray-400 mb-1">{{ $product->category->name }}</p>
        <h3 class="font-medium text-sm mb-1">{{ $product->name }}</h3>
        <p class="font-bold text-blue-600 mb-3">LKR {{ number_format($product->price, 2) }}</p>
        <a href="{{ route('products.show', $product->slug) }}"
           class="block text-center border border-blue-600 text-blue-600 rounded-lg py-1.5 text-sm hover:bg-blue-600 hover:text-white transition">
            View Product
        </a>
    </div>
    @empty
        <p class="col-span-4 text-center text-gray-400 py-12">No products found.</p>
    @endforelse
</div>

<div class="mt-6">
    {{ $products->links() }}
</div>

@endsection