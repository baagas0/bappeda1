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
<a href="{{ route('menu.create') }}"><button type="button" class="float-right mb-2 btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah </button></a>
<div class="table-responsive">
    <table id="MenuTable" class="table display">
        <thead class="bg-primary text-white">
            <tr>
                <th>#</th>
                <th colspan="3">Menu</th>
                <th>Jenis URL</th>
                <th>Target</th>
                <th>Act.</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $menu)
                <?php
                    if($menu->jenurl == 0){
                        $jenisurl = '';
                    }else
                    if($menu->jenurl == 1){
                        $jenisurl = 'Dokumen';
                    }else
                    if($menu->jenurl == 2){
                        $jenisurl = 'Link';
                    }
                ?>
                <tr>
                    <td>{{ $loop->iteration }}</td>               
                    <td colspan="3"><b>{{$menu->title}}</b></td>
                    <!--<td>{{$jenisurl}}</td>-->
                    <td>upload image</td>
                    <td>{{$menu->target}}</td> 
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-settings"></i>
                            </button>
                            <div class="dropdown-menu animated flipInY">
                                <a class="dropdown-item" href="{{ route('menu.edit',$menu->id) }}">Edit</a>
                                <a class="dropdown-item" href="{{ route('menu.destroy',$menu->id) }}">Hapus</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
                    $subs = \DB::table('menu')
                    ->where('parent_id','=',$menu->id)
                    ->orderby('menu_order','asc')
                    ->get();
                ?>
                @foreach($subs as $sub)
                    <?php
                        if($sub->jenurl == 0){
                            $jenisurl1 = '';
                        }else
                        if($sub->jenurl == 1){
                            $jenisurl1 = 'Dokumen';
                        }else
                        if($sub->jenurl == 2){
                            $jenisurl1 = 'Link';
                        }
                    ?>
                    <tr>
                        <td>{{ $loop->iteration }}</td>    
                        <td bgcolor="grey"></td>           
                        <td colspan="2">{{$sub->title}}</td>
                        <td>{{$jenisurl1}}</td>
                        <td>{{$sub->target}}</td> 
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ti-settings"></i>
                                </button>
                                <div class="dropdown-menu animated flipInY">
                                    <a class="dropdown-item" href="{{ route('menu.edit',$sub->id) }}">Edit</a>
                                    <a class="dropdown-item" href="{{ route('menu.destroy',$sub->id) }}">Hapus</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                        $subs1 = \DB::table('menu')
                        ->where('parent_id','=',$sub->id)
                        ->orderby('menu_order','asc')
                        ->get();
                    ?>
                    @foreach($subs1 as $sub1)
                        <?php
                            if($sub1->jenurl == 0){
                                $jenisurl2 = '';
                            }else
                            if($sub1->jenurl == 1){
                                $jenisurl2 = 'Dokumen';
                            }else
                            if($sub1->jenurl == 2){
                                $jenisurl2 = 'Link';
                            }
                        ?>
                        <tr>
                            <td>{{ $loop->iteration }}</td>    
                            <td bgcolor="grey"></td>
                            <td bgcolor="grey"></td>               
                            <td>{{$sub1->title}}</td>
                            <td>{{$jenisurl2}}</td>
                            <td>{{$sub1->target}}</td> 
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ti-settings"></i>
                                    </button>
                                    <div class="dropdown-menu animated flipInY">
                                        <a class="dropdown-item" href="{{ route('menu.edit',$sub1->id) }}">Edit</a>
                                        <a class="dropdown-item" href="{{ route('menu.destroy',$sub1->id) }}">Hapus</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                @endforeach

            @endforeach

        </tbody>
    </table>
</div>
@endsection
@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/r-2.2.6/datatables.min.css"/>
@endpush
@push('js')
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.22/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/r-2.2.6/datatables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() { 
        $('#MenuTable').DataTable( 
        { 
            dom: 'Bfrtip', 
            buttons: [ 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5' ] 
        }); 
    } ); 
</script>

@endpush