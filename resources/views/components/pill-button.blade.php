@props([
    'href' => null,
    'label',
    'variant' => 'dark',
    'type' => 'button',
    'icon' => 'arrow',
])

@php
    $isDark = $variant === 'dark';
    $isOutline = $variant === 'outline';

    $wrapperClasses = match (true) {
        $isDark => 'bg-ink text-paper',
        $isOutline => 'border border-paper/30 text-paper hover:bg-paper/5',
        default => 'bg-paper text-ink',
    };

    $circleClasses = match (true) {
        $isDark => 'bg-paper text-ink',
        $isOutline => 'border border-paper/40 text-paper',
        default => 'bg-ink text-paper',
    };

    // Les boutons reposent presque toujours sur un fond noir (bg-ink) désormais,
    // donc l'anneau de focus reste clair avec un décalage sombre pour rester visible.
    $baseClasses = "inline-flex items-center gap-3 rounded-full py-2 pl-6 pr-2 transition hover:opacity-80 focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink {$wrapperClasses}";

    $iconMarkup = match ($icon) {
        'github' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="h-4 w-4"><path fill="currentColor" fill-rule="evenodd" d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385c.6.105.825-.255.825-.57c0-.285-.015-1.23-.015-2.235c-3.015.555-3.795-.735-4.035-1.41c-.135-.345-.72-1.41-1.23-1.695c-.42-.225-1.02-.78-.015-.795c.945-.015 1.62.87 1.845 1.23c1.08 1.815 2.805 1.305 3.495.99c.105-.78.42-1.305.765-1.605c-2.67-.3-5.46-1.335-5.46-5.925c0-1.305.465-2.385 1.23-3.225c-.12-.3-.54-1.53.12-3.18c0 0 1.005-.315 3.3 1.23c.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23c.66 1.65.24 2.88.12 3.18c.765.84 1.23 1.905 1.23 3.225c0 4.605-2.805 5.625-5.475 5.925c.435.375.81 1.095.81 2.22c0 1.605-.015 2.895-.015 3.3c0 .315.225.69.825.57A12.02 12.02 0 0 0 24 12c0-6.63-5.37-12-12-12" clip-rule="evenodd" /></svg>',
        'link' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-4 w-4"><path d="M6.939 5.01c.57.044 1.122.216 1.619.503c.496.286.924.678 1.257 1.148l-1.63 1.157a2 2 0 0 0-.625-.573a1.8 1.8 0 0 0-1.564-.12c-.255.101-.49.26-.69.469l-1.75 1.848c-.355.391-.56.924-.555 1.486c.005.564.22 1.094.584 1.478c.362.383.841.59 1.33.594a1.85 1.85 0 0 0 1.333-.562l.308-.325a1 1 0 0 1 1.452 1.375l-.315.332l-.012.013A3.85 3.85 0 0 1 4.896 15a3.86 3.86 0 0 1-2.763-1.218A4.18 4.18 0 0 1 1 10.943a4.18 4.18 0 0 1 1.085-2.857l.012-.013l1.758-1.855a3.9 3.9 0 0 1 1.408-.953a3.8 3.8 0 0 1 1.676-.254M11.105 1a3.86 3.86 0 0 1 2.762 1.218A4.18 4.18 0 0 1 15 5.057a4.18 4.18 0 0 1-1.085 2.858l-.012.013l-1.758 1.854a3.9 3.9 0 0 1-1.408.953a3.8 3.8 0 0 1-3.295-.247a4 4 0 0 1-1.257-1.15l1.63-1.156c.17.24.386.434.626.573a1.79 1.79 0 0 0 1.563.12c.255-.1.49-.26.69-.469l1.751-1.847c.355-.391.56-.924.555-1.486a2.18 2.18 0 0 0-.584-1.48A1.86 1.86 0 0 0 11.086 3a1.85 1.85 0 0 0-1.334.564l-.313.328a1 1 0 0 1-1.447-1.38l.319-.334l.01-.01A3.85 3.85 0 0 1 11.104 1" /></svg>',
        default => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4"><line x1="7" y1="17" x2="17" y2="7"></line><polyline points="7 7 17 7 17 17"></polyline></svg>',
    };
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
        <span class="font-display text-sm font-semibold">{{ $label }}</span>
        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full {{ $circleClasses }}">
            {!! $iconMarkup !!}
        </span>
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $baseClasses]) }}>
        <span class="font-display text-sm font-semibold">{{ $label }}</span>
        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full {{ $circleClasses }}">
            {!! $iconMarkup !!}
        </span>
    </button>
@endif
