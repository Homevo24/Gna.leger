@csrf

<div class="grid gap-6 md:grid-cols-2">
    <div>
        <label for="company" class="text-sm font-medium text-paper">Entreprise</label>
        <input
            id="company"
            name="company"
            type="text"
            value="{{ old('company', $jobApplication->company) }}"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >
        @error('company')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="position" class="text-sm font-medium text-paper">Poste</label>
        <input
            id="position"
            name="position"
            type="text"
            value="{{ old('position', $jobApplication->position) }}"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >
        @error('position')
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
            @foreach (\App\Models\JobApplication::STATUSES as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $jobApplication->status) === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('status')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="applied_at" class="text-sm font-medium text-paper">Date de candidature</label>
        <input
            id="applied_at"
            name="applied_at"
            type="date"
            value="{{ old('applied_at', optional($jobApplication->applied_at)->format('Y-m-d')) }}"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >
        @error('applied_at')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="salary_range" class="text-sm font-medium text-paper">Fourchette de salaire</label>
        <input
            id="salary_range"
            name="salary_range"
            type="text"
            value="{{ old('salary_range', $jobApplication->salary_range) }}"
            placeholder="Optionnel"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >
        @error('salary_range')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="offer_url" class="text-sm font-medium text-paper">URL de l'offre</label>
        <input
            id="offer_url"
            name="offer_url"
            type="url"
            value="{{ old('offer_url', $jobApplication->offer_url) }}"
            placeholder="https://…"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >
        @error('offer_url')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="notes" class="text-sm font-medium text-paper">Notes</label>
        <textarea
            id="notes"
            name="notes"
            rows="5"
            placeholder="Optionnel"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >{{ old('notes', $jobApplication->notes) }}</textarea>
        @error('notes')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-8">
    <x-pill-button label="Enregistrer" variant="light" type="submit" />
</div>
