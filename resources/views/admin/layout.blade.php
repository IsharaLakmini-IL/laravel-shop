<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">
    <aside class="w-56 bg-white border-r flex flex-col py-6 px-4 fixed h-full">
        <p class="font-bold text-lg mb-8 text-blue-600">Admin Panel</p>
        <nav class="flex flex-col gap-2 text-sm">
            <a href="{{ route('admin.dashboard') }}"
               class="px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-600' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.products.index') }}"
               class="px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.products*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600' }}">
                Products
            </a>
            <a href="{{ route('admin.categories.index') }}"
               class="px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.categories*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600' }}">
                Categories
            </a>
            <a href="{{ route('admin.orders.index') }}"
               class="px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.orders*') ? 'bg-blue-50 text-blue-600' : 'text-gray-600' }}">
                Orders
            </a>
            <hr class="my-2">
            <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-100">
                View Shop
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full text-left px-3 py-2 rounded-lg text-red-500 hover:bg-gray-100">
                    Logout
                </button>
            </form>
        </nav>
    </aside>

    <main class="ml-56 flex-1 p-8">
        @if(session('success'))
            <div class="bg-green-50 text-green-700 border border-green-200 rounded px-4 py-3 mb-6">
                {{ session('success') }}
            </div>
        @endif
        @yield('content')
    </main>
</div>

</body>
</html>