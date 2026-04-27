@extends('admin.layout')

@section('content')
<h1 class="text-xl font-semibold mb-6">Orders</h1>

<div class="bg-white border rounded-xl overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 border-b">
            <tr>
                <th class="text-left px-4 py-3 font-medium text-gray-500">Order #</th>
                <th class="text-left px-4 py-3 font-medium text-gray-500">Customer</th>
                <th class="text-left px-4 py-3 font-medium text-gray-500">Total</th>
                <th class="text-left px-4 py-3 font-medium text-gray-500">Status</th>
                <th class="text-left px-4 py-3 font-medium text-gray-500">Date</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr class="border-b last:border-0">
                <td class="px-4 py-3">#{{ $order->id }}</td>
                <td class="px-4 py-3">{{ $order->user->name }}</td>
                <td class="px-4 py-3">LKR {{ number_format($order->total_amount, 2) }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs
                        {{ $order->status == 'pending' ? 'bg-yellow-50 text-yellow-600' : '' }}
                        {{ $order->status == 'processing' ? 'bg-blue-50 text-blue-600' : '' }}
                        {{ $order->status == 'shipped' ? 'bg-purple-50 text-purple-600' : '' }}
                        {{ $order->status == 'delivered' ? 'bg-green-50 text-green-600' : '' }}
                        {{ $order->status == 'cancelled' ? 'bg-red-50 text-red-500' : '' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-gray-400">{{ $order->created_at->format('M d, Y') }}</td>
                <td class="px-4 py-3">
                    <a href="{{ route('admin.orders.show', $order) }}"
                       class="text-blue-600 hover:underline">View</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-8 text-gray-400">No orders yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $orders->links() }}</div>
@endsection