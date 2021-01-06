@extends('layouts.backend.app')
@section('rihgt-head')

@endsection
@section('content')
<div class="row">                        
	<div class="col-lg-3 col-sm-6 bg-gradient">
		<div class="widget-box bg-grad-1 m-b-30">
			<div class="row d-flex align-items-center">
				<div class="col-4">
					<div class=""><i class="fa fa-shopping-cart"></i></div>
				</div>
				<div class="col-4 align-items-center">
					<p class="m-0 text-white text-center">Visits Today</p>
				</div>                                    
				<div class="col-4 align-self-end">
					<h2 class="m-0 counter text-right">981</h2>                                         
				</div>
			</div>
		</div> 
	</div>
	<div class="col-lg-3 col-sm-6 bg-gradient">
		<div class="widget-box bg-grad-2 m-b-30">
			<div class="row d-flex align-items-center">
				<div class="col-4">
					<div class=""><i class="fa fa-envelope"></i></div>
				</div>
				<div class="col-4 align-items-center">
					<p class="m-0 text-white text-center">Visits Today</p>
				</div>                                    
				<div class="col-4 align-self-end">
					<h2 class="m-0 counter text-right">592</h2>                                         
				</div>
			</div>
		</div> 
	</div>
	<div class="col-lg-3 col-sm-6 bg-gradient">
		<div class="widget-box bg-grad-3 m-b-30">
			<div class="row d-flex align-items-center">
				<div class="col-4">
					<div class=""><i class="fa fa-line-chart"></i></div>
				</div>
				<div class="col-4 align-items-center">
					<p class="m-0 text-white text-center">Visits Today</p> 
				</div>                                    
				<div class="col-4 align-self-end">
					<h2 class="m-0 counter text-right">246</h2>
				</div>
			</div>
		</div> 
	</div>
	<div class="col-lg-3 col-sm-6 bg-gradient">
		<div class="widget-box bg-grad-4 m-b-30">
			<div class="row d-flex align-items-center">
				<div class="col-4">
					<div><i class="fa fa-users"></i></div>
				</div>
				<div class="col-4 align-items-center">
					<p class="m-0 text-white text-center">Visits Today</p>
				</div>                                    
				<div class="col-4 align-self-end">
					<h2 class="m-0 counter text-right">833</h2>
				</div>
			</div>
		</div> 
	</div>
</div><!--end row-->

<div class="row">
	<div class="col-lg-4 col-sm-12">
		<div class="card bg-white m-b-30">
			<div class="card-body new-user">
				<h5 class="header-title mb-4">Users List</h5>
				<ul class="list-unstyled mb-0 pr-3" id="boxscroll" style="height: 250px !important">
					@foreach($users as $user)
					<li class="p-2 border-b">
						<div class="media">
							<div class="pull-left thumb thumb-sm">
								<a href="#">
									<img class=" rounded-circle" src="{{ asset($user->photo) }}" alt="">
								</a>
							</div>
							<div class="media-body">
								<p class="media-heading mb-0">{{ $user->name }}<i class="fa fa-circle text-success mr-1 pull-right"></i></p>
								<small class="pull-right text-muted">Now</small>
								<small class="text-muted">Newyork</small>
							</div>
						</div>
					</li>
					@endforeach
				</ul>                                    
			</div>                                
		</div>
	</div>

	<div class="col-lg-4 col-sm-12">
		<div class="card bg-white m-b-30">
			<img src="{{ asset('backend/assets/images/users/baground.png') }}" alt="" class="img-fluid">
			<div class="card-body pro-img mx-auto text-center">
				<img src="{{ asset(Auth::user()->photo) }}" alt="" class="rounded-circle mx-auto d-block">
			</div>
			<div class="text-center">
				<h5>{{ Auth::user()->name.' ('.Auth::user()->username.')' }}</h5>
				<p class="text-muted">{{ Auth::user()->email }}</p>
			</div>
			<div class="text-center">
				<a href="{{ route('profile') }}">
				<button type="button" class="btn btn-primary btn-sm mb-4"> + Edit Account</button></a>
			</div>

		</div>
	</div>

	<div class="col-lg-4 col-sm-12">
		<div class="card bg-white m-b-30">
			<div class="card-body new-user">
				<h5 class="header-title mb-4">Data Management</h5>
				<ul class="list-unstyled mb-0" id="boxscrol2" style="height: 250px !important">
					<li class="p-2 border-b">
						<div class="media">
							
							<div class="media-body">
								<p class="media-heading mb-0">Ruby T. Curd </p>
								<small class="text-muted">voloratati andigen daepeditem quiate ut repore autem labor. Laceaque quiae sitiorem rest non tumquam core posae volor remped modis volor.</small>
							</div>
						</div>
					</li>
				</ul>
				
			</div>
		</div>
	</div>
</div>

<div class="row">
	@foreach($igs as $ig)
	<div class="col-lg-4 col-sm-12">
		<div class="card bg-white m-b-30">
			@if($ig->type == 'image')
				@foreach(json_decode($ig->file) as $d)
				<img src="{{ asset($d) }}" alt="" class="img-fluid" style="height: 346px !important">
				@endforeach
			@elseif($ig->type == 'video')
				@foreach(json_decode($ig->file) as $d)
				<video class="img-fluid" controls>
					<source src="{{ asset($d) }}" type="video/mp4">
						Your browser does not support the video tag.
				</video>
				@endforeach
			@else
				<div id="{{ $ig->id }}" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						@foreach(json_decode($ig->file) as $d)
						<div class="carousel-item {{ ($loop->first) ? 'active' : '' }}">
							<img src="{{ asset('frontend/images/instagram/'.$d) }}" alt="" class="img-fluid">
						</div>
						@endforeach
					</div>
					<a class="carousel-control-prev" href="#{{ $ig->id }}" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#{{ $ig->id }}" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			@endif
			<div class="card-body widget-blog">
				<div class="text-muted mb-2">
					<span><i class="fa fa-calendar"></i>{{ date('M Y', strtotime($ig->created_at)) }}</span>
				</div>
				<div class="card-title mb-2">
					<h5>{{Str::limit($ig->caption, 20)}}</h5>
				</div>
				<p class="card-text">{{Str::limit($ig->caption, 100)}}</p>
				<a href="{{ route('..blog',$ig->id) }}" class="btn btn-primary btn-sm float-right">Baca Lagi</a>                                
			</div>
		</div>
	</div>
	@endforeach
</div><!--end row-->
@endsection