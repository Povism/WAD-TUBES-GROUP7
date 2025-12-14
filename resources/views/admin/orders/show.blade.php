<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details - Tel-U Loot</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50">

@php
$logo = asset('images/logo.png');
$profile = asset('images/profile.jpg');
$isEdit = request('edit') === 'true';

$icons = [
    'ArrowLeft' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>',
    'LogOut' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>',
    'Trash' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>',
    'Save' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>',
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

    <div class="container mx-auto px-4 py-8">
        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
            <span class="w-[20px] h-[20px] mr-2">{!! $icons['ArrowLeft'] !!}</span> Back to Orders
        </a>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Order Details -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold text-gray-800">Order #{{ $order->order_number }}</h2>
                        <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>

                    @if($isEdit)
                        <!-- Edit Form -->
                        <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                    <select name="status" class="w-full px-4 py-2 border rounded-lg" required>
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Shipping Name</label>
                                    <input type="text" name="shipping_name" value="{{ $order->shipping_name }}" class="w-full px-4 py-2 border rounded-lg">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Shipping Phone</label>
                                    <input type="text" name="shipping_phone" value="{{ $order->shipping_phone }}" class="w-full px-4 py-2 border rounded-lg">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Shipping Address</label>
                                    <textarea name="shipping_address" rows="3" class="w-full px-4 py-2 border rounded-lg">{{ $order->shipping_address }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                                    <textarea name="notes" rows="3" class="w-full px-4 py-2 border rounded-lg">{{ $order->notes }}</textarea>
                                </div>

                                <div class="flex space-x-4">
                                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center">
                                        <span class="w-[16px] h-[16px] mr-2">{!! $icons['Save'] !!}</span> Save Changes
                                    </button>
                                    <a href="{{ route('admin.orders.show', $order) }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Cancel</a>
                                </div>
                            </div>
                        </form>
                    @else
                        <!-- View Mode -->
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <div class="text-sm text-gray-600">Customer</div>
                                    <div class="font-medium">{{ $order->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $order->user->email }}</div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-600">Order Date</div>
                                    <div class="font-medium">{{ $order->created_at->format('M d, Y H:i') }}</div>
                                </div>
                            </div>

                            @if($order->shipping_name)
                            <div>
                                <div class="text-sm text-gray-600">Shipping Name</div>
                                <div class="font-medium">{{ $order->shipping_name }}</div>
                            </div>
                            @endif

                            @if($order->shipping_phone)
                            <div>
                                <div class="text-sm text-gray-600">Shipping Phone</div>
                                <div class="font-medium">{{ $order->shipping_phone }}</div>
                            </div>
                            @endif

                            @if($order->shipping_address)
                            <div>
                                <div class="text-sm text-gray-600">Shipping Address</div>
                                <div class="font-medium">{{ $order->shipping_address }}</div>
                            </div>
                            @endif

                            @if($order->notes)
                            <div>
                                <div class="text-sm text-gray-600">Notes</div>
                                <div class="font-medium">{{ $order->notes }}</div>
                            </div>
                            @endif

                            @if($order->shipped_at)
                            <div>
                                <div class="text-sm text-gray-600">Shipped At</div>
                                <div class="font-medium">{{ $order->shipped_at->format('M d, Y H:i') }}</div>
                            </div>
                            @endif

                            @if($order->delivered_at)
                            <div>
                                <div class="text-sm text-gray-600">Delivered At</div>
                                <div class="font-medium">{{ $order->delivered_at->format('M d, Y H:i') }}</div>
                            </div>
                            @endif

                            <div class="pt-4 border-t">
                                <a href="{{ route('admin.orders.show', $order) }}?edit=true" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    Edit Order
                                </a>
                                @if($order->status === 'cancelled')
                                <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Are you sure you want to delete this order? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 flex items-center">
                                        <span class="w-[16px] h-[16px] mr-2">{!! $icons['Trash'] !!}</span> Delete Order
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Order Items -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Order Items</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Item</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($order->orderItems as $item)
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="font-medium">{{ $item->item_title ?? 'Item #' . $item->item_id }}</div>
                                    </td>
                                    <td class="px-4 py-3">{{ $item->quantity }}</td>
                                    <td class="px-4 py-3">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td class="px-4 py-3 text-right font-medium">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <td colspan="3" class="px-4 py-3 text-right font-bold">Total:</td>
                                    <td class="px-4 py-3 text-right font-bold text-lg">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow p-6 sticky top-20">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h3>
                    
                    <!-- Quick Status Update -->
                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST" class="mb-4">
                        @csrf
                        @method('PUT')
                        <label class="block text-sm font-medium text-gray-700 mb-2">Quick Status Update</label>
                        <select name="status" onchange="this.form.submit()" class="w-full px-4 py-2 border rounded-lg">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </form>

                    <div class="space-y-2">
                        <a href="{{ route('admin.orders.show', $order) }}?edit=true" class="block w-full px-4 py-2 bg-blue-600 text-white text-center rounded-lg hover:bg-blue-700">
                            Edit Order Details
                        </a>
                        @if($order->status === 'cancelled')
                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this order? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 flex items-center justify-center">
                                <span class="w-[16px] h-[16px] mr-2">{!! $icons['Trash'] !!}</span> Delete Order
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

