@extends('layouts.moffice.loginpage')
@section('content')
	
	<!-- sign in -->
	<div class="sign-in segments-page" style="padding: 30px 0 0;">
		<div class="container">
		<div class="content b-shadow" style="background:rgba(255,255,255,0.7);">
			<form method="POST" action="{{ route('moffice.proses.login') }}">
			@csrf
				<div class="">
					<img style="width:40%;height:auto;margin-left:30%;" class="circle responsive-img" src="{{ asset('backend/moffice/images/pemkot.png') }}" alt="">
				</div>
				<div class="input-field"> 
					<i class="fa fa-user prefix"></i>
					<input id="icon-email" type="text" name="username">
					<label for="icon-email">Username</label>
					@error('username')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
				</div>
				<div class="input-field">
					<i class="fa fa-key prefix"></i>
					@error('email')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
					<input id="icon-password" type="password" name="password">
					<label for="icon-password">Password</label>
					@error('password')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
				</div>
				<button class="button waves-effect waves-light">Masuk	</button>
			</form>
		</div>
		</div>
	</div>
	<!-- end sign in -->
@endsection
@push('css')
@endpush
@push('js')
@endpush