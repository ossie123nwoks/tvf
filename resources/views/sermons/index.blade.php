<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold mb-8">All Sermons</h1>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($sermons as $sermon)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold mb-2">{{ $sermon->title }}</h2>
                    <p class="text-gray-700 mb-4">{{ $sermon->description }}</p>
                    <a href="{{ route('sermons.show', $sermon) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300">View Sermon</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>