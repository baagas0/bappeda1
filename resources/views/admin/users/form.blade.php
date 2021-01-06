@extends('layouts.backend.app')
@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <form method="POST" action="{{ (empty($data) ? route('users.create') : route('users.update', $data->id)) }}" enctype="multipart/form-data">
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
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <label for="parent_id" class="control-label col-form-label">Photo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="file" name="photo">
                                    <label class="custom-file-label" for="file">Choose Image</label>
                                </div>
                                <small id="comment_file" style="color:red"></small>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <div class="form-group">
                                <?php use App\Models\Role;use App\Models\Bidang;use App\Models\Users;
                                    $role= Role::whereNotIn('id', ['4', '5'])->get();
                                    $user= Users::select('username')->get();
                                    // dd($user);
                                    $bidang = Bidang::whereNotIn('route', $user)->get();
                                ?>
                                <label for="parent_id" class="control-label col-form-label">Role</label>
                                <select class="form-control" style="border: 1px solid;border-color: red;color: red" name="role" id="role">
                                    <option value="pilih">Pilih</option>
                                    @foreach($role as $r)
                                    <option value="{{ $r->name }}" 
                                        @if(Route::currentRouteName() == 'users.create')
                                        @else
                                        @foreach(json_decode($data->roles) as $d)
                                            {{ ($r->name == $d->name) ? 'selected' : '' }}
                                        @endforeach
                                        @endif 

                                    id="{{ $r->name }}">{{ $r->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="title" class="control-label col-form-label">Nama</label>
                                <input required type="text" class="form-control" value="{{ (empty($data) ? old('name') : $data->name) }}" name="name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="link_order" class="control-label col-form-label" id="usernametext"></label>
                                <div class="usernameinput1" id="usernameinput1"></div>
                                <label style="color: red" id="username_comment"></label>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="link_order" class="control-label col-form-label">E-mail</label>
                                <input type="text" required class="form-control" id="email" name="email" value="{{ (empty($data) ? old('email') : $data->email) }}">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="link_order" class="control-label col-form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="action-form p-2 float-right">
                    <div class="form-group m-b-0 text-left">
                        <button id="save" type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                        <button class="btn btn-dark waves-effect waves-light">Cancel</button>
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
<script>
    $(document).ready(function() {
        $("#usernametext").text('Username');
        $("#usernameinput1").html('<input type="text" required class="form-control" id="username" name="username" value="{{ (empty($data) ? old('username') : $data->username) }}">');
        $("#username_comment").hide();

      $("#role").change(function() {
        var role = $("#role").val();
        // $("#usernameinput").remove();
        // $("#usernameinput1").remove();
        $("#usernametext").text('Username');

        if(role == "bidang") {
            $("#usernametext").text('Bidang');
            $("#usernameinput1").html('<select class="form-control" style="border: 1px solid;border-color: red;color: red" name="username" id="username"><option value="pilih">Pilih</option>@foreach($bidang as $b)<option value="{{ $b->route }}" id="{{ $b->route }}">{{ $b->bidang }}</option>@endforeach</select>');
            $("#username_comment").show();
            $("#username_comment").html('1 Bidang Hanya 1 Account');
        }else {
            $("#usernameinput1").html('<input type="text" required class="form-control" id="username" name="username" value="{{ (empty($data) ? old('username') : $data->username) }}">');
            $("#username_comment").hide();
        }

      });

      $("#file").change(function() {
        if(this.files[0].size > 1000000) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ukuran file melebihi 1mb!',
                confirmButtonText : 'tutup'
            }).then(function() {
                $("#comment_file").show();
                $("#comment_file").text('File melebihi batas (1mb), Silahkan compress file terlebih dahulu');
				$('#save').hide();
            });
        }else {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Silahkan mengisi form yang lain',
                confirmButtonText : 'tutup'
            }).then(function() {
                $("#comment_file").hide();
				$('#save').show();
            });
        }
      });
    });
</script>
@endpush