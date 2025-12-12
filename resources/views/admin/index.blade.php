<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tel-U Loot - Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50">

<?php
// PHP equivalent of mock data for the Admin Dashboard Page

$logo = asset('images/logo.png');
$profile = asset('images/profile.jpg');

// REVISED: Removed 'Pending Reviews' and 'New Discussions'
$adminStats = [
    ['title' => 'Total Users', 'value' => '4,521', 'icon' => 'Users', 'color' => 'blue'],
    ['title' => 'Active Listings', 'value' => '689', 'icon' => 'Package', 'color' => 'green'],
    ['title' => 'Categories & Tags', 'value' => '45', 'icon' => 'Tags', 'color' => 'purple'], // Changed from Discussions
];

$recentListings = [
    ['id' => 101, 'title' => 'Gaming Keyboard (Razer)', 'seller' => 'tech_noob', 'category' => 'Electronics', 'status' => 'Pending'],
    ['id' => 102, 'title' => 'Business Law Textbook', 'seller' => 'book_seller', 'category' => 'Books', 'status' => 'Active'],
    ['id' => 103, 'title' => 'Used Dorm Bed Sheet', 'seller' => 'dorm_clear', 'category' => 'Clothing', 'status' => 'Rejected'],
    ['id' => 104, 'title' => 'Desk Organizer', 'seller' => 'student_helper', 'category' => 'Furniture', 'status' => 'Pending'],
];

// PHP/SVG representation of Lucide icons
$icons = [
    'MessageSquare' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
    'LayoutDashboard' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>',
    'Package' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package"><path d="m7.5 4.27 9 5.15"/><path d="m21 15.35-9-5.15-9 5.15"/><path d="m7.5 19.73 9-5.15"/><path d="M3 10.5v10l9 5 9-5v-10l-9-5z"/></svg>',
    'Users' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="9.5" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
    'Tags' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tags"><path d="M9 18l1.3-3.9L22 4l-4-4L9 18z"/><path d="M5 21l-3-3V5a2 2 0 0 1 2-2h3"/><circle cx="17.5" cy="6.5" r="1.5"/></svg>',
    'LogOut' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>',
    'Leaf' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-leaf"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 21.1 2.2 22 8c.8 4.7-4.3 8.6-7.3 10.4"/><path d="M17 12c-2.3-1.8-5.3-3-8-3-1.8 0-3.4-.6-4.9-1.3C5.1 11.2 5 12.3 5 14c0 4.4 3.6 8 8 8h1"/></svg>',
    'MapPin' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin"><path d="M12 22s8-4 8-12c0-4.4-3.6-8-8-8-4.4 0-8 3.6-8 8s8 12 8 12z"/><circle cx="12" cy="10" r="3"/></svg>',
    'Phone' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone"><path d="M22 16.9v3.1a2 2 0 0 1-2 2h-1c-2.3 0-5.6-.7-8.8-3.9-3.2-3.2-3.9-6.5-3.9-8.8V4a2 2 0 0 1 2-2h3.1c1.1 0 2.2.4 3 1.2l3 3c.8.8 1.2 1.9 1.2 3V14c0 1.1-.9 2-2 2z"/></svg>',
    'Mail' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.9 5.9c-.3.2-.6.3-1.1.3-.4 0-.7-.1-1.1-.3L2 7"/></svg>',
];

$colorClasses = [
    'blue' => 'border-blue-600 text-blue-600',
    'green' => 'border-green-600 text-green-600',
    'red' => 'border-red-600 text-red-600',
    'purple' => 'border-purple-600 text-purple-600',
];

$statusColors = [
    'Active' => 'bg-green-100 text-green-800',
    'Pending' => 'bg-yellow-100 text-yellow-800',
    'Rejected' => 'bg-red-100 text-red-800',
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
                    <a href="{{ url('/') }}" class="font-medium text-gray-700 hover:text-blue-700">Go to Marketplace</a>
                </nav>
            </div>

            <div class="flex items-center space-x-4">
                <span class="text-gray-700 text-sm font-medium">{{Auth::user()->name}}</span>
                <img src="{{ $profile }}" alt="Profile" class="w-8 h-8 rounded-full ring-2 ring-red-500" />
                <button class="p-2 rounded-full hover:bg-gray-100">
                    <span class="text-gray-700 w-[25px] h-[25px]">{!! $icons['LogOut'] !!}</span>
                </button>
            </div>
        </div>
    </header>

    <section class="bg-gradient-to-r from-red-700 to-purple-500 text-white py-8">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <h1 class="text-3xl font-bold flex items-center">
                <span class="w-[20px] h-[20px] mr-3">{!! $icons['LayoutDashboard'] !!}</span> Admin Panel
            </h1>
            <p class="text-lg opacity-90">System Management & Moderation</p>
        </div>
    </section>

    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 grid grid-cols-1 lg:grid-cols-4 gap-8">

            <div class="lg:col-span-1 space-y-6">
                <nav class="bg-white p-4 rounded-xl shadow-md">
                    <h2 class="text-sm uppercase text-gray-500 font-semibold mb-3">Navigation</h2>
                    <a href="#" class="flex items-center p-3 rounded-lg bg-blue-100 text-blue-700 font-medium transition mb-1">
                        <span class="mr-3">{!! $icons['LayoutDashboard'] !!}</span> Dashboard Overview
                    </a>
                    <a href="admin/items" class="flex items-center p-3 rounded-lg text-gray-700 transition hover:bg-gray-100 mb-1">
                        <span class="mr-3 text-red-500">{!! $icons['Package'] !!}</span> Listings Management
                    </a>
                    <a href="/admin/category" class="flex items-center p-3 rounded-lg text-gray-700 transition hover:bg-gray-100 mb-1">
                        <span class="mr-3 text-green-500">{!! $icons['Tags'] !!}</span> Categories & Tags
                    </a>
                    </nav>
            </div>

            <div class="lg:col-span-3 space-y-8">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach ($adminStats as $stat)
                        @php
                            $borderClass = "border-{$stat['color']}-600";
                            $iconColorClass = "text-{$stat['color']}-600";
                        @endphp
                        <div class="bg-white p-5 rounded-xl shadow-md border-b-4 {{ $borderClass }}">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 uppercase">{{ $stat['title'] }}</p>
                                    <p class="text-3xl font-bold text-gray-900 mt-1">{{ $stat['value'] }}</p>
                                </div>
                                <div class="p-3 rounded-full bg-gray-100 {{ $iconColorClass }}">
                                    <span class="w-[24px] h-[24px]">{!! $icons[$stat['icon']] ?? '' !!}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 border-b pb-3">Recent Listings for Review</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Seller</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($recentListings as $listing)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $listing['id'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $listing['title'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $listing['seller'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$listing['status']] }}">
                                                {{ $listing['status'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                            <a href="#" class="text-blue-600 hover:text-blue-900">View</a>
                                            <a href="#" class="text-green-600 hover:text-green-900">Approve</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                        <li><a href="{{ url('/items') }}" class="hover:text-white">Items</a></li>
                        <li><a href="{{ url('/profile') }}" class="hover:text-white">My Profile</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-semibold mb-4">Contact</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center"><span class="w-[16px] h-[16px] mr-2">{!! $icons['MapPin'] ?? '' !!}</span> Telkom University, Bandung</li>
                        <li class="flex items-center"><span class="w-[16px] h-[16px] mr-2">{!! $icons['Mail'] ?? '' !!}</span> telloots@telkomuniversity.ac.id</li>
                        <li class="flex items-center"><span class="w-[16px] h-[16px] mr-2">{!! $icons['Phone'] ?? '' !!}</span> +62 22 1234 5678</li>
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