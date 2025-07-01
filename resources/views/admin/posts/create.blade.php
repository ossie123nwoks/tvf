<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Title -->
                        <div class="mb-6">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Post Title</label>
                            <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Slug -->
                        <div class="mb-6">
                            <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">URL Slug</label>
                            <input type="text" id="slug" name="slug" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('slug')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Excerpt -->
                        <div class="mb-6">
                            <label for="excerpt" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Excerpt</label>
                            <textarea id="excerpt" name="excerpt" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                            @error('excerpt')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Content Section -->
                        <div class="mb-6">
    <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Content</label>
    <textarea name="content" id="content">{{ old('content', '') }}</textarea>
    @error('content')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
                        
                        <!-- Categories -->
                        <div class="mb-6">
                            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <select id="category_id" name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Featured Image -->
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="featured_image">Featured Image</label>
                            <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="featured_image" name="featured_image" type="file">
                            @error('featured_image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Published At -->
                        <div class="mb-6">
                            <label for="published_at" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Publish Date</label>
                            <input type="datetime-local" id="published_at" name="published_at" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            @error('published_at')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Status -->
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center">
                                    <input id="draft" name="status" type="radio" value="draft" checked class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="draft" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Draft</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="published" name="status" type="radio" value="published" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="published" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Published</label>
                                </div>
                            </div>
                            @error('status')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.tiny.cloud/1/anj24ccs9fqlypytjynijpkr3kipx4if1yyceqpejjep2w7x/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: '#content',
            height: 500,
            plugins: 'lists link image table code help wordcount',
            toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image | code',
            skin: 'oxide-dark',
            content_css: 'dark',
            branding: false,
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            }
        });
    });
</script>

        
</x-app-layout>