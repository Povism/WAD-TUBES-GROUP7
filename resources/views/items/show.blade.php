@extends('layouts.app')

@section('title', 'Home - Tel-U Loot')

@section('content')

<?php
// PHP equivalent of mock data for the Item Detail Page

$logo = asset('images/logo.png');
$profile = asset('images/profile.jpg');

// Data for the specific item being viewed
$images = [];
if (isset($item) && is_array($item->images)) {
    foreach ($item->images as $path) {
        $images[] = asset('storage/' . $path);
    }
}

if (count($images) === 0) {
    $images[] = 'https://placehold.co/800x600/060771/white?text=Item+Image';
}

$selectedItem = [
    'id' => $item->id,
    'title' => $item->title,
    'price' => 'Rp ' . number_format($item->price, 0, ',', '.'),
    'condition' => $item->condition,
    'category' => $item->category,
    'eco' => (bool) $item->eco_friendly,
    'seller_name' => $item->user?->name ?? 'Unknown',
    'seller_id' => $item->user_id,
    'location' => 'Telkom University',
    'description' => $item->description,
    'images' => $images,
    'tags' => [$item->category],
];

// PHP/SVG representation of Lucide icons (adjusted for size)
$icons = [
    'ShoppingCart' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h1.9l2.7 13.9c.1 0 .2 0 .3 0h11.8c.2 0 .4-.1.5-.2l4-8c.1-.2.1-.4 0-.6-.1-.2-.3-.3-.5-.3H6.85"/></svg>',
    'MessageCircle' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle"><path d="M7.9 20.3c.4.1.8.1 1.2.1h6.8c1.7 0 3-1.3 3-3V6c0-1.7-1.3-3-3-3H9c-1.7 0-3 1.3-3 3v11.5c0 .3.1.5.3.7l4 4c.2.2.5.3.7.3z"/></svg>',
    'Leaf' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-leaf"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 21.1 2.2 22 8c.8 4.7-4.3 8.6-7.3 10.4"/><path d="M17 12c-2.3-1.8-5.3-3-8-3-1.8 0-3.4-.6-4.9-1.3C5.1 11.2 5 12.3 5 14c0 4.4 3.6 8 8 8h1"/></svg>',
    'MapPin' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin"><path d="M12 22s8-4 8-12c0-4.4-3.6-8-8-8-4.4 0-8 3.6-8 8s8 12 8 12z"/><circle cx="12" cy="10" r="3"/></svg>',
    'CheckCircle' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>',
    'Star' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="none" class="lucide lucide-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
    'Heart' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 1.27-4.5 3.32-1.5-2.05-2.74-3.32-4.5-3.32A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>',
    'Phone' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone"><path d="M22 16.9v3.1a2 2 0 0 1-2 2h-1c-2.3 0-5.6-.7-8.8-3.9-3.2-3.2-3.9-6.5-3.9-8.8V4a2 2 0 0 1 2-2h3.1c1.1 0 2.2.4 3 1.2l3 3c.8.8 1.2 1.9 1.2 3V14c0 1.1-.9 2-2 2z"/></svg>',
    'Mail' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.9 5.9c-.3.2-.6.3-1.1.3-.4 0-.7-.1-1.1-.3L2 7"/></svg>',
];
?>


<div>
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            
            <div class="mb-6">
                <a href="{{ url('/items') }}" class="text-blue-600 hover:text-blue-800 flex items-center text-sm">
                    <svg class="w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    Back to all Items
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 bg-white p-8 rounded-xl shadow-lg">
                
                <div class="lg:col-span-2 space-y-4">
                    <img id="main-image" src="{{ $selectedItem['images'][0] }}" alt="{{ $selectedItem['title'] }}" class="w-full h-96 object-cover rounded-xl shadow-md" />
                    
                    <div class="flex space-x-3 overflow-x-auto">
                        @foreach ($selectedItem['images'] as $index => $image)
                            <img 
                                src="{{ $image }}" 
                                alt="Gallery image {{ $index + 1 }}" 
                                class="w-20 h-20 object-cover rounded-lg cursor-pointer border-2 hover:border-blue-500 transition"
                                onclick="document.getElementById('main-image').src='{{ $image }}'"
                            />
                        @endforeach
                    </div>
                </div>

                <div class="lg:col-span-1 space-y-6">
                    
                    <div class="border-b pb-4">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $selectedItem['title'] }}</h1>
                        <p class="text-4xl font-extrabold text-red-600">{{ $selectedItem['price'] }}</p>
                    </div>

                    @auth
                        @if (auth()->id() === $item->user_id || auth()->user()->role === 'admin')
                            <div class="flex items-center gap-2">
                                <a href="{{ route('items.edit', $item) }}" class="px-4 py-2 rounded-xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                                    Edit Item
                                </a>
                                <form action="{{ route('items.destroy', $item) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this item?')" class="px-4 py-2 rounded-xl border border-red-300 text-red-600 font-semibold hover:bg-red-50 transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth

                    <div class="space-y-3 text-gray-700">
                        <div class="flex items-center text-lg">
                            <span class="mr-2 text-green-500 w-[18px] h-[18px]">{!! $icons['CheckCircle'] !!}</span>
                            Condition: <span class="font-semibold ml-2">{{ $selectedItem['condition'] }}</span>
                        </div>
                        <div class="flex items-center text-lg">
                            <span class="mr-2 text-blue-500 w-[18px] h-[18px]">{!! $icons['MapPin'] !!}</span>
                            Location: <span class="font-semibold ml-2">{{ $selectedItem['location'] }}</span>
                        </div>
                        <div class="flex items-center text-sm font-medium pt-2">
                            @if ($selectedItem['eco'])
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full flex items-center">
                                    <span class="w-[16px] h-[16px] mr-1">{!! $icons['Leaf'] !!}</span> Eco-Friendly Item
                                </span>
                            @endif
                            <span class="ml-auto text-gray-500">Category: {{ $selectedItem['category'] }}</span>
                        </div>
                    </div>

                    <div class="pt-4 border-t space-y-4">
                        <div class="flex items-center p-3 bg-gray-100 rounded-lg">
                            <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-sm font-bold text-white uppercase mr-3">
                                {{ substr($selectedItem['seller_name'], 0, 1) }}
                            </div>
                            <span class="text-md font-semibold text-gray-800">Seller: {{ $selectedItem['seller_name'] }}</span>
                        </div>

                        <button class="w-full py-3 bg-blue-600 text-white font-bold text-lg rounded-xl hover:bg-blue-700 transition flex items-center justify-center shadow-lg">
                            <span class="w-[24px] h-[24px] mr-2">{!! $icons['ShoppingCart'] !!}</span> Add to Cart
                        </button>
                        
                        <button class="w-full py-3 bg-green-500 text-white font-bold text-lg rounded-xl hover:bg-green-600 transition flex items-center justify-center">
                            <span class="w-[24px] h-[24px] mr-2">{!! $icons['MessageCircle'] !!}</span> Message Seller
                        </button>

                        <button class="w-full py-2 text-red-600 border border-red-300 rounded-xl hover:bg-red-50 transition flex items-center justify-center">
                             <span class="w-[24px] h-[24px] mr-2">{!! $icons['Heart'] !!}</span> Add to Wishlist
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-8 bg-white p-8 rounded-xl shadow-lg">
                <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b pb-2">Product Description</h2>
                <p class="text-gray-700 whitespace-pre-wrap">{{ $selectedItem['description'] }}</p>

                <h3 class="text-xl font-bold text-gray-800 mt-6 mb-3">Tags</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach ($selectedItem['tags'] as $tag)
                        <span class="bg-gray-200 text-gray-700 text-sm px-3 py-1 rounded-full hover:bg-gray-300 cursor-pointer">
                            #{{ $tag }}
                        </span>
                    @endforeach
                </div>
            </div>
            
            </div>
    </section>

</div>
</body>
</html>
@endsection