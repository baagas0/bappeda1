
<table class="table" id="tbl_renja">
	<thead>
		<tr>
			<th style="color:#000">Periode Renja</th>
			<th style="color:#000">Nama OPD</th>
			<th style="color:#000">Act.</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($tentang1 as $tj)
		<tr>
			<td>Renja Tahun {{$tj->periode}}</td>
			<td>{{$tj->nama_skpd}}</td>
			<td>
				<a href="#" id="preview" kode="https://esakip.semarangkota.go.id/packages/upload/files/dokumen/{{$tj->location}}" class="btn btn-sm btn-success">
					<i class="fa fa-eye"/>Lihat
				</a>
				<a href="https://esakip.semarangkota.go.id/packages/upload/files/dokumen/{{$tj->location}}" class="btn btn-sm btn-primary" download>
					<i class="fas fa-arrow-alt-circle-down"/>Unduh
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
  <script> 
    $(document).ready(function(){
		$('#tbl_rkpd, #tbl_renstra, #tbl_iku, #tbl_rkt, #tbl_renja, #tbl_lkjip_kota, #tbl_lkjip_opd').on('click','#preview',function(e){
            e.preventDefault();
			var kode = $(this).attr('kode');
			$("#modal_show #isinya").html('<iframe src="'+kode+'" width="100%" height="600px"></iframe>');
			$("#modal_show").modal('show');
        });
    });
  </script>