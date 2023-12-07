<?php
$sql = "select jenis,deskripsi from kontak where utama='Y' and aktif='Y'";
$cek_favorit = $db->select($sql);
if ($cek_favorit) {
	foreach ($cek_favorit as $hsl_data) {
		echo "<tr><td width='80px;'><b>" . $hsl_data['jenis'] . " <b/></td><td >" . $hsl_data['deskripsi'] . "</td></tr>";
	}
} else {
	log_error($Redirected, $cek_favorit);
}
$sql = "select url,deskripsi,img from kontak where utama='Y' and aktif='Y' and follow='Y'";
$sosmed = $db->select($sql);
if ($sosmed) {
	echo "<tr><td><b>Follow US</b></td><td>";
	foreach ($sosmed as $hsl_data) {
		echo "<a href='$hsl_data[url]' class='follow' style='background-position:$hsl_data[img];'></a>";
	}
	echo "</td></tr>";
} else {
	log_error($Redirected, $cek_favorit);
}
