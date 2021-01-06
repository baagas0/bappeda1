@extends('layouts.frontend.app')
@section('content')
@include('layouts.frontend.partials.slider')

@include('layouts.frontend.partials.main')
<div class="hb-contactus-formarea">
	<div class="col-xs-12">
		<div class="hb-headcontent">
			<h2>Buku Tamu</h2>
			<div class="hb-description">
				<p>Silahkan mengisi buku tamu website BAPPEDA KOTA SEMARANG di bawah ini.</p>
			</div>
			<div class="hb-description">
				<p style="color: red" id="responsebukutamu"></p>
			</div>
		</div>
	</div>
	<div class="hb-formtheme hb-contactusform">
		<form id="contactForm" data-toggle="validator" method="POST" action="{{ route('..buku.tamu') }}">
			<input type="hidden" name="token" id="tokentemp" value="{{ Session::token() }}" />
			<fieldset> 
				<div class="col-xs-12 col-sm-12 col-md-6">
					<div class="form-group">
						<input type="text" id="txtname" class="form-control" name="name" placeholder="Name" required data-error="NEW ERROR MESSAGE">
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6">
					<div class="form-group">
						<input type="text" id="txtemail" class="form-control" name="email" placeholder="Email" required data-error="NEW ERROR MESSAGE">
					</div>
				</div>
				
				<div class="col-xs-12 col-sm-12">
					<div class="form-group">
						<textarea id="txtmessage" class="form-control" name="message" required data-error="NEW ERROR MESSAGE">Messages</textarea>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12">
					<div class="form-group">
						<button type="submit" class="hb-btn">Submit</button>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
@endsection