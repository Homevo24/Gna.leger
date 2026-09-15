{{--
    Gabarit partagé par toutes les pages d'erreur (404, 403, 500, 503, ...).
    Attend $code, $title, $message. Page volontairement autonome (pas de layout
    partagé, pas de navbar/footer) pour rester robuste même en cas d'erreur serveur.
--}}
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $code }} — {{ $title }}</title>

        <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=space-grotesk:400,700|black-ops-one:400&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="flex min-h-screen flex-col items-center justify-center bg-ink px-6 py-12 text-center font-sans text-paper antialiased">
        <a href="{{ url('/') }}" class="rounded-sm font-brand text-2xl text-paper focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink">
            Gn
        </a>

        <div class="mt-10 w-full max-w-md rounded-panel border border-paper/10 bg-ink p-10">
            <p class="font-display text-6xl font-bold text-paper">{{ $code }}</p>
            <p class="mt-4 font-display text-xl font-semibold text-paper">{{ $title }}</p>
            <p class="mt-3 text-sm text-paper/70">{{ $message }}</p>

            <div class="mt-8 flex justify-center">
                <x-pill-button label="Retour à l'accueil" variant="light" :href="url('/')" />
            </div>
        </div>
    </body>
</html>
