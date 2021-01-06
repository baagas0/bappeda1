@extends('layouts.backend.app')
@section('content')
<a href="{{ route('structure.add') }}"><button type="button" class="float-right mb-2 btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah </button></a>
<div class="table-responsive">
    <table id="MenuTable" class="table display">
        <thead class="bg-primary text-white">
            <tr>
                <th>#</th>
                <th>Image</th>
                <th colspan="6">Name</th>
                <th>Position</th>
                <th>Act.</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $menu)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="{{ asset($menu->image) }}" style="width:25px;height:auto;"></td>
                    <td colspan="6"><b>{{$menu->name}}</b></td>
                    <td>{{ $menu->position }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-settings"></i>
                            </button>
                            <div class="dropdown-menu animated flipInY">
                                <a class="dropdown-item" href="{{ route('structure.edit',$menu->id) }}">Edit</a>
                                <a class="dropdown-item" href="{{ route('structure.destroy',$menu->id) }}">Hapus</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php
                    $subs = \DB::table('structures')
                    ->where('parent_id','=',$menu->id)
                    ->get();
                ?>
                @foreach($subs as $sub)
                    <tr>
                        <td>{{ $loop->iteration }}</td>    
                        <td><img src="{{ asset($sub->image) }}" style="width:25px;height:auto;"></td>
                        <td bgcolor="grey"></td>           
                        <td colspan="5"><b>{{$sub->name}}</b></td>
                        <td>{{ $sub->position }}</td> 
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="ti-settings"></i>
                                </button>
                                <div class="dropdown-menu animated flipInY">
                                    <a class="dropdown-item" href="{{ route('structure.edit',$sub->id) }}">Edit</a>
                                    <a class="dropdown-item" href="{{ route('structure.destroy',$sub->id) }}">Hapus</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php
                        $subs1 = \DB::table('structures')
                        ->where('parent_id','=',$sub->id)
                        ->get();
                    ?>
                    @foreach($subs1 as $sub1)
                        <tr>
                            <td>{{ $loop->iteration }}</td>    
                            <td><img src="{{ asset($sub1->image) }}" style="width:25px;height:auto;"></td>
                            <td bgcolor="grey"></td>
                            <td bgcolor="grey"></td>               
                            <td colspan="4"><b>{{$sub1->name}}</b></td>
                            <td>{{ $sub1->position }}</td> 
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ti-settings"></i>
                                    </button>
                                    <div class="dropdown-menu animated flipInY">
                                        <a class="dropdown-item" href="{{ route('structure.edit',$sub1->id) }}">Edit</a>
                                        <a class="dropdown-item" href="{{ route('structure.destroy',$sub1->id) }}">Hapus</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                            $subs2 = \DB::table('structures')
                            ->where('parent_id','=',$sub1->id)
                            ->get();
                        ?>
                        @foreach($subs2 as $sub2)
                            <tr>
                                <td>{{ $loop->iteration }}</td>    
                                <td><img src="{{ asset($sub2->image) }}" style="width:25px;height:auto;"></td>
                                <td bgcolor="grey"></td>
                                <td bgcolor="grey"></td>               
                                <td colspan="4"><b>{{$sub2->name}}</b></td>
                                <td>{{ $sub2->position }}</td> 
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="ti-settings"></i>
                                        </button>
                                        <div class="dropdown-menu animated flipInY">
                                            <a class="dropdown-item" href="{{ route('structure.edit',$sub2->id) }}">Edit</a>
                                            <a class="dropdown-item" href="{{ route('structure.destroy',$sub2->id) }}">Hapus</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                $subs3 = \DB::table('structures')
                                ->where('parent_id','=',$sub2->id)
                                ->get();
                            ?>
                            @foreach($subs3 as $sub3)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>    
                                    <td><img src="{{ asset($sub3->image) }}" style="width:25px;height:auto;"></td>
                                    <td bgcolor="grey"></td>
                                    <td bgcolor="grey"></td> 
                                    <td bgcolor="grey"></td>               
                                    <td colspan="3"><b>{{$sub3->name}}</b></td>
                                    <td>{{ $sub3->position }}</td> 
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti-settings"></i>
                                            </button>
                                            <div class="dropdown-menu animated flipInY">
                                                <a class="dropdown-item" href="{{ route('structure.edit',$sub3->id) }}">Edit</a>
                                                <a class="dropdown-item" href="{{ route('structure.destroy',$sub3->id) }}">Hapus</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                    $subs4 = \DB::table('structures')
                                    ->where('parent_id','=',$sub3->id)
                                    ->get();
                                ?>
                                @foreach($subs4 as $sub4)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>    
                                        <td><img src="{{ asset($sub4->image) }}" style="width:25px;height:auto;"></td>
                                        <td bgcolor="grey"></td>
                                        <td bgcolor="grey"></td> 
                                        <td bgcolor="grey"></td> 
                                        <td bgcolor="grey"></td>               
                                        <td colspan="2"><b>{{$sub4->name}}</b></td>
                                        <td>{{ $sub4->position }}</td> 
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="ti-settings"></i>
                                                </button>
                                                <div class="dropdown-menu animated flipInY">
                                                    <a class="dropdown-item" href="{{ route('structure.edit',$sub4->id) }}">Edit</a>
                                                    <a class="dropdown-item" href="{{ route('structure.destroy',$sub4->id) }}">Hapus</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                        $subs5 = \DB::table('structures')
                                        ->where('parent_id','=',$sub4->id)
                                        ->get();
                                    ?>
                                    @foreach($subs5 as $sub5)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>    
                                            <td><img src="{{ asset($sub5->image) }}" style="width:25px;height:auto;"></td>
                                            <td bgcolor="grey"></td>
                                            <td bgcolor="grey"></td> 
                                            <td bgcolor="grey"></td> 
                                            <td bgcolor="grey"></td> 
                                            <td bgcolor="grey"></td>               
                                            <td><b>{{$sub5->name}}</b></td>
                                            <td>{{ $sub5->position }}</td> 
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti-settings"></i>
                                                    </button>
                                                    <div class="dropdown-menu animated flipInY">
                                                        <a class="dropdown-item" href="{{ route('structure.edit',$sub5->id) }}">Edit</a>
                                                        <a class="dropdown-item" href="{{ route('structure.destroy',$sub5->id) }}">Hapus</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
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