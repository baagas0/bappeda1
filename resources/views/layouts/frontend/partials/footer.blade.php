		<!--************************************
				Footer Start
		*************************************-->
		<footer id="hb-footer" class="hb-footer hb-haslayout">
			<div class="hb-footer-area">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-3">
							<div class="hb-col">
								<strong class="hb-logo">
									<a href="javascript:void"><img src="{{ Setting('logo-small') }}" alt=""></a>
								</strong>
								<span class="hb-timeandday">{{ Setting('time') }}</span>
								<ul class="list-unstyled hb-socialicons">
									@if(!empty(Set('fb')))
									<li><a href="{{ Setting('fb') }}"><i class="fab fa-facebook-f"></i></a></li>@endif
									@if(!empty(Set('twitter')))
									<li><a href="{{ Setting('twitter') }}"><i class="fab fa-twitter"></i></a></li>@endif
									@if(!empty(Set('ig')))
									<li><a href="{{ Setting('ig') }}"><i class="fab fa-instagram"></i></a></li>@endif
								</ul>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-3">
							<div class="hb-col">
								<h3>Contacts</h3>
								<ul class="list-unstyled hb-info">
									<li><span>{{ Setting('telfon') }}<a href="mailto:{{ Setting('email') }}">{{ Setting('email') }}</a></span>
									</li>
									<li>{!! Setting('alamat') !!}
									</li>
								</ul>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-3">
							<div class="hb-col">
								<h3>Update Berita</h3>
								<div class="hb-emailarea">
									<form class="hb-formtheme">
										<fieldset>
											<div class="form-group">
												<input type="text" class="form-control" placeholder="E-mail">
												<button type="submit" class="hb-btn">Submit</button>
											</div>
										</fieldset>
									</form>
								</div>
								<div class="hb-description">
									<p>Isi emailmu untuk mendapatkan update terbaru pada web Bappeda Kota Semarang</p>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-3">
							<div class="hb-col hb-widget">
								<?php
									use App\Models\Igfeed;
									$footimgs = Igfeed::orderBy('id_ig', 'desc')->where('type','image')->limit(6)->get();
								?>
								<ul>
									@foreach($footimgs as $footimg)
									<li><a href="javascript:void(0);">
										<?php
											$images = (array)json_decode($footimg->file, true);
										?>
										@foreach($images as $a)
										@foreach(json_decode($a) as $d)
										@if($loop->iteration > 1 )
										@break
										@endif
										<img style="height: 80px;width: 80px" src="{{ asset($d) }}"></a>
										@endforeach
										@endforeach
									</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="hb-footerbar">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 text-center">
							<span class="hb-copyright text-center">{{ date('Y') }} @ Bappeda Kota Semarang</span>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!--************************************
				Footer End
		*************************************-->

		<!--************************************
				Back Top Button
		*************************************-->
		
		<span id="back-top" class="text-center rounded-circle fa fa-angle-up"></span>
		<div id="loader" class="loader-holder">
			<div class="block">
			    <div class="dot white"></div>
			    <div class="dot"></div>
			    <div class="dot"></div>
			    <div class="dot"></div>
			    <div class="dot"></div>
			</div>
		</div>

		<!--************************************
				End Back Top Button
		*************************************-->