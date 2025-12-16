<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tel-U Loot - Order Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50">

@php
$logo = asset('images/logo.png');
$profile = asset('images/profile.jpg');

$icons = [
    'Package' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="m21 15.35-9-5.15-9 5.15"/><path d="m7.5 19.73 9-5.15"/><path d="M3 10.5v10l9 5 9-5v-10l-9-5z"/></svg>',
    'LogOut' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>',
    'Eye' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s5 7 10 7 10-7 10-7-5-7-10-7-10 7-10 7z"/><circle cx="12" cy="12" r="3"/></svg>',
    'Pencil' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.85 0 0 1 3 3L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>',
    'Trash' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>',
    'Search' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>',
];

$statusColors = [
    'pending' => 'bg-yellow-100 text-yellow-800',
    'processing' => 'bg-blue-100 text-blue-800',
    'shipped' => 'bg-purple-100 text-purple-800',
    'delivered' => 'bg-green-100 text-green-800',
    'cancelled' => 'bg-red-100 text-red-800',
];
@endphp

<div>
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <img src="{{ $logo }}" alt="Logo" class="h-10 w-auto" />
                <span class="text-2xl font-bold text-red-800">Tel-U Loot</span>
            </div>
            <div class="hidden md:flex items-center space-x-6">
                <nav class="flex space-x-6">
                    <a href="{{ url('/admin') }}" class="font-medium text-gray-700 hover:text-blue-700">Dashboard</a>
                    <a href="{{ url('/admin/orders') }}" class="font-medium text-blue-700 border-b-2 border-blue-700">Orders</a>
                    <a href="{{ url('/admin/items') }}" class="font-medium text-gray-700 hover:text-blue-700">Items</a>
                </nav>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-700 text-sm font-medium">{{ Auth::user()->name }}</span>
                <img src="{{ $profile }}" alt="Profile" class="w-8 h-8 rounded-full ring-2 ring-red-500" />
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="p-2 rounded-full hover:bg-gray-100">
                        <span class="text-gray-700 w-[20px] h-[20px]">{!! $icons['LogOut'] !!}</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <section class="bg-gradient-to-r from-red-700 to-purple-500 text-white py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold flex items-center">
                <span class="w-[20px] h-[20px] mr-3">{!! $icons['Package'] !!}</span> Order Management
            </h1>
            <p class="text-lg opacity-90 mt-2">Manage all customer orders</p>
        </div>
    </section>

    <div class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Statistics Cards -->
        <div class="grid grid-cols-2 md:grid-cols-6 gap-4 mb-6">
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="text-sm text-gray-600">Total</div>
                <div class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="text-sm text-gray-600">Pending</div>
                <div class="text-2xl font-bold text-yellow-600">{{ $stats['pending'] }}</div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="text-sm text-gray-600">Processing</div>
                <div class="text-2xl font-bold text-blue-600">{{ $stats['processing'] }}</div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="text-sm text-gray-600">Shipped</div>
                <div class="text-2xl font-bold text-purple-600">{{ $stats['shipped'] }}</div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="text-sm text-gray-600">Delivered</div>
                <div class="text-2xl font-bold text-green-600">{{ $stats['delivered'] }}</div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="text-sm text-gray-600">Cancelled</div>
                <div class="text-2xl font-bold text-red-600">{{ $stats['cancelled'] }}</div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by order number or customer..." class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div>
                    <select name="status" class="px-4 py-2 border rounded-lg">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center">
                    <span class="w-[16px] h-[16px] mr-2">{!! $icons['Search'] !!}</span> Search
                </button>
                <a href="{{ route('admin.orders.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Clear</a>
            </form>
        </div>

        <!-- Orders Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order #</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($orders as $order)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $order->order_number }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $order->user->name }}</div>
                                <div class="text-sm text-gray-500">{{ $order->user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded" title="View">
                                        <span class="w-[16px] h-[16px]">{!! $icons['Eye'] !!}</span>
                                    </a>
                                    <a href="{{ route('admin.orders.show', $order) }}?edit=true" class="p-2 text-green-600 hover:bg-green-50 rounded" title="Edit">
                                        <span class="w-[16px] h-[16px]">{!! $icons['Pencil'] !!}</span>
                                    </a>
                                    @if($order->status === 'cancelled')
                                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded" title="Delete">
                                            <span class="w-[16px] h-[16px]">{!! $icons['Trash'] !!}</span>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                No orders found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
</body>
</html>

