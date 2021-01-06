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
							<a href="#add" class="button button-red button-custom waves-effect waves-light-grey button-white white b-shadow modal-trigger"><i class="fa fa-pencil"></i>Tambah</a>
						</div>
					</div>
				</div>
			</div>
			<div class="table-contents default-table">
				<table>
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Act.</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$data= DB::table('m_ruang')->get();
						?>
						@foreach($data as $row)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td class="namerow">{{ $row->name }}</td>
							<td><a id="update"><i class="material-icons">border_color</i></a>  <a href="{{ route('.moffice.proses.del.data.ruang',$row->id) }}"><i class="small material-icons">delete_sweep</i></a></td>
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
			<form action="{{ route('.moffice.proses.data.ruang.form','add') }}" method="POST">
				@csrf
				<input type="text" placeholder="Nama Barang" name="name">
				<button type="submit" class="button button-red button-custom waves-effect waves-light-grey button-white white b-shadow">Submit</button>
			</form>
		</div>
	</div>
	<div id="update" class="modal">
		<div class="modal-content">
			<p>Form Data Ruang.</p>
			<form action="{{ route('.moffice.proses.data.ruang.form','add') }}" method="POST">
				@csrf
				<input type="text" placeholder="Nama Barang" id="nameupdate" name="nameupdate">
				<button type="submit" class="button button-red button-custom waves-effect waves-light-grey button-white white b-shadow">Submit</button>
			</form>
		</div>
	</div>
@endsection
@push('js')

@endpush