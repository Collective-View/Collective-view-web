@if($paginator->hasPages())
    <div class="pagination-wrap">
        <p class="pagination-info">
            Mostrando {{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}
            de {{ $paginator->total() }} publicaciones
        </p>

        <div class="pagination-buttons">
            {{-- Anterior --}}
            @if($paginator->onFirstPage())
                <span class="page-btn page-btn--disabled">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="page-btn">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </a>
            @endif

            {{-- Números --}}
            @foreach($paginator->links()->elements[0] as $page => $url)
                @if(is_string($page) && $page === '...')
                    <span class="page-btn page-btn--dots">…</span>
                @elseif($page == $paginator->currentPage())
                    <span class="page-btn page-btn--active">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-btn">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Siguiente --}}
            @if($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="page-btn">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            @else
                <span class="page-btn page-btn--disabled">
                    <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </span>
            @endif
        </div>
    </div>
@endif