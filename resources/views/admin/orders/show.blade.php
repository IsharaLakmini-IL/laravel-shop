@extends('admin.layout')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-xl font-semibold mb-6">Order #{{ $order->id }}</h1>

    <div class="bg-white border rounded-xl p-6 mb-4">
        <p class="text-sm text-gray-500 mb-1">Customer: <span class="text-gray-800 font-medium">{{ $order->user->name }}</span></p>
        <p class="text-sm text-gray-500 mb-1">Email: {{ $order->user->email }}</p>
        <p class="text-sm text-gray-500 mb-4">Shipping: {{ $order->shipping_address }}</p>

        <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="flex gap-3 items-center">
            @csrf @method('PATCH')
            <select name="status" class="border rounded-lg px-3 py-2 text-sm">
                @foreach(['pending','processing','shipped','delivered','cancelled'] as $status)
                    <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
                Update Status
            </button>
        </form>
    </div>

    <div class="bg-white border rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="text-left px-4 py-3 font-medium text-gray-500">Product</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500">Qty</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500">Price</th>
                    <th class="text-left px-4 py-3 font-medium text-gray-500">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr class="border-b last:border-0">
                    <td class="px-4 py-3">{{ $item->product->name }}</td>
                    <td class="px-4 py-3">{{ $item->quantity }}</td>
                    <td class="px-4 py-3">LKR {{ number_format($item->price, 2) }}</td>
                    <td class="px-4 py-3">LKR {{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot class="border-t bg-gray-50">
                <tr>
                    <td colspan="3" class="px-4 py-3 font-medium text-right">Total</td>
                    <td class="px-4 py-3 font-bold text-blue-600">LKR {{ number_format($order->total_amount, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection