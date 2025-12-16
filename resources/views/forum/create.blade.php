@extends('layouts.app')
@section('title', 'Home - Tel-U Loot')

@section('content')

<?php
$icons = [
    'Upload' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
        <polyline points="17 8 12 3 7 8"/>
        <line x1="12" y1="3" x2="12" y2="15"/>
    </svg>',
];
?>

<div>
    <main class="py-12">
        <div class="container mx-auto px-4 max-w-2xl">

            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
                Start a New Discussion
            </h1>

            <p class="text-center text-gray-600 mb-8">
                Share your ideas, ask questions, or start a sustainable conversation.
            </p>

            <form
                action="{{ route('forum.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-6"
            >
                @csrf

                <!-- Topic Details -->
                <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-red-700 space-y-4">
                    <h2 class="text-xl font-bold text-red-700">Topic Details</h2>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Topic Title <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            required
                            class="w-full form-input-forum @error('title') is-invalid @enderror"
                            placeholder="e.g., Best place to find used textbooks?"
                        >

                        @error('title')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Content -->
                <div class="bg-white p-6 rounded-xl shadow-md space-y-4">
                    <h2 class="text-xl font-bold text-red-700">Discussion Content</h2>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Detailed Content <span class="text-red-500">*</span>
                        </label>

                        <textarea
                            name="body"
                            rows="10"
                            required
                            class="w-full form-textarea-forum @error('body') is-invalid @enderror"
                            placeholder="Write your post content here..."
                        >{{ old('body') }}</textarea>

                        @error('body')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Optional Attachments -->
                <div class="bg-white p-6 rounded-xl shadow-md space-y-4">
                    <h2 class="text-xl font-bold text-red-700">Optional Attachments</h2>

                    <label
                        for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full min-h-[8rem]
                               border-2 border-dashed border-gray-300 rounded-lg cursor-pointer
                               bg-gray-50 hover:bg-gray-100 transition"
                    >
                        <!-- Default -->
                        <div id="upload-placeholder" class="flex flex-col items-center text-gray-500">
                            <span class="mb-2 text-red-600">{!! $icons['Upload'] !!}</span>
                            <p class="text-sm">
                                <span class="font-semibold text-red-600">Click to upload</span> or drag & drop
                            </p>
                            <p class="text-xs">PNG, JPG, PDF (Max 1 file)</p>
                        </div>

                        <!-- Preview -->
                        <div id="file-preview" class="hidden flex flex-col items-center gap-2 p-4">
                            <img
                                id="image-preview"
                                class="hidden max-h-32 rounded-lg border"
                            >
                            <p id="file-name" class="text-sm font-medium text-gray-700"></p>
                            <p class="text-xs text-gray-500">Click again to change file</p>
                        </div>

                        <input
                            id="dropzone-file"
                            type="file"
                            name="image"
                            accept="image/*,.pdf"
                            class="hidden @error('image') is-invalid @enderror"
                        >
                    </label>

                    @error('image')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button
                    type="submit"
                    class="w-full bg-red-700 text-white font-bold py-3 rounded-lg
                           hover:bg-red-800 transition shadow-md"
                >
                    Publish Post
                </button>

            </form>
        </div>
    </main>
</div>

<!-- JS for preview -->
<script>
    const fileInput = document.getElementById('dropzone-file');
    const placeholder = document.getElementById('upload-placeholder');
    const previewBox = document.getElementById('file-preview');
    const fileName = document.getElementById('file-name');
    const imagePreview = document.getElementById('image-preview');

    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        fileName.textContent = file.name;
        placeholder.classList.add('hidden');
        previewBox.classList.remove('hidden');

        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = e => {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.classList.add('hidden');
        }
    });
</script>

@endsection
