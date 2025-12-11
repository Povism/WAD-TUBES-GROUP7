<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tel-U Loot - Discussion Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .comment-input {
            /* Standard input style, using red focus */
            @apply w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-700 focus:border-red-700;
        }
        /* Style for the main content area */
        .post-content {
            /* Ensures centered text within the content block */
            @apply text-lg text-gray-700 leading-relaxed text-center; 
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50">

<?php
// Mock Data
$logo = asset('images/logo.png');
$profile = asset('images/profile.jpg');

$post = [
    'id' => 45,
    'title' => 'Where to find cheap and reusable coffee cups on campus?',
    'content' => 'I am trying to reduce my waste footprint this semester, and my goal is to stop using disposable coffee cups. Does anyone know a stand or a small store near the main lecture halls that sells good, affordable reusable cups?',
    'author' => 'SustainableSally',
    'avatar' => asset('images/avatar_sally.jpg'),
    'date' => 'December 10, 2025',
    'attachment' => 'reusable_cup_example.jpg',
    'views' => 450,
    'replies' => 12,
];

$comments = [
    ['user' => 'EcoWarriorRaj', 'time' => '1 hour ago', 'text' => 'Try the co-op store near the library! They have bamboo cups for under 30k. Highly recommend them.'],
    ['user' => 'CampusGuru', 'time' => '30 minutes ago', 'text' => 'The coffee shop in the Student Center gives a 10% discount if you bring your own cup.'],
    ['user' => 'StudentBuyer', 'time' => '10 minutes ago', 'text' => 'I saw a few for sale on the "Items" section of this site yesterday, maybe check there!'],
];

$icons = [
    // ... icons array (omitted for brevity)
    'Eye' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye"><path d="M2 12s5 7 10 7 10-7 10-7-5-7-10-7-10 7-10 7z"/><circle cx="12" cy="12" r="3"/></svg>',
    'MessageCircle' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle"><path d="M7.9 20.3c.4.1.8.1 1.2.1h6.8c1.7 0 3-1.3 3-3V6c0-1.7-1.3-3-3-3H9c-1.7 0-3 1.3-3 3v11.5c0 .3.1.5.3.7l4 4c.2.2.5.3.7.3z"/></svg>',
    'Pencil' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M17 3a2.85 2.85 0 0 1 3 3L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>',
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
                    <a href="{{ url('/') }}" class="font-medium text-gray-700 hover:text-red-700">Home</a>
                    <a href="{{ url('/forum') }}" class="font-medium text-red-700 border-b-2 border-red-700 pb-1">Forum</a>
                    <a href="{{ url('/items') }}" class="font-medium text-gray-700 hover:text-red-700">Items</a>
                </nav>
            </div>
            <div class="flex items-center space-x-4">
                <button class="p-2 rounded-full hover:bg-gray-100 relative">
                    <a href="/cart" class="text-gray-700 w-[25px] h-[25px]"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h1.9l2.7 13.9c.1 0 .2 0 .3 0h11.8c.2 0 .4-.1.5-.2l4-8c.1-.2.1-.4 0-.6-.1-.2-.3-.3-.5-.3H6.85"/></svg></a>
                    <span class="absolute -top-1.5 -right-1 bg-blue-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </button>
                <button class="p-2 rounded-full hover:bg-gray-100">
                    <span class="text-gray-700 w-[25px] h-[25px]"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle"><path d="M7.9 20.3c.4.1.8.1 1.2.1h6.8c1.7 0 3-1.3 3-3V6c0-1.7-1.3-3-3-3H9c-1.7 0-3 1.3-3 3v11.5c0 .3.1.5.3.7l4 4c.2.2.5.3.7.3z"/></svg></span>
                </button>
                <a href="profile">
                <img src="{{ $profile }}" alt="Profile" class="w-8 h-8 rounded-full" /></a>
            </div>
        </div>
    </header>

    <main class="py-12">
        <div class="container mx-auto px-4 max-w-4xl">
            
            <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-red-700 mb-8">
                <div class="flex justify-between items-start mb-4">
                    <h1 class="text-3xl font-extrabold text-gray-900 text-center w-full">
                        {{ $post['title'] }}
                    </h1>
                </div>

                <div class="flex items-center justify-center text-sm text-gray-500 space-x-4 border-b pb-4 mb-4">
                    <div class="flex items-center space-x-2">
                        <span class="font-medium text-red-700">By {{ $post['author'] }}</span>
                    </div>
                    <span>•</span>
                    <span>Posted on {{ $post['date'] }}</span>
                    <span>•</span>
                    <span class="flex items-center space-x-1">
                        {!! $icons['Eye'] !!}
                        <span>{{ $post['views'] }} Views</span>
                    </span>
                    <span class="flex items-center space-x-1">
                        {!! $icons['MessageCircle'] !!}
                        <span>{{ $post['replies'] }} Replies</span>
                    </span>
                    
                    <a href="/forum/{{ $post['id'] }}/edit" class="ml-4 text-sm text-gray-500 hover:text-red-700 flex items-center space-x-1 p-1 rounded hover:bg-gray-100 transition">
                        {!! $icons['Pencil'] !!}
                        <span>Edit</span>
                    </a>
                </div>

                <div class="post-content pt-4">
                    <p class="whitespace-pre-line">{{ $post['content'] }}</p>
                    
                    @if($post['attachment'])
                        <div class="mt-8 pt-4 border-t border-gray-200">
                            <p class="text-xs text-gray-500 mb-2">Attachment:</p>
                            <img src="{{ $post['attachment'] }}" alt="Post attachment" class="mx-auto w-1/2 rounded-lg shadow-md border-2 border-gray-100">
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-10">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">
                    Discussion ({{ $post['replies'] }} replies)
                </h2>

                <div class="bg-white p-6 rounded-xl shadow-md mb-8 border-t-2 border-red-500">
                    <h3 class="text-lg font-semibold text-red-700 mb-3">Leave a Reply</h3>
                    <form action="/forum/{{ $post['id'] }}/comment" method="POST" class="space-y-3">
                        <textarea name="comment" rows="4" placeholder="Share your insights or answer the question..." required class="comment-input text-left"></textarea>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-red-700 text-white font-semibold py-2 px-5 rounded-lg hover:bg-red-800 transition">
                                Post Comment
                            </button>
                        </div>
                    </form>
                </div>

                <div class="space-y-6">
                    @foreach ($comments as $comment)
                    <div class="bg-white p-5 rounded-lg shadow-sm border border-gray-100">
                        <div class="flex items-center justify-between mb-2 pb-2 border-b">
                            <span class="font-semibold text-gray-800">{{ $comment['user'] }}</span>
                            <span class="text-sm text-gray-500">{{ $comment['time'] }}</span>
                        </div>
                        <p class="text-gray-700 text-left">{{ $comment['text'] }}</p>
                    </div>
                    @endforeach
                </div>
                
                @if (count($comments) === 0)
                    <div class="text-center text-gray-500 py-10">Be the first to comment on this discussion!</div>
                @endif
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white py-10 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <span class="text-green-400 w-[28px] h-[28px]"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-leaf"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 21.1 2.2 22 8c.8 4.7-4.3 8.6-7.3 10.4"/><path d="M17 12c-2.3-1.8-5.3-3-8-3-1.8 0-3.4-.6-4.9-1.3C5.1 11.2 5 12.3 5 14c0 4.4 3.6 8 8 8h1"/></svg></span>
                        <h4 class="text-xl font-bold">Tel-U Loots</h4>
                    </div>
                    <p class="text-gray-400">
                        A sustainable second-hand marketplace for Telkom University students. Supporting SDG 12.
                    </p>
                </div>
                <div>
                    <h5 class="font-semibold mb-4">Navigation</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="/" class="hover:text-white">Home</a></li>
                        <li><a href="/items" class="hover:text-white">Items</a></li>
                        <li><a href="/forum" class="hover:text-white">Forum</a></li>
                        <li><a href="/profile" class="hover:text-white">My Profile</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-semibold mb-4">Contact</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center"><span class="w-[16px] h-[16px] mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin"><path d="M12 22s8-4 8-12c0-4.4-3.6-8-8-8-4.4 0-8 3.6-8 8s8 12 8 12z"/><circle cx="12" cy="10" r="3"/></svg></span> Telkom University, Bandung</li>
                        <li class="flex items-center"><span class="w-[16px] h-[16px] mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.9 5.9c-.3.2-.6.3-1.1.3-.4 0-.7-.1-1.1-.3L2 7"/></svg></span> telloots@telkomuniversity.ac.id</li>
                        <li class="flex items-center"><span class="w-[16px] h-[16px] mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone"><path d="M22 16.9v3.1a2 2 0 0 1-2 2h-1c-2.3 0-5.6-.7-8.8-3.9-3.2-3.2-3.9-6.5-3.9-8.8V4a2 2 0 0 1 2-2h3.1c1.1 0 2.2.4 3 1.2l3 3c.8.8 1.2 1.9 1.2 3V14c0 1.1-.9 2-2 2z"/></svg></span> +62 22 1234 5678</li>
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