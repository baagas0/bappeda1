<?php $tanggal_format =  Carbon\Carbon::parse($tanggal)->format('Y-m-d') ?>

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
        ->where('tgl_agenda',$tanggal_format)
        ->where('jns',1)
        ->orderBy('jam', 'DESC')
        ->limit(6)
        ->get();
?>

@foreach($agendas as $agenda)
<?php
	$dispo_masuk = DB::connection('eoffice')->table('dispo_masuk')
		->where('noagenda','=',$agenda->no_agenda)
        ->get();
	// $uniquedispo_masuk = $dispo_masuk->disposisi->unique();
?>

<div class="quotes">
	<div class="container">
		<div class="content one-q"  style="border-left: 3px solid #{!! color() !!}!important;">
			<div class="container"> 
			<div class="row" >
				<i class="fa fa-calendar"></i> {{ tgl_indo(date('Y-m-d', strtotime($agenda->tgl_agenda)))}} |  <i class="fa fa-clock-o" aria-hidden="true"></i> {{ $agenda->jam }}
			</div>
			<div class="row" style="font-size:16px;">
			 <b>{{ strtoupper($agenda->acara) }}</b>
			</div>
			<div class="row">
			<i class="fa fa-map-marker"></i> {{ $agenda->tmpt }}
			</div>  
			@foreach($dispo_masuk->unique('disposisi') as $dispo)
				<?php 
					$disposisi = DB::connection('eoffice')->table('disposisi')
					->where('id','=',$dispo->disposisi)
					->first(); 
				?>
				<div class="row" style="margin-bottom: 0px!important">
					<div class="col-md-12"> 
						{{ $disposisi->disposisi }}
					</div>
				</div>
			@endforeach
			</div>
		</div>
	</div>
</div>
@endforeach