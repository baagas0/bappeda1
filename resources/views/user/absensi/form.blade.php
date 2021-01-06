<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Magnifica Questionnaire Form Wizard includes Corona Virus Covid-19 questionnaire">
    <meta name="author" content="Ansonika">
    <title>ABSENSI | {{ env('APP_NAME', 'BAPPEDA') }}</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="{{ asset('frontend/absensi/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/absensi/css/menu.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/absensi/css/style.css') }}" rel="stylesheet">
	<link href="{{ asset('frontend/absensi/css/vendors.css') }}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('frontend/absensi/css/custom.css') }}" rel="stylesheet">
	
	<!-- MODERNIZR MENU -->
	<script src="{{ asset('frontend/absensi/js/modernizr.js') }}"></script>

</head>

<body>
	
	<div id="preloader">
		<div data-loader="circle-side"></div>
	</div><!-- /Preload -->
	
	<div id="loader_form">
		<div data-loader="circle-side-2"></div>
	</div><!-- /loader_form -->

	

	<div class="container" style="padding-top: 20px">
    <div id="form_container">
        <div class="row no-gutters">
            <div class="col-lg-4">
                <div id="left_form">
                    <figure><img src="https://ardilamadi2.files.wordpress.com/2012/08/9dcc3-logokotasemarang.png" alt="" width="100" height="auto"></figure>
                    <h2>{{ $kegiatan_bidang->name }} <span>{{ Carbon\Carbon::parse($kegiatan_bidang->tanggal)->format('d M Y') }} | {{ $kegiatan_bidang->time }} WIB</span></h2>
                    <p>Ini merupakan platform absensi digital resmi milik BAPPEDA Kota SEMARANG</p>
                    <a href="#" class="btn_1 rounded yellow purchase" target="_parent">{{ $bidang->bidang }}</a>
	                <a href="#wizard_container" class="btn_1 rounded mobile_btn yellow">Start Now!</a>
                    <a href="#0" id="more_info" data-toggle="modal" data-target="#more-info"><i class="pe-7s-info"></i></a>
                </div>
            </div>
            <div class="col-lg-8">
                <div id="wizard_container">
                    <div id="top-wizard">
                        <div id="progressbar"></div>
                        <span id="location"></span>
                    </div>
                    <!-- /top-wizard -->
                    <form id="wrapped" method="post" action="{{ route('..add.absensi', $absensi->id) }}">
						@csrf
                        <input id="website" name="website" type="text" value="">
                        <!-- Leave for security protection, read docs for details -->
                        <div id="middle-wizard">
 
                            <div class="step">
								<div class="row" style="padding-bottom:15px">
									<div class="col-md-12">
										<h3 class="main_question"><i class="arrow_right"></i>Masukan Email Anda*</h3>
										<input type="email" name="email" id="email" class="form-control required" onchange="getVals(this, 'email_field');">
									</div>
								</div>
								<div class="row" style="padding-bottom:15px">
									<div class="col-md-12">
										<h3 class="main_question"><i class="arrow_right"></i>Masukan Nama Anda*</h3>
										<input type="text" name="name" id="name" class="form-control required" onchange="getVals(this, 'name_field');">
									</div>
								</div>
								<div class="row" style="padding-bottom:15px">
									<div class="col-md-12">
										<h3 class="main_question"><i class="arrow_right"></i>Masukan Nomor Telf Anda*</h3>
										<input type="number" name="no_telf" id="no_telf" class="form-control required" value="62">
									</div>
								</div>
                            </div>
                            <!-- /step-->

                            <div class="step">
								<div class="row" style="padding-bottom:15px">
									<div class="col-md-12">
										<h3 class="main_question"><i class="arrow_right"></i>Jenis Kelamin Anda*</h3>
										<div class="form-group">
											<label class="container_radio version_2">Laki-Laki
												<input type="radio" name="gender" value="laki" class="required">
												<span class="checkmark"></span>
											</label>
											<label class="container_radio version_2">Perempuan
												<input type="radio" name="gender" value="perempuan" class="required">
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
								</div>
								<div class="row" style="padding-bottom:15px">
									<div class="col-md-12">
										<h3 class="main_question"><i class="arrow_right"></i>Instansi/Organisasi Anda*</h3>
										<input type="text" name="instansi" id="instansi" class="form-control required" onchange="getVals(this, 'instansi');">
									</div>
								</div>
                            </div>
                            <!-- /step-->

                            

                            <div class="submit step" id="end">
                                <div class="summary">
                                    <div class="wrapper">	
                                        <h3>Terima kasih atas waktunya<br><span id="name_field"></span>!</h3>
                                        <p>Kami akan menyimpan data anda sebagai rekap data absent di sistem kami <strong id="name_field"></strong> and if necessary take measures.</p>
                                    </div>
                                    <div class="text-center">
                                        <div class="form-group terms">
                                            <label class="container_check">Saya telah mengisi data dengan sebenar benarnnya
                                                <input type="checkbox" name="terms" value="Yes" class="required">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /step last-->

                        </div>
                        <!-- /middle-wizard -->
                        <div id="bottom-wizard">
                            <button type="button" name="backward" class="backward">Prev</button>
                            <button type="button" name="forward" class="forward">Next</button>
                            <button type="submit" class="submit">Submit</button>
                        </div>
                        <!-- /bottom-wizard -->
                    </form>
                </div>
                <!-- /Wizard container -->
            </div>
        </div><!-- /Row -->
    </div><!-- /Form_container -->
</div>
<!-- /container -->

<div class="container">
    <footer id="home" class="clearfix">
        <p>© {{ date('Y') }} BAPPEDA</p>
        <ul>
            <li><a href="#0" class="animated_link">Purchase this template</a></li>
            <li><a href="index-2.html" class="animated_link">Layout 1</a></li>
            <li><a href="faq.html" class="animated_link">Faq</a></li>
            <li><a href="prevention.html" class="animated_link">Prevention Tips</a></li>
        </ul>
    </footer>
    <!-- end footer-->
</div>
<!-- /container -->

<div class="cd-overlay-nav">
    <span></span>
</div>
<!-- /cd-overlay-nav -->
<div class="cd-overlay-content">
    <span></span>
</div>
<!-- /cd-overlay-content -->

	<!-- Modal info -->
	<div class="modal fade" id="more-info" tabindex="-1" role="dialog" aria-labelledby="more-infoLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="more-infoLabel">Frequently asked questions</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in <strong>nec quod novum accumsan</strong>, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus. Lorem ipsum dolor sit amet, <strong>in porro albucius qui</strong>, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
					<p>Lorem ipsum dolor sit amet, in porro albucius qui, in nec quod novum accumsan, mei ludus tamquam dolores id. No sit debitis meliore postulant, per ex prompta alterum sanctus, pro ne quod dicunt sensibus.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn_1" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	
	<!-- COMMON SCRIPTS -->
	<script src="{{ asset('frontend/absensi/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('frontend/absensi/js/common_scripts.min.js') }}"></script>
	<script src="{{ asset('frontend/absensi/js/velocity.min.js') }}"></script>
	<script src="{{ asset('frontend/absensi/js/common_functions.js') }}"></script>

	<!-- Wizard script with branch -->
    <script src="{{ asset('frontend/absensi/js/wizard_with_branch.js') }}"></script>

</body>
</html>