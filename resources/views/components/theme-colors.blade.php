@props(['variant' => 'primary'])

@php
    $baseClasses = 'transition duration-300 ease-in-out';
    $variantClasses = match($variant) {
        'primary' => 'bg-navy text-white hover:bg-navy-dark',
        'secondary' => 'bg-gold text-navy hover:bg-gold-dark',
        'accent' => 'bg-teal text-navy hover:bg-teal-600',
        'neutral' => 'bg-gray-100 text-navy hover:bg-gray-200',
        default => 'bg-white text-navy',
    };
@endphp

<div {{ $attributes->merge(['class' => $baseClasses.' '.$variantClasses]) }}>
    {{ $slot }}
</div>