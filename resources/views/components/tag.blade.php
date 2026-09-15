@props([
    'label',
    'color' => 'neutral',
])

@php
    $colorClasses = $color === 'accent'
        ? 'bg-accent text-white'
        : 'bg-paper/10 text-paper border border-paper/20';
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center rounded-full px-4 py-1 text-xs font-medium {$colorClasses}"]) }}>
    {{ $label }}
</span>
