@csrf

<div class="grid gap-6">
    <div>
        <label for="title" class="text-sm font-medium text-paper">Titre</label>
        <input
            id="title"
            name="title"
            type="text"
            value="{{ old('title', $article->title) }}"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >
        @error('title')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="excerpt" class="text-sm font-medium text-paper">Résumé (500 caractères max)</label>
        <textarea
            id="excerpt"
            name="excerpt"
            rows="2"
            maxlength="500"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >{{ old('excerpt', $article->excerpt) }}</textarea>
        @error('excerpt')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="content" class="text-sm font-medium text-paper">Contenu</label>
        <textarea
            id="content"
            name="content"
            rows="10"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >{{ old('content', $article->content) }}</textarea>
        @error('content')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="max-w-xs">
        <label for="published_at" class="text-sm font-medium text-paper">Date de publication</label>
        <input
            id="published_at"
            name="published_at"
            type="datetime-local"
            value="{{ old('published_at', optional($article->published_at)->format('Y-m-d\TH:i')) }}"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >
        <p class="mt-1 text-xs text-paper/40">Laisser vide = brouillon, non visible sur le site public.</p>
        @error('published_at')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-8">
    <x-pill-button label="Enregistrer" variant="light" type="submit" />
</div>
