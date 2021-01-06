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
            <form method="POST" action="{{ (empty($data) ? route('news.store') : route('news.update', $data->id)) }}" enctype="multipart/form-data">
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
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="parent_id" class="control-label col-form-label">Judul</label>
                                <input type="text" class="form-control" value="{{ (empty($data) ? old('judul') : $data->judul) }}" name="judul">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="kegiatan" class="control-label col-form-label">Pengantar</label>
                                <textarea id="pengantar" class="form-control" rows="3" name="pengantar">{!! (empty($data) ? old('pengantar') : $data->pengantar) !!}</textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="kegiatan" class="control-label col-form-label">Isi</label>
                                <textarea id="isi" class="form-control" rows="3" name="isi">{!! (empty($data) ? old('isi') : $data->isi) !!}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="parent_id" class="control-label col-form-label">Warna</label>
                                <select class="form-control" name="warna">
                                    <option value="">Pilih Warna</option>
                                    <option value="lime accent-3" {{ (empty($data) ? (old('warna') == 'lime accent-3' ? 'selected' : '') : ($data->warna == 'lime accent-3' ? 'selected' : '')) }}>Lime</option>
                                    <option value="yellow accent-3" {{ (empty($data) ? (old('warna') == 'yellow accent-3' ? 'selected' : '') : ($data->warna == 'yellow accent-3' ? 'selected' : '')) }}>Yellow</option>
                                    <option value="cyan accent-3" {{ (empty($data) ? (old('warna') == 'cyan accent-3' ? 'selected' : '') : ($data->warna == 'cyan accent-3' ? 'selected' : '')) }}>Cyan</option>
                                    <option value="blue lighten-4" {{ (empty($data) ? (old('warna') == 'blue lighten-4' ? 'selected' : '') : ($data->warna == 'blue lighten-4' ? 'selected' : '')) }}>Blue Ligth</option>
                                    <option value="purple accent-1" {{ (empty($data) ? (old('warna') == 'purple accent-1' ? 'selected' : '') : ($data->warna == 'purple accent-1' ? 'selected' : '')) }}>Purple</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="parent_id" class="control-label col-form-label">Ukuran</label>
                                <select class="form-control" name="ukuran">
                                    <option>Pilih Ukuran</option>
                                    <option value="1" {{ (empty($data) ? (old('ukuran') == '1' ? 'selected' : '') : ($data->ukuran == '1' ? 'selected' : '')) }}>Kecil</option>
                                    <option value="2" {{ (empty($data) ? (old('ukuran') == '2' ? 'selected' : '') : ($data->ukuran == '2' ? 'selected' : '')) }}>Besar</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="parent_id" class="control-label col-form-label">Sumber</label>
                                <input type="text" class="form-control" value="{{ (empty($data) ? old('sumber') : $data->sumber) }}" name="sumber">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="parent_id" class="control-label col-form-label">Publish ?</label><br>
                                <input type="checkbox" value="" {{ (empty($data) ? 'checked' : ($data->flag == '1') ? 'checked' : '')}} name="flag">
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
<link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/libs/summernote/dist/summernote-bs4.css') }}">
@endpush
@push('js')
<script src="{{ asset('backend/assets/libs/summernote/dist/summernote-bs4.min.js') }}"></script>
<script>
     $('#pengantar').summernote({
        height: 200, // set editor height
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        focus: true // set focus to editable area after initializing summernote
    });

     $('#isi').summernote({
        height: 200, // set editor height
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        focus: true // set focus to editable area after initializing summernote
    });
</script>
@endpush