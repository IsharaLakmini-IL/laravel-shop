@extends('admin.layout')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Dashboard</h1>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-xl border p-4">
        <p class="text-sm text-gray-400 mb-1">Total Products</p>
        <p class="text-2xl font-bold text-blue-600">{{ $stats['total_products'] }}</p>
    </div>
    <div class="bg-white rounded-xl border p-4">
        <p class="text-sm text-gray-400 mb-1">Total Orders</p>
        <p class="text-2xl font-bold text-blue-600">{{ $stats['total_orders'] }}</p>
    </div>
    <div class="bg-white rounded-xl border p-4">
        <p class="text-sm text-gray-400 mb-1">Total Revenue</p>
        <p class="text-2xl font-bold text-blue-600">LKR {{ number_format($stats['total_revenue'], 2) }}</p>
    </div>
    <div class="bg-white rounded-xl border p-4">
        <p class="text-sm text-gray-400 mb-1">Pending Orders</p>
        <p class="text-2xl font-bold text-orange-500">{{ $stats['pending_orders'] }}</p>
    </div>
    <div class="bg-white rounded-xl border p-4">
        <p class="text-sm text-gray-400 mb-1">Total Users</p>
        <p class="text-2xl font-bold text-green-600">{{ $stats['total_users'] }}</p>
    </div>
</div>

<div class="flex gap-4">
    <a href="{{ route('admin.products.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
        + Add Product
    </a>
    <a href="{{ route('admin.categories.create') }}"
       class="border border-blue-600 text-blue-600 px-4 py-2 rounded-lg text-sm hover:bg-blue-50">
        + Add Category
    </a>
    <a href="{{ route('admin.orders.index') }}"
       class="border px-4 py-2 rounded-lg text-sm hover:bg-gray-50">
        View Orders
    </a>
</div>
@endsection