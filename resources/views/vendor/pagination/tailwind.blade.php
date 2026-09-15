@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between gap-4">
        <div>
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center rounded-full px-4 py-2 text-sm font-medium text-paper/30">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex items-center rounded-full px-4 py-2 text-sm font-medium text-paper/70 transition hover:bg-paper/5 hover:text-paper focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink">
                    {!! __('pagination.previous') !!}
                </a>
            @endif
        </div>

        <div class="flex items-center gap-1">
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span class="px-2 text-sm text-paper/40">{{ $element }}</span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page" class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-paper text-sm font-medium text-ink">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="inline-flex h-8 w-8 items-center justify-center rounded-full text-sm font-medium text-paper/70 transition hover:bg-paper/5 hover:text-paper focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        <div>
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex items-center rounded-full px-4 py-2 text-sm font-medium text-paper/70 transition hover:bg-paper/5 hover:text-paper focus:outline-none focus-visible:ring-2 focus-visible:ring-paper focus-visible:ring-offset-2 focus-visible:ring-offset-ink">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="inline-flex items-center rounded-full px-4 py-2 text-sm font-medium text-paper/30">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>
    </nav>
@endif
