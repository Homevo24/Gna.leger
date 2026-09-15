@extends('layouts.app')

@section('title', $project->title . ' — ' . config('app.name'))

@section('content')

    <div class="mx-auto max-w-5xl">
        <a href="{{ route('parcours-projets') }}" class="rounded-sm text-sm text-paper/50 transition hover:text-paper focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink">
            ← Retour à Parcours & Projets
        </a>

        <section class="mt-6 rounded-panel border border-paper/10 bg-ink p-10 text-paper md:p-16">
            <h1 class="font-display text-3xl font-semibold md:text-4xl">{{ $project->title }}</h1>

            @if ($project->skills->isNotEmpty())
                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach ($project->skills as $skill)
                        <x-tag :label="$skill->name" />
                    @endforeach
                </div>
            @endif

            @if ($project->image_path)
                <img
                    src="{{ asset('storage/' . $project->image_path) }}"
                    alt="Aperçu visuel du projet {{ $project->title }}"
                    class="mt-8 aspect-video w-full rounded-card object-cover"
                >
            @endif

            <div class="mt-8 max-w-2xl space-y-4 text-base text-paper/70">
                <p>{{ $project->content }}</p>
            </div>

            @if ($project->demo_url || $project->repo_url)
                <div class="mt-10 flex flex-wrap gap-4">
                    @if ($project->demo_url)
                        <x-pill-button label="Voir la démo" variant="light" icon="link" :href="$project->demo_url" />
                    @endif
                    @if ($project->repo_url)
                        <x-pill-button label="Voir le code" variant="light" icon="github" :href="$project->repo_url" />
                    @endif
                </div>
            @endif
        </section>
    </div>

@endsection
