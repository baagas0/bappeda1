@extends('layouts.backend.app')
@section('content')
<a href="{{ route('berita.add') }}"><button type="button" class="float-right mb-2 btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah </button></a>
<div class="table-responsive">
    <table id="MenuTable" class="table display">
        <thead class="bg-primary text-white">
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Title</th>
                <th>Content</th>
                <th>Active</th>
                <th>Act.</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $blog)
                <tr>
                    <td>{{ $loop->iteration }}</td>               
                    <td><img src="{{ asset($blog->photo) }}" class="img-fluid" style="width: 75px"></td>
                    <td>{{ $blog->title }}</td>
                    <td>{{ $blog->title }}</td> 
                    <td>
                        <div class="checkbox my-2">
                            <label class="cr-styled">
                                <input type="checkbox" {{ ($blog->is_active == 0) ? '' : 'checked' }} id="{{ $blog->id }}">
                                <i class="fa"></i>
                                {{ ($blog->is_active == 0) ? 'In active' : 'Active' }}
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ti-settings"></i>
                            </button>
                            <div class="dropdown-menu animated flipInY">
                                <a class="dropdown-item" href="{{ route('berita.edit',$blog->id) }}">Edit</a>
                                <a class="dropdown-item" href="{{ route('berita.destroy',$blog->id) }}">Hapus</a>
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
@endpush
@push('js')
<script type="text/javascript">
    $(document).ready( function () {
        $('#MenuTable').DataTable();
    } );
</script>
@endpush