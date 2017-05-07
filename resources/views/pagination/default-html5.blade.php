@if ($paginator->lastPage() > 1)
    <nav class="pagination">
        <span class="pagination-meta">Page {{ $paginator->currentPage() }} of {{ $paginator->lastPage() }}</span>
        <!-- if actual page is not equals 1, and there is more than 5 pages then I show first page button -->
        {{--@if ($paginator->currentPage() > 2)@endif--}}
        <a href="{{ $paginator->url($paginator->url(1)) }}" class="{{ ($paginator->currentPage() > 2) ? ' disabled inactive' : '' }}">
            <<
        </a>

        <a href="{{ $paginator->url($paginator->currentPage()-1) }}"  class="{{ ($paginator->currentPage() == 1) ? ' disabled inactive' : '' }}">
            <
        </a>
        <!-- I draw the pages... I show 3 pages back and 3 pages forward -->
        {{--@if($paginator->currentPage() > 1)@endif--}}
        @for($i = max($paginator->currentPage()-2, 1); $i <= min(max($paginator->currentPage()-2, 1)+5,$paginator->lastPage()); $i++)
            <a href="{{ $paginator->url($i) }}" class="{{ ($paginator->currentPage() == $i) ? ' current' : '' }}">{{ $i }}</a>
        @endfor

        {{--@if ($paginator->currentPage() != $paginator->lastPage())@endif--}}

        <a href="{{ ($paginator->currentPage() < $paginator->lastPage() ? $paginator->url($paginator->currentPage()+1) : $paginator->url($paginator->currentPage())) }}"   class="{{($paginator->currentPage() != $paginator->lastPage() ? ' disabled inactive' : '')}}">
            >
        </a>

        {{--@if ($paginator->currentPage() < $paginator->lastPage() - 2)@endif--}}
        <a href="{{ $paginator->url($paginator->lastPage()) }}"  class="{{($paginator->currentPage() < $paginator->lastPage() - 2 ? ' disabled inactive' : '')}}">
            >>
        </a>

    </nav>
@endif