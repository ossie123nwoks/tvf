@props(['variant' => 'neutral', 'image' => null])

<div {{ $attributes->merge(['class' => 'rounded-lg shadow-lg overflow-hidden']) }}>
    @if($image)
    <img src="{{ $image }}" alt="" class="w-full h-48 object-cover">
    @endif
    <div class="p-6">
        {{ $slot }}
    </div>
</div>