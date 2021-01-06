@extends('layouts.frontend.app')
@push('css')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endpush
@section('content')
		<main id="hb-main" class="hb-main hb-haslayout">
			<!--************************************
						Blog Start
			*************************************-->
			<section id="hb-blog" class="hb-blog hb-sectionspace hb-haslayout">
				<div class="container">
					<div class="container row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pull-right">
							<div class="hb-shop-area">
							<input type="hidden" name="token" id="tokentemp" value="{{ Session::token() }}" />
								<div class="select-form form-group">
									<fieldset>
										<div class="col-md-6">
											<input type="text" id="judul" class="form-control " placeholder="Judul">
										</div>
										<div class="col-md-2">
											<input type="date" id="tanggal">
										</div>
										<button id="tampilkan" class="hb-btn" style="pointer-events: all; cursor: pointer;"> Tampilkan </button>
									</fieldset>
								</div>
								<div id="content">
								
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!--************************************
						Blog End
			*************************************-->
		</main> 
@endsection
@push('js')
<script>
	$(document).ready(function(){
		$("#tampilkan").on('click',function(){
			var judul = $("#judul").val();
			var tanggal = $("#tanggal").val();
            var token = $('#tokentemp').val();
            $.ajax({
                url: '{{route('..ajax.agenda')}}',
                type: 'POST',
                data: {
					judul : judul,
                    tanggal : tanggal,
                    _token : token,
                    },
                success: function(html, tanggal){
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