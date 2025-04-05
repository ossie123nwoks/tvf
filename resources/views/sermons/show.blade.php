<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-4">{{ $sermon->title }}</h1>
        <p class="text-gray-700 mb-4">{{ $sermon->description }}</p>
        <p class="text-gray-700 mb-4">{{ $sermon->video_url }}</p>
        <p class="text-gray-700 mb-4"><strong>Date:</strong> {{ $sermon->created_at->format('F j, Y') }}</p>
        <a href="{{ route('sermons.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">Back to Sermons</a>
    </div>
</x-app-layout>