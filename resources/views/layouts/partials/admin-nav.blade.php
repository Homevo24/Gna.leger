@php
    $navItems = [
        ['label' => 'Dashboard', 'href' => route('admin.dashboard'), 'active' => request()->routeIs('admin.dashboard')],
        ['label' => 'Projets', 'href' => route('admin.projects.index'), 'active' => request()->routeIs('admin.projects.*')],
        ['label' => 'Compétences', 'href' => route('admin.skills.index'), 'active' => request()->routeIs('admin.skills.*')],
        ['label' => 'Parcours', 'href' => route('admin.experiences.index'), 'active' => request()->routeIs('admin.experiences.*')],
        ['label' => 'Articles', 'href' => route('admin.articles.index'), 'active' => request()->routeIs('admin.articles.*')],
        ['label' => 'Candidatures', 'href' => route('admin.job-applications.index'), 'active' => request()->routeIs('admin.job-applications.*')],
    ];
@endphp

<nav class="flex flex-col gap-1">
    @foreach ($navItems as $item)
        <a
            href="{{ $item['href'] }}"
            class="rounded-card px-4 py-2 text-sm font-medium transition focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink {{ $item['active'] ? 'bg-paper text-ink' : 'text-paper/70 hover:bg-white/5 hover:text-paper' }}"
        >
            {{ $item['label'] }}
        </a>
    @endforeach
</nav>

<div class="mt-8 space-y-1 border-t border-paper/10 pt-6">
    <a
        href="{{ route('profil') }}"
        class="block rounded-card px-4 py-2 text-sm font-medium text-paper/70 transition hover:bg-white/5 hover:text-paper focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink"
    >
        Voir le site public
    </a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button
            type="submit"
            class="w-full rounded-card px-4 py-2 text-left text-sm font-medium text-paper/70 transition hover:bg-white/5 hover:text-paper focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink"
        >
            Se déconnecter
        </button>
    </form>
</div>
