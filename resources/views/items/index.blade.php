<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tel-U Loot - Browse Items</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50">

<?php
// PHP equivalent of mock data for the Items Page

$logo = asset('images/logo.png');
$profile = asset('images/profile.jpg');

// Item Content Data (More extensive list for a dedicated page)
$itemListings = [
    [ 'id' => 1, 'title' => 'MacBook Air M1 (2020)', 'price' => 'Rp 8.500.000', 'condition' => 'Used', 'category' => 'Electronics', 'eco' => true, 'img' => 'https://placehold.co/400x300/060771/white?text=MacBook+Air', 'seller' => 'andi_s', 'rating' => 4.8 ],
    [ 'id' => 2, 'title' => 'Data Structures Textbook (Rinaldi Munir)', 'price' => 'Rp 75.000', 'condition' => 'Good', 'category' => 'Books', 'eco' => true, 'img' => 'https://placehold.co/400x300/7132CA/white?text=Textbook', 'seller' => 'bookworm', 'rating' => 5.0 ],
    [ 'id' => 3, 'title' => 'Ergonomic Office Chair (Black)', 'price' => 'Rp 450.000', 'condition' => 'Used', 'category' => 'Furniture', 'eco' => false, 'img' => 'https://placehold.co/400x300/DE1A58/white?text=Office+Chair', 'seller' => 'dorm_clear', 'rating' => 4.2 ],
    [ 'id' => 4, 'title' => 'Warm Winter Jacket (Size L)', 'price' => 'Rp 200.000', 'condition' => 'New', 'category' => 'Clothing', 'eco' => true, 'img' => 'https://placehold.co/400x300/BF1A1A/white?text=Jacket', 'seller' => 'fashion_eco', 'rating' => 4.9 ],
    [ 'id' => 5, 'title' => 'Portable Electric Fan', 'price' => 'Rp 50.000', 'condition' => 'Used', 'category' => 'Electronics', 'eco' => true, 'img' => 'https://placehold.co/400x300/00A9E0/white?text=Fan', 'seller' => 'hot_student', 'rating' => 4.5 ],
    [ 'id' => 6, 'title' => 'Python Programming Handbook', 'price' => 'Rp 30.000', 'condition' => 'Fair', 'category' => 'Books', 'eco' => true, 'img' => 'https://placehold.co/400x300/4CAF50/white?text=Python', 'seller' => 'code_guy', 'rating' => 4.0 ],
    [ 'id' => 7, 'title' => 'Mini Desk Lamp', 'price' => 'Rp 65.000', 'condition' => 'New', 'category' => 'Furniture', 'eco' => false, 'img' => 'https://placehold.co/400x300/FFC107/black?text=Desk+Lamp', 'seller' => 'light_up', 'rating' => 4.7 ],
    [ 'id' => 8, 'title' => 'Soccer Jersey (Size M)', 'price' => 'Rp 150.000', 'condition' => 'Used', 'category' => 'Clothing', 'eco' => false, 'img' => 'https://placehold.co/400x300/9C27B0/white?text=Jersey', 'seller' => 'sporty_kid', 'rating' => 4.6 ],
];

// PHP/SVG representation of Lucide icons (adjusted for size)
$icons = [
    'ShoppingCart' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h1.9l2.7 13.9c.1 0 .2 0 .3 0h11.8c.2 0 .4-.1.5-.2l4-8c.1-.2.1-.4 0-.6-.1-.2-.3-.3-.5-.3H6.85"/></svg>',
    'MessageCircle' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle"><path d="M7.9 20.3c.4.1.8.1 1.2.1h6.8c1.7 0 3-1.3 3-3V6c0-1.7-1.3-3-3-3H9c-1.7 0-3 1.3-3 3v11.5c0 .3.1.5.3.7l4 4c.2.2.5.3.7.3z"/></svg>',
    'Filter' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-filter"><path d="M22 3.5l-10 10V21"/><path d="M2 3.5l10 10V21"/></svg>',
    'Leaf' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-leaf"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 21.1 2.2 22 8c.8 4.7-4.3 8.6-7.3 10.4"/><path d="M17 12c-2.3-1.8-5.3-3-8-3-1.8 0-3.4-.6-4.9-1.3C5.1 11.2 5 12.3 5 14c0 4.4 3.6 8 8 8h1"/></svg>',
    'Star' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="none" class="lucide lucide-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
    'MessageCircle18' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle"><path d="M7.9 20.3c.4.1.8.1 1.2.1h6.8c1.7 0 3-1.3 3-3V6c0-1.7-1.3-3-3-3H9c-1.7 0-3 1.3-3 3v11.5c0 .3.1.5.3.7l4 4c.2.2.5.3.7.3z"/></svg>',
    'MapPin' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin"><path d="M12 22s8-4 8-12c0-4.4-3.6-8-8-8-4.4 0-8 3.6-8 8s8 12 8 12z"/><circle cx="12" cy="10" r="3"/></svg>',
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
                    <a href="#" class="font-medium text-blue-700 border-b-2 border-blue-700 pb-1">Items</a>
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
                </button>
            </div>
        </div>
    </header>

    <section class="bg-gradient-to-r from-red-700 to-purple-500 text-white py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 text-center">Find Your Next Sustainable Loot</h1>
            <div class="flex justify-center">
                <div class="relative w-full max-w-2xl">
                    <input type="search" placeholder="Search for books, gadgets, furniture, or clothes..." class="w-full p-4 pl-12 rounded-xl text-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-lg">
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 grid grid-cols-1 lg:grid-cols-4 gap-8">

            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h4 class="font-bold text-lg mb-4 flex items-center text-blue-800">
                        <span class="w-[20px] h-[20px] mr-2">{!! $icons['Filter'] !!}</span> Filter Listings
                    </h4>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                        <select class="w-full p-2 border border-gray-300 rounded-lg">
                            <option>All Categories</option>
                            <option>Electronics</option>
                            <option>Books</option>
                            <option>Furniture</option>
                            <option>Clothing</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Condition</label>
                        <div class="space-y-1">
                            <label class="flex items-center text-sm"><input type="checkbox" class="mr-2 rounded text-blue-600"> New</label>
                            <label class="flex items-center text-sm"><input type="checkbox" class="mr-2 rounded text-blue-600"> Used (Good)</label>
                            <label class="flex items-center text-sm"><input type="checkbox" class="mr-2 rounded text-blue-600"> Used (Fair)</label>
                        </div>
                    </div>

                    <div class="pt-4 border-t">
                        <label class="flex items-center text-sm font-semibold text-green-700">
                            <input type="checkbox" class="mr-2 rounded text-green-600 focus:ring-green-500">
                            Show Only Eco-Friendly
                            <span class="w-[16px] h-[16px] ml-1 text-green-500">{!! $icons['Leaf'] !!}</span>
                        </label>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h4 class="font-bold text-lg mb-4">Price Range</h4>
                    <input type="range" min="10000" max="10000000" value="5000000" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                    <p class="text-sm text-center mt-2 text-gray-600">Max: Rp 5.000.000</p>
                </div>

            </div>

            <div class="lg:col-span-3">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-700">Showing 8 of 42 Items</h3>
                    <select class="p-2 border border-gray-300 rounded-lg text-sm">
                        <option>Sort by: Newest</option>
                        <option>Sort by: Price (Low to High)</option>
                        <option>Sort by: Price (High to Low)</option>
                        <option>Sort by: Rating</option>
                    </select>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                   @foreach ($itemListings as $item)
                        <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden relative">
                            <div class="p-4">
                                <a href="{{ url('/items/' . $item['id']) }}" class="font-semibold text-lg text-gray-800 line-clamp-2 hover:text-blue-700 transition">
                                    {{ $item['title'] }}
                                </a>
                                
                                <p class="text-green-600 font-bold text-xl mt-1">{{ $item['price'] }}</p>
                                </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 flex justify-center">
                    <nav class="flex space-x-2">
                        <a href="#" class="px-3 py-2 text-gray-500 bg-white rounded-lg hover:bg-gray-100">Previous</a>
                        <a href="#" class="px-3 py-2 text-white bg-blue-600 rounded-lg">1</a>
                        <a href="#" class="px-3 py-2 text-gray-700 bg-white rounded-lg hover:bg-gray-100">2</a>
                        <a href="#" class="px-3 py-2 text-gray-700 bg-white rounded-lg hover:bg-gray-100">3</a>
                        <a href="#" class="px-3 py-2 text-gray-500 bg-white rounded-lg hover:bg-gray-100">Next</a>
                    </nav>
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
                        
                        
                    </div>
                    <p class="text-gray-400">
                        A sustainable second-hand marketplace for Telkom University students. Supporting SDG 12.
                    </p>
                </div>
                <div>
                    <h5 class="font-semibold mb-4">Navigation</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ url('/') }}" class="hover:text-white">Home</a></li>
                        <li><a href="#" class="hover:text-white">Items</a></li>
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