@extends('layouts.app')

@section('title', 'Parcours & Projets — ' . config('app.name'))

@section('content')

    <section class="mx-auto max-w-5xl">
        <x-section-label label="Parcours" size="lg" />

        <div class="mt-6 rounded-panel border border-paper/10 bg-ink p-10 text-paper md:p-16">
            @if ($experiences->isEmpty())
                <p class="text-center text-sm text-paper/50">Le parcours sera bientôt complété.</p>
            @else
                <div class="space-y-10">
                    @foreach ($experiences as $experience)
                        <div class="border-l border-paper/20 pl-6">
                            <p class="text-xs text-paper/50">
                                {{ $experience->start_date->format('Y') }}
                                —
                                {{ $experience->end_date ? $experience->end_date->format('Y') : 'Aujourd’hui' }}
                            </p>
                            <h3 class="mt-1 font-display text-xl font-semibold">
                                {{ $experience->role }} <span class="text-paper/60">— {{ $experience->company }}</span>
                            </h3>
                            @if ($experience->location)
                                <p class="mt-1 text-sm text-paper/50">{{ $experience->location }}</p>
                            @endif
                            <p class="mt-3 max-w-2xl text-sm text-paper/70">{{ $experience->description }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="mx-auto mt-16 max-w-5xl">
        <x-section-label label="Projets" size="lg" />

        <div class="mt-6 rounded-panel border border-paper/10 bg-ink p-10 md:p-16">
            @if ($projects->isEmpty())
                <p class="text-center text-sm text-paper/50">Les projets arrivent bientôt.</p>
            @else
                {{-- Desktop : grille complète, inchangée. --}}
                <div class="hidden gap-6 md:grid md:grid-cols-2">
                    @foreach ($projects as $project)
                        @include('parcours-projets._project-card', ['project' => $project])
                    @endforeach
                </div>

                {{-- Mobile : carrousel, deux projets par page. --}}
                @php
                    $projectSlides = $projects->chunk(2)->values();
                @endphp

                <div x-data="{ slide: 0 }" class="md:hidden">
                    @foreach ($projectSlides as $index => $slideProjects)
                        <div x-show="slide === {{ $index }}" x-cloak class="grid gap-6">
                            @foreach ($slideProjects as $project)
                                @include('parcours-projets._project-card', ['project' => $project])
                            @endforeach
                        </div>
                    @endforeach

                    <x-carousel-nav
                        :total="$projectSlides->count()"
                        label-prev="Projets précédents"
                        label-next="Projets suivants"
                    />
                </div>
            @endif
        </div>
    </section>

@endsection
