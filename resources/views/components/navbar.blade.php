@props([
    'links' => [
        ['label' => 'Profil', 'href' => route('profil'), 'active' => request()->routeIs('profil')],
        ['label' => 'Parcours & Projets', 'href' => route('parcours-projets'), 'active' => request()->routeIs('parcours-projets') || request()->routeIs('projects.show')],
        ['label' => 'Articles & Contact', 'href' => route('articles-contact'), 'active' => request()->routeIs('articles-contact')],
    ],
])

<nav
    x-data="{ open: false, theme: document.documentElement.getAttribute('data-theme') || 'dark' }"
    @keydown.escape.window="open = false"
    class="relative"
>
    <div class="flex items-center justify-between py-4">
        <a href="/" class="rounded-sm font-brand text-[22px] text-paper focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink">Gna.Léger</a>

        <div class="hidden items-center gap-2 md:flex">
            @foreach ($links as $link)
                <a
                    href="{{ $link['href'] }}"
                    class="rounded-card px-3 py-1.5 text-base font-bold transition focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink {{ $link['active'] ? 'bg-paper text-ink' : 'text-paper/70 hover:text-paper' }}"
                >
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>

        <div class="flex items-center gap-2">
            <button
                type="button"
                @click="
                    theme = theme === 'dark' ? 'light' : 'dark';
                    document.documentElement.setAttribute('data-theme', theme);
                    localStorage.setItem('theme', theme);
                "
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-paper/30 text-paper transition hover:border-paper focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink"
                :aria-label="theme === 'dark' ? 'Passer en mode clair' : 'Passer en mode sombre'"
            >
                <svg x-show="theme === 'dark'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                    <circle cx="12" cy="12" r="5"></circle>
                    <line x1="12" y1="1" x2="12" y2="3"></line>
                    <line x1="12" y1="21" x2="12" y2="23"></line>
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                    <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                    <line x1="1" y1="12" x2="3" y2="12"></line>
                    <line x1="21" y1="12" x2="23" y2="12"></line>
                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                    <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                </svg>
                <svg x-show="theme === 'light'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5">
                    <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                </svg>
            </button>

            <button
                type="button"
                @click="open = !open"
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-paper text-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink md:hidden"
                :aria-label="open ? 'Fermer le menu' : 'Ouvrir le menu'"
                :aria-expanded="open"
            >
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="h-5 w-5">
                    <line x1="4" y1="7" x2="20" y2="7"></line>
                    <line x1="4" y1="12" x2="20" y2="12"></line>
                    <line x1="4" y1="17" x2="20" y2="17"></line>
                </svg>
                <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="h-5 w-5">
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                    <line x1="6" y1="18" x2="18" y2="6"></line>
                </svg>
            </button>
        </div>
    </div>

    <x-burger-menu :links="$links" />
</nav>
