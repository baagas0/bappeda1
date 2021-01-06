<!--************************************
Bidang
*************************************-->
<style>
	.item2:hover img {
		border:4px solid #c8cdee !important;
	}
	.sadap{
		font-family: "Poppins", "Helvetica Neue", Helvetica, Arial, sans-serif;
		font-size: 18px;
		line-height: 27px;
		color: #2d2c40;
		margin: 0 0 16px;
		font-weight: 400;
		text-transform: none;
	}
</style>
<section id="hb-blog" class="hb-blog hb-sectionspace hb-haslayout">
	<div class="container">
		<div class="row">
			<div class=" col-xs-12 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2">
				<div class="hb-sectionhead">
					<div class="hb-sectiontitle">
						<h2 style="color:#D62255;"><span>Selamat Datang Di</span>
							BAPPEDA KOTA SEMARANG
						</h2>
					</div>
				</div>
			</div>
			<div class="hb-post-area">
				<div class="row justify-content-center">
					<div class="col-md-2" style="width: 20%;">
						<div class="text-center mb-3 dropdown">
							<div class="item2">
								<a href="http://pangripta.semarangkota.go.id/bidang/sosbud"><img style=" padding:10px; border: 1px solid transparent; border-radius: 10px; border-color:#c2c2cb;" class="bg-white" src="{{ asset('/frontend/images/bidang/sosbud.png') }}" alt="icon-menu" width="70%"></a>
							</div>
						</div>
						<h2 class="text-center sadap" >Pemerintah, Sosial dan Budaya</h2>
					</div>
					
					<div class="col-md-2" style="width: 20%;">
						<div class="text-center mb-3 dropdown"> 
							<div class="item2">
								<a href="http://pangripta.semarangkota.go.id/bidang/ekonomi"><img style=" padding:10px; border: 1px solid transparent; border-radius: 10px; border-color:#c2c2cb;" class="bg-white" src="{{ asset('/frontend/images/bidang/perekonomian.png') }}" alt="icon-menu" width="70%"></a>
							</div>
						</div>
						<h2 class="text-center sadap" >Perekonomian</h2>
					</div>
					
					<div class="col-md-2" style="width: 20%;">
						<div class="text-center mb-3 dropdown">
							<div class="item2">
								<a href="http://pangripta.semarangkota.go.id/bidang/infrastruktur"><img style=" padding:10px; border: 1px solid transparent; border-radius: 10px; border-color:#c2c2cb;" class="bg-white" src="{{ asset('/frontend/images/bidang/infrastruktur.png') }}" alt="icon-menu" width="70%"></a>
							</div>
							
						</div>
						<h2 class="text-center sadap" >Infrastruktur Pengembangan Wilayah</h2>
					</div>
					
					<div class="col-md-2" style="width: 20%;">
						<div class="text-center mb-3 dropdown">
							<div class="item2">
								<a href="http://pangripta.semarangkota.go.id/bidang/litbang"><img style=" padding:10px; border: 1px solid transparent; border-radius: 10px; border-color:#c2c2cb;" class="bg-white" src="{{ asset('/frontend/images/bidang/penelitian.png') }}" alt="icon-menu" width="70%"></a>
							</div>
						</div>
						<h2 class="text-center sadap" >Penelitian dan Pengembangan</h2>
					</div>
					
					<div class="col-md-2" style="width: 20%;">
						<div class="text-center mb-3 dropdown">
							<div class="item2">
								<a href="http://pangripta.semarangkota.go.id/bidang/ppe"><img style=" padding:10px; border: 1px solid transparent; border-radius: 10px; border-color:#c2c2cb;" class="bg-white" src="{{ asset('/frontend/images/bidang/ppe.png') }}" alt="icon-menu" width="70%"></a>
							</div>
						</div>
						<h2 class="text-center sadap" >Perencanaan Pengendalian dan Evaluasi</h2>
					</div>
				</div>
			</div>
		</div>
	</section>
<!--************************************
			Event End
*************************************-->









<!--************************************
Event Start
*************************************-->
<section id="hb-blog" class="awn-bg-grey hb-blog hb-sectionspace hb-haslayout">
	<div class="container">
		<div class="row">
			<div class=" col-xs-12 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2">
				<div class="hb-sectionhead">
					<div class="hb-sectiontitle">
						<h2 style="color:#D62255;"><span>Sedulur Perencana</span>
							Berita &amp; Event Terbaru
						</h2>
					</div>
				</div>
			</div>
			<div class="hb-post-area">
				@foreach($igs as $ig)
				<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 pb-3">
					<article class="hb-post">
						<figure class="hb-postimage">
							<a href="">
							<?php
								$igImage = (array)json_decode($ig->file, true);
								
							?>
							@foreach($igImage as $a)
							@foreach(json_decode($a) as $d)
							@if($loop->iteration > 1 )
							@break
							@endif
							@if(pathinfo($d, PATHINFO_EXTENSION) == 'mp4')
								<video style="height: 300px;width: 250px" controls>
									<source src="{{ asset($d) }}" type="video/mp4">
									Your browser does not support the video tag.
								</video>
							@else 
								<img style="height: 300px;width: 300px" src="{{ asset($d) }}" alt="" class="img-fluid">
							@endif
							@endforeach
							@endforeach
							</a>
						</figure>
						<div class="hb-postcontent">
							<a href="bloggrid-sidebar.html" class="hb-postcategory">{{ ($ig->is_sosbud == 1) ? '#PPE' : '' }} {{ ($ig->is_bpsb == 1) ? '#Sosbud' : '' }} {{ ($ig->is_ekonomi == 1) ? '#Ekonomi' : '' }} {{ ($ig->is_infrastruktur == 1) ? '#Infrstruktur' : '' }} {{ ($ig->is_litbang == 1) ? '#Litbang' : '' }}</a>
							<div class="hb-posttitle">
								<h3><a href="bloggrid-sidebar.html">{{ Str::limit($ig->caption, 20) }}</a></h3>
							</div>
							<div class="hb-postmeta">
								<span>Instagram | {{ date('d M Y', strtotime($ig->created_at)) }}</span>
							</div>
						</div>
					</article>
					</div>
				@endforeach
				</div>
			</div>
		</div>
	</section>
<!--************************************
			Event End
*************************************-->