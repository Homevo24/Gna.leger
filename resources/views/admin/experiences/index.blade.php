@extends('layouts.admin')

@section('title', 'Parcours — ' . config('app.name'))

@section('content')

    <div class="flex items-center justify-between">
        <h1 class="font-display text-2xl font-semibold text-paper">Parcours</h1>
        <x-pill-button label="Nouvelle expérience" variant="light" :href="route('admin.experiences.create')" />
    </div>

    @if (session('status'))
        <p class="mt-6 rounded-card bg-paper px-4 py-3 text-sm text-ink">
            {{ session('status') }}
        </p>
    @endif

    <div class="mt-6 overflow-x-auto rounded-card border border-paper/10 bg-ink">
        @if ($experiences->isEmpty())
            <p class="p-10 text-center text-sm text-paper/50">Aucune expérience pour l'instant.</p>
        @else
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-paper/10 text-paper/50">
                        <th class="px-6 py-4 font-medium">Entreprise</th>
                        <th class="px-6 py-4 font-medium">Rôle</th>
                        <th class="px-6 py-4 font-medium">Période</th>
                        <th class="px-6 py-4 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($experiences as $experience)
                        <tr class="border-b border-paper/5 last:border-0">
                            <td class="px-6 py-4 font-medium text-paper">{{ $experience->company }}</td>
                            <td class="px-6 py-4 text-paper/70">{{ $experience->role }}</td>
                            <td class="px-6 py-4 text-paper/70">
                                {{ $experience->start_date->format('Y') }}
                                —
                                {{ $experience->end_date ? $experience->end_date->format('Y') : 'présent' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('admin.experiences.edit', $experience) }}" class="rounded-sm text-paper/70 underline transition hover:text-paper focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink">
                                        Modifier
                                    </a>
                                    <form
                                        method="POST"
                                        action="{{ route('admin.experiences.destroy', $experience) }}"
                                        onsubmit="return confirm('Supprimer définitivement cette expérience chez « {{ $experience->company }} » ?');"
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
        {{ $experiences->links() }}
    </div>

@endsection
