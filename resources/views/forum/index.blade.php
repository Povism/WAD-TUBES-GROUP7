<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tel-U Loot - Community Forum</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50">

<?php
// PHP equivalent of mock data for the Forum Page

$logo = asset('images/logo.png');
$profile = asset('images/profile.jpg');

// Forum Content Data
$discussionThreads = [
    [ 'id' => 1, 'title' => 'Where is the best place to find used textbooks for IF?', 'author' => 'andi_s', 'replies' => 21, 'views' => 450, 'time' => '1 hour ago', 'tags' => ['Books', 'Informatika', 'Tips'] ],
    [ 'id' => 2, 'title' => 'Tips for selling a used monitor (Is the price fair?)', 'author' => 'tech_junkie', 'replies' => 8, 'views' => 180, 'time' => '3 hours ago', 'tags' => ['Electronics', 'Pricing'] ],
    [ 'id' => 3, 'title' => 'What is the policy for large item exchange (e.g., mini-fridge)?', 'author' => 'newbie_l00t', 'replies' => 5, 'views' => 120, 'time' => '1 day ago', 'tags' => ['Rules', 'Furniture'] ],
    [ 'id' => 4, 'title' => 'Selling unused practical work clothes, size M, good deal!', 'author' => 'fashion_eco', 'replies' => 15, 'views' => 310, 'time' => '1 day ago', 'tags' => ['Clothing'] ],
    [ 'id' => 5, 'title' => 'Any groups focused on sustainable reuse ideas?', 'author' => 'eco_warrior', 'replies' => 12, 'views' => 250, 'time' => '2 days ago', 'tags' => ['General', 'Sustainability'] ],
];

$popularTopics = [
    ['name' => 'Textbook Exchange (45)', 'slug' => 'textbooks'],
    ['name' => 'Laptop/PC Components (32)', 'slug' => 'electronics'],
    ['name' => 'Dorm Furniture (28)', 'slug' => 'furniture'],
    ['name' => 'Campus Rules (15)', 'slug' => 'rules'],
];

// PHP/SVG representation of Lucide icons (adjusted for size)
$icons = [
    'ShoppingCart' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h1.9l2.7 13.9c.1 0 .2 0 .3 0h11.8c.2 0 .4-.1.5-.2l4-8c.1-.2.1-.4 0-.6-.1-.2-.3-.3-.5-.3H6.85"/></svg>',
    'MessageCircle' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle"><path d="M7.9 20.3c.4.1.8.1 1.2.1h6.8c1.7 0 3-1.3 3-3V6c0-1.7-1.3-3-3-3H9c-1.7 0-3 1.3-3 3v11.5c0 .3.1.5.3.7l4 4c.2.2.5.3.7.3z"/></svg>',
    'Plus' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>',
    'Leaf' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-leaf"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 21.1 2.2 22 8c.8 4.7-4.3 8.6-7.3 10.4"/><path d="M17 12c-2.3-1.8-5.3-3-8-3-1.8 0-3.4-.6-4.9-1.3C5.1 11.2 5 12.3 5 14c0 4.4 3.6 8 8 8h1"/></svg>',
    'MapPin' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin"><path d="M12 22s8-4 8-12c0-4.4-3.6-8-8-8-4.4 0-8 3.6-8 8s8 12 8 12z"/><circle cx="12" cy="10" r="3"/></svg>',
    'Phone' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone"><path d="M22 16.9v3.1a2 2 0 0 1-2 2h-1c-2.3 0-5.6-.7-8.8-3.9-3.2-3.2-3.9-6.5-3.9-8.8V4a2 2 0 0 1 2-2h3.1c1.1 0 2.2.4 3 1.2l3 3c.8.8 1.2 1.9 1.2 3V14c0 1.1-.9 2-2 2z"/></svg>',
    'Mail' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.9 5.9c-.3.2-.6.3-1.1.3-.4 0-.7-.1-1.1-.3L2 7"/></svg>',
    'MessageSquare' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
    'Eye' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye"><path d="M2 12s4-8 10-8 10 8 10 8-4 8-10 8-10-8-10-8z"/><circle cx="12" cy="12" r="3"/></svg>',
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
                    <a href="#" class="font-medium text-blue-700 border-b-2 border-blue-700 pb-1">Forum</a>
                    <a href="{{ url('/items') }}" class="font-medium text-gray-700 hover:text-blue-700">Items</a>
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
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Community Discussions</h1>
            <p class="text-lg">Ask questions, share tips, and connect with fellow students.</p>
        </div>
    </section>

    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 grid grid-cols-1 lg:grid-cols-4 gap-8">

            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h4 class="font-bold text-lg mb-4 text-blue-800">Start a Discussion</h4>
                    <a href="#" class="w-full flex items-center justify-center bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                        <span class="w-[20px] h-[20px] mr-2">{!! $icons['Plus'] !!}</span> New Thread
                    </a>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md">
                    <h4 class="font-bold text-lg mb-3">Popular Topics</h4>
                    <ul class="space-y-2">
                        @foreach ($popularTopics as $topic)
                            <li>
                                <a href="#" class="text-gray-700 hover:text-blue-600 transition">{{ $topic['name'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="lg:col-span-3">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold">Latest Threads</h3>
                    <div class="relative w-1/2 max-w-sm">
                        <input type="text" placeholder="Search discussions..." class="w-full p-2 pl-10 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow divide-y">
                    @foreach ($discussionThreads as $thread)
                        <div class="p-5 hover:bg-gray-50 cursor-pointer transition">
                            <h4 class="font-semibold text-blue-800 mb-1">{{ $thread['title'] }}</h4>
                            <div class="flex flex-wrap items-center text-sm text-gray-500">
                                <span class="mr-3">by **{{ $thread['author'] }}**</span>
                                <span class="mr-3 flex items-center">
                                    <span class="w-[18px] h-[18px] mr-1 text-green-600">{!! $icons['MessageSquare'] !!}</span> {{ $thread['replies'] }} replies
                                </span>
                                <span class="mr-3 flex items-center">
                                    <span class="w-[18px] h-[18px] mr-1 text-purple-600">{!! $icons['Eye'] !!}</span> {{ $thread['views'] }} views
                                </span>
                                <span>• {{ $thread['time'] }}</span>
                            </div>
                            <div class="mt-2 space-x-2">
                                @foreach ($thread['tags'] as $tag)
                                    <span class="inline-block bg-blue-100 text-blue-600 text-xs font-medium px-3 py-1 rounded-full">{{ $tag }}</span>
                                @endforeach
                            </div>
                        </div>
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
                        <h4 class="text-xl font-bold">Tel-U Loots</h4>
                    </div>
                    <p class="text-gray-400">
                        A sustainable second-hand marketplace for Telkom University students. Supporting SDG 12.
                    </p>
                </div>
                <div>
                    <h5 class="font-semibold mb-4">Navigation</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ url('/') }}" class="hover:text-white">Home</a></li>
                        <li><a href="{{ url('/') }}#items" class="hover:text-white">Items</a></li>
                        <li><a href="#" class="hover:text-white">Forum</a></li>
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