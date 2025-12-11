<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tell-U Loot - Sustainable Marketplace</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50">

<?php
// PHP equivalent of mock data (replace with actual database queries in a real app)

$logo = asset('images/logo.png'); // Replace with your actual path
$profile = asset('images/profile.jpg'); // Replace with your actual path
// $heroBg = asset('assets/hero-bg.jpg'); // Not directly used in styling, but defined in original component

$featuredItems = [
    [ 'id' => 1, 'title' => 'MacBook Air M1', 'price' => 'Rp 8.500.000', 'condition' => 'Used', 'category' => 'Electronics', 'eco' => true, 'img' => 'https://placehold.co/300x200/060771/white?text=MacBook' ],
    [ 'id' => 2, 'title' => 'Data Structures Textbook', 'price' => 'Rp 75.000', 'condition' => 'Good', 'category' => 'Books', 'eco' => true, 'img' => 'https://placehold.co/300x200/7132CA/white?text=Book' ],
    [ 'id' => 3, 'title' => 'Office Chair', 'price' => 'Rp 450.000', 'condition' => 'Used', 'category' => 'Furniture', 'eco' => false, 'img' => 'https://placehold.co/300x200/DE1A58/white?text=Chair' ],
    [ 'id' => 4, 'title' => 'Winter Jacket', 'price' => 'Rp 200.000', 'condition' => 'New', 'category' => 'Clothing', 'eco' => true, 'img' => 'https://placehold.co/300x200/BF1A1A/white?text=Jacket' ],
];

// PHP/SVG representation of Lucide icons (adjusted for size 24/20/16/14)
$icons = [
    'BookOpen' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>',
    'Monitor' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-monitor"><path d="M10 12l2 2 4-4"/><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 0-1.6.8L10 8H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h16z"/></svg>',
    'Shirt' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shirt"><path d="M19 19c0 .7-.3 1.4-1.2 1.8-.7.3-1.4.2-1.8.8-.4.7-.2 1.4.3 1.8.4.4.2 1 .3 1.8L12 18l-5.6 4.8c-.4-.5-.6-1.1-.3-1.8.3-.6.1-1.3-.7-1.7-.8-.4-1.2-1-1.2-1.8"/><path d="M2 12l.7-4.3C3.2 5.5 5 4 7.2 4h9.6c2.2 0 4 .5 4.5 3.7L22 12l-10 10-10-10z"/></svg>',
    'Sofa' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sofa"><path d="M10 12H4a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-6m-4 0v-4h4v4m-4 0h-6m14 0h-6m-4 4v2m4-2v2m4-2v2m4-2v2m-16-2h16"/></svg>',
    'Globe' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-globe"><circle cx="12" cy="12" r="10"/><path d="M12 2a15.3 15.3 0 0 0 4 10 15.3 15.3 0 0 0-4 10 15.3 15.3 0 0 0-4-10 15.3 15.3 0 0 0 4-10zM2.05 12h19.9"/></svg>',
    'ShoppingCart' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h1.9l2.7 13.9c.1 0 .2 0 .3 0h11.8c.2 0 .4-.1.5-.2l4-8c.1-.2.1-.4 0-.6-.1-.2-.3-.3-.5-.3H6.85"/></svg>',
    'MessageCircle' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle"><path d="M7.9 20.3c.4.1.8.1 1.2.1h6.8c1.7 0 3-1.3 3-3V6c0-1.7-1.3-3-3-3H9c-1.7 0-3 1.3-3 3v11.5c0 .3.1.5.3.7l4 4c.2.2.5.3.7.3z"/></svg>',
    'MessageCircle18' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle"><path d="M7.9 20.3c.4.1.8.1 1.2.1h6.8c1.7 0 3-1.3 3-3V6c0-1.7-1.3-3-3-3H9c-1.7 0-3 1.3-3 3v11.5c0 .3.1.5.3.7l4 4c.2.2.5.3.7.3z"/></svg>',
    'Plus' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>',
    'Plus16' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>',
    'Filter' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-filter"><path d="M22 3.5l-10 10V21"/><path d="M2 3.5l10 10V21"/></svg>',
    'Star' => '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="none" class="lucide lucide-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
    'Leaf' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-leaf"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 21.1 2.2 22 8c.8 4.7-4.3 8.6-7.3 10.4"/><path d="M17 12c-2.3-1.8-5.3-3-8-3-1.8 0-3.4-.6-4.9-1.3C5.1 11.2 5 12.3 5 14c0 4.4 3.6 8 8 8h1"/></svg>',
    'MapPin' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin"><path d="M12 22s8-4 8-12c0-4.4-3.6-8-8-8-4.4 0-8 3.6-8 8s8 12 8 12z"/><circle cx="12" cy="10" r="3"/></svg>',
    'Phone' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone"><path d="M22 16.9v3.1a2 2 0 0 1-2 2h-1c-2.3 0-5.6-.7-8.8-3.9-3.2-3.2-3.9-6.5-3.9-8.8V4a2 2 0 0 1 2-2h3.1c1.1 0 2.2.4 3 1.2l3 3c.8.8 1.2 1.9 1.2 3V14c0 1.1-.9 2-2 2z"/></svg>',
    'Mail' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.9 5.9c-.3.2-.6.3-1.1.3-.4 0-.7-.1-1.1-.3L2 7"/></svg>',
];

$categories = [
    [ 'name' => 'Books', 'icon' => $icons['BookOpen'] ],
    [ 'name' => 'Electronics', 'icon' => $icons['Monitor'] ],
    [ 'name' => 'Clothing', 'icon' => $icons['Shirt'] ],
    [ 'name' => 'Furniture', 'icon' => $icons['Sofa'] ],
    [ 'name' => 'Others', 'icon' => $icons['Globe'] ],
];

$forumPosts = [
    [ 'id' => 1, 'title' => 'Where to sell old textbooks?', 'author' => 'ahokbiadap34', 'replies' => 12, 'time' => '2 hours ago' ],
    [ 'id' => 2, 'title' => 'How to recycle electronics?', 'author' => 'aselole', 'replies' => 8, 'time' => '1 day ago' ],
    [ 'id' => 3, 'title' => 'FJB Rules & Tips', 'author' => 'Admin', 'replies' => 24, 'time' => '3 days ago' ],
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
                    <a href="#" class="font-medium text-gray-700 hover:text-blue-700">Home</a>
                    <a href="#forum" class="font-medium text-gray-700 hover:text-blue-700">Forum</a>
                    <a href="#items" class="font-medium text-gray-700 hover:text-blue-700">Items</a>
                </nav>
            </div>

            <div class="flex items-center space-x-4">
                <button class="p-2 rounded-full hover:bg-gray-100 relative">
                    <span class="text-gray-700 w-[25px] h-[25px]">{!! $icons['ShoppingCart'] !!}</span>
                    <span class="absolute -top-1.5 -right-1 bg-blue-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </button>
                <button class="p-2 rounded-full hover:bg-gray-100">
                    <span class="text-gray-700 w-[25px] h-[25px]">{!! $icons['MessageCircle'] !!}</span>
                </button>
                <img src="{{ $profile }}" alt="Profile" class="w-8 h-8 rounded-full" />
            </div>
        </div>
    </header>

    <section class="bg-gradient-to-r from-red-700 to-purple-500 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">Buy, Sell, Reuse — Sustainably at Telkom University</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Lorem ipsum dolor sit amet, consectetur adipiscing elit (slogan).</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <button class="bg-white text-blue-700 px-6 py-3 rounded-full font-semibold hover:bg-gray-100 flex items-center justify-center">
                    <span class="w-[20px] h-[20px] mr-2">{!! $icons['Plus'] !!}</span> Post an Item
                </button>
                <button class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-full font-semibold hover:bg-white/10">
                    Browse Items
                </button>
            </div>
        </div>
    </section>

    <div class="bg-white py-3 shadow-sm">
        <div class="container mx-auto px-4 flex flex-wrap justify-center gap-6 text-center">
            <div>
                <span class="font-bold text-green-600">124 kg</span> waste prevented
            </div>
            <div>
                <span class="font-bold text-blue-600">542</span> items exchanged
            </div>
            <div>
                <span class="font-bold text-purple-600">1,200+</span> students engaged
            </div>
        </div>
    </div>

    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h3 class="text-2xl font-bold text-center mb-8">Browse by Category</h3>
            <div class="flex flex-wrap justify-center gap-6">
                @foreach ($categories as $cat)
                    <div class="flex flex-col items-center bg-white p-6 rounded-xl shadow hover:shadow-md transition cursor-pointer w-32">
                        <div class="text-blue-600 mb-2">{!! $cat['icon'] !!}</div>
                        <span class="font-medium">{{ $cat['name'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="items" class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold">Recent Listings</h3>
                <button class="flex items-center text-blue-600 font-medium">
                    <span class="w-[16px] h-[16px] mr-1">{!! $icons['Filter'] !!}</span> Filter
                </button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($featuredItems as $item)
                    <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden relative">
                        <img src="{{ $item['img'] }}" alt="{{ $item['title'] }}" class="w-full h-48 object-cover" />
                        @if ($item['eco'])
                            <div class="absolute top-0 right-0 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-bl">
                                Eco-Friendly
                            </div>
                        @endif
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <h4 class="font-semibold text-gray-800 line-clamp-1">{{ $item['title'] }}</h4>
                                <span class="text-green-600 font-bold">{{ $item['price'] }}</span>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">{{ $item['condition'] }} • {{ $item['category'] }}</p>
                            <div class="flex justify-between items-center mt-4">
                                <div class="flex items-center">
                                    <div class="w-6 h-6 rounded-full bg-gray-300 flex items-center justify-center text-xs font-bold text-white">U</div>
                                    <span class="w-[14px] h-[14px] text-yellow-400 ml-1">{!! $icons['Star'] !!}</span>
                                    <span class="text-xs ml-1">4.8</span>
                                </div>
                                <button class="text-blue-600 hover:text-blue-800">
                                    <span class="w-[18px] h-[18px]">{!! $icons['MessageCircle18'] !!}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="forum" class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h3 class="text-2xl font-bold mb-6">Community Forum</h3>
            <div class="bg-white rounded-xl shadow divide-y">
                @foreach ($forumPosts as $post)
                    <div class="p-5 hover:bg-gray-50 cursor-pointer">
                        <h4 class="font-semibold text-blue-800">{{ $post['title'] }}</h4>
                        <div class="flex text-sm text-gray-500 mt-2">
                            <span>by {{ $post['author'] }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $post['replies'] }} replies</span>
                            <span class="mx-2">•</span>
                            <span>{{ $post['time'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="mt-4 text-blue-600 font-medium flex items-center">
                <span class="w-[16px] h-[16px] mr-1">{!! $icons['Plus16'] !!}</span> Start a new discussion
            </button>
        </div>
    </section>

    <footer class="bg-gray-800 text-white py-10">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <span class="text-green-400 w-[28px] h-[28px]">{!! $icons['Leaf'] !!}</span>
                        <h4 class="text-xl font-bold">Tell-U Loots</h4>
                    </div>
                    <p class="text-gray-400">
                        A sustainable second-hand marketplace for Telkom University students. Supporting SDG 12.
                    </p>
                </div>
                <div>
                    <h5 class="font-semibold mb-4">Navigation</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Home</a></li>
                        <li><a href="#items" class="hover:text-white">Items</a></li>
                        <li><a href="#forum" class="hover:text-white">Forum</a></li>
                        <li><a href="#" class="hover:text-white">My Profile</a></li>
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
                <p>© 2025 Tell-U Loots — Group 7, Telkom University. Built with ❤️ for sustainability.</p>
            </div>
        </div>
    </footer>
</div>
</body>
</html>