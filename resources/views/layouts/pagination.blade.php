@if ($paginator->hasPages())
    <div class="paginator">  
        <ul class="page">
            {{-- Enlace "Anterior" --}}
            @if ($paginator->onFirstPage())
                <li class="page__btn">
                    <i class='bx bx-chevron-left'></i>
                </li>
            @else
                <a class="pagination__link" href="{{ $paginator->previousPageUrl() }}">
                    <li class="page__btn">
                        <i class='bx bx-chevron-left'></i>
                    </li>
                </a>
            @endif

            {{-- Elementos de la paginación --}}
            @foreach ($elements as $element)
                {{-- "..." se mostrará si hay muchas páginas --}}
                @if (is_string($element))
                    <li class="page__numbers">{{ $element }}</li>
                @endif

                {{-- Páginas --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page__numbers active">{{ $page }}</li>
                        @else
                            <a href="{{ $url }}">
                                <li class="page__numbers">
                                    {{ $page }}
                                </li>
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Enlace "Siguiente" --}}
            @if ($paginator->hasMorePages())
                <a class="pagination__link" href="{{ $paginator->nextPageUrl() }}">
                    <li class="page__btn">
                        <i class='bx bx-chevron-right'></i>
                    </li>
                </a>
                
            @else
                <li class="page__btn">
                    <i class='bx bx-chevron-right'></i>
                </li>
            @endif
        </ul>
    </div>
@endif
