@extends('layouts.admin')

@section('title', 'Projets — ' . config('app.name'))

@section('content')

    <div class="flex items-center justify-between">
        <h1 class="font-display text-2xl font-semibold text-paper">Projets</h1>
        <x-pill-button label="Nouveau projet" variant="light" :href="route('admin.projects.create')" />
    </div>

    @if (session('status'))
        <p class="mt-6 rounded-card bg-paper px-4 py-3 text-sm text-ink">
            {{ session('status') }}
        </p>
    @endif

    <div class="mt-6 overflow-x-auto rounded-card border border-paper/10 bg-ink">
        @if ($projects->isEmpty())
            <p class="p-10 text-center text-sm text-paper/50">Aucun projet pour l'instant.</p>
        @else
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-paper/10 text-paper/50">
                        <th class="px-6 py-4 font-medium">Titre</th>
                        <th class="px-6 py-4 font-medium">Statut</th>
                        <th class="px-6 py-4 font-medium">Vedette</th>
                        <th class="px-6 py-4 font-medium">Créé le</th>
                        <th class="px-6 py-4 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr class="border-b border-paper/5 last:border-0">
                            <td class="px-6 py-4 font-medium text-paper">{{ $project->title }}</td>
                            <td class="px-6 py-4">
                                <x-tag :label="$project->status === 'published' ? 'Publié' : 'Brouillon'" />
                            </td>
                            <td class="px-6 py-4 text-paper/70">{{ $project->featured ? 'Oui' : 'Non' }}</td>
                            <td class="px-6 py-4 text-paper/70">{{ $project->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="rounded-sm text-paper/70 underline transition hover:text-paper focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink">
                                        Modifier
                                    </a>
                                    <form
                                        method="POST"
                                        action="{{ route('admin.projects.destroy', $project) }}"
                                        onsubmit="return confirm('Supprimer définitivement « {{ $project->title }} » ?');"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-sm text-red-500 underline transition hover:text-red-400 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2 focus-visible:ring-offset-ink">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <div class="mt-6">
        {{ $projects->links() }}
    </div>

@endsection
