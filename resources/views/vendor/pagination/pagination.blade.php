@if ($paginator->hasPages())
    <div class="pagination-container">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())

            <a href="{{ $paginator->previousPageUrl() }}" class="prevposts-link" aria-disabled="true"><i
                    class="fa fa-chevron-left"></i></a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="prevposts-link"><i class="fa fa-chevron-left"></i></a>
        @endif

        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <a href="#" class="current-page"><span class="page-link">{{ $page }}</span></a>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="nextposts-link"><i class="fa fa-chevron-right"></i></a>
        @else
            <a href="#" class="nextposts-link"><i class="fa fa-chevron-right"></i></a>
        @endif
        {{--    <a href="#" class="prevposts-link"><i class="fa fa-chevron-left"></i></a>--}}
        {{--    <a href="#">1</a>--}}
        {{--    <a href="#" class="current-page">2</a>--}}
        {{--    <a href="#">3</a>--}}
        {{--    <a href="#">4</a>--}}
        {{--    <a href="#" class="nextposts-link"><i class="fa fa-chevron-right"></i></a>--}}
    </div>
@endif
