<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tel-U Loot - Categories & Tags Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gray-50">

<?php
// PHP equivalent of mock data
$logo = asset('images/logo.png');
$profile = asset('images/profile.jpg');

// Icons definition matching the style from your Admin Dashboard code
$icons = [
    'MessageSquare' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>',
    'LayoutDashboard' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>',
    'Package' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package"><path d="m7.5 4.27 9 5.15"/><path d="m21 15.35-9-5.15-9 5.15"/><path d="m7.5 19.73 9-5.15"/><path d="M3 10.5v10l9 5 9-5v-10l-9-5z"/></svg>',
    'Users' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="9.5" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>',
    'Tags' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-tags"><path d="M9 18l1.3-3.9L22 4l-4-4L9 18z"/><path d="M5 21l-3-3V5a2 2 0 0 1 2-2h3"/><circle cx="17.5" cy="6.5" r="1.5"/></svg>',
    'LogOut' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>',
    'Leaf' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-leaf"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 21.1 2.2 22 8c.8 4.7-4.3 8.6-7.3 10.4"/><path d="M17 12c-2.3-1.8-5.3-3-8-3-1.8 0-3.4-.6-4.9-1.3C5.1 11.2 5 12.3 5 14c0 4.4 3.6 8 8 8h1"/></svg>',
    'Plus' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus"><path d="M5 12h14"/><path d="M12 5v14"/></svg>',
    'Pencil' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M17 3a2.85 2.85 0 0 1 3 3L7.5 20.5 2 22l1.5-5.5L17 3z"/></svg>',
    'Trash' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>'
];

// Mock Data for Categories
$categories = [
    ['id' => 1, 'name' => 'Electronics', 'slug' => 'electronics', 'listings' => 256, 'is_main' => true],
    ['id' => 2, 'name' => 'Books & Stationery', 'slug' => 'books-stationery', 'listings' => 421, 'is_main' => true],
    ['id' => 3, 'name' => 'Furniture & Dorm', 'slug' => 'furniture-dorm', 'listings' => 189, 'is_main' => true],
    ['id' => 4, 'name' => 'Clothing & Accessories', 'slug' => 'clothing-accessories', 'listings' => 355, 'is_main' => true],
    ['id' => 5, 'name' => 'Services', 'slug' => 'services', 'listings' => 45, 'is_main' => false],
];

// Mock Data for Popular Tags
$tags = ['#telkom-sale', '#discount', '#m3-laptop', '#used-book', '#kost-must-have', '#ready-to-negotiate'];
?>

<div>
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <img src="{{ $logo }}" alt="Logo" class="h-10 w-auto" />
                <span class="text-2xl font-bold text-red-800">Tel-U Loot</span>
            </div>
            
            <div class="flex items-center space-x-4">
                <span class="text-gray-700 text-sm font-medium">Admin: Jane Doe</span>
                <img src="{{ $profile }}" alt="Profile" class="w-8 h-8 rounded-full ring-2 ring-red-500" />
                <button class="p-2 rounded-full hover:bg-gray-100">
                    <span class="text-gray-700 w-[25px] h-[25px]">{!! $icons['LogOut'] ?? '' !!}</span>
                </button>
            </div>
        </div>
    </header>

    <section class="bg-gradient-to-r from-red-700 to-purple-500 text-white py-8">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <h1 class="text-3xl font-bold flex items-center">
                <span class="w-[20px] h-[20px] mr-3">{!! $icons['Tags'] !!}</span> Categories & Tags
            </h1>
            <p class="text-lg opacity-90">Organize and manage listing taxonomy</p>
        </div>
    </section>

    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 grid grid-cols-1 lg:grid-cols-4 gap-8">

            <div class="lg:col-span-1 space-y-6">
                <nav class="bg-white p-4 rounded-xl shadow-md sticky top-24"> 
                    <h2 class="text-sm uppercase text-gray-500 font-semibold mb-3">Navigation</h2>
                    <a href="/admin" class="flex items-center p-3 rounded-lg text-gray-700 transition hover:bg-gray-100 mb-1">
                        <span class="mr-3">{!! $icons['LayoutDashboard'] !!}</span> Dashboard Overview
                    </a>
                    <a href="/admin/items" class="flex items-center p-3 rounded-lg text-gray-700 transition hover:bg-gray-100 mb-1">
                        <span class="mr-3 text-red-500">{!! $icons['Package'] !!}</span> Listings Management
                    </a>
                    </a>
                    <a href="#" class="flex items-center p-3 rounded-lg bg-blue-100 text-blue-700 font-medium transition mb-1">
                        <span class="mr-3 text-blue-700">{!! $icons['Tags'] !!}</span> Categories & Tags
                    </a>
                </nav>
            </div>

            <div class="lg:col-span-3 space-y-8">
                
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex justify-between items-center mb-4 border-b pb-3">
                        <h2 class="text-xl font-bold text-gray-800">Marketplace Categories</h2>
                        <button class="bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-800 transition flex items-center">
                            {!! $icons['Plus'] !!} <span class="ml-1">Add New Category</span>
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Listings Count</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($categories as $cat)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $cat['id'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $cat['name'] }}
                                        @if ($cat['is_main'])
                                            <span class="ml-2 px-2 py-0.5 bg-indigo-100 text-indigo-700 text-xs font-medium rounded">Main</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $cat['slug'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-700">{{ number_format($cat['listings']) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                                        <button class="text-indigo-600 hover:text-indigo-900 p-1 inline-flex items-center" title="Edit">{!! $icons['Pencil'] !!}</button>
                                        <button class="text-red-600 hover:text-red-900 p-1 inline-flex items-center" title="Delete">{!! $icons['Trash'] !!}</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex justify-between items-center mb-4 border-b pb-3">
                        <h2 class="text-xl font-bold text-gray-800">Popular User Tags</h2>
                        <button class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition flex items-center">
                            {!! $icons['Plus'] !!} <span class="ml-1">Manually Add Tag</span>
                        </button>
                    </div>

                    <p class="text-sm text-gray-600 mb-4">Tags are mostly user-generated. Manage the most popular ones here.</p>

                    <div class="flex flex-wrap gap-3">
                        @foreach ($tags as $tag)
                            <div class="flex items-center bg-gray-100 text-gray-800 text-sm font-medium px-3 py-1 rounded-full border border-gray-300">
                                <span class="mr-2">{!! $tag !!}</span>
                                <button class="text-red-500 hover:text-red-700 ml-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    
                    <button class="mt-6 text-sm text-blue-600 hover:underline">View all 120 user-generated tags...</button>
                </div>
                
            </div>
        </div>
    </section>

    <footer class="bg-gray-800 text-white py-10 mt-12">
        <div class="container mx-auto px-4">
            <div class="border-t border-gray-700 pt-6 text-center text-gray-400">
                <p>© 2025 Tel-U Loots — Group 7, Telkom University. Built with ❤️ for sustainability.</p>
            </div>
        </div>
    </footer>
</div>
</body>
</html>