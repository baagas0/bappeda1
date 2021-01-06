@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endpush
@section('content')
<main id="hb-main" class="hb-main hb-haslayout">
<!--************************************
			Blog Start
*************************************-->
<section id="hb-blog" class="hb-blog hb-sectionspace hb-haslayout">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 pull-right">
				<div class="hb-post-area hb-bloggrid hb-bloggridfullwidth">
					<div class="row">
						@foreach($igs as $ig)
						<div class="col-xs-12 col-sm-6 col-lg-4">
							<article class="hb-post">
								<figure class="hb-postimage">
									@foreach(json_decode($ig->file) as $d)
									@if($loop->iteration > 1 )
									@break
									@endif
									<a href="{{ route('..blog',$ig->id) }}"><img src="{{ asset($d) }}" style="height: 250px;width: auto;" alt="image description"></a>
									@endforeach
								</figure>
								<div class="hb-postcontent">
									<a href="{{ route('..blog',$ig->id) }}" class="hb-postcategory">{{ ($ig->is_sosbud == 1) ? '#PPE' : '' }} {{ ($ig->is_bpsb == 1) ? '#Sosbud' : '' }} {{ ($ig->is_ekonomi == 1) ? '#Ekonomi' : '' }} {{ ($ig->is_infrastruktur == 1) ? '#Infrstruktur' : '' }} {{ ($ig->is_litbang == 1) ? '#Litbang' : '' }}</a>
									<div class="hb-posttitle">
										<h3><a href="{{ route('..blog',$ig->id) }}">{{ Str::limit($ig->caption, 20) }}</a></h3>
									</div>
									<div class="hb-postmeta">
										<span>{{ 'Instagram | '.$ig->created_at->format('d M Y') }}</span>
									</div>
								</div>
							</article>
						</div>
						@endforeach
						<div class="col-xs-12">
						{{ $igs->links('vendor.pagination.template') }}
							
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 pull-left">
				<aside id="hb-sidebar" class="hb-sidebar hb-haslayout">
					<div class="hb-widget hb-recentnews">
						<div class="hb-widgettitle">
							<h3>Recent News</h3>
						</div>
						<ul>
							@foreach($recent as $row)
							<li>
								<h4>{{ Str::limit($row->caption, 40) }}</h4>
								<div class="hb-postmeta">
									<span>{{ $row->created_at->format('d M Y') }}</span>
								</div>
							</li>
							@endforeach
						</ul>
					</div>
				</aside>
			</div>
		</div>
	</div>
</section>
<!--************************************
			Blog End
*************************************-->
		</main>
@endsection	