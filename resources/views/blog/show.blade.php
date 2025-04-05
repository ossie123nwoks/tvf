<x-app-layout>

@section('content')
<div class="container mx-auto px-4 py-8">
    <article class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        @if($post->featured_image)
            <img 
                src="{{ Storage::url($post->featured_image) }}" 
                alt="{{ $post->title }}" 
                class="w-full h-96 object-cover"
            >
        @endif
        
        <div class="p-8">
            <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
            
            <div class="flex items-center text-gray-500 mb-6">
                <span>{{ $post->published_at->format('F j, Y') }}</span>
                <span class="mx-2">•</span>
                <span>By {{ $post->author->name }}</span>
            </div>
            
            <div class="prose max-w-none">
                {!! $post->content !!}
            </div>
        </div>
    </article>
</div>
@endsection

</x-app-layout>