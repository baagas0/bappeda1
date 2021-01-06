

@if ($paginator->hasPages())
<nav aria-label="Page navigation example">
  <ul class="pagination">
    @if ($paginator->onFirstPage())
        <li class="disabled"><span>&laquo;</span></li>
    @else
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
    @endif

    @foreach ($elements as $element)
        @if(is_string($element))
            <li class="disabled"><span>&laquo;</span></li>
        @elseif(is_array($element))
            @foreach ($element as $page => $url)
                @if($page == $paginator->currentPage())
                    <li class="active"><span>{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach

    @if ($paginator->hasMorePages())
        <li class="page-item">
          <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
    @else
        <li class="disabled"><span>&raquo;</span></li>
    @endif
  </ul>
</nav>
@endif