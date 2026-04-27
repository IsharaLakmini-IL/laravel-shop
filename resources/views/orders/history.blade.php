@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold mb-6">My Orders</h1>

@forelse($orders as $order)
<div class="bg-white border rounded-xl p-4 mb-4">
    <div class="flex justify-between items-center">
        <div>
            <p class="font-medium">Order #{{ $order->id }}</p>
            <p class="text-sm text-gray-400">{{ $order->created_at->format('M d, Y') }}</p>
        </div>
        <div class="text-right">
            <p class="font-bold text-blue-600">LKR {{ number_format($order->total_amount, 2) }}</p>
            <span class="text-xs px-2 py-1 rounded-full bg-blue-50 text-blue-600">
                {{ ucfirst($order->status) }}
            </span>
        </div>
    </div>
    <a href="{{ route('orders.show', $order) }}" class="text-sm text-blue-600 mt-2 inline-block">
        View Details →
    </a>
</div>
@empty
    <p class="text-center text-gray-400 py-12">No orders yet.</p>
@endforelse

{{ $orders->links() }}
@endsection