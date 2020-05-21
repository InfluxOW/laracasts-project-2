@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="flex justify-center text-sm">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li aria-label="@lang('pagination.previous')">
                    <span class="px-4 py-3 text-muted block border border-r-0 border-muted-light rounded-l" aria-hidden="true">&larr;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                       rel="prev"
                       class="px-4 py-3 block text-accent border border-r-0 border-muted-light rounded-l hover:text-white hover:bg-accent "
                       aria-label="@lang('pagination.previous')"
                    >
                        &larr;
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li aria-disabled="true">
                        <span class="px-4 py-3 block text-muted border border-r-0 border-muted-light">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page">
                                <span class="px-4 py-3 block text-white bg-accent border border-r-0 border-muted-light">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                   class="px-4 py-3 block text-accent border border-r-0 border-muted-light hover:text-white hover:bg-accent "
                                   aria-label="@lang('pagination.goto_page', ['page' => $page])"
                                >
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                       rel="next"
                       class="px-4 py-3 block text-accent border border-muted-light rounded-r hover:text-white hover:bg-accent "
                       aria-label="@lang('pagination.next')"
                    >
                        &rarr;
                    </a>
                </li>
            @else
                <li aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="px-4 py-3 block text-muted border border-muted-light rounded-r" aria-hidden="true">&rarr;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
