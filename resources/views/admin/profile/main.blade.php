@extends('layouts.backend.app')
@section('breadcrumb')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Menu</h4>
            <div class="d-flex align-items-center">

            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item ">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Menu</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-3 col-sm-12">
        <div class="card m-b-30 border-0">
            <div class="row text-center text-white profile-block" style="height: 100px;">
                <div class="col-4 align-self-center">
                    <a href="#">

                    </a>
                </div>
                <div class="col-4 ml-auto align-self-center">
                    <a href="mailto:{{ Auth::user()->email }}">
                        <i class="fa fa-envelope"></i>
                    </a>
                </div>
            </div>
            <div class="card-body pro-img mx-auto text-center">
                <img src="{{ asset(Auth::user()->photo) }}" alt="" class="rounded-circle mx-auto d-block">
            </div>
            <div class="text-center">
                <h5>{{ Auth::user()->name }}</h5>
                <p class="text-muted">Admin</p>
                <p class="text-muted p-2">{{ Auth::user()->description }}</p>
            </div>

            
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="card m-b-30 contact">
                    <div class="card-body">
                        <h6 class="header-title pb-3">Contact</h6>
                        <ul class="list-unstyled">
                            <li class=""><i class="fa fa-phone mr-2"></i> <b> phone </b> : +91 23456 78910</li>
                            <li class="mt-2"><i class="fa fa-envelope-o mt-2 mr-2"></i> <b> Email </b> : mannat.theme@gmail.com</li>
                            <li class="mt-2"><i class="fa fa-map-marker mt-2 mr-2"></i> <b>Location</b> : USA</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9 col-sm-12">
        <div class="card-title tab-2">
            <ul class="nav nav-tabs nav-justified">
                <li class="nav-item">
                    <a class="nav-link active" href="#about" data-toggle="tab" aria-expanded="false"><i class="ti-user mr-2"></i>Informasi Data</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#photo" data-toggle="tab" aria-expanded="false"><i class="ti-image mr-2"></i>Update Data</a>
                </li>                                                

                <li class="nav-item">
                    <a class="nav-link" href="#settings" data-toggle="tab" aria-expanded="false"><i class="ti-settings mr-2"></i>Aktifitas</a>
                </li>                                                
            </ul>
            <div class="tab-content p-4 bg-white">
                <div class="tab-pane home-text p-4" id="home-6">
                    <img src="{{ asset('backend/assets/images/logo_sm.png') }}" alt="">
                    <h1>Syntra Admin Template</h1>
                    <h4 class="text-muted">Sociis natoque penatibus et magnis dis parturient montes.</h4>
                </div>
                <div class="tab-pane active p-4" id="about">
                    <div class="row justify-content-center">
                        <div class="col-md-12  profile-detail">
                            <div class="text-center">
                                <i class="fa fa-graduation-cap"></i>
                                <h5>Personal Details</h5>
                                <div class="profile-border my-3"></div>
                                <p class="detail-text">{{ Auth::user()->description }}</p>

                            </div>
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <div class="presonal-inform">
                                        <ul class="list-unstyled">
                                            <li><b>Username:</b>{{ Auth::user()->username }}</li>
                                            <li><b>Email:</b><a href="mailto: {{ Auth::user()->email  }}">{{ Auth::user()->email  }}</a></li>
                                            <li><b>Nama:</b>{{ Auth::user()->name }}</li>
                                            <li><b>Register Date:</b> {{ date('d M Y', strtotime(Auth::user()->created_at)) }}</li>
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div><!--END ROW-->
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="photo">
                    <div class="general-label">
                        <div class="portlet">
                            <div class="portlet-heading bg-warning">
                                <h3 class="portlet-title text-white">
                                    Informasi
                                </h3>
                                <div class="portlet-widgets">
                                    <a href="javascript:;" data-toggle="reload"><i class="fa fa-refresh"></i></a>
                                    <span class="divider"></span>
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#bg-warning"><i class="fa fa-minus"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div id="bg-warning" class="panel-collapse collapse in show">
                                <div class="portlet-body">
                                    <div>
                                        * Mohon Hubungi Admin Jika Ingin Mengganti / Lupa Password
                                    </div>
                                    <div>
                                        * Isi <span class="text-danger">Konfirmasi Password</span> Dengan Password Sekarang Untuk Memvalidasi Bahwa Ini Memang Anda
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form role="form" method="POST" action="{{ route('profile.update') }}"  enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Username </label>
                                        <input type="text" disabled class="form-control" value="{{ Auth::user()->username }}">
                                    </div>
                                </div>
                                <div class="col-md-6">         
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama</label>
                                        <input type="text"  class="form-control" id="exampleInputEmail1" name="name" value="{{ Auth::user()->name }}">
                                    </div>  
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Deskripsi</label>
                                        <textarea class="form-control" name="description" rows="5">{{ Auth::user()->description }}</textarea>
                                    </div>  
                                </div>
                                
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Foto</label>
                                        <input type="file" class="form-control" id="photo" name="photo">
                                    </div>  
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="text-danger">Konfirmasi Password</label>
                                        <input type="password" class="form-control" name="password" id="password" style="color:red;border-color: red">
                                    </div>  
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>                                    
                    </div>  
                </div>
                <div class="tab-pane" id="settings">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
                            <div class="card m-b-30">
                                <div class="card-body">
                                    <h5 class="header-title pb-3">Activities</h5>
                                    <div id="user-activities" class="tab-pane">
                                        <div class="timeline-2">
                                            <?php use App\Helpers\Activity; ?>
                                            @foreach(Activity::list() as $log)
                                            <div class="time-item">
                                                <div class="item-info">
                                                    <div class="text-muted">{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</div>
                                                    <p><strong><a href="#" class="text-info">{{ $log->page }}</a></strong> {{ $log->description }}</p>
                                                    <p><a href="http://{{ $log->ip }}">{{ $log->ip }}</a></p>
                                                    <p>{{ $log->agent }}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </div>                                    
        </div>

        
    </div>            
</div>
@endsection
@push('css')
{{-- <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script> --}}
{{-- <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script> --}}

<link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endpush
@push('js')

<script src="{{ asset('backend/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script src="{{ asset('backend/dist/js/pages/datatable/datatable-advanced.init.js') }}"></script>


@endpush