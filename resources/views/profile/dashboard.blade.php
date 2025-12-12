@extends('layouts.app')

@section('title', 'Home - Tel-U Loot')

@section('content')
<?php
// PHP equivalent of mock data for the User Profile Page

$logo = asset('images/logo.png');
$profile = asset('images/profile.jpg');

$user = [
    'rating' => 4.7,
    'listings_active' => 3,
    'listings_sold' => 15,
];

$dashboardNav = [
    ['id' => 'listings', 'name' => 'My Listings', 'icon' => 'ListOrdered'],
    ['id' => 'reviews', 'name' => 'Reviews', 'icon' => 'Star'],
];

$activeListings = [
    [ 'id' => 1, 'title' => 'MacBook Air M1', 'price' => 'Rp 8.500.000', 'status' => 'Active', 'views' => 120 ],
    [ 'id' => 2, 'title' => 'Data Structures Textbook', 'price' => 'Rp 75.000', 'status' => 'Pending', 'views' => 45 ],
    [ 'id' => 3, 'title' => 'Winter Jacket', 'price' => 'Rp 200.000', 'status' => 'Active', 'views' => 88 ],
];

// PHP/SVG representation of Lucide icons (adjusted for size)
$icons = [
    'ShoppingCart' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h1.9l2.7 13.9c.1 0 .2 0 .3 0h11.8c.2 0 .4-.1.5-.2l4-8c.1-.2.1-.4 0-.6-.1-.2-.3-.3-.5-.3H6.85"/></svg>',
    'MessageCircle' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle"><path d="M7.9 20.3c.4.1.8.1 1.2.1h6.8c1.7 0 3-1.3 3-3V6c0-1.7-1.3-3-3-3H9c-1.7 0-3 1.3-3 3v11.5c0 .3.1.5.3.7l4 4c.2.2.5.3.7.3z"/></svg>',
    'ListOrdered' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list-ordered"><line x1="10" x2="21" y1="6" y2="6"/><line x1="10" x2="21" y1="12" y2="12"/><line x1="10" x2="21" y1="18" y2="18"/><path d="M4 6h1"/><path d="M4 12h1"/><path d="M4 18h1"/></svg>',
    'ShoppingBag' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-bag"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4H6z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>',
    'Settings' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2.07.24L4.09 7.21a2 2 0 0 0-1.28 2v1.5a2 2 0 0 0 .52 1.33l.94.94a2 2 0 0 1 0 2.83l-.94.94a2 2 0 0 0-.52 1.33v1.5a2 2 0 0 0 1.28 2l1.64-.81a2 2 0 0 1 2.07.24l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2.07-.24l1.64.81a2 2 0 0 0 1.28-2v-1.5a2 2 0 0 0-.52-1.33l-.94-.94a2 2 0 0 1 0-2.83l.94-.94a2 2 0 0 0 .52-1.33V4a2 2 0 0 0-2-2h-.44z"/><circle cx="12" cy="12" r="3"/></svg>',
    'Star' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor" stroke="none" class="lucide lucide-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
    'MessageSquare' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
    'Calendar' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>',
    'Eye' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-eye"><path d="M2 12s4-8 10-8 10 8 10 8-4 8-10 8-10-8-10-8z"/><circle cx="12" cy="12" r="3"/></svg>',
    'Leaf' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-leaf"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 21.1 2.2 22 8c.8 4.7-4.3 8.6-7.3 10.4"/><path d="M17 12c-2.3-1.8-5.3-3-8-3-1.8 0-3.4-.6-4.9-1.3C5.1 11.2 5 12.3 5 14c0 4.4 3.6 8 8 8h1"/></svg>',
    'MapPin' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin"><path d="M12 22s8-4 8-12c0-4.4-3.6-8-8-8-4.4 0-8 3.6-8 8s8 12 8 12z"/><circle cx="12" cy="10" r="3"/></svg>',
    'Phone' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone"><path d="M22 16.9v3.1a2 2 0 0 1-2 2h-1c-2.3 0-5.6-.7-8.8-3.9-3.2-3.2-3.9-6.5-3.9-8.8V4a2 2 0 0 1 2-2h3.1c1.1 0 2.2.4 3 1.2l3 3c.8.8 1.2 1.9 1.2 3V14c0 1.1-.9 2-2 2z"/></svg>',
    'Mail' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.9 5.9c-.3.2-.6.3-1.1.3-.4 0-.7-.1-1.1-.3L2 7"/></svg>',
];
?>

<div>
    <section class="bg-gradient-to-r from-red-700 to-purple-500 text-white py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold">Seller Dashboard</h1>
            <p class="text-lg opacity-90">Welcome back, {{ Auth::user()->name }}!</p>
        </div>
    </section>

    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 grid grid-cols-1 lg:grid-cols-4 gap-8">

            <div class="lg:col-span-1 space-y-6">

                <div class="bg-white p-6 rounded-xl shadow-md text-center">
                    <img src="{{ $profile }}" alt="Profile" class="w-24 h-24 rounded-full mx-auto mb-4 border-4 border-blue-100" />
                    <h3 class="text-xl font-bold text-gray-800">{{ Auth::user()->name }}</h3>
                    <p class="text-sm text-gray-500">{{ Auth::user()->nim }}</p>
                    
                    <div class="flex items-center justify-center mt-3 text-yellow-500">
                        <span class="w-[20px] h-[20px] mr-1">{!! $icons['Star'] !!}</span>
                        <span class="font-semibold text-gray-700">{{ $user['rating'] }} Rating</span>
                    </div>

                    <p class="text-xs text-gray-400 mt-2 flex items-center justify-center">
                        <span class="w-[16px] h-[16px] mr-1">{!! $icons['Calendar'] !!}</span> Joined {{ Auth::user()->created_at }}
                    </p>
                </div>

                <nav class="bg-white p-2 rounded-xl shadow-md">
                    @foreach ($dashboardNav as $navItem)
                        @php
                            // Check if current item is the active link (Mocking 'listings' as default active view)
                            $isActive = ($navItem['id'] === 'listings');
                            
                            // Set the correct URL for navigation
                            $linkHref = ($navItem['id'] === 'reviews') ? '/profile/reviews' : '/profile';

                            $linkClasses = $isActive
                                ? 'bg-blue-600 text-white shadow-lg'
                                : 'text-gray-700 hover:bg-gray-100';
                        @endphp
                        <a href="{{ $linkHref }}" class="flex items-center p-3 rounded-lg font-medium transition {{ $linkClasses }} mb-1">
                            <span class="w-[20px] h-[20px] mr-3">{!! $icons[$navItem['icon']] !!}</span>
                            {{ $navItem['name'] }}
                        </a>
                    @endforeach
                    <a href="{{ route('logout') }}" class="flex items-center p-3 rounded-lg font-medium transition text-red-500 hover:bg-red-50">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out mr-3"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                        Logout
                    </a>
                </nav>
            </div>

            <div class="lg:col-span-3 space-y-8">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white p-5 rounded-xl shadow-md border-b-4 border-blue-500">
                        <p class="text-sm font-medium text-gray-500">Active Listings</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $user['listings_active'] }}</p>
                    </div>
                    <div class="bg-white p-5 rounded-xl shadow-md border-b-4 border-green-500">
                        <p class="text-sm font-medium text-gray-500">Items Sold</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">{{ $user['listings_sold'] }}</p>
                    </div>
                    <div class="bg-white p-5 rounded-xl shadow-md border-b-4 border-purple-500">
                        <p class="text-sm font-medium text-gray-500">Total Revenue (Est.)</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1">Rp 12M+</p>
                    </div>
                </div>

                <div id="listings" class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex justify-between items-center mb-4 border-b pb-3">
                        <h2 class="text-xl font-bold text-gray-800">My Active Listings ({{ count($activeListings) }})</h2>
                        <a href="items/create" class="bg-blue-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                            Create New Listing
                        </a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Views</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($activeListings as $listing)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $listing['title'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-bold">{{ $listing['price'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if ($listing['status'] == 'Active')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">{{ $listing['status'] }}</span>
                                            @elseif ($listing['status'] == 'Pending')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ $listing['status'] }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 flex items-center">
                                            <span class="w-[16px] h-[16px] mr-1 text-gray-400">{!! $icons['Eye'] !!}</span> {{ $listing['views'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                                            <a href="#" class="text-blue-600 hover:text-blue-900">Edit</a>
                                            <a href="#" class="text-red-600 hover:text-red-900">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md h-40 flex items-center justify-center text-gray-500" id="purchases">
                    Content for My Purchases will appear here.
                </div>
            </div>
        </div>
    </section>


</div>
</body>
</html>
@endsection