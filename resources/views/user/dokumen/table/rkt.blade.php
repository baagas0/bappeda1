<table class="table" id="tbl_rkpd">
	<thead>
		<tr>
			<th>Tahun</th>
			<th>OPD</th>
			<th>Act.</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$tentang1 = \DB::connection('sakipsmg')->table('dok_rkt')
		->where('periode', $tanggal)
		->get();
		$no=0;
		?>
		@foreach ($tentang1 as $tj)
		<? $no++;?>
		<tr>
			<td>{{$tj->periode}}</td>
			<td>{{$tj->uraian}}</td>
			<td>
				<a href="#" id="preview" kode="https://esakip.semarangkota.go.id/packages/upload/files/dokumen/{{$tj->location}}" class="btn btn-sm btn-success"><i class="fa fa-eye"> </i> Lihat</a>
				<a href="https://esakip.semarangkota.go.id/packages/upload/files/dokumen/{{$tj->location}}" class="btn btn-sm btn-primary" download><i class="fas fa-arrow-alt-circle-down"> </i> Unduh</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>