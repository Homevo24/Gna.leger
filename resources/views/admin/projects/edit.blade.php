@extends('layouts.admin')

@section('title', 'Modifier ' . $project->title . ' — ' . config('app.name'))

@section('content')

    <div class="flex items-center justify-between">
        <h1 class="font-display text-2xl font-semibold text-paper">Modifier le projet</h1>
        <a href="{{ route('admin.projects.index') }}" class="rounded-sm text-sm text-paper/50 transition hover:text-paper focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink">
            ← Retour à la liste
        </a>
    </div>

    <div class="mt-6 rounded-card border border-paper/10 bg-ink p-6">
        <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data">
            @method('PUT')
            @include('admin.projects._form')
        </form>
    </div>

@endsection
