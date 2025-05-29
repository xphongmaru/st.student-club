@if ($paginator->hasPages())
    <nav>
        <ul class="custom-pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><span>«</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" wire:click.prevent="previousPage">«</a></li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}" wire:click.prevent="gotoPage({{ $page }})">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" wire:click.prevent="nextPage">»</a></li>
            @else
                <li class="disabled"><span>»</span></li>
            @endif
        </ul>
    </nav>
@endif
