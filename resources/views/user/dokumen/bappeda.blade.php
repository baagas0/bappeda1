@extends('layouts.frontend.app')

@section('content')

<section id="hb-blog" class="hb-blog hb-sectionspace hb-haslayout">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 pull-left">
							<aside id="hb-sidebar" class="hb-sidebar hb-haslayout">
								<div class="hb-widget"  style="margin-bottom:0px;">
									<div class="hb-sectionhead">
										<div class="hb-sectiontitle">
											<h2 style="color:#D62255;"><span>Selamat Datang Di</span>
												M E N U
											</h2>
										</div>
									</div>
								</div>
								<div class="hb-widget">
									<div class="tab-holder">
										<ul class="list-unstyled tab-list text-uppercase text-center">
										<?php $no=1; $text="";?>
										@foreach($kategori_dokumens as $ig)
											<?php
												if($no == '1'){ $text="active";
												}else{ $text="";
												}
												$no++;
											?>
											<li class="{{ $text }}" role="presentation" style="width:100%;">
												<a href="#tabmenu{{ $ig->id }}" aria-controls="Exapmle" role="tab" data-toggle="tab">{{ $ig->judul }}</a>
											</li>
										@endforeach
										</ul>
									</div>
								</div>
							</aside>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 pull-right">
							<div class="tab-holder">
								<div class="tab-content">
									<?php $no=1; $text="";?>
									@foreach($kategori_dokumens as $id)
										<?php
											if($no == '1'){ $text="active";
											}else{ $text="";
											}
											$no++;
										?>
										<div id="tabmenu{{ $id->id }}" role="tabpanel" class="tab-pane {{ $text }}">
											<div class="row" style="margin-bottom:40px;">
												<div class="hb-sectiontitle">
													<h2 style="color:#D62255;"><span>Detail Menu</span>
													{{ $id->judul }}
													</h2>
												</div>
												<div class="hb-headcontent">
													<h2>Laporan Kegiatan Jawaban Institusi Pendidikan</h2>
													<div class="hb-description" style="padding:0px 15%;">
														<p>{{ $id->uraian }}</p>
													</div>
												</div>
											</div>
											<div class="row">
												<?php
													$dokumens = DB::table('dokumen_bappedas')
													->where('dokumen_bappedas.kategori_dokumen_id',$id->id)
													->get();
													$hitung=count($dokumens);
													$nos=1;
												?>
													@foreach($dokumens as $dok)
													<?php if($nos%2 == 1){ ?>
													<div class="row">
													<?php } ?>
													<div class="hb-shoparea-detail col-md-6"> 
														<div class="img-holder" style="padding:10px;width:30%;border: 1px solid #ccd1f3;">
															<img src="{{ url($dok->thumbnail) }}" alt="image description" class="img-responsive">
															<a href="#" class="hb-zoom-btn text-center rounded-circle"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
														</div>
														<div class="content-holder" style="width:70%;"> 
															<ul class="list-unstyled detail-list" style="margin-bottom:10px;">
																@if ($dok->perubahan == '0')
																	<li><span class="clr badge" style="background-color:green;color:white;font-size:12px;padding:5px 20px;">Murni </span></li>
																@else
																	<li><span class="clr badge" style="background-color:blue;color:white;font-size:12px;padding:5px 20px;">Perubahan <b>{{ $dok->perubahan }}</b></span></li> 
																@endif
															</ul>
															<h3 style="margin-bottom:20px;">{{ $dok->judul }}</h3><!--letter-spacing: 10px;-->
															<span class=""><b>Deskripsi :</b></span>
															<p>{{ $dok->keterangan }}.</p> 
															<div class="holder" style="padding: 10px 0;margin:0px;border-top:0px solid white;">
																<a href="#" class="btn-sm hb-btn" style="padding: 5px 25px 5px;font-size:20px;border-radius:3px;"><i class="fa fa-eye" aria-hidden="true"></i></a>
																<form action="{{ route('..download',$dok->id) }}" method="post">
																	@csrf
																	<button href="#" class="btn-sm hb-btn" style="padding: 5px 25px 5px;font-size:20px;border-radius:3px;"><i class="fa fa-save" aria-hidden="true"></i></button>
																</form>
															</div>
														</div>
													</div>
													<?php if($nos%2==0 || $nos==$hitung){ $nos ++;?>
													</div>
													<?php }else{ $nos ++; } ?>
													@endforeach
											</div>
										</div>
									@endforeach
									<div id="tab01" role="tabpanel" class="tab-pane">
										  <div class="row" style="margin-bottom:40px;">
											  <div class="hb-sectiontitle">
												<h2 style="color:#D62255;"><span>Detail Menu</span>
												  LKJIP BAPPEDA
												</h2>
											  </div>
												<div class="hb-headcontent">
													<h2>Laporan Kegiatan Jawaban Institusi Pendidikan</h2>
													<div class="hb-description" style="padding:0px 15%;">
														<p>Pengunduh dapat memanfaatkan berkas sesuai kebutuhan. Bappeda Kota Semarang tidak bertanggung jawab atas perubahan/perbedaan atas file hasil unduhan akibat rekayasa teknologi. Bila terdapat perbedaan antara file hasil unduhan dengan dokumen sumber versi tercetak, maka yang menjadi rujukan adalah dokumen sumber versi tercetak yang arsipnya dimiliki Bappeda Kota Semarang.</p>
													</div>
												</div>
										  </div>
										<div class="row">
											<div class="hb-shoparea-detail">
												<div class="img-holder" style="padding: 10px 10px 10px 10px;width:20%;">
													<img src="https://via.placeholder.com/450x575" alt="image description" class="img-responsive">
													<a href="#" class="hb-zoom-btn text-center rounded-circle"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
												</div>
												<div class="content-holder" style="width:80%;">
													<ul class="list-unstyled detail-list" style="margin-bottom:0px;>
														<li><span class="clr" style="color:black">Perubahan <b style="font-size:30px;line-height: 56px;background-color:yellow;"> 3 </b></span></li>
													</ul>
													<h2 style="margin-bottom:30px;">Judul Dokumen Ada Disini</h2>
													<span class="	"><b>Deskripsi :</b></span>
													<p>Six Simple Steps to Success series will give you six strategies that will set you on your way. Each book will provide tangible actions that you can take to turn your dreams into reality. This introductory book lays out the system.</p>
													<div class="holder" style="padding: 10px 0;margin:0px;border-top:0px solid white;">
														<a href="#" class="hb-btn text-uppercase">LIHAT</a>
														<a href="#" class="hb-btn text-uppercase">UNDUH</a>
													</div>
													<ul class="list-unstyled social-network" style="padding: 10px 0;">
														<li class="heading">Share Link:</li>
														<li><a href="#"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fab fa-google-plus-g" aria-hidden="true"></i></a></li>
														<li><a href="#"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
													</ul>
												</div> 
											</div>
										</div>
									</div>
									<div id="tab02" role="tabpanel" class="tab-pane">
										<div class="row">
											<div class="col-xs-12 col-sm-6 col-md-4">
												<div class="hb-productsbox">
													<figure class="hb-productsimg">
														<img src="https://via.placeholder.com/210x220" alt="images description">
														<figcaption class="hb-productsicon">
															<ul class="list-unstyled hb-roundicon">
																<li><a href="javascript:void(0)" class="hb-g-icon change-bg t-icon1"><i class="arrow_move"></i></a></li>
																<li><a href="javascript:void(0)" class="hb-g-icon change-bg t-icon2"><i class="icon_cart_alt"></i></a></li>
															</ul>
														</figcaption>
													</figure>
													<div class="hb-productscontent">
														<h3 class="hb-headingtree">
															<a href="shop-detail.html">The Supreme Skin Care</a>
															<span>$29.99</span>
														</h3>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div id="tab03" role="tabpanel" class="tab-pane">
										<p>There are no reviews yet</p>
										<h3>Be the first to review “Electric Shavers” </h3>
										<p>Your email address will not be published. Required fields are marked *</p>
										<ul class="list-unstyled rating-list">
											<li class="heading">Your Rating</li>
											<li><a href="#"><i class="fas fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fas fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fas fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fas fa-star" aria-hidden="true"></i></a></li>
											<li><a href="#"><i class="fas fa-star" aria-hidden="true"></i></a></li>
										</ul>
										<form class="rating-form">
											<fieldset>
												<div class="form-group">
													<input class="form-control" type="text" placeholder="Name*">
													<input class="form-control" type="email" placeholder="Email*">
												</div>
												<div class="form-group">
													<textarea placeholder="Your Review"></textarea>
												</div>
												<button type="submit" class="hb-btn text-uppercase">submit a review</button>
											</fieldset>
										</form>
									</div>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</section>
			

@endsection