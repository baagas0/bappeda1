@extends('layouts.backend.app')
@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <form method="POST" action="{{ (empty($data) ? route('page.store') : route('page.update', $data->id)) }}">
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
                                <label for="parent_id" class="control-label col-form-label">Menu</label>
                                <select class="form-control" name="menu_id">
                                    <option value="0">Pilih</option>
                                    <?php
                                        $menus = \DB::table('menu')
                                        ->where('jenurl','=','1')
                                        ->whereNotExists(function($query){
                                            $query->select(DB::raw(1))
                                                ->from('dokumen')
                                                ->whereRaw('dokumen.menu_id=menu.id');
                                        })
                                        ->get();

                                        $menuedit = \DB::table('menu')
                                        ->where('jenurl','=','1')
                                        ->get();
                                    ?>
                                    @foreach( (empty($data) ? $menus : $menuedit) as $menu)
                                        <option value="{{$menu->id}}" {{ empty($data) ? (old('menu_id') == $menu->id ? 'selected' : '') : ($menu->id == $data->menu_id  ? 'selected' : '') }}>{{$menu->title}}</option>
                                    @endforeach  
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="title" class="control-label col-form-label">Judul</label>
                                <input type="text" class="form-control" value="{{ (empty($data) ? old('title') : $data->title) }}" name="title">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Content</h4>                             
                                    <textarea id="mymce" name="content">{!! (empty($data) ? old('content') : $data->content) !!}</textarea>
                              
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-sm-12 col-md-12">
                            <input type="text" name="iduser" hidden value="{{ Auth::user()->id }}">
                        </div> --}}
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ...
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
<!-- End row -->
@endsection
@push('css')
@endpush
@push('js')
<script src="{{ asset('backend/assets/libs/tinymce/tinymce.min.js') }}"></script>
<script>
    $(document).ready(function() {

        if ($("#mymce").length > 0) {
            tinymce.init({
                selector: "textarea#mymce",
                theme: "modern",
                height: 300,
                plugins: [
                    "advlist autolink link lists charmap print preview hr anchor pagebreak spellchecker",
                    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                    "save table contextmenu directionality emoticons template paste textcolor"
                ],
                toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | print preview fullpage | forecolor backcolor emoticons",

            });
        }
    });
</script>
@endpush