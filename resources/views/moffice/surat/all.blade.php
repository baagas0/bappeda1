@extends('layouts.moffice.app')
@section('content')
<div style="padding-bottom:20px;"></div>
	<div class="form-element wrap-content b-shadow white">  
		<div class="container">
				<input type="hidden" name="token" id="tokentemp" value="{{ Session::token() }}" />
				<div class="row">
					<div class="col s12" style="padding-top: 15px">
						<div class="content" style="margin-bottom: 0px;">
							<h5>Tanggal</h5>
							<input id="tanggal" type="text" class="datepicker" placeholder="Pilih Tanggal">
						</div>
					</div>
					<div class="col s12">
						<div class="contents">
							<button id="lihat_data" class="button waves-effect button-red button-full b-shadow" style="margin-bottom: 15px;">Tampilkan</button>
						</div>
					</div>
				</div>
		</div>
	</div>
	<div id="content">
		
	</div>
@endsection
@push('js')
<script>
	$(document).ready(function(){
		$("#lihat_data").on('click',function(e){
			var tanggal = $("#tanggal").val();
            var token = $('#tokentemp').val();
            $.ajax({
                url: '{{route('.moffice.proses.ajax.surat.all')}}',
                type: 'POST',
                data: {
                    tanggal : tanggal,
                    _token : token,
                    },
                success: function(html){
                    $("#content").html(html);
                },
				error: function(html) {
					$("#content").html(html);
				}
            });
		});
	});
</script>
@endpush