@extends('layouts.admin')

@section('title', 'Modifier ' . $skill->name . ' — ' . config('app.name'))

@section('content')

    <div class="flex items-center justify-between">
        <h1 class="font-display text-2xl font-semibold text-paper">Modifier la compétence</h1>
        <a href="{{ route('admin.skills.index') }}" class="rounded-sm text-sm text-paper/50 transition hover:text-paper focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink">
            ← Retour à la liste
        </a>
    </div>

    <div class="mt-6 rounded-card border border-paper/10 bg-ink p-6">
        <form method="POST" action="{{ route('admin.skills.update', $skill) }}">
            @method('PUT')
            @include('admin.skills._form')
        </form>
    </div>

@endsection
