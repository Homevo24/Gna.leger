@props([
    'label',
    'size' => 'sm',
])

@php
    $sizeClasses = $size === 'lg' ? 'text-lg md:text-xl' : 'text-xs md:text-sm';
    $colorClasses = $size === 'lg' ? 'text-paper' : 'text-paper/50';
    $weightClasses = $size === 'lg' ? 'font-bold' : 'font-medium';
@endphp

<p {{ $attributes->merge(['class' => "text-center tracking-wide {$colorClasses} {$sizeClasses} {$weightClasses}"]) }}>
    .../ {{ $label }} ...
</p>
