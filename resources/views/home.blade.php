@extends('layouts.app')

@section('title', 'Home - Tel-U Loot')

@section('content')
    {{-- The variables that define your main page content must be here or passed from the controller --}}
    @php
        // These variables were moved from the layout file and are needed for the content sections below
        $featuredItems = $featuredItems ?? collect();
        
        $icons = [
            // Only define icons used in the content section (not already in the layout)
            'Plus' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>',
            'Plus16' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>',
            'Filter' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-filter"><path d="M22 3.5l-10 10V21"/><path d="M2 3.5l10 10V21"/></svg>',
            'Star' => '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" stroke="none" class="lucide lucide-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
            'MessageCircle18' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle"><path d="M7.9 20.3c.4.1.8.1 1.2.1h6.8c1.7 0 3-1.3 3-3V6c0-1.7-1.3-3-3-3H9c-1.7 0-3 1.3-3 3v11.5c0 .3.1.5.3.7l4 4c.2.2.5.3.7.3z"/></svg>',
            'BookOpen' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>',
            'Monitor' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-monitor"><path d="M10 12l2 2 4-4"/><path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 0-1.6.8L10 8H4a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h16z"/></svg>',
            'Shirt' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shirt"><path d="M19 19c0 .7-.3 1.4-1.2 1.8-.7.3-1.4.2-1.8.8-.4.7-.2 1.4.3 1.8.4.4.2 1 .3 1.8L12 18l-5.6 4.8c-.4-.5-.6-1.1-.3-1.8.3-.6.1-1.3-.7-1.7-.8-.4-1.2-1-1.2-1.8"/><path d="M2 12l.7-4.3C3.2 5.5 5 4 7.2 4h9.6c2.2 0 4 .5 4.5 3.7L22 12l-10 10-10-10z"/></svg>',
            'Sofa' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-sofa"><path d="M10 12H4a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-6m-4 0v-4h4v4m-4 0h-6m14 0h-6m-4 4v2m4-2v2m4-2v2m4-2v2m-16-2h16"/></svg>',
            'Globe' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-globe"><circle cx="12" cy="12" r="10"/><path d="M12 2a15.3 15.3 0 0 0 4 10 15.3 15.3 0 0 0-4 10 15.3 15.3 0 0 0-4-10 15.3 15.3 0 0 0 4-10zM2.05 12h19.9"/></svg>',
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
    @endphp

    <section class="bg-gradient-to-r from-red-700 to-purple-500 text-white py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl md:text-5xl font-bold mb-4">Buy, Sell, Reuse — Sustainably at Telkom University</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">Lorem ipsum dolor sit amet, consectetur adipiscing elit (slogan).</p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="/items/create" class="bg-white text-blue-700 px-6 py-3 rounded-full font-semibold hover:bg-gray-100 flex items-center justify-center">
                    <span class="w-[20px] h-[20px] mr-2">{!! $icons['Plus'] !!}</span> Post an Item
                </a>
                <a href="/items" class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-full font-semibold hover:bg-white/10 flex items-center justify-center">
                    Browse Items
                </a>
            </div>
        </div>
    </section>

    <div class="bg-white py-3 shadow-sm">
        <div class="container mx-auto px-4 flex flex-wrap justify-center gap-6 text-center">
            <div>
                <span class="font-bold text-green-600">{{ number_format($wastePreventedKg ?? 0) }} kg</span> waste prevented
            </div>
            <div>
                <span class="font-bold text-blue-600">{{ number_format($itemsExchanged ?? 0) }}</span> items exchanged
            </div>
            <div>
                <span class="font-bold text-purple-600">{{ number_format($studentsEngaged ?? 0) }}</span> students engaged
            </div>
        </div>
    </div>

    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h3 class="text-2xl font-bold text-center mb-8">Browse by Category</h3>
            <div class="flex flex-wrap justify-center gap-6">
                @foreach ($categories as $cat)
                    <a href="{{ route('items.index', ['category' => $cat['name']]) }}" class="flex flex-col items-center bg-white p-6 rounded-xl shadow hover:shadow-md transition cursor-pointer w-32">
                        <div class="text-blue-600 mb-2">{!! $cat['icon'] !!}</div>
                        <span class="font-medium">{{ $cat['name'] }}</span>
                    </a>
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
                        @php
                            $thumb = (is_array($item->images) && count($item->images) > 0)
                                ? asset('storage/' . $item->images[0])
                                : 'https://placehold.co/300x200/060771/white?text=Item+Image';
                        @endphp
                        <a href="{{ route('items.show', $item) }}" class="block">
                            <img src="{{ $thumb }}" alt="{{ $item->title }}" class="w-full h-48 object-cover" loading="lazy" />
                        </a>
                        @if ($item->eco_friendly)
                            <div class="absolute top-0 right-0 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-bl">
                                Eco-Friendly
                            </div>
                        @endif
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <a href="{{ route('items.show', $item) }}" class="font-semibold text-gray-800 line-clamp-1 hover:text-blue-700 transition">
                                    {{ $item->title }}
                                </a>
                                <span class="text-green-600 font-bold">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                            </div>
                            <p class="text-sm text-gray-500 mt-1">{{ $item->condition }} • {{ $item->category }}</p>
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
@endsection