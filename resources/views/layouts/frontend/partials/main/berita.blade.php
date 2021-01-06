			<!--************************************
						Welcome Start
			*************************************-->
			<section id="hb-services" class="hb-services ver-4 v2 hb-sectionspace hb-haslayout">
				<div class="container">
					<div class="row">
						<div class=" col-xs-12 col-sm-12 col-sm-offset-0 col-md-8 col-md-offset-2">
							<div class="hb-sectionhead mb-50">
								<div class="hb-sectiontitle">
									<h2 style="color:#D62255;"><span>Selamat Datang Di</span>
										Bappeda Kota Semarang
									</h2>
								</div>
								<div class="hb-headcontent">
									<h2>Prioritas Pembangunan Kota Semarang Tahun 2021</h2>
									<div class="hb-description">
										<p>Paradise products combine botanical and advanced cosmeceutical ingredients with the Science of Beauty to bring you the ultimate in professional skincare in a retail form.</p>
									</div>
								</div>
							</div>
						</div>
						<div id="hb-servicesslider" class="hb-servicesslider hb-haslayout owl-carousel owl-theme">
							@foreach($beritas as $berita)
							<div class="item">
								<div class="hb-servicebox bg-grey sm-round">
									<span class="price font-arizonia">$25.99</span>
									<figure class="hb-serviceimg">
										<img src="{{ asset($berita->photo) }}" alt="images description" class="img-responsive">
										
									</figure>
									<div class="hb-servicecontent">
										<h3 class="hb-headingtree">{{ $berita->title }}</h3>
										<div class="hb-description">
											{!! $berita->content !!}
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</section>
			<!--************************************
						Welcome End
			*************************************-->