<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tel-U Loot - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Optional: Adding a custom background for visual appeal */
        .login-bg {
            background-image: url('https://source.unsplash.com/random/1600x900/?university,library');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="min-h-screen login-bg flex items-center justify-center p-4">

<?php
$logo = asset('images/logo.png');
// PHP/SVG representation of Lucide icons (adjusted for size)
$icons = [
    'Lock' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>',
    'Mail' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.9 5.9c-.3.2-.6.3-1.1.3-.4 0-.7-.1-1.1-.3L2 7"/></svg>',
];
?>

@if(session('error') || session('success'))
    @php
        $type = session('error') ? 'error' : 'success';
        $message = session($type);
        $alertColor = $type === 'error' ? 'bg-red-500' : 'bg-green-500';
    @endphp

    <div class="fixed top-5 right-5 z-50 p-4 rounded-lg text-white shadow-lg {{ $alertColor }}">
        {{ $message }}
    </div>
@endif

<div class="w-full max-w-md">
    <div class="bg-white/95 backdrop-blur-sm p-8 md:p-10 rounded-xl shadow-2xl border border-gray-100">

        <div class="text-center mb-8">
            <div class="flex items-center justify-center space-x-3 mb-2">
                {{-- Uncomment and use the actual Laravel asset helper if needed: --}}
                {{-- <img src="{{ $logo }}" alt="Logo" class="h-10 w-auto" /> --}}
                <span class="text-3xl font-extrabold text-red-700">Tel-U Loot</span>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Welcome Back, Student!</h2>
            <p class="text-gray-500 text-sm">Sign in to manage your listings and purchases.</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Student Email (e.g., @student.telkomuniversity.ac.id)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        {!! $icons['Mail'] !!}
                    </div>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email') }}"
                        placeholder="Your university email"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 text-gray-800
                                @error('email') border-red-500 @else border-gray-300 @enderror"
                        required 
                        autofocus
                    />
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        {!! $icons['Lock'] !!}
                    </div>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        placeholder="••••••••"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 text-gray-800
                                @error('password') border-red-500 @else border-gray-300 @enderror"
                        required
                    />
                </div>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mb-6 text-sm">
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="remember_me" class="ml-2 block text-gray-600">Remember me</label>
                </div>
                <a href="/forgot-password" class="font-medium text-red-600 hover:text-red-700 transition">
                    Forgot Password?
                </a>
            </div>

            <button type="submit" class="w-full bg-red-600 text-white py-2.5 rounded-lg font-semibold hover:bg-red-700 transition duration-200 shadow-md shadow-red-200/50">
                Log In
            </button>
        </form>

        <div class="mt-6 text-center text-sm">
            <p class="text-gray-600">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-bold text-red-600 hover:text-red-700 transition">
                    Register Here
                </a>
            </p>
        </div>

    </div>
</div>

</body>
</html>