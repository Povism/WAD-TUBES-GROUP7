@extends('layouts.app')

@section('title', 'My Orders - Tel-U Loot')

@section('content')
@php
$icons = [
    'Package' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m7.5 4.27 9 5.15"/><path d="m21 15.35-9-5.15-9 5.15"/><path d="m7.5 19.73 9-5.15"/><path d="M3 10.5v10l9 5 9-5v-10l-9-5z"/></svg>',
    'Eye' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s5 7 10 7 10-7 10-7-5-7-10-7-10 7-10 7z"/><circle cx="12" cy="12" r="3"/></svg>',
    'X' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6L6 18"/><path d="M6 6l12 12"/></svg>',
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
            <span class="w-[20px] h-[20px] mr-3">{!! $icons['Package'] !!}</span> My Orders
        </h1>
        <p class="text-lg opacity-90 mt-2">View and manage your orders</p>
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

    @if($orders->count() > 0)
        <div class="space-y-4">
            @foreach($orders as $order)
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div class="flex-1">
                            <div class="flex items-center space-x-4 mb-3">
                                <h3 class="text-lg font-bold text-gray-800">Order #{{ $order->order_number }}</h3>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600 mb-3">
                                <div>
                                    <span class="font-medium">Order Date:</span>
                                    <span>{{ $order->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Items:</span>
                                    <span>{{ $order->orderItems->count() }} item(s)</span>
                                </div>
                                <div>
                                    <span class="font-medium">Total:</span>
                                    <span class="text-green-600 font-bold">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            @if($order->orderItems->count() > 0)
                                <div class="mt-3 pt-3 border-t">
                                    <div class="text-sm text-gray-600 mb-2">Items:</div>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($order->orderItems->take(3) as $item)
                                            <span class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $item->item_title ?? 'Item #' . $item->item_id }} (x{{ $item->quantity }})</span>
                                        @endforeach
                                        @if($order->orderItems->count() > 3)
                                            <span class="text-xs text-gray-500">+{{ $order->orderItems->count() - 3 }} more</span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="mt-4 md:mt-0 md:ml-4 flex space-x-2">
                            <a href="{{ route('orders.show', $order) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center">
                                <span class="w-[16px] h-[16px] mr-2">{!! $icons['Eye'] !!}</span> View Details
                            </a>
                            @if(in_array($order->status, ['pending', 'processing']))
                                <form action="{{ route('orders.cancel', $order) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 flex items-center">
                                        <span class="w-[16px] h-[16px] mr-2">{!! $icons['X'] !!}</span> Cancel
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <div class="text-gray-400 mb-4">
                <span class="w-[64px] h-[64px] inline-block">{!! $icons['Package'] !!}</span>
            </div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">No Orders Yet</h3>
            <p class="text-gray-500 mb-6">You haven't placed any orders yet. Start shopping to see your orders here!</p>
            <a href="{{ route('items.index') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-semibold">
                Browse Items
            </a>
        </div>
    @endif
</div>
@endsection

