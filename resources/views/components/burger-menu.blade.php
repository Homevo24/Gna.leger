@props([
    'links' => [],
])

<div
    x-show="open"
    x-cloak
    x-transition:enter="transition ease-out duration-150"
    x-transition:enter-start="opacity-0 -translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-100"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-2"
    @click.outside="open = false"
    class="absolute inset-x-0 top-full z-20 mt-2 rounded-panel border border-paper/10 bg-ink p-6 md:hidden"
>
    <div class="flex flex-col gap-4">
        @foreach ($links as $link)
            <a
                href="{{ $link['href'] }}"
                @click="open = false"
                class="rounded-card px-3 py-2 font-display text-[20px] font-bold transition focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink {{ $link['active'] ? 'bg-paper text-ink' : 'text-paper' }}"
            >
                {{ $link['label'] }}
            </a>
        @endforeach
    </div>
</div>
