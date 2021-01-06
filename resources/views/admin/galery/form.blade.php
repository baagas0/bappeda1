@extends('layouts.backend.app')
@section('breadcrumb')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">{{ $title }}</h4>
            <div class="d-flex align-items-center">

            </div>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex no-block justify-content-end align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('menu.create') }}">Menu</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <form method="POST" action="{{ (empty($data) ? route('album.store') : route('album.update', $data->id)) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <span class="badge badge-info"><i class="fas fa-info"></i></span>
                        <strong> Silahkan Input Data Di Form Bawah Dengan Data Yang Valid.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <h6 class="card-subtitle">Silahkan Klik Save Jika Ingin Mem Proses Data Yang Di Input Dan Klik Batal Untuk Kembali</h6>
                </div>
                <hr>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="link_order" class="control-label col-form-label">nama</label>
                                <input type="text" class="form-control" id="album" name="album" value="{{ (empty($data) ? old('album') : $data->album) }}">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="parent_id" class="control-label col-form-label">Lokasi</label>
                                <input type="text" class="form-control" id="lokasi" name="lokasi" value="{{ (empty($data)) ? '' : $data->lokasi }}">
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="action-form p-2 float-right">
                    <div class="form-group m-b-0 text-left">
                        <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                        <button type="submit" class="btn btn-dark waves-effect waves-light">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End row -->
@endsection
@push('css')
@endpush
@push('js')
@endpush