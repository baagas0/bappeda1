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
<a href="{{ route('run-text.create') }}"><button type="button" class="float-right mb-2 btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah </button></a>
<div class="table-border">
    <table id="PageTable" class="table display">
        <thead class="bg-primary text-white">
            <tr>
                <th>#</th>
                <th>Running Text</th>
                <th>Act.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$data->running_text}}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti-settings"></i>
                        </button>
                        <div class="dropdown-menu animated flipInY">
                            <a class="dropdown-item" href="{{ route('run-text.edit',$data->id) }}">Edit</a>
                            <a class="dropdown-item" href="{{ route('run-text.destroy',$data->id) }}">Hapus</a>
                        </div>
                    </div>
                </td>
            </tr>
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
        $('#PageTable').DataTable( 
        { 
            dom: 'Bfrtip', 
            buttons: [ 'copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5' ] 
        }); 
    } ); 
</script>

@endpush