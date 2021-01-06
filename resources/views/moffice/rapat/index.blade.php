@extends('layouts.moffice.app')
@section('content')


	<div class="form-element wrap-content b-shadow white"> 
		<div class="container">
				<input type="hidden" name="token" id="tokentemp" value="{{ Session::token() }}" />
				<div class="row">
					<div class="col s12" style="padding-top: 15px">
						<div class="content" style="margin-bottom: 0px;">
							<h5>Tanggal</h5>
							<input id="tanggal" type="text" class="datepicker" required placeholder="Pilih Tanggal">
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
	<div class="container" style="margin:0px 10px;padding-bottom:15px">
		<a id="add_button" class="waves-effect waves-light btn modal-trigger b-shadow" href="#modal_add"><i class="fa fa-plus center-align"></i></a>
	</div>
	<div id="content">
		
	</div>
	<!-- end gallery --> 
	<div id="modal_add" class="modal" style="width: 92%;max-height: 90%;">
		<div class="modal-content">
			<p>buat booking Ruang Rapat disini.</p>
			<!--<form method="POST" action="{{ route('.moffice.proses.add.rapat') }}">-->
			<form id="modal_tambah" method="POST">
				<input type="hidden" name="token" id="tokentempform" value="{{ Session::token() }}" />
				<div class="input-field">
					<i class="fa fa-envelope prefix"></i>
					<input id="tanggal-form" name="tanggal" class="disable" disabled type="text" placeholder="Pilih Tanggal Dulu, Di Menu Sebelumnya!!!" >
					<!-- <label for="icon-email">Tanggal</label>-->
				</div>
				<div class="input-field">
					<i class="fa fa-envelope prefix"></i>
					<input id="jam-mulai" name="jam_mulai" class="timepicker" type="text">
					<label for="jam-mulai">Jam pinjam (Mulai)</label>
				</div>
				<div class="input-field">
					<i class="fa fa-envelope prefix"></i>
					<input id="jam-selesai" name="jam_selesai" class="timepicker" type="text">
					<label for="jam-selesai">Jam pinjam (Selesai)</label>
				</div>
				<div class="input-field">
					<i class="fa fa-envelope prefix"></i>
					<input id="kegiatan" name="kegiatan" type="text">
					<label for="kegiatan">Kegiatan</label>
				</div>
				<div class="input-field">
					<i class="fa fa-envelope prefix"></i>
					<input id="peminjam" name="peminjam" type="text">
					<label for="peminjam">Nama Peminjam</label>
				</div>
				<div class="input-field">
					<i class="fa fa-envelope prefix"></i>
					<input id="keterangan" name="keterangan" type="text">
					<label for="keterangan">Keterangan</label>
				</div>
				<div class="input-field">
				<?php 
					$ruang = \DB::table('m_ruang')->get();
					foreach($ruang as $row){
				?>
					<p>
						<label>
							<input type="checkbox" name="ruang[]" class="ruang" id="ruang{{ $row->id }}" value="{{ $row->id }}">
							<span>{{ $row->name }}</span>
						</label>
					</p>
				<?php } ?>
				</div>
				<button type="button" id="submittambahrapat" class="button waves-effect waves-light">Simpan</button>
			</form>
		</div>
	</div>
	</div>
	
	
@endsection
@push('css')
// Isi dengan css mu
@endpush
@push('js')
<script>
	$(document).ready(function(){
		$("#lihat_data").on('click',function(e){
			var tanggal = $("#tanggal").val();
			$("#tanggal-form").val(tanggal);
            var token = $('#tokentemp').val();
            $.ajax({
                url: '{{ route('.moffice.proses.ajax.rapat') }}',
                type: 'POST',
                data: {
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
		
		$("#submittambahrapat").on('click',function(e){
			var tanggal = $("#tanggal-form").val();
			var jam_mulai = $("#jam-mulai").val();
			var jam_selesai = $("#jam-selesai").val();
			var kegiatan = $("#kegiatan").val();
			var peminjam = $("#peminjam").val();
			var keterangan = $("#keterangan").val();
			var ruang = [];
			$('.ruang:checked').each(function(i, e) {
   				ruang.push($(this).val());
			});
			$('.ruang:checked').serialize();
			var elements = document.getElementsByTagName("input");
			var token = $('#tokentempform').val();
            $.ajax({
                url: '{{route('.moffice.proses.add.rapat')}}',
                type: 'POST',
                data: {
                    _token : token,
                    tanggal : tanggal,
					jam_mulai : jam_mulai,
					jam_selesai : jam_selesai,
					kegiatan : kegiatan,
					peminjam : peminjam,
					keterangan : keterangan,
					'ruang[]': ruang
                    },
                success: function(html){
					Swal.fire({
  						title: 'Success!',
  						text: html,
  						icon: 'success',
  						confirmButtonText: 'Tutup' 
					}).then(function() {
						$(".modal-overlay").trigger('click'); 
  						$("#lihat_data").trigger('click'); 
  						for (var ii=0; ii < elements.length; ii++) {
  						 	if (elements[ii].type == "text") {
    							elements[ii].value = ""; 
  							}
						};
					});
                },
				error: function(){
					Swal.fire({
  						title: 'Error!',
  						text: 'Mohon cek data inputanmu, Dan kalau kerja di perhatikan!!! Kalau ngga saya tutup FORM ini',
  						icon: 'error',
						type: 'warning',
  						confirmButtonText: 'Tutup'
					}).then(function() {
						$(".modal-overlay").trigger('click'); 
  						$("#lihat_data").trigger('click'); 
					});
                }
            });
		});
	});
</script>
@endpush