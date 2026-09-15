@extends('layouts.admin')

@section('title', 'Dashboard — ' . config('app.name'))

@section('content')

    <h1 class="font-display text-2xl font-semibold text-paper">Dashboard</h1>

    @if ($allZero)
        <div class="mt-6 rounded-panel border border-paper/10 bg-ink p-10 text-center text-paper md:p-16">
            <p class="font-display text-2xl font-semibold">Le dashboard est prêt.</p>
            <p class="mx-auto mt-3 max-w-md text-sm text-paper/70">
                Il n'y a pas encore de données. Commence par ajouter ton premier projet, tu pourras ensuite compléter ton parcours, tes compétences et tes candidatures.
            </p>
            <div class="mt-8 flex justify-center">
                <x-pill-button label="Créer un projet" variant="light" :href="route('admin.projects.create')" />
            </div>
        </div>
    @else
        <div class="mt-6 grid grid-cols-2 gap-4 md:grid-cols-4">
            <div class="rounded-card border border-paper/10 bg-ink p-6">
                <p class="font-display text-3xl font-semibold text-paper">{{ $projectsTotal }}</p>
                <p class="mt-1 text-sm text-paper/60">Projets ({{ $projectsPublished }} publiés)</p>
            </div>
            <div class="rounded-card border border-paper/10 bg-ink p-6">
                <p class="font-display text-3xl font-semibold text-paper">{{ $experiencesTotal }}</p>
                <p class="mt-1 text-sm text-paper/60">Expériences</p>
            </div>
            <div class="rounded-card border border-paper/10 bg-ink p-6">
                <p class="font-display text-3xl font-semibold text-paper">{{ $articlesPublished }}</p>
                <p class="mt-1 text-sm text-paper/60">Articles publiés</p>
            </div>
            <div class="rounded-card border border-paper/10 bg-ink p-6">
                <p class="font-display text-3xl font-semibold text-paper">{{ $jobApplicationsTotal }}</p>
                <p class="mt-1 text-sm text-paper/60">Candidatures</p>
            </div>
        </div>

        <div class="mt-6 rounded-card border border-paper/10 bg-ink p-6">
            <p class="text-sm font-medium text-paper/60">Candidatures par statut</p>
            <div class="mt-3 flex flex-wrap gap-2">
                @foreach ($statusLabels as $status => $label)
                    <x-tag color="accent" :label="$label . ' · ' . $jobApplicationsByStatus->get($status, 0)" />
                @endforeach
            </div>
        </div>
    @endif

@endsection
