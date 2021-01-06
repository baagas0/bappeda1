<?php
    function tgl_indo($tanggal) {
        $bulan = array (
            1 =>   'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sept',
            'Okt',
            'Nov',
            'Des'
        );
        $pecahkan = explode('-', $tanggal); // untuk memecah date('Y-m-d')
  
        // variabel pecahkan 0 = tahun
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tanggal
 
      return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
    function bln_indo($m) {
        if($m == 1){
            $bulan = 'Jan';
        }else if($m == 2) {
            $bulan = 'Feb';
        }else if($m == 3){
            $bulan = 'Mar';
        }else if($m == 4){
            $bulan = 'Apr';
        }else if($m == 5){
            $bulan = 'Mei';
        }else if($m == 6){
            $bulan = 'Jun';
        }else if($m == 7){
            $bulan = 'Jul';
        }else if($m == 8){
            $bulan = 'Agu';
        }else if($m == 9){
            $bulan = 'Sep';
        }else if($m == 10){
            $bulan = 'Okt';
        }else if($m == 11){
            $bulan = 'Nov';
        }else if($m == 12){
            $bulan = 'Des';
        }else{
            $bulan = "tidak terdefinisi";
        }
        return $bulan;
    }
?>
<?php
    $tanggal_hari_ini = date('Y-m-d');
    $tanggal_besok = date('Y-m-d', strtotime('+1 days', strtotime($tanggal_hari_ini)));
    $agendas = DB::connection('eoffice')->table('surat_masuk')
		->where('publish','=',1)
        ->where('tgl_agenda',$tanggal)
        ->where('acara','like','%'.$judul.'%')
        ->where('jns',1)
        ->orderby('tgl_agenda')
        ->orderby('jam')
        ->limit(6)
        ->get();
		
	// dd($agendas);
?>
								<div class="row">
@foreach($agendas as $agenda)
									<div class="col-xs-12 col-sm-12 col-md-6">
										<div class="hb-productsbox" style="background-color: #B6CEC7">
											<figure class="hb-productsimg"> 
												<p  style="float:left!important">
													<i class="ti-calendar" style="color:#d9dde2;font-size:20px"></i> {{ tgl_indo(date('Y-m-d', strtotime($agenda->tgl_agenda)))}}
													<span style="padding-left: 25px;">
														<i class="ti-time" style="color:#d9dde2;font-size: 12px"> </i> {{ date('H:i',strtotime($agenda->jam))}} WIB
													</span>
													<span style="padding-left: 20px;">
														<i class="ti-time" style="color:#d9dde2;font-size: 12px"> </i> {{ $agenda->no_surat }}
													</span>
												</p>
												<br>
												<p style="float:left!important;text-align: left;">
													{{Str::limit($agenda->acara, 500)}}
												</p>
											</figure>
											<div class="hb-productscontent" style="margin-top: -20px;">
												<p style="float:left!important">
													<i class="ti-map-alt" style="font-size: 25px"></i> {{Str::limit($agenda->tmpt, 40)}}
												</p>
											</div>
										</div>
									</div>
									
@endforeach
								</div>