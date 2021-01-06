<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mannat Themes">
    <meta name="keyword" content="">

    <title>{{ setting('title') }}</title>
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-178882699-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-178882699-1');
    </script>

    <!-- Theme icon -->
    <link rel="shortcut icon" href="https://bappeda.semarangkota.go.id/packages/tugumuda/claravel/assets/images/favicon.png">
    <link href="{{ asset('backend/assets/plugins/morris-chart/morris.css') }}" rel="stylesheet">
    <!-- Theme Css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/slidebars.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/menu.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">
    <!--notifications-->
    <link href="{{ asset('backend/assets/plugins/notifications/notification.css') }}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/r-2.2.6/datatables.min.css"/>
    @stack('css')
    
</head>

<body class="sticky-header">
    <section>
        <!-- sidebar left start-->
        @include('layouts.backend.partials.sidebar')
        <!-- sidebar left end-->

            <!-- body content start-->
            <div class="body-content">
                <!-- header section start-->
                @include('layouts.backend.partials.topbar')
                <!--right notification end-->
            </div>
        </div>
        <!-- header section end-->

        <div class="container-fluid">
            <div class="page-head">
                <div class="row">
                    <div class="col-md-6">
                        
                        <h4 class="mt-2 mb-2">@yield('breadcumb', 'Dashboard')</h4>
                    </div>  
                    <div class="col-md-6 float-right">
                        @yield('rihgt-head')
                    </div>    
                </div>
            </div>
            @yield('content')          
        </div>
        <!--end container-->

        <!--footer section start-->
        <footer class="footer">
            {{ date('Y') }} &copy; Bappeda.
        </footer>
        <!--footer section end-->


        <!-- Activity Slidebar start -->
        @include('layouts.backend.partials.activity')
        <!--end Activity Slidebar-->
    </div>
            <!--end body content-->
    </section>
</body>
</html>
<!-- jQuery -->
<script src="{{ asset('backend/assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/jquery-migrate.js') }}"></script>
<script src="{{ asset('backend/assets/js/modernizr.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/slidebars.min.js') }}"></script>

<!--plugins js-->
<script src="{{ asset('backend/assets/plugins/counter/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/waypoints/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/sparkline-chart/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('backend/assets/pages/jquery.sparkline.init.js') }}"></script>

<!-- <script src="{{ asset('backend/assets/plugins/chart-js/Chart.bundle.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/morris-chart/raphael-min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/morris-chart/morris.js') }}"></script> -->
<script src="{{ asset('backend/assets/pages/dashboard-init.js') }}"></script>

<!--Notifications-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('backend/assets/plugins/notifications/notify.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/notifications/notify-metro.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/notifications/notifications.js') }}"></script>

<!-- Parsley js -->
<script type="text/javascript" src="{{ asset('backend/assets/plugins/parsleyjs/dist/parsley.min.js') }}"></script>

<!--app js-->
<script src="{{ asset('backend/assets/js/jquery.app.js') }}"></script>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/r-2.2.6/datatables.min.js"></script>

<script>
    $(document).ready(function(){ 

        $('form').parsley();

        @if ($message = Session::get('info'))
            $.Notification.autoHideNotify('info', 'top right', 'Informasi !!!', {!! json_encode($message, JSON_HEX_TAG) !!});
        @endif
        @if ($message = Session::get('success'))
            $.Notification.autoHideNotify('success', 'top right', 'Sukses !!!', {!! json_encode($message, JSON_HEX_TAG) !!});
        @endif
        @if ($message = Session::get('warning'))
            $.Notification.autoHideNotify('warning', 'top right', 'Perhatian !!!', {!! json_encode($message, JSON_HEX_TAG) !!});
        @endif
        @if ($message = Session::get('error'))
            $.Notification.autoHideNotify('error', 'top right', 'Error !!!', {!! json_encode($message, JSON_HEX_TAG) !!});
        @endif
        @if ($message = Session::get('penting'))
            $.Notification.autoHideNotify('black', 'top right', 'Penting !!!', {!! json_encode($message, JSON_HEX_TAG) !!});
        @endif
        @if ($message = Session::get('white'))
            $.Notification.autoHideNotify('white', 'top right', 'Sample Notification', {!! json_encode($message, JSON_HEX_TAG) !!});
        @endif
    });
    jQuery(document).ready(function($) {
        $('.counter').counterUp({
            delay: 100,
            time: 1200
        });
    });
</script>

<!--Custom js-->
@stack('js')