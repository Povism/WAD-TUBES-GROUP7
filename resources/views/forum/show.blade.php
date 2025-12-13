@extends('layouts.app')

@section('title', 'Home - Tel-U Loot')

@section('content')
<?php
// Mock Data and Icons
$logo = asset('images/logo.png');
$profile = asset('images/profile.jpg');

// NOTE: These comments are mock data and would ideally be passed from your controller
$icons = [
    'Eye' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s5 7 10 7 10-7 10-7-5-7-10-7-10 7-10 7z"/><circle cx="12" cy="12" r="3"/></svg>',
    'MessageCircle' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7.9 20.3h6.8c1.7 0 3-1.3 3-3V6c0-1.7-1.3-3-3-3H9c-1.7 0-3 1.3-3 3v11.5l4 4z"/></svg>',
    'Pencil' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.85 2.85 0 0 1 3 3L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>',
    'Trash2' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>',
];
?>

<main class="py-12">
    <div class="container mx-auto px-4 max-w-4xl">

        {{-- POST --}}
        <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-red-700 mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 text-center mb-4">
                {{ $forum->title }}
            </h1>

            <div class="flex flex-wrap items-center justify-center text-sm text-gray-500 gap-4 border-b pb-4 mb-4">
                <span class="font-medium text-red-700">
                    By {{ $forum->user ? $forum->user->name : 'Anonymous' }}
                </span>
                <span>•</span>
                <span>{{ $forum->created_at->diffForHumans() }}</span>
                <span>•</span>
                <span class="flex items-center gap-1">{!! $icons['MessageCircle'] !!} {{ count($forum->comments) }} Replies</span>

                {{-- AUTHORIZATION CHECK --}}
                @auth
                    @if (auth()->id() == $forum->user_id)

                        {{-- Edit --}}
                        <a href="{{ route('forum.edit', $forum) }}"
                           class="flex items-center gap-1 text-gray-500 hover:text-red-700 p-1 rounded hover:bg-gray-100 transition">
                            {!! $icons['Pencil'] !!} Edit
                        </a>

                        {{-- Delete --}}
                        <form action="{{ route('forum.destroy', $forum) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this discussion? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="flex items-center gap-1 text-gray-500 hover:text-red-700 p-1 rounded hover:bg-gray-100 transition">
                                {!! $icons['Trash2'] !!} Delete
                            </button>
                        </form>

                    @endif
                @endauth
            </div>

            <p class="whitespace-pre-line text-gray-800">{{ $forum->body }}</p>

            @if($forum->image)
                <div class="mt-8 pt-4 border-t">
                    <img src="{{ asset('storage/' . $forum->image) }}"
                         class="mx-auto w-1/2 rounded-lg shadow-md">
                </div>
            @endif
        </div>

        {{-- REPLIES --}}
        <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">
            Discussion ({{ count($forum->comments) }} replies)
        </h2>

        {{-- REPLY FORM --}}
        <div class="bg-white p-6 rounded-xl shadow-md mb-8 border-t-2 border-red-500">
            <h3 class="text-lg font-semibold text-red-700 mb-4 text-center">
                Leave a Reply
            </h3>

            <form action="{{ route('comment.store', $forum) }}" method="POST" class="space-y-4">
                @csrf
                <div class="flex justify-center">
                    <textarea
                        name="comment"
                        rows="4"
                        required
                        placeholder="Share your insights or answer the question..."
                        class="w-full max-w-3xl p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-600 focus:outline-none text-left"
                    ></textarea>
                </div>

                <div class="flex justify-center">
                    <button type="submit"
                            class="bg-red-700 text-white font-semibold py-2 px-6 rounded-lg hover:bg-red-800 transition">
                        Post Comment
                    </button>
                </div>
            </form>
        </div>

{{-- COMMENTS --}}
        <div class="space-y-6">
            {{-- Loop through REAL comments (assuming $forum->comments is populated) --}}
            @foreach ($forum->comments as $comment)
                <div class="bg-white p-5 rounded-lg shadow-sm border">
                    <div class="flex justify-between items-center mb-2 pb-2 border-b">
                        
                        <span class="font-semibold">{{ $comment->user ? $comment->user->name : 'Anonymous' }}</span>
                        
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>

                            {{-- AUTHORIZATION CHECK for Delete Button --}}
                            @auth
                                @if (auth()->id() == $comment->user_id)
                                    <form action="{{ route('comment.destroy', $comment) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-500 hover:text-red-700 transition"
                                                title="Delete Comment">
                                            {!! $icons['Trash2'] !!} 
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>

                    </div>
                    <p class="text-gray-700">{{ $comment->body }}</p>
                </div>
            @endforeach
        </div>

        @if(count($forum->comments) === 0)
            <p class="text-center text-gray-500 py-10">
                Be the first to comment on this discussion!
            </p>
        @endif

    </div>
</main>
@endsection
