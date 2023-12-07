<style type="text/css">
	.counter {
		padding: 5px;
		font-size: 11px;
		font-family: tahoma;
		overflow: hidden;
		height: auto;
		width: auto;
		color: #555;
		font-weight: normal;
	}

	.counter_right {
		height: auto;
		width: 63%;
		border-radius: 5px;
		float: left;
		margin-bottom: 10px;
	}

	.counter_left {
		height: auto;
		width: 24%;
		border-radius: 5px;
		float: right;
		margin-bottom: 4px;
	}

	.garis_bawah {
		border-bottom: solid 1px orange;
	}

	.angka_counter {
		float: left;
		width: 98%;
		background: #000000;
		padding-bottom: 5px;
		padding-top: 3px;

	}
</style>
<?php
$ip  = getenv("REMOTE_ADDR");
$tgl = date("Y-m-d");
$jam = date("H:i:s");
//include "../config/config.php";
//require_once "halaman/browser.php";
$sql = $db->select("select * from counter");
if ($sql) {
	$sintak  = "select * from counter 
		           where ip_client='$ip' 
				   and tanggal='$tgl'";
	/* 
				   and browser='$browser_name' 
				   and os='$operating_sys'";
				   */
	$cari = count($db->select($sintak));
	if ($cari == 0) {
		/*
				//require_once "halaman/regional.php";					
				$sintax  ="select * from counter 
					   where ip_client='$ip' 
					   and tanggal='$tgl'";
					   /*
					   
					   and browser='$browser_name' 
					   and os='$operating_sys'
					   and country='$country'
					   and isp='$isp'";
					   */
		//mysql_query("insert into counter values('$tgl','$jam','$ip','$browser_name','$browser_versi','$operating_sys','$country','$reg_name','$city','$isp')");
		mysql_query("insert into counter values('$tgl','$jam','$ip','unknown','unknown','unknown','unknown','unknown','unknown','unknown')");
	}
	//kemarin
	$kemarin   = date('Y-m-d', strtotime($tgl . "-1 days"));
	//minggu ini & minggu lalu		
	$minggu      = date("w");
	$kurangx   = $minggu;
	$kurang1   = $minggu + 1;
	$kurang2   = $minggu + 7;
	$this_week1 = date('Y-m-d');
	$this_week2 = date('Y-m-d', strtotime($tgl . "-" . $kurangx . " days"));
	$last_week1 = date('Y-m-d', strtotime($tgl . "-" . $kurang1 . " days"));
	$last_week2 = date('Y-m-d', strtotime($tgl . "-" . $kurang2 . " days"));
	//bulan ini & bulan lalu		
	$bulan      = date("m");
	$this_month = date('Y-m', strtotime($tgl));
	$last_month = date('Y-m', strtotime($tgl . "last month"));
	$a = "select count(*) from counter where tanggal='$tgl'";
	$b = "select count(*) from counter where tanggal='$kemarin'";
	$c = "select count(*) from counter where tanggal between '$this_week2' and '$this_week1'";
	$d = "select count(*) from counter where tanggal between '$last_week2' and '$last_week1'";
	$e = "select count(*) from counter where DATE_FORMAT(tanggal,'%Y-%m')='$this_month'";
	$f = "select count(*) from counter where DATE_FORMAT(tanggal,'%Y-%m')='$last_month'";
	//echo $a."<br/>".$b."<br/>".$c."<br/>".$d."<br/>".$e."<br/>".$f;
	$today      = count($db->select($a));
	$yesterday  = count($db->select($b));
	$thisweek   = count($db->select($c));
	$lastweek   = count($db->select($d));
	$thismonth  = count($db->select($e));
	$lastmonth  = count($db->select($f));
	$sumary     = count($db->select("select count(*) from counter"));
?>
	<div class="counter">
		<div align="center" style="font-size:14px; color:orange; padding-bottom:5px;"><?php //echo "Ip Anda ".$ip; 
												?> </div>
		<div class="counter_right">
			<div class="garis_bawah">Hari ini<br /></div>
			<div class="garis_bawah">Kemarin<br /></div>
			<div class="garis_bawah">Minggu ini<br /></div>
			<div class="garis_bawah">Minggu lalu<br /></div>
			<div class="garis_bawah">Bulan ini<br /></div>
			<div class="garis_bawah">Bulan lalu<br /></div>
			<div class="garis_bawah">Total<br /></div>
		</div>
		<div class="counter_left" align="right">
			<div class="garis_bawah"><?= $today[0]; ?><br /></div>
			<div class="garis_bawah"><?= $yesterday[0]; ?><br /></div>
			<div class="garis_bawah"><?= $thisweek[0]; ?><br /></div>
			<div class="garis_bawah"><?= $lastweek[0]; ?><br /></div>
			<div class="garis_bawah"><?= $thismonth[0]; ?><br /></div>
			<div class="garis_bawah"><?= $lastmonth[0]; ?><br /></div>
			<div class="garis_bawah"><?= $sumary[0]; ?><br /></div>
		</div>
		<div align="center" class="angka_counter">
		<?php
		$total = count($db->select("select count(*) from counter"));
		$adel  = strlen($total[0]) - 1;
		$adhe3 = 7 - $adel - 1;
		$r = 0;
		while ($r <= $adhe3) {
			echo '<img src="image/0.GIF">';
			$r++;
		}
		$x = 0;
		while ($x <= $adel) {
			$adelia = trim(substr($total[0], $x, 1));
			$nomer = '<img src="image/' . $adelia . '.GIF">';
			echo $nomer;
			$x++;
		}
		echo "</div>
		</div>";
	} else {
		echo "Maaf tabel counter blum ada, mohon buat dahulu";
	}
		?>