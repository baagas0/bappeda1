@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endpush
@section('content')
<main id="hb-main" class="hb-main hb-haslayout">
<!--************************************
			Blog Start
*************************************-->
<style>
	.hoper:hover{
		background-color:red;
		padding:10px 20px; 
		border-radius: 20px;
	}
</style>
<div class="row" style="padding-top:80px;padding-bottom:0px;">
	<div class="hb-headcontent">
		<h2 style="color:#D62255;margin:0 0 0px;">BIDANG {{ strtoupper($bidang) }}</h2>
		<div class="hb-description" style="padding:0px 15%;">
			<p>Badan Perencanaan Pembangunan Daerah Kota Semarang</p>
		</div>
	</div>
</div>
<section id="hb-blog" class="hb-blog hb-sectionspace hb-haslayout">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 pull-right">
				<div class="hb-post-area hb-bloggrid hb-bloggridfullwidth">
					<div class="row">
						
						<?php
							$bidangs = DB::table('igfeeds')
							->where('is_'.$bidang,'1')
							->paginate(6);
						?>
						@foreach($bidangs as $row)
						<div class="col-xs-12 col-sm-6 col-lg-4">
							<article class="hb-post">
								<figure class="hb-postimage">
									@foreach(json_decode($row->file) as $d)
									@if($loop->iteration > 1 )
									@break
									@endif
									<a href="{{ route('..blog',$row->id) }}"><img src="{{ asset($d) }}" style="height: 250px;width: 100%;" alt="image description img-cover"></a>
									@endforeach
								</figure>
								<div class="hb-postcontent">
									<a href="{{ route('..blog',$row->id) }}" class="hb-postcategory">{{ ($row->is_sosbud == 1) ? '#PPE' : '' }} {{ ($row->is_sosbud == 1) ? '#Sosbud' : '' }} {{ ($row->is_ekonomi == 1) ? '#Ekonomi' : '' }} {{ ($row->is_infrastruktur == 1) ? '#Infrstruktur' : '' }} {{ ($row->is_litbang == 1) ? '#Litbang' : '' }}</a>
									<div class="hb-posttitle">
										<h3><a href="{{ route('..blog',$row->id) }}">{{ Str::limit($row->caption, 20) }}</a></h3>
									</div>
									<div class="hb-postmeta">
										<span>{{ Carbon\Carbon::parse($row->created_at)->format('d M Y') }}</span>
									</div>
								</div>
							</article>
						</div>
						@endforeach
						<div class="col-xs-12">
						{{ $bidangs->links('vendor.pagination.template') }}
							
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 pull-left">
				<aside id="hb-sidebar" class="hb-sidebar hb-haslayout">
					<div class="hb-widget hb-recentnews">
						<div class="hb-widgettitle" style=" text-decoration: underline">
							<h4>Pengumuman</h4>
						</div>
						<ul>
							<?php
							$recents = DB::table('igfeeds')
							->where('is_'.$bidang,'1')
							->where('is_pengumuman', 1)
							->orderBy('created_at', 'DESC') 
							->get();
							?>
							@foreach($recents as $row)
							<a href="{{ route('..blog',$row->id) }}">
							<li class="hoper">
								<h4>{{ Str::limit($row->caption, 40) }}</h4>
								<div class="hb-postmeta">
									<span>{{ Carbon\Carbon::parse($row->created_at)->format('d M Y') }}</span>
								</div>
							</li>
							</a>
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