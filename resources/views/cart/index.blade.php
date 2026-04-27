@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold mb-6">Your Cart</h1>

@if($items->isEmpty())
    <div class="text-center py-12 text-gray-400">
        <p class="mb-4">Your cart is empty.</p>
        <a href="{{ route('home') }}" class="text-blue-600">Continue Shopping</a>
    </div>
@else
    <div class="bg-white border rounded-xl overflow-hidden mb-6">
        @foreach($items as $item)
        <div class="flex items-center gap-4 p-4 border-b last:border-0">
            <div class="flex-1">
                <p class="font-medium">{{ $item->product->name }}</p>
                <p class="text-sm text-gray-400">LKR {{ number_format($item->product->price, 2) }}</p>
            </div>
            <form method="POST" action="{{ route('cart.update', $item) }}">
                @csrf @method('PATCH')
                <input type="number" name="quantity" value="{{ $item->quantity }}"
                       min="1" onchange="this.form.submit()"
                       class="w-16 border rounded text-center text-sm py-1">
            </form>
            <p class="font-medium w-28 text-right">
                LKR {{ number_format($item->product->price * $item->quantity, 2) }}
            </p>
            <form method="POST" action="{{ route('cart.remove', $item) }}">
                @csrf @method('DELETE')
                <button class="text-red-400 text-sm hover:text-red-600">Remove</button>
            </form>
        </div>
        @endforeach
    </div>

    <div class="flex justify-between items-center bg-white border rounded-xl p-4">
        <div>
            <p class="text-gray-500 text-sm">Total</p>
            <p class="text-2xl font-bold text-blue-600">LKR {{ number_format($total, 2) }}</p>
        </div>
        <a href="{{ route('checkout') }}"
           class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
            Proceed to Checkout
        </a>
    </div>
@endif
@endsection