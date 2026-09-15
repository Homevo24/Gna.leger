{{--
    Flèches + points de pagination pour un carrousel Alpine.
    À utiliser à l'intérieur d'un élément portant x-data="{ slide: 0 }".
--}}
@props([
    'total',
    'labelPrev' => 'Page précédente',
    'labelNext' => 'Page suivante',
])

@if ($total > 1)
    <div class="mt-8 flex items-center justify-center gap-4">
        <button
            type="button"
            @click="slide = (slide - 1 + {{ $total }}) % {{ $total }}"
            aria-label="{{ $labelPrev }}"
            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-paper/30 text-paper transition hover:border-paper focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink"
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
        </button>

        <div class="flex items-center gap-2">
            @for ($i = 0; $i < $total; $i++)
                <button
                    type="button"
                    @click="slide = {{ $i }}"
                    :class="slide === {{ $i }} ? 'bg-paper' : 'bg-paper/20'"
                    class="h-2 w-2 rounded-full transition focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink"
                    aria-label="Aller à la page {{ $i + 1 }}"
                ></button>
            @endfor
        </div>

        <button
            type="button"
            @click="slide = (slide + 1) % {{ $total }}"
            aria-label="{{ $labelNext }}"
            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-paper/30 text-paper transition hover:border-paper focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink"
        >
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </button>
    </div>
@endif
