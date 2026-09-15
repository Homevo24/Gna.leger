@php
    $endDateValue = old('end_date', optional($experience->end_date)->format('Y-m-d'));
    $isCurrent = ! old('end_date', $experience->end_date);
@endphp

@csrf

<div class="grid gap-6 md:grid-cols-2">
    <div>
        <label for="company" class="text-sm font-medium text-paper">Entreprise</label>
        <input
            id="company"
            name="company"
            type="text"
            value="{{ old('company', $experience->company) }}"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >
        @error('company')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="role" class="text-sm font-medium text-paper">Rôle</label>
        <input
            id="role"
            name="role"
            type="text"
            value="{{ old('role', $experience->role) }}"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >
        @error('role')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="location" class="text-sm font-medium text-paper">Lieu</label>
        <input
            id="location"
            name="location"
            type="text"
            value="{{ old('location', $experience->location) }}"
            placeholder="Optionnel"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >
        @error('location')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="start_date" class="text-sm font-medium text-paper">Date de début</label>
        <input
            id="start_date"
            name="start_date"
            type="date"
            value="{{ old('start_date', optional($experience->start_date)->format('Y-m-d')) }}"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >
        @error('start_date')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div x-data="{ current: {{ $isCurrent ? 'true' : 'false' }}, endDate: '{{ $endDateValue }}' }">
        <label for="end_date" class="text-sm font-medium text-paper">Date de fin</label>
        <input
            id="end_date"
            name="end_date"
            type="date"
            x-model="endDate"
            :disabled="current"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20 disabled:bg-ink/5 disabled:text-ink/40"
        >
        <label class="mt-2 inline-flex items-center gap-2 text-sm text-paper/70">
            <input
                type="checkbox"
                x-model="current"
                @change="if (current) endDate = ''"
                class="h-4 w-4 rounded border-ink/30 text-ink focus:ring-ink"
            >
            Poste actuel
        </label>
        @error('end_date')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="description" class="text-sm font-medium text-paper">Description</label>
        <textarea
            id="description"
            name="description"
            rows="5"
            class="mt-1 w-full rounded-card border border-ink/15 bg-white px-4 py-3 text-sm text-ink focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
        >{{ old('description', $experience->description) }}</textarea>
        @error('description')
            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="mt-8">
    <x-pill-button label="Enregistrer" variant="light" type="submit" />
</div>
