<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<title>Hitung Umur</title>
</head>
<style>
	input{padding:5px 10px; margin:10px auto;}
	a{text-decoration:none;color:green;border:solid 1px;padding:5px !important;margin:5px;border-radius:2px}
	</style>


<body>

<h1>Menghitung Usia Anda</h1>
<form method="post" action="">
Masukkan tanggal lahir anda :<br/> <input type="date" name="tanggal_lahir" value="<?php umur(); ?>" max="<?= date("Y-m-d") ?>">
<input type="submit" name="submit" value="Hitung">
<a href="https://jami-alhidayah.com/umur.php">reset</a>
</form>
<?php
function umur(){
	if(isset($_POST['submit'])){
		echo $_POST['tanggal_lahir'];
	}else{
		echo date("Y-m-d");
	}

}
if(isset($_POST['submit'])){
	$tanggal_lahir = $_POST['tanggal_lahir']; // Mendapatkan tanggal lahir dari form
	$birthDate = new DateTime($tanggal_lahir); // membuat format tanggal lahir menjadi format date
	$today = new DateTime("today"); // mengambil hari ini
	if ($birthDate > $today) { 
	    exit("0 tahun 0 bulan 0 hari");
	}
	$y = $today->diff($birthDate)->y; // tahun
	$m = $today->diff($birthDate)->m; // bulan
	$d = $today->diff($birthDate)->d; // hari
	echo "Umur anda <br>".$y." tahun <br>".$m." bulan <br>".$d." hari";
}
?>



</body>
</html>



<?php
/*
function hitung_umur($tanggal_lahir){
	$birthDate = new DateTime($tanggal_lahir);
	$today = new DateTime("today");
	if ($birthDate > $today) { 
	    exit("0 tahun 0 bulan 0 hari");
	}
	$y = $today->diff($birthDate)->y;
	$m = $today->diff($birthDate)->m;
	$d = $today->diff($birthDate)->d;
	return $y." tahun ".$m." bulan ".$d." hari";
}

echo hitung_umur("1980-12-01");
*/
?>