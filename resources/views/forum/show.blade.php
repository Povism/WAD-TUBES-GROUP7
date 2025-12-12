@extends('layouts.app')

@section('title', 'Home - Tel-U Loot')

@section('content')
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

</div>
</body>
</html>
@endsection