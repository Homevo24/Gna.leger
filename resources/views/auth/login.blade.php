<x-guest-layout>
    <x-auth-session-status class="mb-6 text-center" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="text-sm font-medium text-paper">Email</label>
            <input
                id="email"
                name="email"
                type="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="admin@example.com"
                class="mt-1 w-full rounded-card border border-ink/15 bg-paper px-4 py-3 text-sm text-ink placeholder:text-ink/30 focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
            >
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div>
            <label for="password" class="text-sm font-medium text-paper">Mot de passe</label>
            <input
                id="password"
                name="password"
                type="password"
                required
                autocomplete="current-password"
                placeholder="••••••••"
                class="mt-1 w-full rounded-card border border-ink/15 bg-paper px-4 py-3 text-sm text-ink placeholder:text-ink/30 focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
            >
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="flex items-center justify-between gap-4">
            <label for="remember_me" class="inline-flex items-center gap-2 text-sm text-paper/70">
                <input id="remember_me" type="checkbox" name="remember" class="h-4 w-4 rounded border-ink/30 text-ink focus:ring-ink">
                Se souvenir de moi
            </label>

            @if (Route::has('password.request'))
                <a
                    href="{{ route('password.request') }}"
                    class="rounded-sm text-sm text-paper/50 transition hover:text-paper focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink"
                >
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <x-pill-button label="Se connecter" variant="light" type="submit" class="w-full justify-center" />
    </form>
</x-guest-layout>
