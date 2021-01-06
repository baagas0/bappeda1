@extends('layouts.backend.app')
@section('breadcrumb')
<?php
	use App\Models\Absensi;
	use App\Models\Suggestion;
?>
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
<button type="button" class="float-right mb-2 btn btn-sm btn-primary"  data-toggle="modal" data-target="#modaladd"><i class="fa fa-plus"></i> Tambah </button>
<div class="table-responsive">
    <table id="PageTable" class="table display">
        <thead class="bg-primary text-white">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Tanggal</th>
                <th hidden="">Tanggal</th>
                <th>Jam</th>
                <th>Absensi</th>
				<th>Pesan & Saran</th>
                <th>Act.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $kegiatan)
				<?php
					$abs = Absensi::where('kegiatan_bidang_id', $kegiatan->id)->first();
					$suggestion = Suggestion::where('kegiatan_bidang_id', $kegiatan->id)->first();
				?>
            <tr>
                <td>{{ $kegiatan->id }}</td>
                <td>{{$kegiatan->name}}</td>
                <td>{{ Carbon\Carbon::parse($kegiatan->tanggal)->format('d M Y')}}</td>
                <td hidden="">{{ $kegiatan->tanggal }}</td>
                <td>{{$kegiatan->time}}</td>
				<td>
				@if(empty($abs))
				<a href="#">
					<button type="button" class="btn btn-danger createabsensi" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Create Absent
                    </button>
				</a>
				@else
				<a href="{{ route('..absensi',$abs->link) }}" target="_blank" class="btn btn-primary">Click Here</a>
				@endif
				</td>
				<td>
				@if(empty($suggestion)) 
				<a href="#">
					<button type="button" class="btn btn-danger createsuggestion" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Create Pesan & Saran
                    </button>
				</a>
				@else
				<a href="{{ route('..pesan.saran',$suggestion->link) }}" target="_blank" class="btn btn-primary">Click Here</a>
				@endif
				</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="ti-settings"></i>
                        </button>
                        <div class="dropdown-menu animated flipInY">
                            <a class="dropdown-item edit">Edit</a>
                            <a class="dropdown-item" href="{{ route('kegiatan.delete',$kegiatan->id) }}">Hapus</a>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Penambahan Data Kegiatan Bidang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
				<form role="form" method="POST" action="{{ route('kegiatan.add') }}">
			<div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Kegiatan</label>
                        <input type="text" class="form-control" placeholder="Nama Kegiatan" name="name">
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Bidang</label>
                        <select name="bidang" class="form-control">
							@foreach($bidangs as $bidang)
								<option value="{{ $bidang->id }}">{{ $bidang->bidang }}</option>
							@endforeach
						</select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Tanggal Kegiatan</label>
                                <input type="date" class="form-control" placeholder="Tanggal Kegiatan"  name="tanggal">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Waktu Kegiatan</label>
                                <input type="time" class="form-control" placeholder="Waktu Kegiatan"  name="time">
                            </div>
                        </div>
                    </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
                </form>
		</div>
	</div>
</div>  
<div class="modal fade" id="modalupdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Penambahan Data Kegiatan Bidang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
				<form role="form" method="POST" action="" id="updateform">
			<div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Kegiatan</label>
                        <input type="text" class="form-control" id="name" placeholder="Nama Kegiatan" name="name">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Tanggal Kegiatan</label>
                                <input type="date" class="form-control" id="tanggal" placeholder="Tanggal Kegiatan"  name="tanggal">
                            </div>
                            <div class="col-md-6">
                                <label for="exampleInputEmail1">Waktu Kegiatan</label>
                                <input type="time" class="form-control" id="time" placeholder="Waktu Kegiatan"  name="time">
                            </div>
                        </div>
                    </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
                </form>
		</div>
	</div>
</div>  
<div class="modal fade" id="createabsensimodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Penambahan Absensi Data Kegiatan Bidang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
				<form role="form" method="POST" action="" id="createabsensiform">
			<div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Url Absensi</label>
                        <input type="text" class="form-control" id="link" placeholder="Url Absensi" name="link">
						
						<div id="response"></div>
					</div>
					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
                </form>
		</div>
	</div>
</div>  
<div class="modal fade" id="createsuggestionmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Penambahan Pesan & Saran Data Kegiatan Bidang</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
				<form role="form" method="POST" action="" id="createsuggestionform">
			<div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Url Pesan Dan Saran</label>
                        <input type="text" class="form-control" id="linksuggestion" placeholder="Url Absensi" name="linksuggestion">
						
						<div id="responsesuggestion"></div>
					</div>
					
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save changes</button>
			</div>
                </form>
		</div>
	</div>
</div>  

@endsection
@push('css')
{{-- <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script> --}}
    {{-- <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script> --}}

<link href="{{ asset('backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endpush
@push('js')
<script type="text/javascript">
    $(document).ready( function () {
        var table = $('#PageTable').DataTable();
        
        table.on('click','.edit', function() {
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#name').val(data[1]);
            $('#tanggal').val(data[3]);
            $('#time').val(data[4]);

            $('#updateform').attr('action','/pemuda/kegiatan/update/' + data[0]);
            $('#modalupdate').modal('show');

        });
		
		table.on('click','.createabsensi', function() {
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#createabsensiform').attr('action','/pemuda/kegiatan/create-absensi/' + data[0]);
            $('#createabsensimodal').modal('show');

        });
		
		table.on('click','.createsuggestion', function() {
            $tr = $(this).closest('tr');
            if ($($tr).hasClass('child')) {
                $tr = $tr.prev('.parent');
            }

            var data = table.row($tr).data();
            console.log(data);

            $('#createsuggestionform').attr('action','/pemuda/kegiatan/create-suggestion/' + data[0]);
            $('#createsuggestionmodal').modal('show');

        });
		
		$("#link").on('keyup',function(e){
			var link = $(this).val();
            $.ajax({
                url: '{{route('kegiatan.cek.absensi')}}',
                type: 'GET',
                data: {
                    link : link,
                    },
                success: function(html){
					if(html == 0){
						$('#link').attr('style','border-color:red');
						$('#response').attr('style','color:red');
						$("#response").text('Tautan tidak tersedia, silahkan pilih tautan lain');
					}else {
						$('#link').attr('style','border-color:#33FF00');
						$('#response').attr('style','color:#33FF00');
						$("#response").text('Tautan tersedia, Pilih save change untuk melanjutkan');
					}
                    
                },
				error: function(html) {
					$("#response").html(html);
				}
            });
		});
		
		$("#linksuggestion").on('keyup',function(e){
			var link = $(this).val();
            $.ajax({
                url: '{{route('kegiatan.cek.suggestion')}}',
                type: 'GET',
                data: {
                    link : link,
                    },
                success: function(html){
					if(html == 0){
						$('#linksuggestion').attr('style','border-color:red');
						$('#responsesuggestion').attr('style','color:red');
						$("#responsesuggestion").text('Tautan tidak tersedia, silahkan pilih tautan lain');
					}else {
						$('#linksuggestion').attr('style','border-color:#33FF00');
						$('#responsesuggestion').attr('style','color:#33FF00');
						$("#responsesuggestion").text('Tautan tersedia, Pilih save change untuk melanjutkan');
					}
                    
                },
				error: function(html) {
					$("#responsesuggestion").html(html);
				}
            });
		});
    } );
</script>
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