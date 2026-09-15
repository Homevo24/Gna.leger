<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'Admin — ' . config('app.name'))</title>

        <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('favicon-512x512.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=space-grotesk:400,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-ink font-sans text-paper antialiased" x-data="{ open: false }" @keydown.escape.window="open = false">

        <!-- Barre mobile -->
        <div class="flex items-center justify-between px-6 py-4 md:hidden">
            <span class="font-display text-lg font-semibold text-paper">
                Portfolio <span class="text-paper/40">admin</span>
            </span>

            <button
                type="button"
                @click="open = !open"
                class="flex h-10 w-10 items-center justify-center rounded-full bg-paper text-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink"
                :aria-label="open ? 'Fermer le menu' : 'Ouvrir le menu'"
                :aria-expanded="open"
            >
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="h-5 w-5">
                    <line x1="4" y1="7" x2="20" y2="7"></line>
                    <line x1="4" y1="12" x2="20" y2="12"></line>
                    <line x1="4" y1="17" x2="20" y2="17"></line>
                </svg>
                <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" class="h-5 w-5">
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                    <line x1="6" y1="18" x2="18" y2="6"></line>
                </svg>
            </button>
        </div>

        <!-- Tiroir mobile -->
        <div
            x-show="open"
            x-cloak
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            @click.outside="open = false"
            class="mx-6 mb-6 rounded-panel border border-paper/10 bg-ink p-6 text-paper md:hidden"
        >
            @include('layouts.partials.admin-nav')
        </div>

        <div class="mx-auto flex max-w-6xl gap-8 px-6 pb-16 md:px-10 md:pt-10">
            <!-- Sidebar desktop -->
            <aside class="hidden w-64 shrink-0 rounded-panel border border-paper/10 bg-ink p-6 text-paper md:sticky md:top-10 md:block md:h-fit">
                <p class="font-display text-lg font-semibold">
                    Portfolio <span class="text-paper/40">admin</span>
                </p>

                <div class="mt-8">
                    @include('layouts.partials.admin-nav')
                </div>
            </aside>

            <main class="min-w-0 flex-1 py-6 md:py-0">
                @yield('content')
            </main>
        </div>
    </body>
</html>
