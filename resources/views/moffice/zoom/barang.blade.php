@extends('layouts.moffice.app')
@section('content')
	<div class="segments-page quotes" style="padding: 0px 0 30px;">
		<div class="container">
			@if($message = Session::get('alert'))
			<div class="content one-q">
				<span>{{ $message }}</span>
			</div>
			@endif
			<div class="">
				<div class="row">
					<div class="col s4">
						<div class="contents left">
							<a href="#add" id="tambah" class="button button-red button-custom waves-effect waves-light-grey button-white white b-shadow modal-trigger"><i class="fa fa-pencil"></i>Tambah</a>
						</div>
					</div>
				</div>
			</div>
			<div class="table-contents default-table">
				<table id="table">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Act.</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$data= DB::table('m_barang')->get();
						?>
						@foreach($data as $row)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $row->name }}</td>
							<td><a class="edit" href="#"><i class="material-icons">border_color</i></a>  <a href="{{ route('.moffice.proses.del.data.barang',$row->id) }}"><i class="small material-icons">delete_sweep</i></a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	
	<div id="add" class="modal">
		<div class="modal-content">
			<p>Form Data Ruang.</p>
			<form action="{{ route('.moffice.proses.data.barang.form','add') }}" method="POST">
				@csrf
				<input type="text" placeholder="Nama Barang" name="name">
				<button type="submit" class="button button-red button-custom waves-effect waves-light-grey button-white white b-shadow">Submit</button>
			</form>
		</div>
	</div>
	<div id="update" class="modal">
		<div class="modal-content">
			<p>Form Data Ruang.</p>
			<form action="{{ route('.moffice.proses.data.barang.form','update') }}" method="POST">
				@csrf
				<input type="text" placeholder="Nama Barang" id="nameupdate" name="nameupdate">
				<button type="submit" class="button button-red button-custom waves-effect waves-light-grey button-white white b-shadow">Submit</button>
			</form>
		</div>
	</div>
@endsection
@push('css')
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endpush
@push('js')
<script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<script>
	var table = $('#primary-table').DataTable();
	
	table.on('click','.edit', function() {
        $tr = $(this).closest('tr');
        if ($($tr).hasClass('child')) {
            $tr = $tr.prev('.parent');
        }

        var data = table.row($tr).data();
        console.log(data);

        $('#name').val(data[2]);

        $('#editform').attr('action','/inventaris/update/' + data[0]);
        $('#edit').modal('show');

    });
</script>
@endpush