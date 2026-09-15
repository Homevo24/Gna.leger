<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--
            Applique le thème avant le premier rendu pour éviter le flash :
            choix déjà enregistré (localStorage) sinon préférence système, sinon sombre par défaut.
        -->
        <script>
            (function () {
                var stored = localStorage.getItem('theme');
                var theme = (stored === 'light' || stored === 'dark')
                    ? stored
                    : (window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark');
                document.documentElement.setAttribute('data-theme', theme);
            })();
        </script>

        <title>@yield('title', config('app.name'))</title>

        <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('favicon-512x512.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=space-grotesk:400,700|black-ops-one:400&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-ink font-sans text-paper antialiased">
        <div class="border-b border-paper/10 bg-ink px-6 md:px-10">
            <div class="mx-auto max-w-6xl">
                <x-navbar />
            </div>
        </div>

        <main class="px-6 pt-16">
            @yield('content')
        </main>

        <div class="mx-auto mt-16 max-w-6xl px-6">
            <hr class="border-t border-paper/10">
        </div>

        <x-footer />
    </body>
</html>
