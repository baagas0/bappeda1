@extends('layouts.backend.app')
@section('breadcumb', 'Instagram Managemet')
@section('rihgt-head')
<a href="#" onclick="sync()"><button type="button" id="sync" class="float-right ml-3 btn btn-sm btn-danger"><i class="mdi mdi-sync
    "></i> Sync </button></a>

<a href="{{ route('instagram.add') }}"><button type="button" id="sync" class="float-right btn btn-sm btn-primary"><i class=" mdi mdi-library-plus

    "></i> Tambah </button></a>

    <br>
    <br>
    {{-- <p class="float-right text-danger">Last Sync : {{ date('d-m-Y', strtotime($last_sync->created_at)) }}</p> --}}
    @endsection
@section('content')



<div class="table-responsive">
    <table id="BasicTable" class="table display">
        <thead class="bg-primary text-white">
            <tr>
                <th>#</th>
                <th>Gambar</th>
                <th>Title</th>
                <th>Source</th>
                <th>Bidang</th>
                <th>Type</th>
                <th hidden>Active</th>
                <th>Act.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $data)
            <?php
                $bidang = DB::table('bidangs')->where('id', $data->bidang_id)->first();
            ?>
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                        @foreach(json_decode($data->file) as $a)
                            @if($loop->iteration > 1 )
                                @break
                            @endif
                            
                            @if(pathinfo($a, PATHINFO_EXTENSION) == 'mp4')
                                <video width="50" controls>
                                  <source src="{{ asset($a) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @else 
                                <img src="{{ asset($a) }}" alt="" width="50" class="img-reponsive">
                            @endif
                        @endforeach
                </td>
                <td>{{Str::limit($data->caption, 75)}}</td>
                <td>{{ $data->source }}</td>
                <td>{{ ($data->is_sosbud == 1) ? 'Sosbud & ' : '' }}{{ ($data->is_ekonomi == 1) ? 'Ekonomi & ' : '' }}{{ ($data->is_infrastruktur == 1) ? 'Infrastruktur & ' : '' }}{{ ($data->is_ppe == 1) ? 'PPE & ' : '' }}{{ ($data->is_litbang == 1) ? 'Litbang & ' : '' }}{{ ($data->is_sosbud == 0 && $data->is_ekonomi == 0 && $data->is_infrastruktur == 0 && $data->is_ppe == 0 && $data->is_litbang == 0) ? 'Bidang Kosong' : '' }}</td>
                <td>{{$data->type}}</td>
                <td hidden>
                    <div class="checkbox my-2">
                        <label class="cr-styled">
                            <input type="checkbox" {{ ($data->is_active == 0) ? '' : 'checked' }} id="checking">
                            
                            <i class="fa"></i>

                            {{ ($data->is_active == 0) ? 'In active' : 'Active' }}
                        </label>
                    </div>
                </td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti-settings"></i>
                        </button>
                        <div class="dropdown-menu animated flipInY">
                            <a class="dropdown-item" href="{{ route('instagram.edit',$data->id) }}">Edit</a>
                            <a class="dropdown-item" href="{{ route('instagram.destroy',$data->id) }}">Hapus</a>
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
<!-- Sweet Alert css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.5/sweetalert2.min.css">
<link href="{{ asset('backend/assets/plugins/sweet-alert/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('js')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script type="text/javascript">
    $(document).ready( function () {
        $('#BasicTable').DataTable();
    } );
</script>
<script type="text/javascript">
    function sync() {
        $id = $('#BasicTable #id').val($(this).attr('id'));
        swal.queue([{
            title: 'Sync Instagram Feeds',
            confirmButtonText: 'Sync Now',
            text: 'Sync Instagram Bappeda Will Update With 1 Touch',
            showLoaderOnConfirm: true,
            preConfirm: function () {
                return new Promise(function (resolve) {
                    $.get('{{ route('instagram.syncig') }}')
                    .done(function (data) {
                        swal.insertQueueStep({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Sync Instagram Feeds berhasil',
                        });
                        console.log(data);
                        // window.location.reload();
                        resolve()
                    })
                })
            }
        }])
    };
</script>
<!-- Sweet Alert Js  -->
<script src="{{ asset('backend/assets/plugins/sweet-alert/sweetalert2.min.js') }}"></script>
<script src="{{ asset('backend/assets/pages/jquery.sweet-alert.init.js') }}"></script>

@endpush