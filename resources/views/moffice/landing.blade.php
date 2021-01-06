<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ env('APP_NAME', 'BAPPEDA') }} | M-OFFICE</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/moffice/landing/images/favicon.ico') }}">
    
    <!-- CSS 
    ========================= -->
   
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('backend/moffice/landing/css/bootstrap.min.css') }}">
    
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('backend/moffice/landing/css/plugins.css') }}">
    
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{ asset('backend/moffice/landing/css/style.css') }}">
    
    <!-- Modernizer JS -->
    <script src="{{ asset('backend/moffice/landing/js/vendor/modernizr-2.8.3.min.js') }}"></script>
</head>

<body>

<!-- Main Wrapper Start -->
<div class="main-wrapper">
    <!-- header-area start -->
    <header class="header header-sticky">
        <!-- header-top start -->
        <div id="main-menu" class="header-top-2 inner-header">
            <div class="container">
                <div class="row header-top-inner">
                    <div class="col-lg-4">
                        <div class="logo">
                            <a href="index.html" class="d-md-block d-none"><img src="{{ asset('backend/moffice/landing/images/logo/logo.png') }}" alt=""></a>
                            <a href="index.html" class="d-md-none d-block"><img src="{{ asset('backend/moffice/landing/images/logo/logo-2.png') }}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="main-menu">
                            <nav class="main-navigation text-white">
                                <ul>
                                    <li class="active"><a href="#slider">Home</a></li>
                                    <li class="smooth-scroll"><a href="#feature">Feature</a></li>
                                    <li class="smooth-scroll"><a href="#screnshot">Screenshot</a></li>
                                    <li class="smooth-scroll"><a href="#download-area">Download</a></li>
                                    <li class="smooth-scroll"><a href="#contact">Contact</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col">
                        <!-- mobile-menu start -->
                        <div class="mobile-menu d-block d-lg-none"></div>
                        <!-- mobile-menu end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Header-top end -->
    </header>
    <!-- Header-area end -->
    
    <!-- Hero Slider start -->
    <div class="hero-slider hero-slider-bg-1" id="slider">
        <div class="single-slide" style="background-image: url({{ asset('backend/moffice/landing/images/slider/slider-top.png') }})">
            <!-- Hero Content One Start -->
            <div class="hero-content-one container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-8"> 
                        <div class="slider-text-info white-text">
                            <h1>M-OFFICE BAPPEDA <br>Kota SEMARANG.</h1>
                            <p>Applikasi data peminjaman ruang rapat dan zoom meeting berbasis digital yang sangat cocok untuk era 4.0 saat ini.</p>
                            <div class="slider-button">
                                <a href="#" class=" slider-btn uppercase"><span><i class="fa fa-android"></i>Google Play</span></a>
                                <a href="#" class="slider-btn uppercase"><span><i class="fa fa-windows"></i>Google play</span></a>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-3 offset-lg-2 col-md-4 text-center"> 
                        <div class="slider-inner-imge-2 banner-right">
                            <img src="{{ asset('backend/moffice/landing/images/slider/phone-1.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hero Content One End -->
        </div>
    </div>
    <!-- Hero Slider end -->
    
    
    
    <!-- Feature Area Start  -->
    <div  id="feature" class="feature-area section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 ml-auto mr-auto">
                    <div class="section-title">
                        <h2>Fitur Applikasi</h2>
                        <p>Dengan fitur yang serba digital, di harapkan dapat meningkatkan kinerja pegawai secara signifikan ke arah yang lebih baik</p>
                    </div>
                </div>
            </div>
            <div class="row align-items-center feature-area-inner">
                <div class="col-lg-4 order-md-2 col-md-6 order-lg-1">
                    <div class="feature-content-inner">
                        <div class="single-feature text-right row-reverse">
                            <div class="feature-icon">
                                <i class="ion-ios-speedometer-outline"></i>
                            </div>
                            <div class="feature-content">
                                <div class="feature-text">
                                <h4>Speed Optimized</h4>
                                <p>Mempercepat waktu up-time sehingga memudahkan user dalam mengakses applikasi.</p>
                            </div>
                            </div>
                        </div>
                        <div class="single-feature  text-right row-reverse">
                            <div class="feature-icon">
                                <i class="ion-ios-chatboxes-outline"></i>
                            </div>
                            <div class="feature-content">
                                <div class="feature-text">
                                <h4>Whatsapp Notification</h4>
                                <p>Dapatkan pemberitahuan melalui whatsapp ketika user lain menambah atau menghapus acara.</p>
                            </div>
                            </div>
                        </div>
                        <div class="single-feature  text-right row-reverse">
                            <div class="feature-icon">
                                <i class="ion-ios-lightbulb-outline"></i>
                            </div>
                            <div class="feature-content">
                                <div class="feature-text">
                                <h4>Creative Design</h4>
                                <p>Tampilan terlihat bagus di perangkat apa pun. Konten dapat dengan mudah dibaca dan pengguna.</p>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4  order-md-1 col-md-12 order-lg-2">
                    <div class="feature-image text-center">
                        <img src="{{ asset('backend/moffice/landing/images/screenshot/phone-2.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-4  order-md-3 col-md-6 order-lg-3 ">
                    <div class="feature-content">
                        <div class="single-feature">
                            <div class="feature-icon">
                                <i class="ion-ios-world-outline"></i>
                            </div>
                            <div class="feature-content">
                                <div class="feature-text">
                                <h4>Clean Design</h4>
                                <p>Desain yang bersih akan meningkatkan integritas anda terhadap penggunaan applikasi ini.</p>
                            </div>
                            </div>
                        </div>
                        <div class="single-feature">
                            <div class="feature-icon">
                                <i class="ion-ios-gear-outline"></i>
                            </div>
                            <div class="feature-content">
                                <div class="feature-text">
                                <h4>User Friendly</h4>
                                <p>Tampilan yang sangat mudah di gunakan. bahkan jika anda gaptek sekalipun.</p>
                            </div>
                            </div>
                        </div>
                        <div class="single-feature">
                            <div class="feature-icon">
                                <i class="ion-ios-cloud-download-outline"></i>
                            </div>
                            <div class="feature-content">
                                <div class="feature-text">
                                <h4>Downalods File</h4>
                                <p>Hanya perlu tekan sekali klik untuk mendownloa file applikasi.</p>
                                <a href="#download-area"  class="smooth-scroll"><button class="btn">Download</button></a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Area End -->
    
    <!-- Video Area Start -->
    <div class="video-area theme-bg video-banner-overlay">
        <div class="video-info text-center">
            <div class="vedio-popup-btn wow pulse" data-wow-duration="1s">
                <a href="http://www.youtube.com/watch?v=vhtjlDPEnU0" class="popup-youtube"> <img src="{{ asset('backend/moffice/landing/images/icon/iconroject.png') }}" alt=""> </a>
            </div>
            <h3 class="video-title text-white">Video Pengenalan</h3>  
            <p>Klik tombol di atas untuk memutar vidio.</p>
        </div>
    </div>
    <!-- Video Area End -->
    
    <!-- Project Count Area Start -->
    <div class="project-count-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="project-count-inner text-black-bg wow fadeInBottom" data-wow-duration="1s">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <!-- counter start -->
                                <div class="counter text-center">
                                    <h3 class="counter-active">241</h3>
                                    <p>APP Downloads</p>
                                </div>
                                <!-- counter end -->
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <!-- counter start -->
                                <div class="counter text-center">
                                    <h3 class="counter-active">531</h3>
                                    <p>Happy Clients</p>
                                </div>
                                <!-- counter end -->
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <!-- counter start --> 
                                <div class="counter text-center">
                                    <h3 class="counter-active">171</h3>
                                    <p>Total App Rates</p>
                                </div>
                                <!-- counter end -->
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <!-- counter start -->
                                <div class="counter text-center">
                                    <h3 class="counter-active">331</h3>
                                    <p>Awrds Winned</p>
                                </div>
                                <!-- counter start -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Project Count Area End -->   
    
    <!-- Testimonial Area Start -->
    
    <!-- Testimonial Area End -->
    
    <!-- Screenshot Area Start -->
    <div id="screnshot" class="screnshot-area section-ptb">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 ml-auto mr-auto">
                    <div class="section-title">
                        <h2>APP Screenshots</h2>
                        <p>Dengan foto screenshot di bawah ini diharapkan anda mengetahui gambaran secara visual sebelum mendownload applikasi</p>
                    </div>
                </div> 
            </div>
            <!-- Screnshot Content Two Start-->
            <div class="screnshot-content-three">
                <div class="row screenshot-center-active">
                    <div class="col-lg-3">
                        <!-- Singel Screenshot Start -->
                        <div class="singel-screenshot">
                            <img src="{{ asset('backend/moffice/landing/images/screenshot/1 (1).png') }}" alt="">
                        </div>
                        <!-- Singel Screenshot End -->
                    </div>
                    <div class="col-lg-3">
                        <!-- Singel Screenshot Start -->
                        <div class="singel-screenshot">
                            <img src="{{ asset('backend/moffice/landing/images/screenshot/1 (2).png') }}" alt="">
                        </div>
                        <!-- Singel Screenshot End -->
                    </div>
                    <div class="col-lg-3">
                        <!-- Singel Screenshot Start -->
                        <div class="singel-screenshot">
                            <img src="{{ asset('backend/moffice/landing/images/screenshot/1 (3).png') }}" alt="">
                        </div>
                        <!-- Singel Screenshot End -->
                    </div>
                    <div class="col-lg-3">
                        <!-- Singel Screenshot Start -->
                        <div class="singel-screenshot">
                            <img src="{{ asset('backend/moffice/landing/images/screenshot/1 (4).png') }}" alt="">
                        </div>
                        <!-- Singel Screenshot End -->
                    </div>
                    <div class="col-lg-3">
                        <!-- Singel Screenshot Start -->
                        <div class="singel-screenshot">
                            <img src="{{ asset('backend/moffice/landing/images/screenshot/1 (5).png') }}" alt="">
                        </div>
                        <!-- Singel Screenshot End -->
                    </div>
                    <div class="col-lg-3">
                        <!-- Singel Screenshot Start -->
                        <div class="singel-screenshot">
                            <img src="{{ asset('backend/moffice/landing/images/screenshot/1 (6).png') }}" alt="">
                        </div>
                        <!-- Singel Screenshot End -->
                    </div>
                    <div class="col-lg-3">
                        <!-- Singel Screenshot Start -->
                        <div class="singel-screenshot">
                            <img src="{{ asset('backend/moffice/landing/images/screenshot/1 (7).png') }}" alt="">
                        </div>
                        <!-- Singel Screenshot End -->
                    </div>
                </div>
            </div>
            <!-- Screnshot Content Two End-->
        </div>
    </div>
    <!-- Screenshot Area End -->
    
    <!-- Our Team Aare Start -->
    
    <!-- Our Team Aare End -->
    
    <!-- Download Area Start  -->
    <div class="download-area download-bg" id="download-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 ml-auto mr-auto">
                    <div class="section-title text-black">
                        <h2>Download APk Sekarang</h2>
                        <p>Klik tombol di bawah ini untuk mendownload file apk ataupun mendownloadnya melalui GOOGLE PLAY STORE di android anda.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="download-buttons text-center">
                        <a href="#" class="button"><i class="fa fa-android"></i>PLAY STORE</a>
                        <a href="#" class="button"><i class="fa fa-windows"></i>PLAY STORE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Download Area End  -->
    
    <!-- Contact Area Start -->
    <div id="contact" class="contact-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-info-container wow fadeInBottom" data-wow-duration="1s">    
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="contact-title">
                                    <h2>Hubungi Kami</h2>
                                    <p>Hubungi kami jika anda menemukan bugs pada applikasi kami dan jika anda menemukan error yang terjadi pada saat mengoperasikan applikasi M-OFFICE ini.</p>
                                </div>
                                <div class="contact-address">
                                    <ul>
                                        <li><i class="fa fa-phone"></i> <span class="information">{{ setting('telfon') }}</span></li>
                                        <li><i class="fa fa-envelope-o"></i> <span class="information"><a href="mailto:{{ setting('email') }}">{{ setting('email') }}</a></span></li>
                                        <li><i class="fa fa-map-o"></i> <span class="information">{!! setting('alamat') !!}</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <form class="contact-form-area" action="mail.php" method="post" id="contact-form">
                                    <div class="row contact-form">
                                        <div class="form-group col-md-12">
                                            <input name="name" class="form-control" placeholder="Name" type="text" id="name">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <input name="email" class="form-control" placeholder="Email" type="email" id="email">
                                        </div>                                      
                                        <div class="form-group col-md-12">
                                            <input name="subject" class="form-control" placeholder="Subject" type="text" id="subject">
                                        </div>  
                                        <div class="form-group col-md-12">
                                            <textarea name="message" class="yourmessage form-control" placeholder="Message"></textarea>
                                        </div>  
                                        <div class="submit-form form-group col-sm-12">
                                            <button class="button submit-btn" type="submit"><span>Submit</span></button>
                                            <p class="form-messege"></p>
                                        </div>                                          
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Area End -->
    
    <!-- Footer Area Start -->
    <footer class="footer-area">
        <div class="footer-content-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-content">
                            <div class="footer-logo">
                                <a href="index.html"><img src="{{ asset('backend/moffice/landing/images/logo/logo.png') }}" alt=""></a>
                            </div>
                            <p>Copyright © {{ date('Y')}} {{ env('APP_NAME', 'BAPPEDA') }}. All Rights Reserved</p>
                            <div class="social-link">
                                <a href="{{ setting('fb') }}"><i class="fa fa-facebook"></i></a>
                                <a href="{{ setting('twitter') }}"><i class="fa fa-twitter"></i></a>
                                <a href="{{ setting('ig') }}"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->
 
</div>
<!-- Main Wrapper End -->

<!-- JS
============================================ -->

<!-- jQuery JS -->
<script src="{{ asset('backend/moffice/landing/js/vendor/jquery-1.12.4.min.js') }}"></script>
<!-- Popper JS -->
<script src="{{ asset('backend/moffice/landing/js/popper.min.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('backend/moffice/landing/js/bootstrap.min.js') }}"></script>
<!-- Plugins JS -->
<script src="{{ asset('backend/moffice/landing/js/plugins.js') }}"></script>
<!-- Ajax Mail -->
<script src="{{ asset('backend/moffice/landing/js/ajax-mail.js') }}"></script>
<!-- Main JS -->
<script src="{{ asset('backend/moffice/landing/js/main.js') }}"></script>


</body>

</html>