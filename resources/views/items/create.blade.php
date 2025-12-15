@extends('layouts.app')

@section('title', 'Home - Tel-U Loot')

@section('content')

<?php
// PHP equivalent of mock data for Header Icons (omitted for brevity)
$logo = asset('images/logo.png');
$profile = asset('images/profile.jpg');
$icons = [
    'ShoppingCart' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h1.9l2.7 13.9c.1 0 .2 0 .3 0h11.8c.2 0 .4-.1.5-.2l4-8c.1-.2.1-.4 0-.6-.1-.2-.3-.3-.5-.3H6.85"/></svg>',
    'MessageCircle' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle"><path d="M7.9 20.3c.4.1.8.1 1.2.1h6.8c1.7 0 3-1.3 3-3V6c0-1.7-1.3-3-3-3H9c-1.7 0-3 1.3-3 3v11.5c0 .3.1.5.3.7l4 4c.2.2.5.3.7.3z"/></svg>',
    'Leaf' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-leaf"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 21.1 2.2 22 8c.8 4.7-4.3 8.6-7.3 10.4"/><path d="M17 12c-2.3-1.8-5.3-3-8-3-1.8 0-3.4-.6-4.9-1.3C5.1 11.2 5 12.3 5 14c0 4.4 3.6 8 8 8h1"/></svg>',
    'Upload' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-upload"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" x2="12" y1="3" y2="15"/></svg>',
    'MapPin' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin"><path d="M12 22s8-4 8-12c0-4.4-3.6-8-8-8-4.4 0-8 3.6-8 8s8 12 8 12z"/><circle cx="12" cy="10" r="3"/></svg>',
    'Phone' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-phone"><path d="M22 16.9v3.1a2 2 0 0 1-2 2h-1c-2.3 0-5.6-.7-8.8-3.9-3.2-3.2-3.9-6.5-3.9-8.8V4a2 2 0 0 1 2-2h3.1c1.1 0 2.2.4 3 1.2l3 3c.8.8 1.2 1.9 1.2 3V14c0 1.1-.9 2-2 2z"/></svg>',
    'Mail' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.9 5.9c-.3.2-.6.3-1.1.3-.4 0-.7-.1-1.1-.3L2 7"/></svg>',
];
?>

<div>

    <main class="py-12">
        <div class="container mx-auto px-4 max-w-4xl">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                List Your Loot for Sale
            </h1>
            <p class="text-center text-gray-600 mb-8">
                Fill out the details below to contribute to Tel-U's sustainable marketplace.
            </p>

            <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 md:p-10 rounded-xl shadow-lg space-y-6">
                @csrf
                <div class="space-y-4 border-b pb-6">
                    <h2 class="text-xl font-semibold text-red-700">Item Details</h2>
                    
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" placeholder="e.g., MacBook Air M1 (2020) with box" required class="form-input">
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category <span class="text-red-500">*</span></label>
                        <select id="category" name="category" required class="form-input">
                            <option value="">Select a Category</option>
                            <option value="Electronics">Electronics</option>
                            <option value="Books">Books</option>
                            <option value="Furniture">Furniture</option>
                            <option value="Clothing">Clothing</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
                        <textarea id="description" name="description" rows="6" placeholder="Mention key specs, condition details, and reasons for selling..." required class="form-input"></textarea>
                    </div>
                </div>

                <div class="space-y-4 border-b pb-6">
                    <h2 class="text-xl font-semibold text-red-700">Pricing and Condition</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Selling Price (IDR) <span class="text-red-500">*</span></label>
                            <input type="number" id="price" name="price" placeholder="e.g., 8500000" min="1000" required class="form-input">
                        </div>
                        
                        <div>
                            <label for="condition" class="block text-sm font-medium text-gray-700 mb-1">Condition <span class="text-red-500">*</span></label>
                            <select id="condition" name="condition" required class="form-input">
                                <option value="">Select Condition</option>
                                <option value="New">New</option>
                                <option value="Like New">Like New</option>
                                <option value="Good">Good</option>
                                <option value="Fair">Fair</option>
                            </select>
                        </div>
                    </div>

                    <div class="pt-2">
                        <div class="flex items-center p-3 border border-green-300 bg-green-50 rounded-lg w-full">
                            <input type="checkbox" id="eco_friendly" name="eco_friendly" class="rounded text-green-600 focus:ring-green-500 mr-2">
                            <label for="eco_friendly" class="text-sm font-medium text-green-700 flex items-center">
                                <span class="w-4 h-4 mr-1 text-green-500">{!! $icons['Leaf'] !!}</span> Mark as Eco-Friendly
                                <span class="text-xs text-gray-500 ml-2">(Reusable, repairable, or significantly reduces waste.)</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <h2 class="text-xl font-semibold text-red-700">Item Images</h2>
                    <p class="text-sm text-gray-500">Upload up to 3 clear photos of the item from different angles.</p>

                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6 text-gray-500">
                                <span class="w-8 h-8 mb-2">{!! $icons['Upload'] !!}</span>
                                <p class="mb-2 text-sm">
                                    <span class="font-semibold text-blue-600">Click to upload</span> or drag and drop
                                </p>
                                <p class="text-xs">PNG, JPG, up to 5MB (Max 3 files)</p>
                            </div>
                            <input id="dropzone-file" type="file" name="images[]" multiple class="hidden" accept="image/png, image/jpeg, image/jpg" />
                        </label>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-red-700 text-white font-bold py-3 rounded-lg hover:bg-red-800 transition duration-200 shadow-md">
                        Publish Listing
                    </button>
                </div>

            </form>
        </div>
    </main>

</div>
</body>
</html>
@endsection