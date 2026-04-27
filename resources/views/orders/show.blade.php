@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white border rounded-xl p-6">
    <div class="text-center mb-6">
        <p class="text-green-600 text-lg font-medium">Order Placed Successfully!</p>
        <p class="text-gray-400 text-sm">Order #{{ $order->id }}</p>
    </div>

    <div class="mb-4">
        <p class="text-sm text-gray-500">Status:
            <span class="font-medium text-blue-600">{{ ucfirst($order->status) }}</span>
        </p>
        <p class="text-sm text-gray-500">Shipping to: {{ $order->shipping_address }}</p>
    </div>

    @foreach($order->items as $item)
    <div class="flex justify-between py-2 border-b text-sm">
        <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
        <span>LKR {{ number_format($item->price * $item->quantity, 2) }}</span>
    </div>
    @endforeach

    <div class="flex justify-between pt-4 font-bold">
        <span>Total</span>
        <span class="text-blue-600">LKR {{ number_format($order->total_amount, 2) }}</span>
    </div>

    <a href="{{ route('home') }}" class="block text-center mt-6 text-blue-600 text-sm">
        Continue Shopping
    </a>
</div>
@endsection