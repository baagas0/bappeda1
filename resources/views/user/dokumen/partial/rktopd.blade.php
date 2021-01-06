
<table class="table" id="tbl_rkt">
	<thead>
		<tr>
			<th style="color:#000;">Tahun</th>
			<th style="color:#000;">Nama OPD</th>
			<th style="color:#000;">Act.</th>
		</tr>
	</thead>
	<tbody>
		
		@foreach ($tentang1 as $tj)
		<tr>
			<td>{{$tj->periode}}</td>
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
		$('#tbl_rkt').on('click','#preview',function(e){
            e.preventDefault();
			var kode = $(this).attr('kode');
			$("#modal_show #isinya").html('<iframe src="'+kode+'" width="100%" height="600px"></iframe>');
			$("#modal_show").modal('show');
        });
    });
  </script>