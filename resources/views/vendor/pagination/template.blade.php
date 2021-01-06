@if ($paginator->hasPages())
<div class="hb-pagination">
	<ul class="list-unstyled">
		@if ($paginator->onFirstPage())
		<li class="hb-prevpage disable">
			<a href="javascript:void(0);"><i class="fa fa-angle-double-left"></i>prev</a>
		</li>
		@else
		<li class="hb-prevpage disable">
			<a href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-double-left"></i>prev</a>
		</li>
		@endif
		<!--************************************
		@foreach ($elements as $element)
			@if (is_array($element))
				@foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
	                    <li class="active bg-primary">
	                    	<a href="{{ $url }}">{{ $page }}</a>
	                    </li>
                    @else
                    	<li>
	                    	<a href="{{ $url }}">{{ $page }}</a>
	                    </li>
                    @endif
                    
					@if($loop->iteration > 2)
					@break
					@else
					@endif
                @endforeach
			@endif


		@endforeach
		*************************************-->

		@if ($paginator->hasMorePages())
		<li class="hb-nextpage">
			<a href="{{ $paginator->nextPageUrl() }}" >next <i class="fa fa-angle-double-right"></i></a>
		</li>
		@else
		<li class="hb-nextpage disable" style="background-color: #CABFBF;">
			<a href="javascript:void(0);" >next <i class="fa fa-angle-double-right"></i></a>
		</li>
		@endif
	</ul>

</div>
	<p class="text-sm text-gray-700 leading-5 float-left">
		{!! __('Showing') !!}
		<span class="font-medium">{{ $paginator->firstItem() }}</span>
		{!! __('to') !!}
		<span class="font-medium">{{ $paginator->lastItem() }}</span>
		{!! __('of') !!}
		<span class="font-medium">{{ $paginator->total() }}</span>
		{!! __('results') !!}
	</p>
@endif