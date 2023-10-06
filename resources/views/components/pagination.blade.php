@if ($paginator->hasPages())
    <ul class="pagination justify-content-center mt-4 mb-0">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled">
                <a class="page-link paginasi" href="javascript:;" tabindex="-1">
                    <i class="fas fa-angle-left"></i>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link paginasi" halaman="{{ $paginator->previousPageUrl() }}" href="javascript:;"
                    tabindex="-1">
                    <i class="fas fa-angle-left"></i>
                </a>
            </li>
        @endif
        @foreach ($elements as $$element)
            @if (is_string($element))
                <li class="page-item disabled"> <a class="page-link" href="javascript:;">...</a></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active">
                            <a class="page-link" href="javascript:;">{{ $page }}
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link paginasi" halaman="{{ $url }}"
                                href="javascript:;">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link paginasi" halaman="{{ $paginator->nextPageUrl() }}" class="page-link paginasi"
                    tabindex="-1">
                    <i class="fas fa-angle-right"></i>
                </a>
            </li>
        @endif
    </ul>
@endif
