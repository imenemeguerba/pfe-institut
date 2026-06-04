@if ($paginator->hasPages())
<nav class="sh-pag-nav">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
        <span class="sh-pag-btn sh-pag-disabled">
            <i class="fa-solid fa-chevron-left"></i>
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="sh-pag-btn">
            <i class="fa-solid fa-chevron-left"></i>
        </a>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="sh-pag-btn sh-pag-dots">{{ $element }}</span>
        @endif
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="sh-pag-btn sh-pag-active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="sh-pag-btn">{{ $page }}</a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="sh-pag-btn">
            <i class="fa-solid fa-chevron-right"></i>
        </a>
    @else
        <span class="sh-pag-btn sh-pag-disabled">
            <i class="fa-solid fa-chevron-right"></i>
        </span>
    @endif
</nav>
@endif
