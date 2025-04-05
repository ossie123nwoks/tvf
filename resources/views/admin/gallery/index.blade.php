<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gallery') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('admin.gallery.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                        Add New Image
                    </a>
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach ($galleries as $gallery)
                            <div class="mb-4">
                                <img src="{{ $gallery->image_url }}" alt="{{ $gallery->title }}" class="w-full h-48 object-cover rounded-lg">
                                <h3 class="text-lg font-bold mt-2">{{ $gallery->title }}</h3>
                                <div class="mt-2">
                                    <a href="{{ route('admin.gallery.edit', $gallery) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                    <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 ml-2">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>