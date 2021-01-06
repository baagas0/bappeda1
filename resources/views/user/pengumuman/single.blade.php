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
							<div class="hb-post-area hb-blogdetails">
								<article class="hb-post">
									<figure class="hb-postimage">
										
										@if($ig->type == 'sidecar')
										<div id="hb-homeslider" class="hb-homeslider owl-carousel owl-theme hb-haslayout">
											@foreach(json_decode($ig->file) as $d)
											<div class="item">
												<div class="container">
													<div class="row">
														<div class="col-xs-12">
															<div class="hb-slidercontent-area">
																<figure class="hb-sliderimg">
																	@if(pathinfo($d, PATHINFO_EXTENSION) == 'mp4')
																	<video style="width: 100%;" controls>
																		<source src="{{ asset($d) }}" type="video/mp4">
																			Your browser does not support the video tag.
																		</video>
																		@else 
																		<img src="{{ asset($d) }}" alt="">
																		@endif
																	</figure>
																</div>
															</div>
														</div>
													</div>
												</div>
												@endforeach
											</div>
											@else
											@foreach(json_decode($ig->file) as $d)
												@if($loop->iteration > 1 )
												@break
												@endif

												@if(pathinfo($d, PATHINFO_EXTENSION) == 'mp4')
												<video style="width: 100%;" controls>
													<source src="{{ asset($d) }}" type="video/mp4">
														Your browser does not support the video tag.
													</video>
												@else 
													<img src="{{ asset($d) }}" alt="">
												@endif
											@endforeach
										@endif
									</figure>
									<div class="hb-postcontent">
										<h2>{{ Str::limit($ig->caption, 35) }}</h2>
										<ul class="hb-postmeta">
											<li>{{ ($ig->is_sosbud == 1) ? 'Sosbud ' : '' }}{{ ($ig->is_ekonomi == 1) ? 'Ekonomi ' : '' }}{{ ($ig->is_infrastruktur == 1) ? 'Infrastruktur ' : '' }}{{ ($ig->is_ppe == 1) ? 'PPE ' : '' }}{{ ($ig->is_litbang == 1) ? 'Litbang ' : '' }}</li>
											<li>Diposting {{ Carbon\Carbon::parse($ig->created_at)->format('d M Y') }}</li>
											<li>{{ ($ig->is_berita) ? 'Berita' : '' }} {{  ($ig->is_pengumuman) ? 'Pengumuman' : '' }}</li>
										</ul>
									</div>
									<div class="hb-description">
										<p>{!! $ig->caption !!}</p>
									</div>
									
									<div class="hb-tags-area">
										<div class="hb-tags">
											<ul>
												<?php
													$str = $ig->caption;

       												preg_match_all('/#(\w+)/', $str, $matches);


       												foreach ($matches[1] as $hashtag) {

												?>
												
													<li>
														<a href="javascript:void(0);" class="hb-tagbtn">#{{ $hashtag }}</a>
													</li>
												<?php } ?>
											</ul> 
										</div>
										<div class="hb-socialshare">
											<ul>
												<li><a href="javascript:void"><i class="fab fa-facebook-f"></i></a></li>
												<li><a href="javascript:void"><i class="fab fa-twitter"></i></a></li>
												<li><a href="javascript:void"><i class="fab fa-pinterest"></i></a></li>
												<li><a href="javascript:void"><i class="fas fa-rss"></i></a></li>
												<li><a href="javascript:void"><i class="fa fa-heart"></i></a></li>
											</ul>
										</div>
									</div>
								</article>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 pull-left">
							<aside id="hb-sidebar" class="hb-sidebar hb-haslayout">
								<div class="hb-widget hb-recentnews">
									<div class="hb-widgettitle">
										<h3>Recent News</h3>
									</div>
									<ul>
									@foreach($recents as $row)
										<li>
											<h4>{{ Str::limit($row->caption, 40) }}</h4>
											<div class="hb-postmeta">
												<span>{{ Carbon\Carbon::parse($row->created_at)->format('d M Y') }}</span>
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
	<div class="container">
	<div id="disqus_thread"></div>
	</div>
	<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() { // DON'T EDIT BELOW THIS LINE
    	var d = document, s = d.createElement('script');
    	s.src = 'https://bappeda-kota-semarang.disqus.com/embed.js';
    	s.setAttribute('data-timestamp', +new Date());
    	(d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
</div>
</div>
</section>
<!--************************************
	Blog End
	*************************************-->
</main>

@endsection	