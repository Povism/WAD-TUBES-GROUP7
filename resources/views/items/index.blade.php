@extends('layouts.app')

@section('title', 'Home - Tel-U Loot')

@section('content')
<?php
// PHP equivalent of mock data for the Items Page

$logo = asset('images/logo.png');
$profile = asset('images/profile.jpg');

// Item Content Data (More extensive list for a dedicated page)
$items = $items ?? collect();

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

    <section class="bg-gradient-to-r from-red-700 to-purple-500 text-white py-12">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 text-center">Find Your Next Sustainable Loot</h1>
            <div class="flex justify-center">
                <div class="relative w-full max-w-2xl">
                    <form method="GET" action="{{ route('items.index') }}" class="w-full">
                        @if (request()->filled('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}" />
                        @endif
                        @foreach ((array) request('condition', []) as $c)
                            <input type="hidden" name="condition[]" value="{{ $c }}" />
                        @endforeach
                        @if (request()->boolean('eco'))
                            <input type="hidden" name="eco" value="1" />
                        @endif
                        @if (request()->filled('sort'))
                            <input type="hidden" name="sort" value="{{ request('sort') }}" />
                        @endif
                        <input type="search" name="q" value="{{ request('q') }}" placeholder="Search for books, gadgets, furniture, or clothes..." class="w-full p-4 pl-12 rounded-xl text-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-lg">
                    </form>
                    <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 grid grid-cols-1 lg:grid-cols-4 gap-8">

            <div class="lg:col-span-1 space-y-6">
                <form method="GET" action="{{ route('items.index') }}" class="space-y-6">
                    @if (request()->filled('q'))
                        <input type="hidden" name="q" value="{{ request('q') }}" />
                    @endif
                    @if (request()->filled('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}" />
                    @endif

                    <div class="bg-white p-6 rounded-xl shadow-md">
                        <h4 class="font-bold text-lg mb-4 flex items-center text-blue-800">
                            <span class="w-[20px] h-[20px] mr-2">{!! $icons['Filter'] !!}</span> Filter Listings
                        </h4>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                            <select name="category" class="w-full p-2 border border-gray-300 rounded-lg">
                                <option value="">All Categories</option>
                                <option value="Electronics" {{ request('category') === 'Electronics' ? 'selected' : '' }}>Electronics</option>
                                <option value="Books" {{ request('category') === 'Books' ? 'selected' : '' }}>Books</option>
                                <option value="Furniture" {{ request('category') === 'Furniture' ? 'selected' : '' }}>Furniture</option>
                                <option value="Clothing" {{ request('category') === 'Clothing' ? 'selected' : '' }}>Clothing</option>
                                <option value="Others" {{ request('category') === 'Others' ? 'selected' : '' }}>Others</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Condition</label>
                            <div class="space-y-1">
                                @php $selectedConditions = (array) request('condition', []); @endphp
                                <label class="flex items-center text-sm">
                                    <input type="checkbox" name="condition[]" value="New" class="mr-2 rounded text-blue-600" {{ in_array('New', $selectedConditions, true) ? 'checked' : '' }}>
                                    New
                                </label>
                                <label class="flex items-center text-sm">
                                    <input type="checkbox" name="condition[]" value="Good" class="mr-2 rounded text-blue-600" {{ in_array('Good', $selectedConditions, true) ? 'checked' : '' }}>
                                    Good
                                </label>
                                <label class="flex items-center text-sm">
                                    <input type="checkbox" name="condition[]" value="Fair" class="mr-2 rounded text-blue-600" {{ in_array('Fair', $selectedConditions, true) ? 'checked' : '' }}>
                                    Fair
                                </label>
                                <label class="flex items-center text-sm">
                                    <input type="checkbox" name="condition[]" value="Like New" class="mr-2 rounded text-blue-600" {{ in_array('Like New', $selectedConditions, true) ? 'checked' : '' }}>
                                    Like New
                                </label>
                            </div>
                        </div>

                        <div class="pt-4 border-t">
                            <label class="flex items-center text-sm font-semibold text-green-700">
                                <input type="checkbox" name="eco" value="1" class="mr-2 rounded text-green-600 focus:ring-green-500" {{ request()->boolean('eco') ? 'checked' : '' }}>
                                Show Only Eco-Friendly
                                <span class="w-[16px] h-[16px] ml-1 text-green-500">{!! $icons['Leaf'] !!}</span>
                            </label>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="submit" class="flex-1 py-2 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                            Apply
                        </button>
                        <a href="{{ route('items.index') }}" class="flex-1 py-2 rounded-lg border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition text-center">
                            Reset
                        </a>
                    </div>
                </form>

            </div>

            <div class="lg:col-span-3">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-700">
                        Showing {{ method_exists($items, 'count') ? $items->count() : 0 }}
                        of {{ method_exists($items, 'total') ? $items->total() : (method_exists($items, 'count') ? $items->count() : 0) }} Items
                    </h3>
                    <div class="flex items-center gap-3">
                        @auth
                            <a href="{{ route('items.create') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-semibold hover:bg-red-700 transition">
                                Post Item
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-semibold hover:bg-red-700 transition">
                                Post Item
                            </a>
                        @endauth

                        <form method="GET" action="{{ route('items.index') }}">
                            @if (request()->filled('q'))
                                <input type="hidden" name="q" value="{{ request('q') }}" />
                            @endif
                            @if (request()->filled('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}" />
                            @endif
                            @foreach ((array) request('condition', []) as $c)
                                <input type="hidden" name="condition[]" value="{{ $c }}" />
                            @endforeach
                            @if (request()->boolean('eco'))
                                <input type="hidden" name="eco" value="1" />
                            @endif

                            <select name="sort" class="p-2 border border-gray-300 rounded-lg text-sm" onchange="this.form.submit()">
                                <option value="newest" {{ (request('sort', 'newest') === 'newest') ? 'selected' : '' }}>Sort by: Newest</option>
                                <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Sort by: Price (Low to High)</option>
                                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Sort by: Price (High to Low)</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach ($items as $item)
                        <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden relative">
                            @php
                                $thumb = (is_array($item->images) && count($item->images) > 0)
                                    ? asset('storage/' . $item->images[0])
                                    : 'https://placehold.co/600x400/060771/white?text=Item+Image';
                            @endphp
                            <a href="{{ route('items.show', $item) }}" class="block">
                                <img src="{{ $thumb }}" alt="{{ $item->title }}" class="w-full h-40 object-cover" loading="lazy" />
                            </a>
                            <div class="p-4">
                                <a href="{{ route('items.show', $item) }}" class="font-semibold text-lg text-gray-800 line-clamp-2 hover:text-blue-700 transition">
                                    {{ $item->title }}
                                </a>
                                <p class="text-sm text-gray-500 mt-1">{{ $item->condition }} • {{ $item->category }}</p>
                                <p class="text-green-600 font-bold text-xl mt-1">Rp {{ number_format($item->price, 0, ',', '.') }}</p>

                                @auth
                                    @if (auth()->id() === $item->user_id || auth()->user()->role === 'admin')
                                        <div class="mt-3 flex items-center gap-2">
                                            <a href="{{ route('items.edit', $item) }}" class="px-3 py-1 text-xs font-semibold rounded-lg border border-blue-200 text-blue-700 hover:bg-blue-50">
                                                Edit
                                            </a>
                                            <form action="{{ route('items.destroy', $item) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Delete this item?')" class="px-3 py-1 text-xs font-semibold rounded-lg border border-red-200 text-red-700 hover:bg-red-50">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth

                                @if ($item->eco_friendly)
                                    <div class="mt-2 inline-flex items-center text-xs font-semibold bg-green-100 text-green-700 px-2 py-1 rounded-full">
                                        <span class="w-[16px] h-[16px] mr-1">{!! $icons['Leaf'] !!}</span>
                                        Eco-Friendly
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                @if (method_exists($items, 'links'))
                    <div class="mt-8 flex justify-center">
                        {{ $items->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>

</div>

</body>
</html>
@endsection