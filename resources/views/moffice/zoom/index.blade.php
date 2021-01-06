@extends('layouts.moffice.app')
@section('content')
	<div class="form-element wrap-content b-shadow white" > 
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
	<div class="container" style="margin:0px 10px;padding-bottom:15px">
		<a id="add_button" class="waves-effect waves-light btn modal-trigger b-shadow" href="#modal_add"><i class="fa fa-plus center-align"></i></a>
	</div>
	<div id="content">
		
	</div>
	<!-- end gallery --> 
	<div id="modal_add" class="modal" style="width: 92%;max-height: 90%;">
		<div class="modal-content">
			<p>buat booking Zoom disini.</p>
			<form method="POST" id="modal_tambah">
				<input type="hidden" name="token" id="tokentempform" value="{{ Session::token() }}" />
				<div class="input-field">
					<i class="fa fa-envelope prefix"></i>
					<input id="tanggal-form" disabled name="tanggal" class="datepicker" type="text" placeholder="Pilih tanggal di menu sebelumnya">
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
					<select id="jenis" name="jenis">
						<option>Pilih Jenis Peminjaman</option>
						<option value="akun">Akun Zoom</option>
						<option value="barang">Barang</option>
					</select>
				</div>
				<div class="input-field">
					<i class="fa fa-envelope prefix"></i>
					<input id="peminjam" name="peminjam" type="text">
					<label for="peminjam">Nama Peminjam</label>
				</div>
				<!--<div class="input-field" id="">
					<i class="fa fa-envelope prefix"></i>
					<input name="barang" type="text">
					<label for="barang">Barang</label>
				</div> -->
				<div class="input-field">
					<i class="fa fa-envelope prefix"></i>
					<input id="keterangan" name="keterangan" type="text">
					<label for="keterangan">Keterangan</label>
				</div>
				<div class="input-field" id="barang">
					<?php
						$barang = \DB::table('m_barang')->get();
						foreach($barang as $row) {
					?>
					<p>
						<label>
							<input type="checkbox" name="barang[]" class="barang" id="barang{{ $row->id }}" value="{{ $row->id }}">
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
		$("#barang").hide();
		$("#jenis").change(function() {
        	var jenis = $("#jenis").val();

        	if(jenis == "akun") {
				$("#barang").hide();
        	}else {
				$("#barang").show();
        	}

      	});
		$("#lihat_data").on('click',function(e){
			var tanggal = $("#tanggal").val();
			$("#tanggal-form").val(tanggal);
            var token = $('#tokentemp').val();
            $.ajax({
                url: '{{route('.moffice.proses.ajax.zoom')}}',
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
			var jenis = $("#jenis").val();
			alert(jenis);
			var barang = [];
			$('.barang:checked').each(function(i, e) {
   				barang.push($(this).val());
			});
			$('.barang:checked').serialize();
			var elements = document.getElementsByTagName("input");
			var token = $('#tokentempform').val();
            $.ajax({
                url: '{{ route('.moffice.proses.add.zoom') }}',
                type: 'POST',
                data: {
                    _token : token,
                    tanggal : tanggal,
					jam_mulai : jam_mulai,
					jam_selesai : jam_selesai,
					kegiatan : kegiatan,
					peminjam : peminjam,
					jenis : jenis,
					keterangan : keterangan,
					'barang[]': barang
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