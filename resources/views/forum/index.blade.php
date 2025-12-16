@extends('layouts.app')

@section('title', 'Home - Tel-U Loot')

@section('content')
<?php
// PHP equivalent of mock data for the Forum Page

$logo = asset('images/logo.png');
$profile = asset('images/profile.jpg');

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
                    <a href="{{ route('forum.create') }}"
                       class="w-full flex items-center justify-center bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                        <span class="w-[20px] h-[20px] mr-2">{!! $icons['Plus'] !!}</span>
                        New Thread
                    </a>
                </div>
            </div>

            <div class="lg:col-span-3">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold">Latest Threads</h3>
                    <div class="relative w-1/2 max-w-sm">
                        <input type="text"
                               placeholder="Search discussions..."
                               class="w-full p-2 pl-10 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
                        <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"
                             xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"/>
                            <path d="m21 21-4.3-4.3"/>
                        </svg>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow divide-y">
                    @foreach ($forums as $thread)
                        <a href="{{ route('forum.show', $thread) }}"
                           class="block p-5 hover:bg-gray-50 cursor-pointer transition">

                            <h4 class="font-semibold text-blue-800 mb-1">{{ $thread->title }}</h4>

                            <div class="flex flex-wrap items-center text-sm text-gray-500">
                                <span class="mr-3">
                                    By {{ $thread->user ? $thread->user->name : 'Anonymous' }}
                                </span>

                                <span class="mr-3 flex items-center">
                                    <span class="w-[18px] h-[18px] mr-1 text-green-600">
                                        {!! $icons['MessageSquare'] !!}
                                    </span>
                                    {{ $thread->comments_count }} replies 
                                </span>

                                <span>• {{ $thread->created_at->diffForHumans() }}</span>
                            </div>

                            <div class="mt-2 space-x-2">
                                <span class="inline-block bg-gray-100 text-gray-600 text-xs font-medium px-3 py-1 rounded-full">
                                    General
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
</div>

@endsection
