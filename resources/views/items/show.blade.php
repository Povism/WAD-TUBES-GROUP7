<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tel-U Loot - Item Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50">

<?php
// PHP equivalent of mock data for the Item Detail Page

$logo = asset('images/logo.png');
$profile = asset('images/profile.jpg');

// Data for the specific item being viewed
$selectedItem = [
    'id' => 1,
    'title' => 'MacBook Air M1 (2020) - 8GB/256GB SSD',
    'price' => 'Rp 8.500.000',
    'condition' => 'Used - Like New (Only 1 year old)',
    'category' => 'Electronics',
    'eco' => true,
    'seller_name' => 'andi_s (4.8 rating)',
    'seller_id' => 10,
    'location' => 'Dormitory A, Telkom University',
    'description' => 'Selling my reliable MacBook Air M1. Used primarily for light school work and web browsing. Battery health is still excellent. Comes with original charger and box. Perfect for a student needing a portable and fast laptop.',
    'images' => [
        'https://placehold.co/800x600/060771/white?text=Main+Image',
        'https://placehold.co/800x600/060771/white?text=Side+View',
        'https://placehold.co/800x600/060771/white?text=Screen+On',
        'https://placehold.co/800x600/060771/white?text=Box+and+Charger',
    ],
    'tags' => ['Laptop', 'Mac', 'M1', 'Gadget'],
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
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <img src="{{ $logo }}" alt="Logo" class="h-10 w-auto" />
                <span class="text-2xl font-bold text-red-800">Tel-U Loot</span>
            </div>

            <div class="hidden md:flex items-center space-x-6">
                <nav class="flex space-x-6">
                    <a href="{{ url('/') }}" class="font-medium text-gray-700 hover:text-blue-700">Home</a>
                    <a href="{{ url('/forum') }}" class="font-medium text-gray-700 hover:text-blue-700">Forum</a>
                    <a href="{{ url('/items') }}" class="font-medium text-blue-700 border-b-2 border-blue-700 pb-1">Items</a>
                </nav>
            </div>

            <div class="flex items-center space-x-4">
                <button class="p-2 rounded-full hover:bg-gray-100 relative">
                    <a href="/cart" class="text-gray-700 w-[25px] h-[25px]">{!! $icons['ShoppingCart'] !!}</a>
                    <span class="absolute -top-1.5 -right-1 bg-blue-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </button>
                <button class="p-2 rounded-full hover:bg-gray-100">
                    <span class="text-gray-700 w-[25px] h-[25px]">{!! $icons['MessageCircle'] !!}</span>
                </button>
                <a href="profile">
                <img src="{{ $profile }}" alt="Profile" class="w-8 h-8 rounded-full" /></a>
            </div>
        </div>
    </header>

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

    <footer class="bg-gray-800 text-white py-10 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <span class="text-green-400 w-[28px] h-[28px]">{!! $icons['Leaf'] !!}</span>
                        <h4 class="text-xl font-bold">Tel-U Loot</h4>
                    </div>
                    <p class="text-gray-400">
                        A sustainable second-hand marketplace for Telkom University students. Supporting SDG 12.
                    </p>
                </div>
                <div>
                    <h5 class="font-semibold mb-4">Navigation</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ url('/') }}" class="hover:text-white">Home</a></li>
                        <li><a href="{{ url('/items') }}" class="hover:text-white">Items</a></li>
                        <li><a href="{{ url('/forum') }}" class="hover:text-white">Forum</a></li>
                        <li><a href="{{ url('/profile') }}" class="hover:text-white">My Profile</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-semibold mb-4">Contact</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center"><span class="w-[16px] h-[16px] mr-2">{!! $icons['MapPin'] !!}</span> Telkom University, Bandung</li>
                        <li class="flex items-center"><span class="w-[16px] h-[16px] mr-2">{!! $icons['Mail'] !!}</span> telloots@telkomuniversity.ac.id</li>
                        <li class="flex items-center"><span class="w-[16px] h-[16px] mr-2">{!! $icons['Phone'] !!}</span> +62 22 1234 5678</li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-semibold mb-4">Stay Updated</h5>
                    <p class="text-gray-400 mb-2">Get notified about new listings and sustainability tips.</p>
                    <div class="flex">
                        <input
                            type="email"
                            placeholder="Your email"
                            class="px-3 py-2 rounded-l w-full text-gray-800 text-sm"
                        />
                        <button class="bg-blue-600 px-3 rounded-r text-sm">Join</button>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-6 text-center text-gray-400">
                <p>© 2025 Tel-U Loots — Group 7, Telkom University. Built with ❤️ for sustainability.</p>
            </div>
        </div>
    </footer>
</div>
</body>
</html>