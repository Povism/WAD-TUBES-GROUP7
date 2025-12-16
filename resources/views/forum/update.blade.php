@extends('layouts.app')
@section('title', 'Home - Tel-U Loot')

@section('content')

<?php
$icons = [
    'Upload' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                Update Discussion Post
            </h1>

            <p class="text-center text-gray-600 mb-8">
                Modify the details and content of your forum discussion.
            </p>

            <form
                action="{{ route('forum.update', $forum->id) }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-6"
            >
                @csrf
                @method('PUT')

                <!-- Topic -->
                <div class="bg-white p-6 rounded-xl shadow-md border-t-4 border-red-700 space-y-4">
                    <h2 class="text-xl font-bold text-red-700">Topic Details</h2>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title', $forum->title) }}"
                        required
                        class="w-full form-input-forum @error('title') is-invalid @enderror"
                    >

                    @error('title')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Content -->
                <div class="bg-white p-6 rounded-xl shadow-md space-y-4">
                    <h2 class="text-xl font-bold text-red-700">Discussion Content</h2>

                    <textarea
                        name="body"
                        rows="10"
                        required
                        class="w-full form-textarea-forum @error('body') is-invalid @enderror"
                    >{{ old('body', $forum->body) }}</textarea>

                    @error('body')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Attachments -->
                <div class="bg-white p-6 rounded-xl shadow-md space-y-4">
                    <h2 class="text-xl font-bold text-red-700">Attachments</h2>

                    <!-- Existing attachment -->
                    @if($forum->image)
                        <div class="flex flex-col items-center gap-2 bg-gray-100 p-4 rounded-lg">
                            <p class="text-sm text-gray-600 font-medium">Current attachment</p>

                            @if(Str::endsWith($forum->image, ['jpg','jpeg','png']))
                                <img
                                    src="{{ asset('storage/' . $forum->image) }}"
                                    class="max-h-32 rounded-lg border"
                                >
                            @else
                                <p class="text-sm text-gray-700">
                                    {{ basename($forum->image) }}
                                </p>
                            @endif
                        </div>
                    @endif

                    <p class="text-sm text-gray-500 text-center">
                        Upload a new file to replace the current attachment (optional)
                    </p>

                    <!-- Upload box -->
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
                            <img id="image-preview" class="hidden max-h-32 rounded-lg border">
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
                    Save Changes
                </button>

            </form>
        </div>
    </main>
</div>

<!-- Preview JS -->
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
