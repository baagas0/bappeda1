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
            <form method="POST" action="{{ (empty($data) ? route('menu.store') : route('menu.update', $data->id)) }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <span class="badge badge-info"><i class="mdi mdi-access-point-network"></i></span>
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
                                <label for="title" class="control-label col-form-label">Nama Menu</label>
                                <input type="text" required class="form-control" value="{{ (empty($data) ? old('title') : $data->title) }}" name="title">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="parent_id" class="control-label col-form-label">Parent</label>
                                <select required="" class="form-control" name="parent_id" >
                                    <option value="0">Pilih</option>
                                    <?php
                                        $menus = \DB::table('menu')
                                        ->where('parent_id','=','0')
                                        ->orderby('menu_order','asc')
                                        ->get();
                                    ?>
                                    @foreach($menus as $menu)
                                    <option value="{{$menu->id}}" {{ empty($data) ? old('parent_id') : ($data->parent_id == $menu->id ? 'selected' : '') }}>{{$menu->title}}</option>
                                    <?php
                                        $menus1 = \DB::table('menu')
                                        ->where('parent_id','=',$menu->id)
                                        ->orderby('menu_order','asc')
                                        ->get();
                                    ?>
                                    @foreach($menus1 as $menu1)
                                    <option value="{{$menu1->id}}" {{ empty($data) ? old('parent_id') : ($data->parent_id == $menu1->id ? 'selected' : '') }}>&nbsp;&nbsp;&nbsp;{{$menu1->title}}</option>
                                    <?php
                                        $menus2 = \DB::table('menu')
                                        ->where('parent_id','=',$menu1->id)
                                        ->orderby('menu_order','asc')
                                        ->get();
                                    ?>
                                    @foreach($menus2 as $menu2)
                                    <option value="{{$menu2->id}}" {{ empty($data) ? old('parent_id') : ($data->parent_id == $menu2->id ? 'selected' : '') }}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$menu2->title}}</option>
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="jenurl" class="control-label col-form-label">Jenis</label>
                                <select class="form-control" name="jenurl">
                                    <option value="0" {{ empty($data) ? (old('jenurl') == '0' ? 'selected' : '') : ($data->jenurl == '0' ? 'selected' : '') }}>Pilih</option>

                                    <option value="1" {{ empty($data) ? (old('jenurl') == '1' ? 'selected' : '') : ($data->jenurl == '1' ? 'selected' : '') }}>Dokumen</option>

                                    <option value="2" {{ empty($data) ? (old('jenurl') == '2' ? 'selected' : '') : ($data->jenurl == '2' ? 'selected' : '') }}>Link</option> 
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="target" class="control-label col-form-label">Target Link</label>
                                <select class="form-control" name="target">
                                    <option value="">Pilih</option>
                                    <option value="_blank" {{ empty($data) ? (old('target') == '_blank' ? 'selected' : '') : ($data->target == '_blank' ? 'selected' : '') }}>_blank</option>

                                    <option value="_new" {{ empty($data) ? (old('target') == '_new' ? 'selected' : '') : ($data->target == '_new' ? 'selected' : '') }}>_new</option>  

                                    <option value="_parent" {{ empty($data) ? (old('target') == '_parent' ? 'selected' : '') : ($data->target == '_parent' ? 'selected' : '') }}>_parent</option> 
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="url" class="control-label col-form-label">Link</label>
                                <input type="text" required="" class="form-control" id="url" name="url" value="{{ (empty($data) ? old('url') : $data->url) }}">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="menu_order" class="control-label col-form-label">Urutan</label>
                                <input type="text" required="" class="form-control" id="menu_order" name="menu_order" value="{{ (empty($data) ? old('menu_order') : $data->menu_order) }}">
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