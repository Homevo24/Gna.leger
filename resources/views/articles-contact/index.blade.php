@extends('layouts.app')

@section('title', 'Articles & Contact — ' . config('app.name'))

@section('content')

    <section class="mx-auto max-w-5xl">
        <x-section-label label="Articles" size="lg" />

        <div class="mt-6 rounded-panel border border-paper/10 bg-ink p-10 md:p-16">
            @if ($articles->isEmpty())
                <p class="text-center text-sm text-paper/50">Les premiers articles arrivent bientôt.</p>
            @else
                @php
                    $articleSlidesDesktop = $articles->chunk(4)->values();
                    $articleSlidesMobile = $articles->chunk(2)->values();
                @endphp

                {{-- Desktop : 4 articles par page. --}}
                <div x-data="{ slide: 0 }" class="hidden md:block">
                    @foreach ($articleSlidesDesktop as $index => $slideArticles)
                        <div x-show="slide === {{ $index }}" x-cloak class="grid gap-6 md:grid-cols-2">
                            @foreach ($slideArticles as $article)
                                @include('articles-contact._article-card', ['article' => $article])
                            @endforeach
                        </div>
                    @endforeach

                    <x-carousel-nav
                        :total="$articleSlidesDesktop->count()"
                        label-prev="Articles précédents"
                        label-next="Articles suivants"
                    />
                </div>

                {{-- Mobile : 2 articles par page. --}}
                <div x-data="{ slide: 0 }" class="md:hidden">
                    @foreach ($articleSlidesMobile as $index => $slideArticles)
                        <div x-show="slide === {{ $index }}" x-cloak class="grid gap-6">
                            @foreach ($slideArticles as $article)
                                @include('articles-contact._article-card', ['article' => $article])
                            @endforeach
                        </div>
                    @endforeach

                    <x-carousel-nav
                        :total="$articleSlidesMobile->count()"
                        label-prev="Articles précédents"
                        label-next="Articles suivants"
                    />
                </div>
            @endif
        </div>
    </section>

    <section id="contact" class="mx-auto mt-16 max-w-5xl scroll-mt-6">
        <x-section-label label="Contact" size="lg" />

        <div class="mx-auto mt-6 max-w-xl rounded-panel border border-paper/10 bg-ink p-10">
            @if (session('status'))
                <p class="mb-6 rounded-card bg-paper px-4 py-3 text-sm text-ink">
                    {{ session('status') }}
                </p>
            @endif

            <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="text-sm font-medium text-paper">Nom</label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name') }}"
                        class="mt-1 w-full rounded-card border border-ink/15 bg-paper px-4 py-3 text-sm text-ink placeholder:text-ink/30 focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
                        placeholder="Ton nom"
                    >
                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="text-sm font-medium text-paper">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email') }}"
                        class="mt-1 w-full rounded-card border border-ink/15 bg-paper px-4 py-3 text-sm text-ink placeholder:text-ink/30 focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
                        placeholder="ton@email.com"
                    >
                    @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="message" class="text-sm font-medium text-paper">Message</label>
                    <textarea
                        id="message"
                        name="message"
                        rows="5"
                        class="mt-1 w-full rounded-card border border-ink/15 bg-paper px-4 py-3 text-sm text-ink placeholder:text-ink/30 focus:border-ink focus:outline-none focus-visible:ring-2 focus-visible:ring-ink/20"
                        placeholder="Ton message"
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <x-pill-button label="Envoyer" variant="light" type="submit" />
            </form>
        </div>
    </section>

@endsection
