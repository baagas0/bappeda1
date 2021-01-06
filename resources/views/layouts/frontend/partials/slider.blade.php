		<!--************************************
				Home Slider v2 Start
		*************************************-->
		<div id="hb-homeslider2" class="hb-homeslider v2 owl-carousel owl-theme hb-haslayout">
		@foreach($slider as $slider)
			<div class="item">
				<!-- <div class="container"> -->
					<div class="row">
						<div class="col-xs-12">
							<div class="hb-slidercontent-area">
								<figure class="hb-sliderimg">
									<img src="{{ asset($slider->gambar) }}" style="width: 100%;height: auto;object-fit: cover;" alt="image description">
									<!--
									<figcaption class="hb-slidercontent" style="padding-left: 10%;background: linear-gradient(to right, rgba(200,0,0,0.6) 20%, rgba(0,0,0,0.3) 75%, rgba(0,0,0,0) 100%);">
										<div style="">
											<h3 style="width: 100%;color:white;">{{ $slider->judul }}</h3>
											<div class="hb-description" style="color:white;">
												<p>{{ $slider->keterangan }}</p>
											</div>
										</div>
									</figcaption>
									-->
								</figure> 
							</div>
						</div>
					</div>
				<!-- </div> -->
			</div>
		@endforeach
		</div>
		<!--************************************
				Home Slider V2 End
		*************************************-->