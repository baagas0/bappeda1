@extends('layouts.frontend.app')
@push('css')
	<link rel="stylesheet" href="{{ asset('frontend/structure/style.css') }}">
@endpush
@push('js')
<script  src="{{ asset('frontend/structure/script.js') }}"></script>
@endpush
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
												if($no == '1'){
													$text="active";
												}else{
													$text="";
												}
												$no++;
											?>
											<li class="<?=$text?>" role="presentation" style="width:100%;">
												<a href="#tabmenu{{ $ig->id }}" aria-controls="Exapmle" role="tab" data-toggle="tab">{{ $ig->name }}</a>
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
											if($no == '1'){
												$text = "active";
											}else{
												$text = "";
											}
											$no++;
										?>
										<div id="tabmenu{{ $id->id }}" role="tabpanel" class="tab-pane <?=$text?>">
											<?php $menu = DB::table('structures')->where('parent_id', '0')->get(); if($id->id=='8'){ ?>
												<div class="body genealogy-body genealogy-scroll">
    <div class="genealogy-tree" style="">
        <ul>
            <li>
                <a href="javascript:void(0);">
                    <div class="member-view-box">
                        <div class="member-image">
                            <img src="https://image.flaticon.com/icons/svg/145/145867.svg" alt="Member">
                            <div class="member-details">
                                <h3>Bunyamin</h3>
                            </div>
                        </div>
                    </div>
                </a>
                <ul class="active">
                    @foreach($menu as $menu)
                    <li>
                        <a href="javascript:void(0);">
                            <div class="member-view-box">
                                <div class="member-image">
                                    <img src="https://image.flaticon.com/icons/svg/145/145867.svg" alt="Member">
                                    <div class="member-details">
                                        <h3>{{ $menu->name }}</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <ul >
                            <?php
                                $sub = DB::table('structures')
                                    ->where('parent_id',$menu ->id)
                                    ->get();
                            ?>
                            @foreach($sub as $row)
                            <li>
                                <a href="javascript:void(0);">
                                    <div class="member-view-box">
                                        <div class="member-image">
                                            <img src="https://image.flaticon.com/icons/svg/145/145867.svg" alt="Member">
                                            <div class="member-details">
                                                <h3>{{ $row->name }}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul >
                                    <?php
                                        $sub1 = DB::table('structures')
                                            ->where('parent_id',$row ->id)
                                            ->get();
                                    ?>
                                    @foreach($sub1 as $row1)
                                    <li>
                                        <a href="javascript:void(0);">
                                            <div class="member-view-box">
                                                <div class="member-image">
                                                    <img src="https://image.flaticon.com/icons/svg/145/145867.svg" alt="Member">
                                                    <div class="member-details">
                                                        <h3>{{ $row1->name }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <ul >
                                            <?php
                                                $sub2 = DB::table('structures')
                                                    ->where('parent_id',$row1 ->id)
                                                    ->get();
                                            ?>
                                            @foreach($sub2 as $row2)
                                            <li>
                                                <a href="javascript:void(0);">
                                                    <div class="member-view-box">
                                                        <div class="member-image">
                                                            <img src="https://image.flaticon.com/icons/svg/145/145867.svg" alt="Member">
                                                            <div class="member-details">
                                                                <h3>{{ $row2->name }}</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <ul >
                                                    <?php
                                                        $sub3 = DB::table('structures')
                                                            ->where('parent_id',$row2->id)
                                                            ->get();
                                                    ?>
                                                    @foreach($sub3 as $row3)
                                                    <li>
                                                        <a href="javascript:void(0);">
                                                            <div class="member-view-box">
                                                                <div class="member-image">
                                                                    <img src="https://image.flaticon.com/icons/svg/145/145867.svg" alt="Member">
                                                                    <div class="member-details">
                                                                        <h3>{{ $row3->name }}</h3>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
</div>
											<?php } else{?>
											<div class="row" style="margin-bottom:40px;">
												<div class="hb-sectiontitle">
													<h2 style="color:#D62255;"><span>Detail Menu</span>
													{{ $id->judul }}
													</h2>
												</div>
											</div>
											<div class="row">
												<div class="hb-shoparea-detail">
													<div class="content-holder" style="width:100%;">
														<h2 style="margin-bottom:30px;">{{ $id->judul }}</h2>
														<!--<span class="	"><b>Deskripsi :</b></span>-->
														
														<p class=""><?= $id->text?></p>
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
														<div class="img-holder col-md-3" style="padding:10px;">
															<img src="{{ asset($dok->thumbnail) }}" alt="image description" class="img-responsive">
															<a href="#" class="hb-zoom-btn text-center rounded-circle"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
															<a href="#" class="hb-zoom-btn text-center rounded-circle"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
														</div>
														<div class="content-holder col-md-9"> 
															<ul class="list-unstyled detail-list" style="margin-bottom:10px;">
																@if ($dok->perubahan == '0')
																	<li><span class="clr badge" style="background-color:green;color:white;font-size:12px;padding:5px 20px;">Murni </span></li>
																@else
																	<li><span class="clr badge" style="background-color:blue;color:white;font-size:12px;padding:5px 20px;">Perubahan <b>{{ $dok->perubahan }}</b></span></li> 
																@endif
															</ul>
															<h2 style="margin-bottom:30px;">{{ $dok->judul }}</h2> <!--letter-spacing: 10px;-->
															<span class=""><b>Deskripsi :</b></span>
															<p>{{ $dok->keterangan }}.</p>
															<div class="holder" style="padding: 10px 0;margin:0px;border-top:0px solid white;">
																<a href="#" class="btn-sm hb-btn" style="padding: 10px 20px 10px;line-height: 10px;">Lihat</a>
																<a href="#" class="btn-sm hb-btn" style="padding: 10px 20px 10px;line-height: 10px;">Unduh</a>
															</div>
														</div>
													</div>
													<?php if($nos%2==0 || $nos==$hitung){ $nos ++;?>
													</div>
													<?php }else{ $nos ++; } ?>
													@endforeach
											</div>
											<?php } ?>
										</div>
									@endforeach
								</div>
							</div>							
						</div>
					</div>
				</div>
			</section>
			

@endsection