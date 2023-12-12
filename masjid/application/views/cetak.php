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
		}
		/*body{margin:auto;color:#02338e;font-family: "tahoma"}*/
		/*body{margin:auto;color:#0f4ec3;font-family: "tahoma"}*/
		body{margin:auto;color:purple;font-family: "tahoma"}
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
		.xno,.no,.nm,.kls1,.kls2,.kls3,.rt,.info,.link,.qr,.pin{position: absolute;font-weight: bold}
		.xhide{display: none !important}
		.xno{top:5mm;right:6mm;font-weight: normal;font-size: 10px;color:#000}
		.no{top:42mm;left:208mm;}
		.nm{top:49mm;left:208mm;}
		.kl{background-color: #000;;border: solid 9px purple}
		.kls1{top:57mm;left:206.5mm;}
		.kls2{top:57mm;left:244.5mm;}
		.kls3{top:57mm;left:283mm;}
		.rt{top:70mm;left:239mm;}
		.info{top:188mm;left:10mm;font-weight: normal;font-size: 11px;color:#0f4ec3}
		.link{top:200mm;left:10mm;font-size: 16px;color:#7b1313;}
		.qr{top:170mm;left:130mm;}
		.pin{top:200mm;left:128mm;font-size: 18px;}
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
				<div class="xno hide" ><?= $value->nomor ?></div>
				<div class="no hide"><?= $value->nomor ?></div>
				<div class="nm hide"><?= $value->nama ?></div>
				<?= $kls ?>
				<div class="rt hide"><?= $value->rt ?></div>
				<div class="info hide">silahkan scan BARCODE dengan aplikasi scan QR<br/>atau akses link alamat di bawah ini dengan browser <br/> atau chrome untuk melihat detail infaq </div>			
				<div class="link hide"><?= $value->link ?></div>			
				<div class="qr hide"><img src='<?= $img ?>'/></div>			
				<div class="pin hide">PIN <?= $value->pin ?></div>			
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