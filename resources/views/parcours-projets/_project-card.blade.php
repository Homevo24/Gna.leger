{{-- Attend une variable $project (App\Models\Project, avec skills chargées). --}}
<div class="flex flex-col rounded-card border border-paper/10 bg-ink p-6 text-paper">
    @if ($project->image_path)
        <img
            src="{{ asset('storage/' . $project->image_path) }}"
            alt="Aperçu visuel du projet {{ $project->title }}"
            class="mb-4 aspect-video w-full rounded-card object-cover"
        >
    @endif

    <h3 class="font-display text-lg font-semibold">{{ $project->title }}</h3>

    @if ($project->skills->isNotEmpty())
        <div class="mt-3 flex flex-wrap gap-2">
            @foreach ($project->skills as $skill)
                <x-tag :label="$skill->name" />
            @endforeach
        </div>
    @endif

    <p class="mt-3 text-sm text-paper/70">{{ $project->description }}</p>

    <div class="mt-6">
        <x-pill-button label="Voir le projet" variant="light" :href="route('projects.show', $project)" />
    </div>
</div>
