@extends('layouts.backend.app')
@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <form method="POST" action="{{ (empty($data) ? route('berita.add') : route('berita.edit', $data->id)) }}" enctype="multipart/form-data">
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
                    @if(empty($data))
                    @else
                    <h6 class="card-subtitle" style="color: red;padding-top:10px">Foto 1, 2, 3, 4 biarkan kosong jika tidak ingin mengganti</h6>
                    @endif
                </div>
                <hr>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="parent_id" class="control-label col-form-label">File 1</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file[]">
                                    <label class="custom-file-label" for="file">Choose Image</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="parent_id" class="control-label col-form-label">File 2</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file[]">
                                    <label class="custom-file-label" for="file">Choose Image</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="parent_id" class="control-label col-form-label">File 3</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file[]">
                                    <label class="custom-file-label" for="file">Choose Image</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="parent_id" class="control-label col-form-label">File 4</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file[]">
                                    <label class="custom-file-label" for="file">Choose Image</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">  
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group"> 
                                <label for="parent_id" class="control-label col-form-label">Bidang</label>
                                <div class="custom-file">
                                    <?php use App\Models\Bidang as BidangModels;use App\Models\Users as UsersModels;use Auth as UserAuth;
                                    $bidang = BidangModels::get();
                                    $userggg = UsersModels::findOrFail(UserAuth::user()->id);
                                    
                                    ?>
                                    <label class="cr-styled">
                                        <input name="is_sosbud" type="checkbox" {{ ($data->is_sosbud == 1) ? 'checked' : '' }}>
                                        <i class="fa"></i> 
                                        sosbud
                                    </label>
                                    <label class="cr-styled">
                                        <input name="is_ekonomi" type="checkbox" {{ ($data->is_ekonomi == 1) ? 'checked' : '' }}>
                                        <i class="fa"></i> 
                                        Ekonomi
                                    </label>
                                    <label class="cr-styled">
                                        <input name="is_infrastruktur" type="checkbox" {{ ($data->is_infrastruktur == 1) ? 'checked' : '' }}>
                                        <i class="fa"></i> 
                                        Infrastruktur
                                    </label>
                                    <label class="cr-styled">
                                        <input name="is_ppe" type="checkbox" {{ ($data->is_ppe == 1) ? 'checked' : '' }}>
                                        <i class="fa"></i> 
                                        PPE
                                    </label>
                                    <label class="cr-styled">
                                        <input name="is_litbang" type="checkbox" {{ ($data->is_litbang == 1) ? 'checked' : '' }}>
                                        <i class="fa"></i> 
                                        Litbang
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="header-title">Content Caption</h5>
                                    <p class="text-muted">Silahkan Isi Content</p> 
                                    <textarea id="summernote" name="caption">{!! (empty($data) ? '' : $data->caption) !!}</textarea>
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
                        <a href="{{ route('berita') }}"><button type="" class="btn btn-dark waves-effect waves-light">Cancel</button></a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End row -->
@endsection
@push('css')
<!--summernote plugin-->
<link href="{{ asset('backend/assets/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">
@endpush
@push('js')
<script src="{{ asset('backend/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>

<script type="text/javascript">
    $(function() {

              // main summernote with custom placeholder
              var $placeholder = $('.placeholder');
              $('#summernote').summernote({
                height: 300,
                codemirror: {
                    mode: 'text/html',
                    htmlMode: true,
                    lineNumbers: true,
                    theme: 'monokai'
                },
                callbacks: {
                  onInit: function() {
                    $placeholder.show();
                }

            }
        });
          });
      </script>
@endpush