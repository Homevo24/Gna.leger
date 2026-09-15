@csrf

<div class="grid gap-6 md:grid-cols-2">
    <div>
        <label for="name" class="text-sm font-medium text-paper">Nom</label>
        <input
            id="name"
            name="name"
            type="text"
            value="{{ old('name', $skill->name) }}"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >
        @error('name')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="category" class="text-sm font-medium text-paper">Catégorie</label>
        <select
            id="category"
            name="category"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >
            @foreach (['frontend' => 'Frontend', 'backend' => 'Backend', 'devops' => 'DevOps', 'outils' => 'Outils'] as $value => $label)
                <option value="{{ $value }}" @selected(old('category', $skill->category) === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('category')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="icon" class="text-sm font-medium text-paper">Icône</label>
        <input
            id="icon"
            name="icon"
            type="text"
            value="{{ old('icon', $skill->icon) }}"
            placeholder="Nom d'icône ou chemin (optionnel)"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >
        @error('icon')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-8">
    <x-pill-button label="Enregistrer" variant="light" type="submit" />
</div>
