<!DOCTYPE html>
<html lang="zxx">
<head>
	@include('layouts.moffice.partials.head')
	@stack('css')
</head>
<body class="animsition" style="background-image:url({{ asset('backend/moffice/images/login-background.jpg') }});">
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
	@yield('content')
</body>
</html>
<script src="{{ asset('backend/moffice/js/jquery.min.js') }}"></script>
<script src="{{ asset('backend/moffice/js/materialize.min.js') }}"></script>
<script src="{{ asset('backend/moffice/js/lightbox.js') }}"></script>
<script src="{{ asset('backend/moffice/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('backend/moffice/js/animsition.min.js') }}"></script>
<script src="{{ asset('backend/moffice/js/animsition-custom.js') }}"></script>
<script src="{{ asset('backend/moffice/js/main.js') }}"></script>
@stack('js')