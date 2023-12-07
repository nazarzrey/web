<?php
require_once "../../seting/config_db.php";
require_once "../../seting/config_web.php";
require_once "../../seting/function_web.php";
$db  = new Db();
if (isset($_GET["hapus_gambar"])) {
	$hapus_gambar = $_GET["hapus_gambar"];
	$pecah = explode(',', $hapus_gambar);
	$total_data = count($pecah);
	$cari = "";
	$z = 1;
	foreach ($pecah as $pecahin) {
		if ($z == $total_data) {
			$cari .= "'" . $pecahin . "'";
		} else {
			$cari .= "'" . $pecahin . "',";
		}
		$z++;
	}
	$cek_dulu 	= $db->select("select full_file_name,thumb_file_name from galery where key_attach in ($cari)");
	$cek_id_dulu 	= $db->select("select distinct id_attach  as id_attach from galery where key_attach in ($cari)");
	if ($cek_dulu = $cek_dulu) {
		foreach ($cek_dulu as $key => $hsl_cekdulu) {
			$full_img = "../../galeri/" . $hsl_cekdulu["full_file_name"];
			$icon_img = "../../galeri/" . $hsl_cekdulu["thumb_file_name"];
			if (file_exists($full_img)) {
				unlink($full_img);
			}
			if (file_exists($icon_img)) {
				unlink($icon_img);
			}
		}
		$hapus_deh = $db->query("delete from galery where key_attach in ($cari)");
		if ($hapus_deh) {
			$Msg1 = "Y";
		} else {
			$Msg1 = " Gagal hapus gambar ";
		}
		$sql = "select 1 from galery where id_attach='" . $cek_id_dulu[0]["id_attach"] . "'";
		$cek_ttl_attach = $db->select($sql);
		if (count($cek_ttl_attach) == 0) {
			$update_berkas = "update pu_pengaduan_berkas set lampiran=null where id_pengaduan='" . $cek_id_dulu[0]["id_attach"] . "'";
			if ($db->query($update_berkas)) {
				$Msg2 = "Y";
			} else {
				log_error("ajax hapus image", $update_berkas);
				$Msg2 = " Error update master berkas, hub admin web ";
			}
		} else {
			$Msg2 = "YY";
		}
		if (substr($Msg1 . $Msg2, 0, 2) == "YY") {
			$Msg = "Y";
		} else {
			$Msg = $Msg1 . $Msg2;
		}
	} else {
		$Msg = " Gagal query cek galeri ";
	}
	echo  $Msg;
}
if (isset($_GET["search"])) {
	echo '
	<style>
	.trx td{
		height:0px;
		padding:0px 10px;
	}
	</style>';
	if (isset($_GET["tipe"])) {
		$content_dtl = $_GET["tipe"];
	} else {
		$content_dtl = "all";
	}
	$Redirected = "?halaman=laporan&lap_dtl=" . $content_dtl;
	$pecah = explode(' ', $_GET['search']);
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
			SELECT a.id_pengaduan,a.surat_laporan,a.upd_rec,a.judul,a.surat_laporan,a.lokasi,a.status_laporan,a.kecamatan,a.lampiran,c.kecamatan,a.grup_laporan,b.deskripsi,a.aktif
			FROM  pu_master_alamat c RIGHT OUTER JOIN pu_pengaduan_berkas a
			ON a.kecamatan=c.id_alamat LEFT OUTER JOIN  pu_pengaduan_grup b
			ON b.id_grup_pengaduan=a.grup_laporan  where (c.kecamatan like '$cari' or judul like '$cari') 
			ORDER BY a.upd_rec DESC limit 50");
		$qry_ttl	= $db->select("select COUNT(1) FROM pu_master_alamat c RIGHT OUTER JOIN pu_pengaduan_berkas a ON a.kecamatan=c.id_alamat  where (c.kecamatan like '$cari' or judul like '$cari')");
	} else {
		$cek_list_data = mysql_query("
		SELECT a.id_pengaduan,a.surat_laporan,a.upd_rec,a.judul,a.surat_laporan,a.lokasi,a.status_laporan,a.kecamatan,a.lampiran,c.kecamatan,a.grup_laporan,b.deskripsi,a.aktif
		FROM  pu_master_alamat c RIGHT OUTER JOIN pu_pengaduan_berkas a
		ON a.kecamatan=c.id_alamat LEFT OUTER JOIN  pu_pengaduan_grup b
		ON b.id_grup_pengaduan=a.grup_laporan where b.id_grup_pengaduan ='$content_dtl'	and (c.kecamatan like '$cari' or judul like '$cari')
		ORDER BY a.upd_rec DESC  limit 50");
		$qry_ttl	= $db->select("select COUNT(1) FROM pu_master_alamat c RIGHT OUTER JOIN pu_pengaduan_berkas a ON a.kecamatan=c.id_alamat  where a.grup_laporan='$content_dtl' and (c.kecamatan like '$cari' or judul like '$cari')");
	}
	/*
	echo "<table id='ajax_td'><thead>";
	$hasilnya = count($qry_ttl);
	if($hasilnya[0]>8){	
		$header =  "<tr><td class='td_hdr wx10'>No</td><td class='td_hdr wx75'>Tanggal</td><td class='td_hdr wx100'>Sumber</td><td class='td_hdr' style='width:auto'>Laporan</td><td class='td_hdr wx150'>Lokasi</td><td class='td_hdr wx100'>Kecamatan</td><td class='td_hdr wx90'>Status</td></tr>";
	}else{
		$header = "<tr><td class='td_hdr wx10'>No</td><td class='td_hdr wx75'>Tanggal</td><td class='td_hdr wx100'>Sumber</td><td class='td_hdr' style='width:auto'>Laporan</td><td class='td_hdr wx150'>Lokasi</td><td class='td_hdr wx100'>Kecamatan</td><td class='td_hdr wx75'>Status</td></tr>";	
	}
	echo $header;
	echo "</thead>";
	echo "<tr><td colspan='8' style='padding:0;margin:0;' ><div style='height:400px;overflow:auto;'><table>";
	echo "<tr class='trx'><td class='trx wx10'></td><td class='wx75'></td><td class='wx100'></td><td class='' style='width:auto'></td><td class='wx150'></td><td class='wx100'></td><td class='wx75'></td></tr>";
	$no=1;
	*/

	echo "<table>";
	echo "<tr><td class='td_hdr wx10 show_td'>No</td><td class='td_hdr wx75 show_td'>Tanggal</td><td class='td_hdr wx100'>Sumber</td><td class='td_hdr w30'>Laporan</td><td class='td_hdr show_td'>Lokasi</td><td class='td_hdr'>Kecamatan</td><td class='td_hdr w10'>Status</td><td class='td_hdr w10'>Action</td></tr>";
	$no = 1;
	if (count($cek_list_data) == 0) {
		echo "<tr><td colspan='8'>data $_GET[search] tidak ditemukan<table>";
	} else {
		# &dtl1=17133-20ae7e1e-143ac-897e0aeae&dtl2=WEB/3/V/16

		while ($hsl_list_data = mysql_fetch_array($cek_list_data)) {
			$format_tgl = substr($hsl_list_data['upd_rec'], 8, 2) . "." . substr($hsl_list_data['upd_rec'], 5, 2) . "." . substr($hsl_list_data['upd_rec'], 2, 2);
			if (empty($hsl_list_data['lampiran'])) {
				$class_lampiran = "";
			} else {
				$class_lampiran = "style='color:#006ab4'";
			}
			$get_id 		= pecah_id(substr($hsl_list_data['id_pengaduan'], 0, 17));
			$get_url = $Redirected . "&dtl1=" . $get_id . "&dtl2=" . $hsl_list_data['surat_laporan'];
			$status_laporan = $hsl_list_data['status_laporan'];
			$stats_lapor 	= cek_progress($hsl_list_data['id_pengaduan']);
			if (empty($stats_lapor) || $stats_lapor == 0) {
				$status_laporan = $hsl_list_data['status_laporan'];
				$proses = "<a href='$Redirected&action=proses&data_dtl=$get_id' class='button2 notif_info2'>Proses</a>";
			} else {
				if ($stats_lapor <> '100%') {
					$status_laporan = $hsl_list_data['status_laporan'] . " " . $stats_lapor;
					$proses = "<a href='$Redirected&action=proses&data_dtl=$get_id' class='button3 notif_info2'>Proses</a>";
				} else {
					$status_laporan = $hsl_list_data['status_laporan'];
					$proses = "<a href='$Redirected&action=proses&data_dtl=$get_id' class='button4 notif_info2' style='padding:3px 8px;' >Lihat</a>";
				}
			}
			if ($hsl_list_data['aktif'] == "X") {
				$status_laporan =  $status_laporan;
				$proses = "<a href='$Redirected&action=proses&data_dtl=$get_id' class='button5 notif_info2'>Proses</a>";
			} else {
				$status_laporan = $status_laporan;
				$proses = $proses;
			}
			#href='$Redirected&laporan_dtl=$hsl_list_data[id_pengaduan]'
			echo "<tr class='tr'><td class='right show_td'>$no</td><td class='show_td'>" . $format_tgl . "</td><td><a href='$get_url' class='no_surat' $class_lampiran >$hsl_list_data[surat_laporan]</a></td><td>$hsl_list_data[judul]</td><td class='show_td'>$hsl_list_data[lokasi]</td><td>$hsl_list_data[kecamatan]</td><td>$status_laporan</td><td >$proses</td></tr>";
			$no++;
		}
		/*
		while($hsl_list_data = mysql_fetch_array($cek_list_data)){
			$format_tgl = substr($hsl_list_data['upd_rec'],8,2)."-".substr($hsl_list_data['upd_rec'],5,2)."-".substr($hsl_list_data['upd_rec'],0,4);
			if(empty($hsl_list_data['status_laporan'])){
				$status_laporan = "Belum diperbaiki";
			}else{
				$status_laporan = $hsl_list_data['status_laporan'];
			}
			if(empty($hsl_list_data['lampiran'])){
				$class_lampiran = "";
				$get_dtl_it = $hsl_list_data['id_pengaduan'];
			}else{
				$class_lampiran = "style='color:#006ab4'";	
				$get_dtl_it = "XX".$hsl_list_data['id_pengaduan'];		
			}
			#href='$Redirected&laporan_dtl=$hsl_list_data[id_pengaduan]'
			echo "<tr><td class='right'>$no</td><td>".$format_tgl."</td><td><a href='#' class='no_surat' id='$get_dtl_it' $class_lampiran >$hsl_list_data[surat_laporan]</a></td><td>$hsl_list_data[judul]</td><td>$hsl_list_data[lokasi]</td><td>$hsl_list_data[kecamatan]</td><td>$status_laporan</td></tr>";
		$no++;
		}
		*/
	}
	echo "</table></div></td></tr>";
	echo "</table>";
}
if (isset($_GET["search_org"])) {
	$Redirected = "?halaman=str_organ";
	$pecah = explode(' ', $_GET['search_org']);
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
	$query_stru = "SELECT a.*,b.jabatan FROM pu_stru_organ_dtl a LEFT OUTER JOIN pu_stru_organ_hdr b ON a.id_jabatan_dtl=b.id_jabatan WHERE CONCAT(a.nama,' ',b.jabatan) LIKE '" . $cari . "' and aktif='Y' ORDER BY upd_rec_dtl DESC";
	$cek_list_data = mysql_query($query_stru);
	echo "<table>";
	echo "<tr><td class='td_hdr'>No</td><td class='td_hdr'>Tgl</td><td class='td_hdr'>Jabatan</td><td class='td_hdr'>Nama</td><td class='td_hdr wx60'>Action</td></tr>";
	$x = 1;
	while ($hsl_list_data = mysql_fetch_array($cek_list_data)) {
		$format_tgl = substr($hsl_list_data['upd_rec_dtl'], 8, 2) . "." . substr($hsl_list_data['upd_rec_dtl'], 5, 2) . "." . substr($hsl_list_data['upd_rec_dtl'], 2, 2);
		$style_aktif = "style='color:#006ab4;'";
		$url_action = "<a href='$Redirected&action=edit_struktur&data_dtl=$hsl_list_data[0]' class='edit'/> <a href='$Redirected&action=delete_struktur&data_dtl=$hsl_list_data[0]' class='delete'/>";
		echo "<tr class='tr'><td class='right'  $style_aktif>$x</td><td class='right'  $style_aktif>" . $format_tgl . "</td><td  $style_aktif>" . $hsl_list_data['jabatan'] . "</td><td $style_aktif>" . $hsl_list_data['nama'] . "</td><td>$url_action</td></tr>";
		$x++;
	}
	echo "</table>";
}
if (isset($_GET["search_satgas"])) {
	$Redirected = "?halaman=str_satgas";
	$pecah = explode(' ', $_GET['search_satgas']);
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
	$query_stru = "SELECT a.*,b.kecamatan FROM
					pu_stru_organ_dtl a LEFT OUTER JOIN pu_master_alamat b 
					ON a.id_jabatan_dtl=b.id_alamat  
					WHERE a.aktif='satgas'
					and CONCAT(a.nama,' ',b.kecamatan) LIKE '" . $cari . "'
					ORDER BY upd_rec_dtl DESC";
	echo "<table>";
	$hdr_table2 = "<tr><td class='td_hdr'>No</td><td class='td_hdr'>Tgl</td><td class='td_hdr'>Wilayah</td><td class='td_hdr'>Nama</td><td class='td_hdr show_td'>Nip</td><td class='td_hdr show_td'>Telp</td><td class='td_hdr wx60'>Action</td></tr>";
	$cek_list_data = mysql_query($query_stru);
	echo $hdr_table2;
	$x = 1;
	while ($hsl_list_data = mysql_fetch_array($cek_list_data)) {
		$format_tgl = substr($hsl_list_data['upd_rec_dtl'], 8, 2) . "." . substr($hsl_list_data['upd_rec_dtl'], 5, 2) . "." . substr($hsl_list_data['upd_rec_dtl'], 2, 2);
		$style_aktif = "style='color:#006ab4;'";
		$url_action = "<a href='$Redirected&action=edit_struktur&data_dtl=$hsl_list_data[0]' class='edit'/> <a href='$Redirected&action=delete_struktur&data_dtl=$hsl_list_data[0]' class='delete'/>";
		echo "<tr class='tr'><td class='right'  $style_aktif>$x</td><td class='right'  $style_aktif>" . $format_tgl . "</td><td  $style_aktif>" . $hsl_list_data['kecamatan'] . "</td><td $style_aktif>" . $hsl_list_data['nama'] . "</td><td $style_aktif class='show_td'>" . $hsl_list_data['nip'] . "</td><td $style_aktif class='show_td'>" . $hsl_list_data['telp'] . "</td><td>$url_action</td></tr>";
		$x++;
	}
	echo "</table>";
}
