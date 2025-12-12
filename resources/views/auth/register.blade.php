<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tel-U Loot - Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Optional: Adding a custom background for visual appeal */
        .login-bg {
            background-image: url('https://source.unsplash.com/random/1600x900/?campus,tech');
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
    'User' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>',
    'Hash' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-hash"><line x1="4" x2="20" y1="9" y2="9"/><line x1="4" x2="20" y1="15" y2="15"/><line x1="10" x2="8" y1="3" y2="21"/><line x1="16" x2="14" y1="3" y2="21"/></svg>',
    'Mail' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.9 5.9c-.3.2-.6.3-1.1.3-.4 0-.7-.1-1.1-.3L2 7"/></svg>',
    'Lock' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>',
];
?>

<div class="w-full max-w-lg">
    <div class="bg-white/95 backdrop-blur-sm p-8 md:p-10 rounded-xl shadow-2xl border border-gray-100">

        <div class="text-center mb-8">
            <div class="flex items-center justify-center space-x-3 mb-2">
                {{-- <img src="{{ $logo }}" alt="Logo" class="h-10 w-auto" /> --}}
                <span class="text-3xl font-extrabold text-red-700">Tel-U Loot</span>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Create Your Student Account</h2>
            <p class="text-gray-500 text-sm">Find and sell items exclusively within the Telkom community.</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        {!! $icons['User'] !!}
                    </div>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}"
                        id="name" 
                        placeholder="e.g., Ria Setiawan"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 text-gray-800
                                @error('name') is-invalid @enderror"
                        required 
                        autofocus
                    />
                    @error('name')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">NIM (Student ID)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        {!! $icons['Hash'] !!}
                    </div>
                    <input 
                        type="text" 
                        name="nim" 
                        id="nim" 
                        value="{{ old('nim') }}"
                        placeholder="e.g., 13022130XX"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 text-gray-800
                        @error('nim') is-invalid @enderror"
                        required
                    />
                    @error('nim')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">University Email</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        {!! $icons['Mail'] !!}
                    </div>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email') }}"
                        placeholder="e.g., name@student.telkomuniversity.ac.id"
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 text-gray-800
                                @error('email') is-invalid @enderror"
                        required
                    />
                        @error('password')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                </div>
            </div>

            <div class="mb-4">
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
                            @error('password') is-invalid @enderror"
                        required
                    />
                    @error('password')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        {!! $icons['Lock'] !!}
                    </div>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        placeholder="••••••••" 
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-150 text-gray-800"
                        required
                    />
                </div>
            </div>

            <button type="submit" class="w-full bg-red-600 text-white py-2.5 rounded-lg font-semibold hover:bg-red-700 transition duration-200 shadow-md shadow-red-200/50">
                Register Account
            </button>
        </form>

        <div class="mt-6 text-center text-sm">
            <p class="text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="font-bold text-red-600 hover:text-red-700 transition">
                    Log In Here
                </a>
            </p>
        </div>

    </div>
</div>

</body>
</html>