@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-xl font-semibold mb-6">Checkout</h1>

    <div class="bg-white border rounded-xl p-4 mb-6">
        @foreach($items as $item)
        <div class="flex justify-between py-2 border-b last:border-0 text-sm">
            <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
            <span>LKR {{ number_format($item->product->price * $item->quantity, 2) }}</span>
        </div>
        @endforeach
        <div class="flex justify-between pt-3 font-bold">
            <span>Total</span>
            <span class="text-blue-600">LKR {{ number_format($total, 2) }}</span>
        </div>
    </div>

    <form method="POST" action="{{ route('orders.store') }}" class="bg-white border rounded-xl p-6">
        @csrf
        <div class="mb-4">
            <label class="block text-sm text-gray-600 mb-1">Shipping Address</label>
            <textarea name="shipping_address" rows="3"
                      class="w-full border rounded-lg px-3 py-2 text-sm">{{ old('shipping_address') }}</textarea>
            @error('shipping_address')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
        <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
            Place Order
        </button>
    </form>
</div>
@endsection