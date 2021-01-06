@extends('layouts.moffice.app')
@section('content')
<!-- slide -->
	<div class="slide">
		<div class="slide-show-home owl-carousel owl-theme">
			<div class="slide-content">
				<div class="mask"></div>
				<img src="images/slider-home1.jpg" alt="">
				<div class="intro-caption">
					<h2>ZOOM to Elecor</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat, quos?</p>
				</div>
			</div>
			<div class="slide-content">
				<div class="mask"></div>
				<img src="images/slider-home2.jpg" alt="">
				<div class="intro-caption">
					<h2>Powerfull Design</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat, quos?</p>
				</div>
			</div>
			<div class="slide-content">
				<div class="mask"></div>
				<img src="images/slider-home3.jpg" alt="">
				<div class="intro-caption">
					<h2>Easy Customize</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat, quos?</p>
				</div>
			</div>
		</div>
	</div>
	<!-- end slide -->
	
	<!-- filter home -->
	<div class="filter-home segments">
		<div class="container">
			<div class="row">
				<div class="col s6">
					<a href="{{ route('.moffice.rapat') }}">
						<div class="content waves-effect waves-light b-shadow" style="background-color:red;">
							<i class="large material-icons">account_balance</i>
							<h6>Ruang Rapat</h6>
						</div>
					</a>
				</div>
				<div class="col s6">
					<a href="{{ route('.moffice.zoom') }}">
						<div class="content waves-effect waves-light b-shadow" style="background-color:red;">
							<i class="large material-icons">perm_camera_mic</i>
							<h6>Zoom</h6>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- end filter home -->
	
	<!-- gallery -->
	<div class="gallery segments-page">
		<div class="container">
			<ul class="tabs b-shadow">
				<li class="tab col s6"><a class="waves-effect waves-light-grey active" href="#tabs1">
					<i class="large material-icons">account_balance</i>
				</a></li>
				<li class="tab col s6"><a class="waves-effect waves-light-grey" href="#tabs2">
					<i class="large material-icons">perm_camera_mic</i>
				</a></li>
			</ul>
			<div id="tabs1" class="col s12">
				<div class="contents-tabs">
					<div class="container">
						<div class="row">
							<div class="col s12">
								<div class="content-text">
									<span>Sport</span>
									<a href=""><h5>Adults like to eat good fruits and meat, for health</h5></a>
									<p class="date"><i class="fa fa-clock-o"></i>01 January 2018</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="tabs2" class="col s12">
				<div class="contents-tabs">
					<div class="row">
						//
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end gallery -->
@endsection
@push('css')
// Isi dengan css mu
@endpush
@push('js')

@endpush