@extends('layouts.admin')

@section('title', 'Candidatures — ' . config('app.name'))

@section('content')

    <div class="flex items-center justify-between">
        <h1 class="font-display text-2xl font-semibold text-paper">Candidatures</h1>
        <x-pill-button label="Nouvelle candidature" variant="light" :href="route('admin.job-applications.create')" />
    </div>

    @if (session('status'))
        <p class="mt-6 rounded-card bg-paper px-4 py-3 text-sm text-ink">
            {{ session('status') }}
        </p>
    @endif

    <div class="mt-6 flex flex-wrap gap-2">
        <a
            href="{{ route('admin.job-applications.index') }}"
            class="inline-flex items-center rounded-full border border-paper/15 px-4 py-2 text-sm font-medium transition focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink {{ is_null($activeStatus) ? 'bg-paper text-ink' : 'text-paper/70 hover:text-paper' }}"
        >
            Tous
        </a>
        @foreach ($statusLabels as $value => $label)
            <a
                href="{{ route('admin.job-applications.index', ['status' => $value]) }}"
                class="inline-flex items-center rounded-full border border-paper/15 px-4 py-2 text-sm font-medium transition focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink {{ $activeStatus === $value ? 'bg-paper text-ink' : 'text-paper/70 hover:text-paper' }}"
            >
                {{ $label }}
            </a>
        @endforeach
    </div>

    <div class="mt-6 overflow-x-auto rounded-card border border-paper/10 bg-ink">
        @if ($jobApplications->isEmpty())
            <p class="p-10 text-center text-sm text-paper/50">Aucune candidature pour l'instant.</p>
        @else
            <table class="w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-paper/10 text-paper/50">
                        <th class="px-6 py-4 font-medium">Entreprise</th>
                        <th class="px-6 py-4 font-medium">Poste</th>
                        <th class="px-6 py-4 font-medium">Statut</th>
                        <th class="px-6 py-4 font-medium">Date</th>
                        <th class="px-6 py-4 font-medium">Offre</th>
                        <th class="px-6 py-4 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobApplications as $jobApplication)
                        <tr class="border-b border-paper/5 last:border-0">
                            <td class="px-6 py-4 font-medium text-paper">{{ $jobApplication->company }}</td>
                            <td class="px-6 py-4 text-paper/70">{{ $jobApplication->position }}</td>
                            <td class="px-6 py-4">
                                <x-tag color="accent" :label="$jobApplication->status_label" />
                            </td>
                            <td class="px-6 py-4 text-paper/70">{{ $jobApplication->applied_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                @if ($jobApplication->offer_url)
                                    <a href="{{ $jobApplication->offer_url }}" target="_blank" rel="noopener" class="rounded-sm text-paper/70 underline transition hover:text-paper focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink">
                                        Voir l'offre
                                    </a>
                                @else
                                    <span class="text-paper/30">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <a href="{{ route('admin.job-applications.edit', $jobApplication) }}" class="rounded-sm text-paper/70 underline transition hover:text-paper focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink">
                                        Modifier
                                    </a>
                                    <form
                                        method="POST"
                                        action="{{ route('admin.job-applications.destroy', $jobApplication) }}"
                                        onsubmit="return confirm('Supprimer définitivement cette candidature chez « {{ $jobApplication->company }} » ?');"
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
        {{ $jobApplications->links() }}
    </div>

@endsection
