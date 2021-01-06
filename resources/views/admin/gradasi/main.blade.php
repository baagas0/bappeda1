@extends('layouts.backend.app')
@section('content')
<a href="{{ route('slider.create') }}"><button type="button" class="float-right mb-2 btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah </button></a>
<div class="table-responsive">
    <table id="PageTable" class="table display">
        <thead class="bg-primary text-white">
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nama</th>
                <th>Tahun</th>
                <th>Oleh</th>
                <th>Waktu</th>
                <th>penjelasan</th>
                <th>Act.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td width="25%">
                    <?php
                        $foto = DB::connection('gradasi')
                            ->table('foto_prestasi')
                            ->where('id_prestasi', $data->id)
                            ->get();
                    ?>
                    @foreach($foto as $d)
                    <img src="{{ url('https://bappeda.semarangkota.go.id/gradasi/modul/foto/'.$d->url_foto) }}" alt="Slider" class="" width="80" height="80">
                    @endforeach

                </td>
                <td>{{$data->nama_penghargaan}}</td>
                <td>{{$data->tahun}}</td>
                <td>{{ $data->pemberi_penghargaan }}</td>
                <td>{{ $data->waktu_pemberian }}</td>
                <td>{{ Str::limit($data->penjelasan, 100) }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti-settings"></i>
                        </button>
                        <div class="dropdown-menu animated flipInY">
                            <a class="dropdown-item" href="{{ route('slider.edit',$data->id) }}">Edit</a>
                            <a class="dropdown-item" href="{{ route('slider.destroy',$data->id) }}">Hapus</a>
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
{{-- <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script> --}}
    {{-- <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script> --}}

<link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endpush
@push('js')

<script src="{{ asset('backend/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<!-- start - This is for export functionality only -->
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script src="{{ asset('backend/dist/js/pages/datatable/datatable-advanced.init.js') }}"></script>


@endpush