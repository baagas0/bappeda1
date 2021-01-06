@extends('layouts.frontend.app')

@section('content')
<input type="hidden" name="token" id="tokentemp" value="{{ Session::token() }}" />
<section id="hb-blog" class="hb-blog hb-sectionspace hb-haslayout">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3 pull-left">
				<aside id="hb-sidebar" class="hb-sidebar hb-haslayout">
					<div class="hb-widget"  style="margin-bottom:0px;">
						<div class="hb-sectionhead">
							<div class="hb-sectiontitle">
								<h2 style="color:#D62255;"><span>Selamat Datang Di</span>
									M E N Us
								</h2>
							</div>
						</div>
					</div>
					<div class="hb-widget">
						<div class="tab-holder">
							<ul class="list-unstyled tab-list text-uppercase text-center">
								
								<li class="rpjmdkota" role="presentation" style="width:100%;">
									<a href="#rpjmdkota" aria-controls="Exapmle" role="tab" data-toggle="tab">RPJMD Kota</a>
								</li>
								<li class="ikukota" role="presentation" style="width:100%;">
									<a href="#ikukota" aria-controls="Exapmle" role="tab" data-toggle="tab">IKU Kota</a>
								</li>
								<li class="rkpdkota" role="presentation" style="width:100%;">
									<a href="#rkpdkota" aria-controls="Exapmle" role="tab" data-toggle="tab">RKPD Kota</a>
								</li>			
								<li class="perkirkota" role="presentation" style="width:100%;">
									<a href="#perkirkota" aria-controls="Exapmle" role="tab" data-toggle="tab">Perjanjian Kinerja Kota</a>
								</li>	
								

								<li class="renstraopd" role="presentation" style="width:100%;">
									<a href="#renstraopd" aria-controls="Exapmle" role="tab" data-toggle="tab">RENSTRA OPD</a>
								</li>
								<li class="ikuopd" role="presentation" style="width:100%;">
									<a href="#ikuopd" aria-controls="Exapmle" role="tab" data-toggle="tab">IKU OPD</a>
								</li>
								<li class="rktopd" role="presentation" style="width:100%;">
									<a href="#rktopd" aria-controls="Exapmle" role="tab" data-toggle="tab">RKT OPD</a>
								</li>			
								<li class="renjaopd" role="presentation" style="width:100%;">
									<a href="#renjaopd" aria-controls="Exapmle" role="tab" data-toggle="tab">Renja OPD</a>
								</li>
								<li class="perkiropd" role="presentation" style="width:100%;">
									<a href="#perkiropd" aria-controls="Exapmle" role="tab" data-toggle="tab">Perjanjian Kinerja OPD</a>
								</li>												
								
							</ul>
						</div>
					</div>
				</aside>
			</div>
			<?php
			$rpjmd_kota = \DB::connection('sakipsmg')->table('dok_rpjmd')
			->where('dok_rpjmd.status','1')
			->first();
			$iku_kota = \DB::connection('sakipsmg')->table('dok_iku_kota')
			->where('status','1')
			->first();
			?>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-9 pull-right">
				<div class="tab-holder">
					<div class="tab-content">
						<div id="rpjmdkota" role="tabpanel" class="tab-pane rpjmdkota active">
							<div class="row" style="margin-bottom:40px;">
								<div class="hb-sectiontitle">
									<h2 style="color:#D62255;"><span>Detail Menu</span>
										Dokumen Kota Semarang
									</h2>
								</div>
								<div class="hb-headcontent">
									<h2>{{ $rpjmd_kota->judul }}</h2>
									<div class="hb-description" style="padding:0px 15%;">
										<iframe id="fred" style="border:1px solid #666CCC" title="PDF in an i-Frame" src="https://esakip.semarangkota.go.id/packages/upload/files/dokumen/{{$rpjmd_kota->location}}" frameborder="1" scrolling="auto" height="550px" width="100%" ></iframe>
									</div>
								</div>
							</div>
						</div>
						<div id="ikukota" role="tabpanel" class="tab-pane rpjmdkota ">
							<div class="row" style="margin-bottom:40px;">
								<div class="hb-sectiontitle">
									<h2 style="color:#D62255;"><span>Detail Menu</span>
										Dokumen Kota Semarang
									</h2>
								</div>
								<div class="hb-headcontent">
									<h2>{{ $iku_kota->judul }}</h2>
									<div class="hb-description" style="padding:0px 15%;">
										<iframe id="fred" style="border:1px solid #666CCC" title="PDF in an i-Frame" src="https://esakip.semarangkota.go.id/packages/upload/files/dokumen/{{$iku_kota->location}}" frameborder="1" scrolling="auto" height="550px" width="100%" ></iframe>
									</div>
								</div>
							</div>
						</div>
						<div id="rkpdkota" role="tabpanel" class="tab-pane ">
							<div class="row" style="margin-bottom:40px;">
								<div class="hb-sectiontitle">
									<h2 style="color:#D62255;"><span>Detail Menu</span>
										Dokumen Kota Semarang
									</h2>
								</div>
								<div class="hb-headcontent">
									<h2>{{ $iku_kota->judul }}</h2>
									<div class="hb-description" style="padding:0px 15%;">
										<table class="table" id="tbl_rkpd">
											<thead>
												<tr>
													<th>Tahun</th>
													<th>Dokumen</th>
													<th>Act.</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$tentang1 = \DB::connection('sakipsmg')->table('dok_rkpd')
												->orderBy('dok_rkpd.periode', 'desc')
												->orderBy('dok_rkpd.perubahan', 'desc')
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
									</div>
								</div>
							</div>
						</div>
						<div id="perkirkota" role="tabpanel" class="tab-pane rpjmdkota ">
							<div class="row" style="margin-bottom:40px;">
								<div class="hb-sectiontitle">
									<h2 style="color:#D62255;"><span>Detail Menu</span>
										Dokumen Kota Semarang
									</h2>
								</div>
								<div class="hb-headcontent">
									<h2>{{ $iku_kota->judul }}</h2>
									<div class="hb-description" style="padding:0px 15%;">
										<table class="table" id="tbl_rkpd">
											<thead>
												<tr>
													<th>Tahun</th>
													<th>Dokumen</th>
													<th>Act.</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$tentang1 = \DB::connection('sakipsmg')->table('dok_perjanjiankineja')
												->orderBy('dok_perjanjiankineja.periode', 'desc')
												->orderBy('dok_perjanjiankineja.perubahan', 'desc')
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
									</div>
								</div>
							</div>
						</div>
						<div id="renstraopd" role="tabpanel" class="tab-pane rpjmdkota ">
							<div class="row" style="margin-bottom:40px;">
								<div class="hb-sectiontitle">
									<h2 style="color:#D62255;"><span>Detail Menu</span>
										Dokumen Kota Semarang
									</h2>
								</div>
								<div class="hb-headcontent">
									<h2>{{ $iku_kota->judul }}</h2>
									<div class="hb-description" style="padding:0px 15%;">
										<table class="table" id="tbl_renstra">
											<thead>
												<tr>
													<th>No</th>
													<th>Nama OPD</th>
													<th>Tahun</th>
													<th>Act.</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$tentang = \DB::connection('sakipsmg')->table('dok_renstra')
												->leftjoin('dok_skpd','dok_renstra.id_opd','=','dok_skpd.id')
												->orderBy('dok_skpd.kode_skpdbr', 'asc')
												->get();
												$no=1;
												?>
												@foreach ($tentang as $tj)
												<tr>
													<td><?=$no++?></td>
													<td>{{$tj->nama_skpd}}</td>
													<td>{{$tj->periode_awal}} - {{$tj->periode_akhir}}</td>
													<td>
														<a href="#" id="preview" kode="https://esakip.semarangkota.go.id/packages/upload/files/dokumen/{{$tj->location}}" class="btn btn-sm btn-success"><i class="fa fa-eye"> </i> Lihat</a>
														<a href="https://esakip.semarangkota.go.id/packages/upload/files/dokumen/{{$tj->location}}" class="btn btn-sm btn-primary" download><i class="fas fa-arrow-alt-circle-down"> </i> Unduh</a>
													</td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div id="ikuopd" role="tabpanel" class="tab-pane ">
							<div class="row" style="margin-bottom:40px;">
								<div class="hb-sectiontitle">
									<h2 style="color:#D62255;"><span>Detail Menu</span>
										Dokumen Kota Semarang
									</h2>
								</div>
								<div class="hb-headcontent">
									<h2>{{ $iku_kota->judul }}</h2>
									<div class="hb-description" style="padding:0px 15%;">
										<table class="table" id="tbl_iku">
											<thead>
												<tr>
													<th style="color:white;">No</th>
													<th style="color:white;">Nama OPD</th>
													<th style="color:white;">Act.</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$tentang = \DB::connection('sakipsmg')->table('dok_iku')
												->leftjoin('dok_skpd','dok_iku.id_opd','=','dok_skpd.id')
												->orderBy('dok_skpd.id', 'asc')
												->get();
												$no=1;
												?>
												@foreach ($tentang as $tj)
												<tr>
													<td>
														<?=$no++?>
													</td>
													<td>{{$tj->nama_skpd}}</td>
													<td>
														<a href="#" id="preview" kode="https://esakip.semarangkota.go.id/packages/upload/files/dokumen/{{$tj->location}}" class="btn btn-sm btn-success">
															<i class="fa fa-eye"></i>Lihat
														</a>
														<a href="https://esakip.semarangkota.go.id/packages/upload/files/dokumen/{{$tj->location}}" class="btn btn-sm btn-primary" download>
															<i class="fas fa-arrow-alt-circle-down"></i>Unduh
														</a>
													</td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>	
						<div id="rktopd" role="tabpanel" class="tab-pane ">
							<div class="row" style="margin-bottom:40px;">
								<div class="hb-sectiontitle">
									<h2 style="color:#D62255;"><span>Detail Menu</span>
										Dokumen Kota Semarang
									</h2>
								</div>
								<div class="hb-headcontent">
									<h2>{{ $iku_kota->judul }}</h2>
									<div class="hb-description" style="padding:0px 15%;">
										<select name="filterrktopd" id="filterrktopd">
											<option value="2016">2016</option>
											<option value="2017">2017</option>
											<option value="2018">2018</option>
											<option value="2019">2019</option>
											<option value="2020">2020</option>
										</select>
										<button class="btn btn-primary" id="carirktopd">Submit</button>
									</div>
									<div id="tam_perenkin_opd_rkt_konten"></div>
								</div>
							</div>
						</div>
						<div id="renjaopd" role="tabpanel" class="tab-pane ">
							<div class="row" style="margin-bottom:40px;">
								<div class="hb-sectiontitle">
									<h2 style="color:#D62255;"><span>Detail Menu</span>
										Dokumen Kota Semarang
									</h2>
								</div>
								<div class="hb-headcontent">
									<h2>{{ $iku_kota->judul }}</h2>
									<div class="hb-description" style="padding:0px 15%;">
										<select name="filterrenjaopd1" id="filterrenjaopd1">
											<option value="2016">2016</option>
											<option value="2017">2017</option>
											<option value="2018">2018</option>
											<option value="2019">2019</option>
											<option value="2020">2020</option>
										</select>
										<select name="filterrenjaopd2" id="filterrenjaopd2">
											<option value="0">Induk</option>
											<option value="1">Perubahan</option>
										</select>
										<button class="btn btn-primary" id="carirenjaopd">Submit</button>
									</div>
									<div id="tam_perenkin_opd_renja_konten"></div>
								</div>
							</div>
						</div>
						<div id="perkiropd" role="tabpanel" class="tab-pane ">
							<div class="row" style="margin-bottom:40px;">
								<div class="hb-sectiontitle">
									<h2 style="color:#D62255;"><span>Detail Menu</span>
										Dokumen Kota Semarang
									</h2>
								</div>
								<div class="hb-headcontent">
									<h2>{{ $iku_kota->judul }}</h2>
									<div class="hb-description" style="padding:0px 15%;">
										<select name="filterperkiropd1" id="filterperkiropd1">
											<option value="2016">2016</option>
											<option value="2017">2017</option>
											<option value="2018">2018</option>
											<option value="2019">2019</option>
											<option value="2020">2020</option>
										</select>
										<select name="filterperkiropd2" id="filterperkiropd2">
											<option value="0">Induk</option>
											<option value="1">Perubahan</option>
										</select>
										<button class="btn btn-primary" id="cariperkiropd">Submit</button>
									</div>
									<div id="tam_perenkin_opd_pk_konten"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			
		</div>
	</div>
</section>

@endsection
@push('js')
<script>
	$(document).ready(function(){
		$("#carirktopd").on('click',function(e){
			var tanggal = $("#filterrktopd").val();
            var token = $('#tokentemp').val();
            $.ajax({
                url: '{{route('..ajax.rkt.opd')}}',
                type: 'POST',
                data: {
                    tanggal : tanggal,
                    _token : token,
                    },
                success: function(html){
                    $("#tam_perenkin_opd_rkt_konten").html(html);
                },
				error: function(html) {
					$("#tam_perenkin_opd_rkt_konten").html(html);
				}
            });
		});
		
		$("#carirenjaopd").on('click',function(e){
			var tanggal = $("#filterrenjaopd1").val();
			var status = $("#filterrenjaopd2").val();
            var token = $('#tokentemp').val();
            $.ajax({
                url: '{{route('..ajax.renja.opd')}}',
                type: 'POST',
                data: {
                    tanggal : tanggal,
					status : status,
                    _token : token,
                    },
                success: function(html){
                    $("#tam_perenkin_opd_renja_konten").html(html);
                },
				error: function(html) {
					$("#tam_perenkin_opd_renja_konten").html(html);
				}
            });
		});
		
		$("#cariperkiropd").on('click',function(e){
			var tanggal = $("#filterperkiropd1").val();
			var status = $("#filterperkiropd2").val();
            var token = $('#tokentemp').val();
            $.ajax({
                url: '{{route('..ajax.perkir.opd')}}',
                type: 'POST',
                data: {
                    tanggal : tanggal,
					status : status,
                    _token : token,
                    },
                success: function(html){
                    $("#tam_perenkin_opd_pk_konten").html(html);
                },
				error: function(html) {
					$("#tam_perenkin_opd_pk_konten").html(html);
				}
            });
		});
	});
</script>
<script>
	$(document).ready(function(){
		
		$('#tbl_rkpd, #tbl_renstra, #tbl_iku, #tbl_rkt, #tbl_renja, #tbl_lkjip_kota, #tbl_lkjip_opd').on('click','#preview',function(e){
			e.preventDefault();
			var kode = $(this).attr('kode');
			$("#modal_show #isinya").html('<iframe src="'+kode+'" width="100%" height="600px"></iframe>');
			$("#modal_show").modal('show');
		});
	)};
</script>
@endpush