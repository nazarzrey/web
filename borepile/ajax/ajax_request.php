<?php
require_once "../seting/config_db.php";
require_once "../seting/config_web.php";
$path = "galeri/";
if (isset($_GET["img_full"])) {
	$cek_img_full = $db->select("select full_file_name from galery");
	if (count($cek_img_full) == 1) {
		$hsl_cek_img_full = $cek_img_full[0]["full_file_name"];
		if (file_exists($hsl_cek_img_full)) {
			echo "<img src='$path.$hsl_cek_img_full' width='800px;'/>";
		} else {
			echo "<img src='../no_image.jpg' width='800px;'/>";
		}
	} else {
		echo "<img src='../no_image.jpg' width='800px;'/>";
	}
}
if (isset($_GET["search"])) {
	$search = escape($_GET["search"]);
	if (isset($_GET["tipe"])) {
		$content_dtl = escape($_GET["tipe"]);
	} else {
		$content_dtl = "all";
	}
	$Redirected = "?page=laporan&lap_dtl=" . $content_dtl;
	$pecah = explode(' ', $search);
	$total_data = count($pecah);
	$cari = "";
	$z = 1;
	foreach ($pecah as $pecahin) {
		if ($z != $total_data) {
			$cari .= "%" . $pecahin;
		} else {
			$cari .= "%" . $pecahin . "%";
		}
		$z++;
	}
	if ($content_dtl == "all") {
		$cek_list_data = mysql_query("
			SELECT a.id_pengaduan,a.surat_laporan,a.upd_rec,a.judul,a.lokasi,a.status_laporan,a.kecamatan,a.lampiran,c.kecamatan,a.grup_laporan,b.deskripsi
			FROM  pu_master_alamat c RIGHT OUTER JOIN pu_pengaduan_berkas a
			ON a.kecamatan=c.id_alamat LEFT OUTER JOIN  pu_pengaduan_grup b
			ON b.id_grup_pengaduan=a.grup_laporan  where concat(c.kecamatan,' ',a.judul,' ',a.surat_laporan) like '$cari' and a.aktif='Y'
			ORDER BY a.upd_rec DESC limit 50");
		$qry_ttl	= $db->select("select COUNT(1) FROM pu_master_alamat c RIGHT OUTER JOIN pu_pengaduan_berkas a ON a.kecamatan=c.id_alamat  where  concat(c.kecamatan,' ',a.judul,' ',a.surat_laporan) like '$cari'   and a.aktif='Y'");
	} else {
		$cek_list_data = mysql_query("
		SELECT a.id_pengaduan,a.surat_laporan,a.upd_rec,a.judul,a.lokasi,a.status_laporan,a.kecamatan,a.lampiran,c.kecamatan,a.grup_laporan,b.deskripsi
		FROM  pu_master_alamat c RIGHT OUTER JOIN pu_pengaduan_berkas a
		ON a.kecamatan=c.id_alamat LEFT OUTER JOIN  pu_pengaduan_grup b
		ON b.id_grup_pengaduan=a.grup_laporan where b.id_grup_pengaduan ='$content_dtl'	and (c.kecamatan like '$cari' or judul like '$cari')  and a.aktif='Y'
		ORDER BY a.upd_rec DESC  limit 50");
		$qry_ttl	= $db->select("select COUNT(1) FROM pu_master_alamat c RIGHT OUTER JOIN pu_pengaduan_berkas a ON a.kecamatan=c.id_alamat  where a.grup_laporan='$content_dtl' and (c.kecamatan like '$cari' or judul like '$cari')   and a.aktif='Y'");
	}
	$cek_total = count($qry_ttl);
	if ($cek_total[0] != 0) {
		echo "<div  class='n1'>$cek_total[0] ditemukan</div>";
	}
	echo "<div style='min-height:300px;max-height:500px;width:100%;'><table>";
	$no = 1;
	if (count($cek_list_data) == 0) {
		echo "<tr><td> data $search tidak ditemukan...!</td></tr>";
	} else {
		echo "<tr><td class='td_hdr wx10'>No</td><td class='td_hdr wx75'>Tanggal</td><td class='td_hdr wx100'>Sumber</td><td class='td_hdr w30'>Laporan</td><td class='td_hdr'>Lokasi</td><td class='td_hdr'>Kecamatan</td><td class='td_hdr w10'>Status</td></tr>";
		while ($hsl_list_data = mysql_fetch_array($cek_list_data)) {
			$format_tgl = format_tgl($hsl_list_data['upd_rec'], ".", 2);
			$status_laporan = $hsl_list_data['status_laporan'];
			if (empty($hsl_list_data['lampiran'])) {
				$class_lampiran = "";
			} else {
				$class_lampiran = "style='color:#006ab4'";
			}
			$get_id 		= pecah_id(substr($hsl_list_data['id_pengaduan'], 0, 17));
			$get_url = $Redirected . "&dtl1=" . $get_id . "&dtl2=" . $hsl_list_data['surat_laporan'];
			echo "<tr><td class='right'>$no</td><td>" . $format_tgl . "</td><td><a href='$get_url' class='no_surat'  $class_lampiran >" . $hsl_list_data["surat_laporan"] . "</a></td><td>$hsl_list_data[judul]</td><td>$hsl_list_data[lokasi]</td><td>$hsl_list_data[kecamatan]</td><td>$status_laporan</td></tr>";
			$no++;
		}
	}
	echo "</table></div>";
}
