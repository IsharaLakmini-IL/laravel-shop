<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Shop</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

<nav class="bg-white border-b px-6 py-3 flex items-center justify-between">
    <a href="{{ route('home') }}" class="font-semibold text-lg">Laravel Shop</a>
    <div class="flex items-center gap-4 text-sm">
        @auth
            <span class="text-gray-500">Hi, {{ auth()->user()->name }}</span>
            <a href="{{ route('cart.index') }}" class="text-blue-600">Cart</a>
            <a href="{{ route('orders.history') }}" class="text-gray-600">My Orders</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button class="text-red-500">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="text-blue-600">Login</a>
            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-3 py-1 rounded">Register</a>
        @endauth
    </div>
</nav>

<main class="max-w-6xl mx-auto px-4 py-8">
    @if(session('success'))
        <div class="bg-green-50 text-green-700 border border-green-200 rounded px-4 py-3 mb-6">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-50 text-red-700 border border-red-200 rounded px-4 py-3 mb-6">
            {{ session('error') }}
        </div>
    @endif
    @yield('content')
</main>

</body>
</html>