<!DOCTYPE html>
<html lang="zxx">
<head>
	@include('layouts.moffice.partials.head')
	@stack('css')
</head>
<body class="">

	<!-- prelaoder -->
	<div class="wrapper-load">
		<div class="preloader-wrapper medium-size active">
			<div class="spinner-layer spinner-custom">
				<div class="circle-clipper left">
					<div class="circle"></div>
				</div>
				<div class="gap-patch">
					<div class="circle"></div>
				</div>
				<div class="circle-clipper right">
					<div class="circle"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- end prelaoder -->
	
	<!-- navbar -->
	<div class="navbar navbar-home">
		<div class="container">
			<div class="row">
				<div class="col s3">
					<div class="content-left">
						<a href="#slide-out" data-target="slide-out" class="sidenav-trigger"><i class="fa fa-bars"></i></a>
						
					</div>
				</div>
				<div class="col s6">
					<div class="content-center">
						<a href="{{ route('.moffice') }}"><h1>M-OFFICE</h1></a>
					</div>
				</div>
				<div class="col s3">
					<div class="content-right">
						<a href="{{ route('moffice.logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i class="fa fa-sign-out"></i></a>
						<form id="frm-logout" action="{{ route('moffice.logout') }}" method="POST" style="display: none;">
                    		{{ csrf_field() }}
                		</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end navbar -->
	
	<!-- sidebar -->
	@include('layouts.moffice.partials.sidebar')
	<!-- end sidebar -->

	<!-- Content -->
	<div style="padding-bottom:50px;"></div>
	@yield('content')
	<!-- End Content -->
	<div style="padding-bottom:25px;"></div>
	<!-- footer -->
    <footer class="footer-home" style="position: fixed;left: 0;bottom: 0;width:100%">
        <div class="by" style="">
        	<p>Made with <i class="fa fa-heart pink-text"></i> By BAPPEDA</p>
        </div>
    </footer>
    <!-- end footer -->

</body>
</html>
<script src="http://pangripta.semarangkota.go.id/backend/assets/js/jquery-3.2.1.min.js"></script>
<script src="{{ asset('backend/moffice/js/materialize.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('backend/moffice/js/lightbox.js') }}"></script>
<script src="{{ asset('backend/moffice/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('backend/moffice/js/animsition.min.js') }}"></script>
<script src="{{ asset('backend/moffice/js/animsition-custom.js') }}"></script>
<script src="{{ asset('backend/moffice/js/main.js') }}"></script>
@stack('js')