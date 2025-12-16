@extends('layouts.app')

@section('title', 'Home - Tel-U Loot')

@section('content')
<?php
// PHP equivalent of mock data for the Cart/Checkout Page

$logo = asset('images/logo.png');
$profile = asset('images/profile.jpg');

$rupiahFormat = function($amount) {
    return 'Rp ' . number_format($amount, 0, ',', '.');
};

// PHP/SVG representation of Lucide icons (adjusted for size)
$icons = [
    'ShoppingCart' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h1.9l2.7 13.9c.1 0 .2 0 .3 0h11.8c.2 0 .4-.1.5-.2l4-8c.1-.2.1-.4 0-.6-.1-.2-.3-.3-.5-.3H6.85"/></svg>',
    'MessageCircle' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle"><path d="M7.9 20.3c.4.1.8.1 1.2.1h6.8c1.7 0 3-1.3 3-3V6c0-1.7-1.3-3-3-3H9c-1.7 0-3 1.3-3 3v11.5c0 .3.1.5.3.7l4 4c.2.2.5.3.7.3z"/></svg>',
    'Trash' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M16 6a2 2 0 0 0-2-2H9a2 2 0 0 0-2 2"/></svg>',
    'Minus' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-minus"><path d="M5 12h14"/></svg>',
    'Plus' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>',
    'Truck' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-truck"><path d="M14 18V6H4V4h16V6M10 22a2 2 0 0 0 2-2H8a2 2 0 0 0 2 2zM20 22a2 2 0 0 0 2-2h-4a2 2 0 0 0 2 2zM18 6h-2V2H8v4H6"/></svg>',
    'CreditCard' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-credit-card"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>',
    'Leaf' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-leaf"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 21.1 2.2 22 8c.8 4.7-4.3 8.6-7.3 10.4"/><path d="M17 12c-2.3-1.8-5.3-3-8-3-1.8 0-3.4-.6-4.9-1.3C5.1 11.2 5 12.3 5 14c0 4.4 3.6 8 8 8h1"/></svg>',
    'MapPin' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin"><path d="M12 22s8-4 8-12c0-4.4-3.6-8-8-8-4.4 0-8 3.6-8 8s8 12 8 12z"/><circle cx="12" cy="10" r="3"/></svg>',
    'Phone' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone"><path d="M22 16.9v3.1a2 2 0 0 1-2 2h-1c-2.3 0-5.6-.7-8.8-3.9-3.2-3.2-3.9-6.5-3.9-8.8V4a2 2 0 0 1 2-2h3.1c1.1 0 2.2.4 3 1.2l3 3c.8.8 1.2 1.9 1.2 3V14c0 1.1-.9 2-2 2z"/></svg>',
    'Mail' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.9 5.9c-.3.2-.6.3-1.1.3-.4 0-.7-.1-1.1-.3L2 7"/></svg>',
];

?>

<div>

    <section class="bg-white py-8 border-b">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold text-gray-800">Your Shopping Cart</h1>
            <p class="text-gray-500 mt-1">{{ method_exists($cartItems, 'count') ? $cartItems->count() : 0 }} items from {{ $sellerCount ?? 0 }} sellers.</p>
        </div>
    </section>

    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-8">
                
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4 border-b pb-3">Items Review</h2>
                    <div class="space-y-4 divide-y">
                        @if (method_exists($cartItems, 'count') && $cartItems->count() === 0)
                            <div class="pt-4 text-gray-600">Your cart is empty.</div>
                        @else
                            @foreach ($cartItems as $cartItem)
                                @php
                                    $item = $cartItem->item;
                                    $thumb = (isset($item) && is_array($item->images) && count($item->images) > 0)
                                        ? asset('storage/' . $item->images[0])
                                        : 'https://placehold.co/80x80/060771/white?text=Item';
                                @endphp
                                <div class="pt-4 flex items-start justify-between">
                                    <img src="{{ $thumb }}" alt="{{ $item?->title }}" class="w-20 h-20 object-cover rounded-lg mr-4 border">
                                    <div class="flex-grow">
                                        <h4 class="font-semibold text-gray-800">{{ $item?->title }}</h4>
                                        <p class="text-sm text-gray-500">Seller: {{ $item?->user?->name ?? 'Unknown' }}</p>
                                        <p class="text-green-600 font-bold mt-1">{{ $rupiahFormat((int) ($item?->price ?? 0)) }}</p>
                                    </div>
                                    
                                    <div class="flex flex-col items-end space-y-2">
                                        <div class="flex items-center border border-gray-300 rounded-lg">
                                            <form action="{{ route('cart.items.delta', $cartItem) }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="delta" value="-1" />
                                                <button type="submit" class="p-2 hover:bg-gray-100 text-gray-600">{!! $icons['Minus'] !!}</button>
                                            </form>
                                            <span class="px-3 text-sm font-medium">{{ $cartItem->quantity }}</span>
                                            <form action="{{ route('cart.items.delta', $cartItem) }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="delta" value="1" />
                                                <button type="submit" class="p-2 hover:bg-gray-100 text-gray-600">{!! $icons['Plus'] !!}</button>
                                            </form>
                                        </div>
                                        <form action="{{ route('cart.items.remove', $cartItem) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 flex items-center text-sm" onclick="return confirm('Remove this item from cart?')">
                                                <span class="w-[18px] h-[18px] mr-1">{!! $icons['Trash'] !!}</span> Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4 flex items-center text-blue-800">
                        <span class="w-[24px] h-[24px] mr-2 text-red-500">{!! $icons['Truck'] !!}</span> Delivery Information
                    </h2>
                    <div class="space-y-3">
                        <p class="font-medium text-gray-700">Recipient: {{ auth()->user()->name }} (Telkom University)</p>
                        <p class="text-gray-500 text-sm">Telkom University, Jl. Telekomunikasi No.1, Bandung, 40257</p>
                        <button class="text-sm text-blue-600 hover:underline">Change Address</button>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-semibold mb-4 flex items-center text-blue-800">
                        <span class="w-[24px] h-[24px] mr-2 text-green-500">{!! $icons['CreditCard'] !!}</span> Payment Method
                    </h2>
                    <div class="space-y-3">
                        <label class="flex items-center bg-gray-50 p-3 rounded-lg border border-blue-300">
                            <input type="radio" name="payment" value="gopay" class="mr-3 text-blue-600 focus:ring-blue-500" checked>
                            <span class="font-medium">OVO/GoPay/Dana</span>
                        </label>
                        <label class="flex items-center bg-white p-3 rounded-lg border">
                            <input type="radio" name="payment" value="bank" class="mr-3 text-blue-600 focus:ring-blue-500">
                            <span class="font-medium">Bank Transfer (BCA/Mandiri)</span>
                        </label>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                    <h2 class="text-2xl font-bold mb-5 text-blue-800">Order Summary</h2>

                    <div class="space-y-3 pb-4 border-b">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal ({{ method_exists($cartItems, 'count') ? $cartItems->count() : 0 }} items)</span>
                            <span>{{ $rupiahFormat((int) ($subtotal ?? 0)) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Delivery Fee (Campus)</span>
                            <span>{{ $rupiahFormat((int) ($deliveryFee ?? 0)) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Voucher Applied</span>
                            <span class="text-red-500">- {{ $rupiahFormat(0) }}</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4 mb-6">
                        <span class="text-xl font-bold">Total Payment</span>
                        <span class="text-2xl font-bold text-green-600">{{ $rupiahFormat((int) ($total ?? 0)) }}</span>
                    </div>

                    <button class="w-full bg-green-600 text-white text-lg font-semibold py-3 rounded-xl hover:bg-green-700 transition shadow-md">
                        Proceed to Payment
                    </button>
                    
                    <p class="text-center text-xs text-gray-400 mt-4">By proceeding, you agree to Tel-U Loot's terms & conditions.</p>
                </div>
            </div>

        </div>
    </section>

</div>
</body>
</html>
@endsection