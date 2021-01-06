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
<section class="hb-blog hb-sectionspace hb-haslayout">
<div class="container" style="padding-bottom: 20px;">
	<div class="hb-sectiontitle">
		<h2 style="color:#D62255;"><span>Sedulur Perencana</span>
			Agenda Hari Ini
		</h2>
	</div>
	<div class="row">
    <?php
    $tanggal_hari_ini = date('Y-m-d');
    $tanggal_besok = date('Y-m-d', strtotime('+1 days', strtotime($tanggal_hari_ini)));
    $agendas = DB::connection('eoffice')->table('surat_masuk')
    ->where('publish','=',1)
    ->where('tgl_agenda','>=',$tanggal_hari_ini)
    ->where('tgl_agenda','<=',$tanggal_besok)
    ->where('jns',1)
    ->orderby('tgl_agenda')
    ->orderby('jam')
    ->limit(6)
    ->get();
    ?>
    @foreach($agendas as $agenda)
    <div class="col-md-4" style="padding-top: 15px">
      <div class="" style="padding:15px; border:1px solid;border-color:#e7e7e7;border-radius: 5px">

      <p>
        <i class="ti-calendar" style="color:#d9dde2;font-size:12px"></i> {{ tgl_indo(date('Y-m-d', strtotime($agenda->tgl_agenda)))}}
        <span style="padding-left: 10px;">
          <i class="ti-time" style="color:#d9dde2;font-size: 12px"> </i> {{ date('H:i',strtotime($agenda->jam))}} WIB
        </span>
      </p>

      <h4 style="padding-top: 15px;color:#63748a;">{{Str::limit($agenda->acara, 25)}}</h4>

      <p style="padding-top: 15px"><i class="ti-map-alt" style="font-size: 25px"></i> {{Str::limit($agenda->tmpt, 25)}}</p>
      </div>
    </div> 
    @endforeach

  </div>  
</div>
</section>
