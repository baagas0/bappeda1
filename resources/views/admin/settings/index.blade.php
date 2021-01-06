@extends('layouts.backend.app')
@section('breadcumb', 'Settings Managemet')
@section('rihgt-head')
<a href="{{ route('settings.add') }}"><button type="button" class="float-right mb-2 btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah </button></a>
@endsection
@section('content')
<div class="table-responsive">
    <table id="BasicTable" class="table display">
        <thead class="bg-primary text-white">
            <tr>
                <th>#</th>
                <th>Slug</th>
                <th>Name</th>
                <th>Value</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{$data->slug}}</td>
                <td>{{$data->name}}</td>
                <td>{!! Str::limit($data->value,40 ) !!}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti-settings"></i>
                        </button>
                        <div class="dropdown-menu animated flipInY">
                            <a class="dropdown-item" href="{{ route('settings.edit',$data->id) }}">Edit</a>
                            <a class="dropdown-item" href="{{ route('settings.destroy',$data->id) }}">Hapus</a>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@push('js')
<script type="text/javascript">
    $(document).ready( function () {
        $('#BasicTable').DataTable();
    } );
</script>
@endpush
