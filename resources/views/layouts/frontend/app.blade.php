<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang=""> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>{{ env('APP_NAME', 'Bappeda') }}</title>
	<link rel="shortcut icon" href="{{ asset('https://bappeda.semarangkota.go.id/packages/tugumuda/claravel/assets/images/favicon.png') }}">
	
	<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/css/icomoon.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/css/icofont.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/css/plugins.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/css/color.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
	<script src="{{ asset('frontend/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
	<script src="{{ asset('https://kit.fontawesome.com/633b634a78.js') }}" crossorigin="anonymous"></script>
	@stack('css')
</head>
<body class="hb-home hb-homeone homepage2 single_with_sidebar" id="body">
	<div>
	@include('layouts.frontend.partials.header')

	@yield('content')

	@include('layouts.frontend.partials.footer')

	</div>
	
	<style>
		#pop{
	margin:5% 30% 30% 30%;
	width: 500px;	
	height: 200px;
	position: absolute;
	position:fixed;
	z-index:1002;
	display: none;
	background: white;	
}
#atas{
	font-size: 15pt;
	padding: 20px;	
	height: 80%;
}
#bawah{
	background: #fff;
}
 
#tutupopup{	
	background: #e74c3c;
}
#tutupopup,#tombol{
	height: 30px;
	width: 100px;
	color: #fff;
	border: 0px;
}
#up{
	opacity:.80;
	position: absolute;
	display: none;
	position: fixed;
	top: 0%;
	left: 0%;
	width: 100%;
	height: 100%;
	background-color: #000;
	z-index:1001;
	opacity: 0.8;
}
#tombol{
	background: #e74c3c;        
}
	</style>

    <!--<div id="up"></div>
    <div id="pop">
        <div class="text-center" id="atas">
            <p style="padding-top: 15px">{{ announcement()->title }}</p><hr>

            <div>
            	{!! announcement()->content !!}
            </div>
        </div>
        <div id="bawah">
            <button id="tutupopup">CLOSE</button>
        </div>
    </div> --> 
    
	<script src="{{ asset('frontend/js/vendor/jquery-library.js') }}"></script>
	<script src="{{ asset('frontend/js/vendor/bootstrap.min.js') }}"></script>
	<script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('frontend/js/isotope.pkgd.js') }}"></script>
	<script src="{{ asset('frontend/js/isotop.js') }}"></script>
	<script src="{{ asset('frontend/js/countTo.js') }}"></script>
	<script src="{{ asset('frontend/js/appear.js') }}"></script>
	<script src="{{ asset('frontend/js/main.js') }}"></script>
	@stack('js')
</body>
</html>
<script>
	$(document).ready(function(){


		//$('#pop , #up').modal('show'); 

		//$('#tutupopup').click(function(){
		//	$('#pop , #up').modal('hide');
		//});
	});
</script>