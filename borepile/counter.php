<?php
$ip  = getenv("REMOTE_ADDR");
$tgl = date("Y-m-d");
$jam = date("H:i:s");
$sintak  = "select * from counter where ip_client='$ip' and tanggal='$tgl'";
$cari = count($db->select($sintak));
if ($cari == 0) {
	$db->query("insert into counter values('$tgl','$jam','$ip','unknown','unknown','unknown','unknown','unknown','unknown','unknown')");
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
$a = "select count(1) from counter where tanggal='$tgl'";
$b = "select count(1) from counter where tanggal='$kemarin'";
$c = "select count(1) from counter where tanggal between '$this_week2' and '$this_week1'";
$d = "select count(1) from counter where tanggal between '$last_week2' and '$last_week1'";
$e = "select count(1) from counter where DATE_FORMAT(tanggal,'%Y-%m')='$this_month'";
$f = "select count(1) from counter where DATE_FORMAT(tanggal,'%Y-%m')='$last_month'";
$g = "select count(1) from counter";

$sql   = "select ($a) as today,($b) as yesterday,($c) as thisweek,($d) as lastweek,($e) as thismonth, ($f) as lastmonth, ($g) as sumary from dual";
$query = $db->select($sql);
?>
<div class="counter">
	<div valign="center" style="font-size:14px; color:orange; padding-bottom:5px;"><?php //echo "Ip Anda ".$ip; 
																					?> </div>
	<div class="counter_right">
		<div>Hari ini<br /></div>
		<div>Kemarin<br /></div>
		<div>Minggu ini<br /></div>
		<div>Minggu lalu<br /></div>
		<div>Bulan ini<br /></div>
		<div>Bulan lalu<br /></div>
		<div>Total<br /></div>
	</div>
	<div class="counter_left" align="right">
		<div><?= $query[0]["today"]; ?><br /></div>
		<div><?= $query[0]["yesterday"]; ?><br /></div>
		<div><?= $query[0]["thisweek"]; ?><br /></div>
		<div><?= $query[0]["lastweek"]; ?><br /></div>
		<div><?= $query[0]["thismonth"]; ?><br /></div>
		<div><?= $query[0]["lastmonth"]; ?><br /></div>
		<div><?= $query[0]["sumary"]; ?><br /></div>
	</div>
	<div align="center" class="angka_counter">
		<?php
		$total = $query[0]["sumary"];
		$adel  = strlen($total) - 1;
		$adhe3 = 7 - $adel - 1;
		$r = 0;
		while ($r <= $adhe3) {
			echo '<img src="gambar/0.GIF">';
			$r++;
		}
		$x = 0;
		while ($x <= $adel) {
			$adelia = trim(substr($total, $x, 1));
			$nomer = '<img src="gambar/' . $adelia . '.GIF">';
			echo $nomer;
			$x++;
		}
		echo "</div>
		</div>";
		?>