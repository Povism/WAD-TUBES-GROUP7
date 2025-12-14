@extends('layouts.app')

@section('title', 'Order Details - Tel-U Loot')

@section('content')
@php
$icons = [
    'ArrowLeft' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>',
    'Package' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="m21 15.35-9-5.15-9 5.15"/><path d="m7.5 19.73 9-5.15"/><path d="M3 10.5v10l9 5 9-5v-10l-9-5z"/></svg>',
    'X' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>',
    'Truck' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.28a1 1 0 0 0-.684-.948l-1.923-.641a1 1 0 0 1-.578-.757l-.288-1.153A1 1 0 0 0 16.728 9H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>',
];

$statusColors = [
    'pending' => 'bg-yellow-100 text-yellow-800',
    'processing' => 'bg-blue-100 text-blue-800',
    'shipped' => 'bg-purple-100 text-purple-800',
    'delivered' => 'bg-green-100 text-green-800',
    'cancelled' => 'bg-red-100 text-red-800',
];
@endphp

<section class="bg-gradient-to-r from-red-700 to-purple-500 text-white py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold flex items-center">
            <span class="w-[20px] h-[20px] mr-3">{!! $icons['Package'] !!}</span> Order Details
        </h1>
    </div>
</section>

<div class="container mx-auto px-4 py-8">
    <a href="{{ route('orders.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
        <span class="w-[20px] h-[20px] mr-2">{!! $icons['ArrowLeft'] !!}</span> Back to My Orders
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
        <div class="lg:col-span-2 space-y-6">
            <!-- Order Info -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800">Order #{{ $order->order_number }}</h2>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <div class="text-sm text-gray-600">Order Date</div>
                        <div class="font-medium">{{ $order->created_at->format('M d, Y H:i') }}</div>
                    </div>
                    @if($order->ordered_at)
                    <div>
                        <div class="text-sm text-gray-600">Ordered At</div>
                        <div class="font-medium">{{ $order->ordered_at->format('M d, Y H:i') }}</div>
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
                </div>

                @if($order->notes)
                <div class="mt-4 pt-4 border-t">
                    <div class="text-sm text-gray-600 mb-1">Notes</div>
                    <div class="text-gray-800">{{ $order->notes }}</div>
                </div>
                @endif
            </div>

            <!-- Shipping Information -->
            @if($order->shipping_name || $order->shipping_address)
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <span class="w-[20px] h-[20px] mr-2 text-blue-600">{!! $icons['Truck'] !!}</span> Shipping Information
                </h3>
                @if($order->shipping_name)
                <div class="mb-2">
                    <div class="text-sm text-gray-600">Recipient Name</div>
                    <div class="font-medium">{{ $order->shipping_name }}</div>
                </div>
                @endif
                @if($order->shipping_phone)
                <div class="mb-2">
                    <div class="text-sm text-gray-600">Phone</div>
                    <div class="font-medium">{{ $order->shipping_phone }}</div>
                </div>
                @endif
                @if($order->shipping_address)
                <div>
                    <div class="text-sm text-gray-600">Address</div>
                    <div class="font-medium">{{ $order->shipping_address }}</div>
                </div>
                @endif
            </div>
            @endif

            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow-md p-6">
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
                                <td class="px-4 py-3 text-right font-bold text-lg text-green-600">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Actions Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6 sticky top-20">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Order Actions</h3>
                
                @if(in_array($order->status, ['pending', 'processing']))
                    <form action="{{ route('orders.cancel', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order? This action cannot be undone.');">
                        @csrf
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 flex items-center justify-center mb-4">
                            <span class="w-[16px] h-[16px] mr-2">{!! $icons['X'] !!}</span> Cancel Order
                        </button>
                    </form>
                @endif

                <div class="space-y-3 text-sm text-gray-600">
                    <div>
                        <div class="font-medium text-gray-800">Order Status</div>
                        <div class="mt-1">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                    </div>
                    <div>
                        <div class="font-medium text-gray-800">Order Total</div>
                        <div class="text-lg font-bold text-green-600 mt-1">Rp {{ number_format($order->total, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

