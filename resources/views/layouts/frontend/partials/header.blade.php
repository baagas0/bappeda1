		<!--************************************
				Header V2 Start
		*************************************-->
		<header id="hb-header" class="hb-header v2 hb-haslayout">   
			<div class="hb-topbar">
				<div class="">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12">
							<strong class="hb-logo" style="padding-left:30px;"><a href="/"><img src="{{ asset(Setting('img-full')) }}" alt="company logo here"></a></strong>
							<div class="hb-info-area hidden-xs" style="margin-top:20px;">
								<ul class="list-unstyled hb-info">
									<li>
										<i class="ti-location-pin hidden-sm"></i><span class="text-center">{!! Setting('alamat') !!}</span>
									</li>
									<li>
										<i class="ti-email hidden-sm"></i><span class="text-center">{{ Setting('telfon') }}<a href="mailto:{{ Setting('email') }}">{{ Setting('email') }}</a></span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="hb-navigationarea" style="box-shadow: 1px 3px 5px #424242;">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							
							<nav id="hb-nav" class="hb-nav">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#hb-navigation" aria-expanded="false">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</button>
								</div>
								<div id="hb-navigation" class="collapse navbar-collapse hb-navigation">
									<ul>       
										<li class="">
											<a href="/"><i class="fa fa-home" aria-hidden="true"> </i> Beranda</a>
										</li>

										<li class="">
											<a href="/profile">Profil</a>
										</li>  
										<li class="">
											<a href="/ppid">PPID</a>
										</li>  
										{{-- <?php dd(menu('a')) ?> --}}
										@foreach(menu('a') as $menu)    
										            
										<li class="menu-item-has-children">
											<a href="javascript:void(0);">{{ $menu ->title}}</a>
											<ul class="list-unstyled sub-menu">
											<?php
			                                    $dropdowns = DB::table('menu')
			                                            ->where('parent_id',$menu ->id)
			                                            ->where('jenurl',1)
			                                            ->orderBy('menu_order', 'DESC')
			                                            ->get();
			                                    foreach ($dropdowns as $dropdown ) { ?>
			                                    <?php $title = strtolower(str_replace(' ','-',$dropdown->title))?>
                                    			<li>
													<a href="{{url($dropdown->url)}}">
														{{ $dropdown->title  }}
													</a>
												</li>
			                                <?php } ?>
											</ul>
										</li>

									@endforeach
									</ul>
								</div>
							</nav>
						</div>
					</div>
				</div>
			</div>
		</header>
		<!--************************************
				Header V2 End
		*************************************-->