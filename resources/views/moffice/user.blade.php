@extends('layouts.moffice.app')
@section('content')
	<div class="segments-page quotes">
		<div class="container">
			@if($message = Session::get('alert'))
			<div class="content one-q">
				<span>{{ $message }}</span>
			</div>
			@endif
			<div class="table-contents default-table">
				<table>
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Position</th>
							<th>NIP</th>
							<th>Bidang</th>
							<th>Role</th>
							<th>Username</th>
							<th>Act.</th>
						</tr>
					</thead>
					<tbody>
						@foreach($data as $row)
						<?php
							$bd= DB::table('bidangs')->where('id', $row->id_bidang)->first();
						?>
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>{{ $row->name }}</td>
							<td>{{ $row->position }}</td>
							<td>{{ $row->nip }}</td>
							<td>{{ $bd->bidang }}</td>
							<td>
								@foreach(json_decode($row->roles->pluck('name')) as $d)
									{{ ($d == ['superadmin','admin','bidang']) ? 'superadmin' : $d }}
								@endforeach
							</td>
							<td>{{ $row->username }}</td>
							<td><a href="{{ route('.moffice.proses.users.up',$row->id) }}"><i class="material-icons">border_color</i></a>  <a href="{{ route('.moffice.proses.del.users',$row->id) }}"><i class="small material-icons">delete_sweep</i></a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection