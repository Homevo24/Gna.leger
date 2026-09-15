@extends('layouts.app')

@section('title', $name . ' — ' . config('app.name'))

@section('content')

    <section class="mx-auto max-w-6xl rounded-panel border border-paper/10 bg-ink p-10 text-paper md:p-16">
        <div class="flex flex-col-reverse items-center gap-10 md:flex-row md:items-center md:justify-between md:gap-16">
            <div class="flex-1">
                <p class="font-display text-sm font-semibold text-paper">{{ $jobTitle }}</p>
                <h1 class="mt-3 font-brand text-4xl md:text-5xl">{{ $name }}</h1>

                <div class="mt-6 max-w-2xl space-y-4 text-base text-paper/70 md:text-lg">
                    @foreach ($bio as $paragraph)
                        <p>{!! $paragraph !!}</p>
                    @endforeach
                </div>

                <div class="mt-10 flex flex-wrap items-center gap-4">
                    <x-pill-button label="Voir mon parcours & mes projets" variant="light" :href="route('parcours-projets')" />
                    <x-pill-button label="Me contacter" variant="outline" :href="route('articles-contact') . '#contact'" />
                </div>
            </div>

            <div class="shrink-0">
                <div class="h-48 w-48 overflow-hidden rounded-panel border border-paper/10 bg-paper/5 md:h-64 md:w-64">
                    <img
                        src="{{ asset('images/AvatarL.jpg') }}"
                        alt="Photo de Gnahoui Léger"
                        class="h-full w-full object-cover"
                    >
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto mt-16 max-w-6xl">
        <x-section-label label="Services" size="lg" />

        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($services as $service)
                <div class="flex flex-col rounded-card border border-paper/10 bg-ink p-6">
                    <h3 class="font-display text-lg font-semibold text-paper">{{ $service['title'] }}</h3>
                    <p class="mt-3 text-sm text-paper/70">{{ $service['description'] }}</p>
                    <div class="mt-6 flex flex-col items-start gap-2">
                        @foreach ($service['tags'] as $tag)
                            <x-tag :label="$tag" />
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="mx-auto mt-16 max-w-6xl">
        <x-section-label label="À propos" size="lg" />

        <div class="mt-6 rounded-panel border border-paper/10 bg-ink p-10 md:p-16">
            <p class="mx-auto max-w-2xl text-center text-base text-paper/70 md:text-lg">
                {{ $aboutDescription }}
            </p>

            <p class="mt-10 text-center font-display text-sm font-semibold text-paper/50">Ma méthode</p>

            <div class="mt-4 grid gap-4 md:grid-cols-3">
                @foreach ($approach as $step)
                    <div class="flex items-center gap-4 rounded-card border border-paper/10 bg-ink p-4">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-card bg-paper text-sm font-semibold text-ink">
                            {{ $step['number'] }}
                        </span>
                        <span class="text-sm font-medium text-paper">{{ $step['label'] }}</span>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 grid grid-cols-3 gap-6 text-center">
                @foreach ($stats as $stat)
                    <div>
                        <p class="font-display text-3xl font-semibold text-paper md:text-4xl">{{ $stat['value'] }}</p>
                        <p class="mt-1 text-xs text-paper/60 md:text-sm">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mx-auto mt-16 max-w-6xl">
        <x-section-label label="Compétences" size="lg" />

        @if ($skillsByCategory->isEmpty())
            <div class="mt-6 rounded-panel border border-paper/10 bg-ink p-10">
                <p class="text-center text-sm text-paper/50">Les compétences seront bientôt listées ici.</p>
            </div>
        @else
            <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($categoryLabels as $category => $label)
                    @continue(! $skillsByCategory->has($category))

                    <div class="flex flex-col rounded-card border border-paper/10 bg-ink p-6">
                        <h3 class="font-display text-lg font-semibold text-paper">{{ $label }}</h3>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach ($skillsByCategory->get($category) as $skill)
                                <x-tag :label="$skill->name" />
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

@endsection
