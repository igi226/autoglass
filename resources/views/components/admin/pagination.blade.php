@php
    $link_limit = 7;
@endphp
@if ($paginator->lastPage() > 1)
<p>
    Showing {{ ($paginator->currentPage() - 1)*$paginator->perPage() + 1 }}
     to 
     {{ ($paginator->currentPage() - 1)*$paginator->perPage() + $paginator->perPage() }} 
     Of {{$paginator->total()}} Records
</p>
<ul class="pagination">
    <li class="{{ ($paginator->onFirstPage() == 1) ? ' disabled' : '' }}">
        <a href="{{ $paginator->url(1) }}">
            First Page
        </a>
     </li>
    @for ($i = 1; $i <= $paginator->lastPage(); $i++)
        <?php
        $half_total_links = floor($link_limit / 2);
        $from = $paginator->currentPage() - $half_total_links;
        $to = $paginator->currentPage() + $half_total_links;
        if ($paginator->currentPage() < $half_total_links) {
           $to += $half_total_links - $paginator->currentPage();
        }
        if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
            $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
        }
        ?>
        @if ($from < $i && $i < $to)
            <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </li>
        @endif
    @endfor
    <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
        <a href="{{ $paginator->url($paginator->lastPage()) }}">
            Last page
        </a>
    </li>
</ul>
@endif