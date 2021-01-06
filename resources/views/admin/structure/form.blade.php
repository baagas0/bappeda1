@extends('layouts.backend.app')
@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="card">
            <form  enctype="multipart/form-data" method="POST" action="{{ (empty($data) ? route('structure.store') : route('structure.update', $data->id)) }}">
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
                                <label for="title" class="control-label col-form-label">Image</label>
                                <input type="file" class="form-control" value="{{ (empty($data) ? old('image') : $data->image) }}" name="image">
                                {{ (empty($data) ? '' :  'Kosongkan image jika tidak ingin mengganti') }}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="parent_id" class="control-label col-form-label">Parent</label>
                                <select required="" class="form-control" name="parent_id" >
                                    <option value="0">========PILIH========</option>
                                    <?php
                                        $menus = \DB::table('structures')
                                        ->where('parent_id','=','0')
                                        ->get();
                                    ?>
                                    @foreach($menus as $menu)
                                        <option value="{{$menu->id}}" {{ empty($data) ? old('parent_id') : ($data->parent_id == $menu->id ? 'selected' : '') }}>{{$menu->name}}</option>
                                        <?php
                                            $menus1 = \DB::table('structures')
                                            ->where('parent_id','=',$menu->id)
                                            ->get();
                                        ?>
                                        @foreach($menus1 as $menu1)
                                            <option value="{{$menu1->id}}" {{ empty($data) ? old('parent_id') : ($data->parent_id == $menu1->id ? 'selected' : '') }}>&nbsp;{{$menu1->name}}</option>
                                            <?php
                                                $menus2 = \DB::table('structures')
                                                ->where('parent_id','=',$menu1->id)
                                                ->get();
                                            ?>
                                            @foreach($menus2 as $menu2)
                                                <option value="{{$menu2->id}}" {{ empty($data) ? old('parent_id') : ($data->parent_id == $menu2->id ? 'selected' : '') }}>&nbsp;&nbsp;{{$menu2->name}}</option>
                                                <?php
                                                    $menus3 = \DB::table('structures')
                                                    ->where('parent_id','=',$menu2->id)
                                                    ->get();
                                                ?>
                                                @foreach($menus3 as $menu3)
                                                    <option value="{{$menu3->id}}" {{ empty($data) ? old('parent_id') : ($data->parent_id == $menu3->id ? 'selected' : '') }}>&nbsp;&nbsp;&nbsp;{{$menu3->name}}</option>
                                                    <?php
                                                        $menus4 = \DB::table('structures')
                                                        ->where('parent_id','=',$menu3->id)
                                                        ->get();
                                                    ?>
                                                    @foreach($menus4 as $menu4)
                                                        <option value="{{$menu4->id}}" {{ empty($data) ? old('parent_id') : ($data->parent_id == $menu4->id ? 'selected' : '') }}>&nbsp;&nbsp;&nbsp;&nbsp;{{$menu4->name}}</option>
                                                        <?php
                                                            $menus5 = \DB::table('structures')
                                                            ->where('parent_id','=',$menu4->id)
                                                            ->get();
                                                        ?>
                                                        @foreach($menus5 as $menu5)
                                                            <option value="{{$menu5->id}}" {{ empty($data) ? old('parent_id') : ($data->parent_id == $menu5->id ? 'selected' : '') }}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$menu5->name}}</option>
                                                            <?php
                                                                $menus6 = \DB::table('structures')
                                                                ->where('parent_id','=',$menu5->id)
                                                                ->get();
                                                            ?>
                                                            @foreach($menus6 as $menu6)
                                                                <option value="{{$menu6->id}}" {{ empty($data) ? old('parent_id') : ($data->parent_id == $menu6->id ? 'selected' : '') }}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$menu6->name}}</option>
                                                                <?php
                                                                    $menus7 = \DB::table('structures')
                                                                    ->where('parent_id','=',$menu6->id)
                                                                    ->get();
                                                                ?>
                                                                @foreach($menus7 as $menu7)
                                                                    <option value="{{$menu7->id}}" {{ empty($data) ? old('parent_id') : ($data->parent_id == $menu7->id ? 'selected' : '') }}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$menu7->name}}</option>
                                                                @endforeach
                                                            @endforeach
                                                        @endforeach
                                                    @endforeach
                                                @endforeach
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
                                <label for="name" class="control-label col-form-label">Name</label>
                                <input type="text" required="" class="form-control" id="name" name="name" value="{{ (empty($data) ? old('name') : $data->name) }}">
                                <small>Masukan nama lengkap + pendidikan</small>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="position" class="control-label col-form-label">Position</label>
                                <input type="text" required="" class="form-control" id="position" name="position" value="{{ (empty($data) ? old('position') : $data->position) }}">
                                <small>Masukan jabatan pengguna</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <label for="nip" class="control-label col-form-label">NIP</label>
                                <input type="text" required="" class="form-control" id="nip" name="nip" value="{{ (empty($data) ? old('nip') : $data->nip) }}">
                                <small>Gunakan tanda ( - ) tanpa tanda kurung jika tidak punya <b>NIP</b></small>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                            <?php use App\Models\Bidang;
                                $bidangs = Bidang::whereNotIn('id', [6])->get();
                            ?>
                                <label for="bidang" class="control-label col-form-label">Bidang</label>
                                <select class="form-control" name="id_bidang">
                                    <option>========PILIH========</option>
                                    @foreach($bidangs as $bidang)
                                    <option value="{{ $bidang->id }}" {{ (empty($data) ? old('id_bidang') : (($bidang->id == $data->id_bidang) ? 'selected' : '')) }}>{{ $bidang->bidang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="form-group">
                                <?php use App\Models\Role;use App\Models\Users;
                                    $role= Role::whereNotIn('id', ['1','2','3',])->get();
                                    $user= Users::select('username')->get();
                                    // dd($user);
                                    // $bidangr = Bidang::whereNotIn('route', $user)->get();
                                ?>
                                <label for="parent_id" class="control-label col-form-label">Role</label>
                                <select class="form-control" style="border: 1px solid;border-color: red;color: red" name="role" id="role">
                                    <option value="pilih">Pilih</option>
                                    @foreach($role as $r)
                                    <option value="{{ $r->name }}" 
                                        @if(Route::currentRouteName() == 'structure.add')
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
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="username" class="control-label col-form-label">Username</label>
                                <input type="text" pattern="\S(.*\S)?" class="form-control" id="username" name="username" value="{{ (empty($data) ? old('username') : '') }}" placeholder="{{ (empty($data) ? '' : 'Kosongkan jika tidak ingin mengganti') }}">
                                <div id="responseusername"></div>
                                {!! (empty($data) ? '<small>Kosongkan username untuk menggunakan <b>NIP</b> sebagai username defauld</small>' : '') !!}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label for="password" class="control-label col-form-label">Password</label>
                                <input type="password" {{ (empty($data)) ? 'required' : '' }} class="form-control" id="password" name="password" placeholder="{{ (empty($data) ? '' : 'Kosongkan jika tidak ingin mengganti') }}">
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
<script>
	$(document).ready(function(){
		$("#username").on('keyup',function(e){
			var username = $(this).val();
            $.ajax({
                url: '{{route('structure.cek.username')}}',
                type: 'GET',
                data: {
                    username : username,
                    },
                success: function(html){
                    $("#responseusername").html(html);
                },
				error: function(html) {
					$("#responseusername").html(html);
				}
            });
		});
	});
</script>
@endpush