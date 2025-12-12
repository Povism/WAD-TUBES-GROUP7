<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tel-U Loot - Sustainable Marketplace')</title>
    {{-- Include Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Optional: Add any global CSS links or scripts here --}}
</head>
<body class="min-h-screen bg-gray-50">

    {{-- 
        NOTE: The PHP variable definitions ($logo, $icons, $categories, etc.) 
        must either be defined here, or passed to this layout using View Composers, 
        or defined within the view that extends this layout (not ideal). 
        For this example, we assume $logo and $icons are available.
    --}}
    
    @php
        // Define $icons and $logo here for the navbar/footer to work, or ensure they are passed globally.
        // If your main view defines them, you must move those definitions here or use a View Composer.
        // Assuming $logo is available globally, and we define the necessary icons:
        $icons = [
            'ShoppingCart' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h1.9l2.7 13.9c.1 0 .2 0 .3 0h11.8c.2 0 .4-.1.5-.2l4-8c.1-.2.1-.4 0-.6-.1-.2-.3-.3-.5-.3H6.85"/></svg>',
            'LogOut' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>',
            'Leaf' => '<svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-leaf"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 21.1 2.2 22 8c.8 4.7-4.3 8.6-7.3 10.4"/><path d="M17 12c-2.3-1.8-5.3-3-8-3-1.8 0-3.4-.6-4.9-1.3C5.1 11.2 5 12.3 5 14c0 4.4 3.6 8 8 8h1"/></svg>',
            'MapPin' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin"><path d="M12 22s8-4 8-12c0-4.4-3.6-8-8-8-4.4 0-8 3.6-8 8s8 12 8 12z"/><circle cx="12" cy="10" r="3"/></svg>',
            'Phone' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone"><path d="M22 16.9v3.1a2 2 0 0 1-2 2h-1c-2.3 0-5.6-.7-8.8-3.9-3.2-3.2-3.9-6.5-3.9-8.8V4a2 2 0 0 1 2-2h3.1c1.1 0 2.2.4 3 1.2l3 3c.8.8 1.2 1.9 1.2 3V14c0 1.1-.9 2-2 2z"/></svg>',
            'Mail' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.9 5.9c-.3.2-.6.3-1.1.3-.4 0-.7-.1-1.1-.3L2 7"/></svg>',
        ];
        $logo = asset('images/logo.png'); // Placeholder
        $profile = asset('images/profile.jpg'); // Placeholder
    @endphp

    <div>
        {{-- ---------------------------------------------------------------- --}}
        {{-- HEADER / NAVBAR (Including the Log-in/Log-out logic) --}}
        {{-- ---------------------------------------------------------------- --}}
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <div class="container mx-auto px-4 py-4 flex items-center justify-between">
                {{-- Logo and Site Name --}}
                <div class="flex items-center space-x-3">
                    <img src="{{ $logo }}" alt="Logo" class="h-10 w-auto" />
                    <span class="text-2xl font-bold text-red-800">Tel-U Loot</span>
                </div>

                {{-- Main Navigation Links --}}
                <div class="hidden md:flex items-center space-x-6">
                    <nav class="flex space-x-6">
                        <a href="/" class="font-medium text-gray-700 hover:text-blue-700">Home</a>
                        <a href="/forum" class="font-medium text-gray-700 hover:text-blue-700">Forum</a>
                        <a href="/items" class="font-medium text-gray-700 hover:text-blue-700">Items</a>
                    </nav>
                </div>

                {{-- User Actions (Conditional) --}}
                <div class="flex items-center space-x-4">
                    
                    {{-- Cart Button --}}
                    <button class="p-2 rounded-full hover:bg-gray-100 relative">
                        <a href="/cart" class="text-gray-700 w-[25px] h-[25px]">{!! $icons['ShoppingCart'] !!}</a>
                        <span class="absolute -top-1.5 -right-1 bg-blue-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                    </button>

                    {{-- Conditional Rendering for Auth/Guest --}}
                    @auth
                        {{-- Logged In: Show Log-out and Profile --}}

                        {{-- CHANGED: This button is now LOGOUT --}}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="p-2 rounded-full hover:bg-gray-100" title="Log Out">
                                <span class="text-gray-700 w-[25px] h-[25px]">{!! $icons['LogOut'] !!}</span>
                            </button>
                        </form>
                        
                        {{-- Profile Button --}}
                        <button class="p-2 rounded-full hover:bg-gray-100">
                            <a href="profile">
                                <img src="{{ $profile }}" alt="Profile" class="w-8 h-8 rounded-full" />
                            </a>
                        </button>
                    @else 
                        {{-- Guest: Show Login Button --}}
                        <a href="{{ route('login') }}" class="bg-red-600 text-white px-4 py-2 rounded-full font-semibold hover:bg-red-700 transition duration-150 shadow-md">
                            Log In
                        </a>
                        {{-- Optional: Register Button --}}
                        <a href="{{ route('register') }}" class="hidden md:inline-block text-gray-700 hover:text-red-700 px-3 py-2 font-medium">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </header>

        {{-- ---------------------------------------------------------------- --}}
        {{-- MAIN CONTENT AREA --}}
        {{-- ---------------------------------------------------------------- --}}
        <main>
            @yield('content')
        </main>
        
        {{-- ---------------------------------------------------------------- --}}
        {{-- FOOTER --}}
        {{-- ---------------------------------------------------------------- --}}
        <footer class="bg-gray-800 text-white py-10">
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
                            <li><a href="/" class="hover:text-white">Home</a></li>
                            <li><a href="/items" class="hover:text-white">Items</a></li>
                            <li><a href="/forum" class="hover:text-white">Forum</a></li>
                            <li><a href="/profile" class="hover:text-white">My Profile</a></li>
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