<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mannat Themes">
    <meta name="keyword" content="">

    <title>{{ env('APP_NAME', 'BAPPEDA') }} Dashboard Login</title>

    <!-- Theme icon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    <!-- Theme Css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/slidebars.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/icons.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/css/menu.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/style.css') }}" rel="stylesheet">
</head>

<body class="sticky-header">
    <section class="bg-login" style="background-image: url('backend/assets/images/bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="wrapper-page">
                        <div class="account-pages">
                            <div class="account-box">
                                <div class="card m-b-30">
                                    <div class="card-body">
                                        <div class="card-title text-center">
                                            <img src="https://bappeda.semarangkota.go.id/packages/tugumuda/claravel/assets/images/favicon.png" alt="" class="">
                                            <h5 class="mt-3"><b>Welcome to <br> BAPPEDA DASHBOARD</b></h5>
                                        </div>  
                                        <form class="form mt-5 contact-form" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            @if (session('error'))
                                            <div class="alert alert-danger">{{ session('error') }}</div>
                                            @endif
                                            <div class="form-group ">
                                                <div class="col-sm-12">
                                                    <input class="form-control form-control-line @error('username') is-invalid @enderror" type="text" placeholder="Username/Email" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
                                                    @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="col-sm-12">
                                                    <input class="form-control form-control-line @error('password') is-invalid @enderror"id="password" type="password"
                                                    name="password" placeholder="Password" required autocomplete="current-password">

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-12">
                                                    <label class="cr-styled">
                                                        <input  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <i class="fa"></i> 
                                                        Remember me
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-12 mt-4">
                                                    <button class="btn btn-danger btn-block" type="submit">Log In</button>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-sm-12 mt-4 text-center">
                                                    @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}"><i class="fa fa-lock m-r-5"></i> Forgot password?</a>
                                                    @endif
                                                    
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
        </div>
    </section>

    <!-- jQuery -->
    <script src="{{ asset('backend/assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery-migrate.js') }}"></script>
    <script src="{{ asset('backend/assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/slidebars.min.js') }}"></script>


    <!--app js-->
    <script src="{{ asset('backend/assets/js/jquery.app.js') }}"></script>
</body>
</html>
