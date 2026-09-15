@csrf

<div class="grid gap-6 md:grid-cols-2">
    <div class="md:col-span-2">
        <label for="title" class="text-sm font-medium text-paper">Titre</label>
        <input
            id="title"
            name="title"
            type="text"
            value="{{ old('title', $project->title) }}"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >
        @error('title')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="description" class="text-sm font-medium text-paper">Description courte</label>
        <textarea
            id="description"
            name="description"
            rows="2"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >{{ old('description', $project->description) }}</textarea>
        @error('description')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="content" class="text-sm font-medium text-paper">Contenu détaillé</label>
        <textarea
            id="content"
            name="content"
            rows="8"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >{{ old('content', $project->content) }}</textarea>
        @error('content')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="status" class="text-sm font-medium text-paper">Statut</label>
        <select
            id="status"
            name="status"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >
            <option value="draft" @selected(old('status', $project->status) === 'draft')>Brouillon</option>
            <option value="published" @selected(old('status', $project->status) === 'published')>Publié</option>
        </select>
        @error('status')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-end">
        <label class="inline-flex items-center gap-2 text-sm font-medium text-paper">
            <input
                type="checkbox"
                name="featured"
                value="1"
                @checked(old('featured', $project->featured))
                class="h-4 w-4 rounded border-ink/30 text-ink focus:ring-ink"
            >
            Projet mis en avant
        </label>
    </div>

    <div>
        <label for="demo_url" class="text-sm font-medium text-paper">URL de démo</label>
        <input
            id="demo_url"
            name="demo_url"
            type="url"
            value="{{ old('demo_url', $project->demo_url) }}"
            placeholder="https://…"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >
        @error('demo_url')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="repo_url" class="text-sm font-medium text-paper">URL du dépôt</label>
        <input
            id="repo_url"
            name="repo_url"
            type="url"
            value="{{ old('repo_url', $project->repo_url) }}"
            placeholder="https://…"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >
        @error('repo_url')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="image" class="text-sm font-medium text-paper">Image</label>

        @if ($project->image_path)
            <img
                src="{{ asset('storage/' . $project->image_path) }}"
                alt="Image actuelle du projet {{ $project->title }}"
                class="mt-2 mb-3 aspect-video w-full max-w-sm rounded-card object-cover"
            >
        @endif

        <input
            id="image"
            name="image"
            type="file"
            accept="image/*"
            class="mt-1 block w-full text-sm text-paper file:mr-4 file:rounded-full file:border-0 file:bg-paper file:px-4 file:py-2 file:text-sm file:font-medium file:text-ink"
        >
        @error('image')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <p class="text-sm font-medium text-paper">Compétences</p>
        <div class="mt-2 flex flex-wrap gap-x-6 gap-y-2">
            @forelse ($skills as $skill)
                <label class="inline-flex items-center gap-2 text-sm text-paper/80">
                    <input
                        type="checkbox"
                        name="skills[]"
                        value="{{ $skill->id }}"
                        @checked(collect(old('skills', $project->skills->pluck('id')->all()))->contains($skill->id))
                        class="h-4 w-4 rounded border-ink/30 text-ink focus:ring-ink"
                    >
                    {{ $skill->name }}
                </label>
            @empty
                <p class="text-sm text-paper/50">
                    Aucune compétence pour l'instant — <a href="{{ route('admin.skills.create') }}" class="rounded-sm underline focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink">crées-en une</a>.
                </p>
            @endforelse
        </div>
        @error('skills')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-8">
    <x-pill-button label="Enregistrer" variant="light" type="submit" />
</div>
