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
            <form method="POST" action="
        @if(Route::currentRouteName() == 'link')
            @if(empty($data))
                {{ route('link.store') }}
            @else
                {{ route('link.update') }}
            @endif
        @else
            @if(empty($data))
                {{ route('applikasi.store') }}
            @else
                {{ route('applikasi.update') }}
            @endif
        @endif" enctype="multipart/form-data">
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
                                <label for="title" class="control-label col-form-label">{{ (Route::currentRouteName() == 'link') ? 'Nama Tautan' : 'Nama Applikasi' }}</label>
                                <input required type="text" class="form-control" value="{{ (empty($data) ? old('title') : $data->title) }}" name="title">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="parent_id" class="control-label col-form-label">URL</label>
                                <input required type="text" class="form-control" id="url" name="url" value="{{ (empty($data) ? (is_null(old('url')) ? 'https://' : old('url')) : $data->url) }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                @if(Route::currentRouteName() == 'link.create')
                                <label for="title" class="control-label col-form-label">Urutan</label>
                                <input required type="text" class="form-control" value="{{ (empty($data) ? old('link_order') : $data->link_order) }}" name="link_order">
                                @else
                                <label for="parent_id" class="control-label col-form-label">photo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="photo">
                                    <label class="custom-file-label" for="file">Choose Image</label>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="jenurl" class="control-label col-form-label">Target</label>
                                <select class="custom-select mr-sm-2" id="target" name="target">
                                    <option selected>Pilih...</option>
                                    <option value="_blank" {{ (empty($data) ? (old('target') == '_blank' ? 'selected' : '') : ($data->target == '_blank' ? 'selected' : '')) }} >Tab Baru</option>
                                    <option value="_self" {{ (empty($data) ? (old('target') == '_self' ? 'selected' : '') : ($data->target == '_self' ? 'selected' : '')) }} >Langsung</option>
                                </select>
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