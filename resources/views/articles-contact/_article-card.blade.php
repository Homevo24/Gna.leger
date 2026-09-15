{{-- Attend une variable $article (App\Models\Article). --}}
<div class="rounded-card border border-paper/10 bg-ink p-6 text-paper">
    <p class="text-xs text-paper/50">{{ $article->published_at->format('d/m/Y') }}</p>
    <h3 class="mt-2 font-display text-lg font-semibold">{{ $article->title }}</h3>
    <p class="mt-3 text-sm text-paper/70">{{ $article->excerpt }}</p>
</div>
