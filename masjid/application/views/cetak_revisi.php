<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		@media print{
			@page{
				/*size:8.5in 11in;*/
				/*size:8.5in 23in;*/
				/*size:213mm 328mm;*/
				size:landscape;						
			}
			body { -webkit-print-color-adjust: exact; }
		}
		/*body{margin:auto;color:#02338e;font-family: "tahoma"}*/
		/*body{margin:auto;color:#0f4ec3;font-family: "tahoma"}*/
		body{margin:auto;color:#7b1313;font-family: "tahoma"}
		/*.bl{color:brown !important;}*/
		.cnt{
			/*width:816px;
			height: 1056px;*/
			width: auto;
			height: 197mm;
			
/*
			width: auto;
			height:auto;*/
			position: relative !important;
			/*margin:15px;*/
			border-top: solid 1px transparent;
			padding:35px 0;
		}
		.xno,.no,.nm,.kls1,.kls2,.kls3,.rt,.info,.link,.qr,.pin,.blok1,.blok2,.blo3,.blok4,.blok5,.qr2,.pin2,.link2,.no2,.nm2{position: absolute;font-weight: bold}
		.hide,.zxhide{display: none !important}
		.xno{top:5mm;right:6mm;font-weight: normal;font-size: 10px;color:#000}
		.no{top:42mm;left:208mm;}
		.no2{top:42mm;left:241mm;}
		.nm{top:49mm;left:208mm;}
		.nm2{top:49mm;left:241mm;}
		.kl{background-color: #000;;border: solid 9px #7b1313}
		.kls1{top:58mm;left:206.5mm;}
		.kls2{top:58mm;left:244.5mm;}
		.kls3{top:58mm;left:283mm;}
		.rt{top:70mm;left:239mm;}
		.info{top:188mm;left:10mm;font-weight: normal;font-size: 11px;color:#0f4ec3}
		.link{top:200mm;left:10mm;font-size: 16px;color:#7b1313;}
		.link2{top:207mm;left:10mm;font-size: 14px;color:#7b1313;}
		.qr2{top:155mm;left:10mm;}
		.qr{top:170mm;left:130mm;}
		.pin{top:200mm;left:128mm;font-size: 18px;}
		.pin2{top:181mm;left:10mm;font-size: 18px;}
		.blok{border: solid 1px #7b1313;height: 18px;min-width:20px;background-color: #7b1313; color:#7b1313 ;z-index: 9999; }
		.blok1{border: solid 1px #7b1313;height: 18px;min-width:110px;background-color: #7b1313; color:#7b1313 ;z-index: 9999; }
		.blok2,.blok3{border: solid 1px #7b1313;height: 18px;width:auto;background-color: #7b1313; color:#7b1313 ;z-index: 9999; }
		.blok3{padding: 0 100px}
	</style>
</head>
<body>
	<div class="container">
		<?php
		if($cetak){
			$z=1;
			$r=1;
			foreach ($cetak as $key => $value) {
				if($z==3){
					$z=1;
					echo '<div class="cnt" style="border-bottom:solid 1px transparent">';
				}else{
					echo '<div class="cnt">';
				}
				$img = base_url()."gallery/".str_replace("_a", "_b", $value->qr);
				// $img = base_url()."gallery/".$value->qr;
				// if($value->kelas==1){
				// 	$wrna = "gold";
				// }elseif($value->kelas==2){
				// 	$wrna = "red";
				// }else{
					$wrna = "blue";
				#}
				if($value->kelas!=""){
					$kls = "<div class='kl hide kls".$value->kelas."'></div>";
				}else{
					$kls = "";
				}
			?>
				<div class="xno blok hide"></div>
				<div class="no blok1 hide"><?= $value->nomor ?></div>
				<div class="no2 xhide"><?= $value->nomor ?></div>
				<div class="nm blok1 hide"><?= $value->nama ?></div>
				<div class="nm2 xhide"><?= $value->nama ?></div>
				<?= $kls ?>
				<div class="rt hide"><?= $value->rt ?></div>
				<div class="info hide">silahkan scan BARCODE dengan aplikasi scan QR<br/>atau akses link alamat di bawah ini dengan browser <br/> atau chrome untuk melihat detail infaq </div>			
				<div class="link blok3 hide"><?= $value->link ?></div>			
				<div class="link2 xhide"><?= $value->link ?></div>			
				<div class="qr blok2 hide" style="width: 100px;height: 100px;margin-left:-5px"><img /></div>			
				<div class="qr2 xhide"><img src="<?= $img ?>"/></div>			
				<div class="pin blok2 hide">PIN <?= $value->pin ?></div>			
				<div class="pin2 xhide">PIN <?= $value->pin ?></div>			
			</div>
			<?php
			$z++;
			$r++;
			}
		}
		// foreach ($cetak as $key => $value) {
		// 	echo "<div class='cnt'></div>";
		// }
		?>
	</div>
</body>
</html>
<!-- 
[nomor] => 1
[nama] => A SAMAT
[pin] => 080278
[rt] => 01
[kelas] => 3
[link] => www.jami-alhidayah.com/nama/a-samat
[qr] => qr0d10551e49_a.png -->