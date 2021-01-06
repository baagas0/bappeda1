@extends('layouts.moffice.app')
@section('content')
	<div class="form-element segments-page button-variant">
		<div class="container">
			<form method="POST" action="{{ (empty($data) ? route('.moffice.proses.add.user') : route('.moffice.proses.up.user', $data->id)) }}">
				@csrf
				<div class="content">
					<h5>NIP</h5>
					<div class="input-field">
						<input type="text" name="nip" id="with-label" placeholder="11800659" value="{{ (empty($data) ? '' : $data->nip) }}">
						<label for="with-label">Ganti dengan ( - ) tanpa tanda kurung jika tidak ada NIP</label>
					</div>
				</div>
				<div class="content">
					<h5>Name</h5>
					<div class="input-field">
						<input type="text" name="name" id="with-label" placeholder="Bagas Aditya Mahendra" value="{{ (empty($data) ? '' : $data->name) }}">
						<label for="with-label">Isi dengan nama user</label>
					</div>
				</div>
				<div class="content">
					<h5>Position</h5>
					<div class="input-field">
						<input type="text" name="position" id="with-label" placeholder="Seketaris" value="{{ (empty($data) ? '' : $data->position) }}">
						<label for="with-label">Isi dengan jabatan user</label>
					</div>
				</div>
				<div class="content">
					<h5>Username</h5>
					<div class="input-field">
						<input type="text"  name="username" id="with-label" placeholder="baagas0" value="{{ (empty($data) ? '' : $data->username) }}">
						<label for="with-label">Defauld username adalah NIP</label>
					</div>
				</div>
				<div class="content">
					<h5>Password</h5>
					<div class="input-field">
						<input type="password"  name="password" id="with-label" placeholder="*******">
						<label for="with-label">Masukan Password User</label>
					</div>
				</div>
				<div class="row">
					<div class="col s12">
						<div class="contents">
							<button class="button waves-effect waves-light-grey button-full button-white white b-shadow button-red">Submit</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection