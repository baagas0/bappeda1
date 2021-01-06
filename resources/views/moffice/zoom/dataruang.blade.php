
	<div class="gallery" style="20px 0px;">
		<div class="container">
			<div class="contents-tabs">
				<div class="container-fluid" id="data">
					@if($dataCount < 1)
						Maaf Data Pada Tanggal Yang Anda Masukan Tidak Di Temukan, Silahkan Tambahkan Data Pada Tombol Di Atas
					@endif
					@foreach($data as $row)
					<?php
						$bidang = \DB::table('bidangs')->where('id', $row->bidang_id)->first(); 
					?>
					<div class="row" style="background-color:white; padding:10px;">
						<div class="col s8">
							<div class="content-text">
								<span>{{ $bidang->bidang }}</span>
								<a href=""><h5>{{ $row->kegiatan }}</h5></a>
								<p class="date"><i class="fa fa-clock-o"></i>{{ Carbon\Carbon::parse($row->tanggal)->format('d M Y') }}</p>
								@if(Auth::user()->id_bidang == $row->bidang_id)
								<a kode="{{ $row->id }}" id="deletedata" ><button class="button button-custom waves-effect button-red b-shadow"><i class="fa fa-pencil"></i>Hapus</button></a>
								@endif
							</div>
						</div>
						<div class="col s4 row">
							<div class="col s6">
								<div class="content-text">
									<span style="font-size: 11px;">mulai</span>
									<h5>{{ $row->jam_mulai }}</h5>
								</div>
							</div>
							<div class="col s6">
								<div class="content-text">
									<span style="font-size: 11px;">selesai</span>
									<h5>{{ $row->jam_selesai }}</h5>
								</div>
							</div>
							<div class="col s12">
								<div class="content-text">
									@if($row->jenis == 'Peminjaman Akun Zoom')
										<span class="red" style="color:white;padding:2px;margin:4px solid white;">{{ $row->jenis }}</span>
									@else
									@foreach(json_decode($row->barang) as $dd)
									<?php
										$barang = \DB::table('m_barang')->where('id', $dd)->first();
									?>
									<span class="{{ ($dd == 1 ? 'pink' : ($dd == 2 ? 'red' : ($dd == 3 ? 'blue' : ($dd == 4 ? 'purple' : ($dd == 5 ? 'indigo' : ($dd == 6 ? 'cyan' : 'green')))))) }}" style="color:white;padding:2px;margin:4px solid white;">{{ $barang->name }}</span>
									@endforeach
									@endif 
								</div>
							</div> 
						</div>
					</div>
					<br>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	<!-- end gallery --> 
	<script>
		$(document).ready(function(){
			$("#data").on('click','#deletedata',function(e){ 
				var kode = $(this).attr("kode");
				var table = 'm_zooms';
				var token = $('#tokentemp').val();
				Swal.fire({
                  title: 'Anda Yakin?',
                  text: "Data yang di pilih akan di hapus secara permanen dan tidak dapat di kembalikan lagi!!!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya, Hapus'
                }).then((result) => {
                  if (result.isConfirmed) {
                    $.ajax({
		                url: '{{route('.moffice.proses.delete')}}',
		                type: 'POST',
		                data: {
		                    _token : token,
							id : kode,
							table : table,
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
							alert('gagal');
		                }
		            });
                  }
                })
	            
			});
		});
	</script>
	