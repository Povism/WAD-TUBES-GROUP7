@extends('layouts.app')

@section('title', 'Home - Tel-U Loot')

@section('content')

<?php
// Mock data for Header Icons (omitted for brevity)
$logo = asset('images/logo.png');
$profile = asset('images/profile.jpg');
$icons = [
    'ShoppingCart' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h1.9l2.7 13.9c.1 0 .2 0 .3 0h11.8c.2 0 .4-.1.5-.2l4-8c.1-.2.1-.4 0-.6-.1-.2-.3-.3-.5-.3H6.85"/></svg>',
    'MessageCircle' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle"><path d="M7.9 20.3c.4.1.8.1 1.2.1h6.8c1.7 0 3-1.3 3-3V6c0-1.7-1.3-3-3-3H9c-1.7 0-3 1.3-3 3v11.5c0 .3.1.5.3.7l4 4c.2.2.5.3.7.3z"/></svg>',
    'Leaf' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-leaf"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 21.1 2.2 22 8c.8 4.7-4.3 8.6-7.3 10.4"/><path d="M17 12c-2.3-1.8-5.3-3-8-3-1.8 0-3.4-.6-4.9-1.3C5.1 11.2 5 12.3 5 14c0 4.4 3.6 8 8 8h1"/></svg>',
    'Upload' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucude-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>',
    'MapPin' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin"><path d="M12 22s8-4 8-12c0-4.4-3.6-8-8-8-4.4 0-8 3.6-8 8s8 12 8 12z"/><circle cx="12" cy="10" r="3"/></svg>',
    'Phone' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone"><path d="M22 16.9v3.1a2 2 0 0 1-2 2h-1c-2.3 0-5.6-.7-8.8-3.9-3.2-3.2-3.9-6.5-3.9-8.8V4a2 2 0 0 1 2-2h3.1c1.1 0 2.2.4 3 1.2l3 3c.8.8 1.2 1.9 1.2 3V14c0 1.1-.9 2-2 2z"/></svg>',
    'Mail' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.9 5.9c-.3.2-.6.3-1.1.3-.4 0-.7-.1-1.1-.3L2 7"/></svg>',
];

// MOCK DATA for pre-filling the form
$post = [
    'title' => 'Where to find cheap and reusable coffee cups on campus?',
    'content' => 'I am trying to reduce my waste footprint this semester, and my goal is to stop using disposable coffee cups. Does anyone know a stand or a small store near the main lecture halls that sells good, affordable reusable cups?',
    'current_attachment' => 'coffee_cup_example.jpg',
];
?>

<div>

    <main class="py-12">
        <div class="container mx-auto px-4 max-w-2xl"> 
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                Update Discussion Post
            </h1>
            <p class="text-center text-gray-600 mb-8">
                Modify the details and content of your forum discussion.
            </p>

            <form action="/forum/{post_id}" method="POST" enctype="multipart/form-data" class="space-y-6">
                <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-red-700 space-y-4">
                    <h2 class="text-xl font-bold text-red-700 text-center">Topic Details</h2>
                    
                    <div>
                        <label for="title" class="form-label-center">Topic Title <span class="text-red-500">*</span></label>
                        <div class="-mx-4 md:mx-0"> 
                            <input type="text" id="title" name="title" value="{{ $post['title'] }}" required class="form-input-forum">
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md space-y-4">
                    <h2 class="text-xl font-bold text-red-700 text-center">Discussion Content</h2>

                    <div>
                        <label for="content" class="form-label-center">Detailed Content <span class="text-red-500">*</span></label>
                        <div class="-mx-4 md:mx-0">
                            <textarea id="content" name="content" rows="12" required class="form-textarea-forum">{{ $post['content'] }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-md space-y-4">
                    <h2 class="text-xl font-bold text-red-700 text-center">Attachments</h2>
                    
                    @if($post['current_attachment'])
                        <div class="bg-gray-100 p-3 rounded-lg flex items-center justify-between text-sm text-gray-600">
                            <span>Current attachment: **{{ $post['current_attachment'] }}**</span>
                            <button type="button" class="text-red-600 hover:text-red-800 font-semibold text-xs">
                                [Remove]
                            </button>
                        </div>
                    @endif

                    <p class="text-sm text-gray-500 text-center pt-2">Upload a **new** image to replace the current one (optional).</p>

                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6 text-gray-500">
                                <span class="w-6 h-6 mb-2 text-red-600">{!! $icons['Upload'] !!}</span>
                                <p class="text-sm">
                                    <span class="font-semibold text-red-600">Click to upload</span> or drag and drop
                                </p>
                                <p class="text-xs">PNG, JPG, PDF (Max 1 file)</p>
                            </div>
                            <input id="dropzone-file" type="file" name="attachment" class="hidden" />
                        </label>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-red-700 text-white font-bold py-3 rounded-lg hover:bg-red-800 transition duration-200 shadow-md">
                        Save Changes
                    </button>
                </div>

            </form>
        </div>
    </main>

</div>
</body>
</html>
@endsection