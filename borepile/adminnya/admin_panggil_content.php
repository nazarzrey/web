<?php
$page = "halaman";
$path_img = "../galeri/";
$get_page = "?" . $page;
$adeliaabizar = "AZAF";
if (!isset($_GET[$page])) {
	if ($Ms_grup != "admin" and $Ms_grup != "user") {
		echo '<script language="javascript">';
		echo 'window.location.href="?halaman=laporan&lap_dtl=all";';
		echo '</script>';
	} else {
		$call_content_info 	= "Pesan Masuk";
		$call_content = "halaman/inbox_web.php";
	}
} else {
	$panggil = escape($_GET[$page]);
	if ($panggil == "home" or $panggil == "") {
		if ($Ms_grup != "admin" and $Ms_grup != "user") {
			echo '<script language="javascript">';
			echo 'window.location.href="?halaman=laporan&lap_dtl=all";';
			echo '</script>';
		} else {
			$call_content_info 	= "Pesan Masuk";
			$call_content = "halaman/inbox_web.php";
		}
	} elseif ($panggil == "laporan") {
		if (!isset($_GET["lap_dtl"])) {
			$page_content		= "all";
			$call_content_info 	= "Laporan Pemeliharaan All";
			$content_dtl		= "all";
			$call_content 		= "halaman/list_pemeliharaan.php";
		} else {
			if (!isset($content_dtl)) {
				$page_content		= "";
				$call_content_info 	= "Halaman tidak tersedia";
				$content_dtl		= "";
				$call_content 		= "";
			}
			if ($_GET["lap_dtl"] == "all") {
				$page_content		= "all";
				$call_content_info 	= "Laporan Pemeliharaan All";
				$content_dtl		= "all";
				$call_content 		= "halaman/list_pemeliharaan.php";
			}
			$cek_grup = $db->select("select id_grup,deskripsi from master_grup where aktif in ('Y','X')  order by id_show");
			foreach ($cek_grup as $key => $hsl_cek_grup) {
				if ($_GET["lap_dtl"] == $hsl_cek_grup[0]) {
					$page_content		= $hsl_cek_grup[0];
					$call_content_info 	= "Laporan Pemeliharaan " . ucwords($hsl_cek_grup[0]["deskripsi"]);
					$content_dtl		= $hsl_cek_grup[0];
					$call_content 		= "halaman/list_pemeliharaan.php";
				}
			}
		}
	} elseif ($panggil == "content") {
		if (!isset($_GET["dtl_cnt"])) {
			$page_content		= "all";
			$call_content_info 	= "Semua Berita";
			$content_dtl		= "all";
			$call_content 		= "halaman/form_content.php";
		} else {
			if (!isset($content_dtl)) {
				$page_content		= "";
				$call_content_info 	= "Halaman tidak tersedia";
				$content_dtl		= "";
				$call_content 		= "";
			}
			$cek_grup = $db->select("select id_hdr_content,deskripsi from content_hdr order by urut");
			foreach ($cek_grup as $key => $hsl_cek_grup) {
				$panggil_content = strtolower(str_replace(' ', '-', $hsl_cek_grup["deskripsi"]));
				if ($_GET["dtl_cnt"] == $panggil_content) {
					require_once "hak_page2.php";
					$page_content		= $panggil_content;
					$call_content_info 	= "Content " . ucwords($hsl_cek_grup["deskripsi"]);
					$content_dtl		= $panggil_content;
					$call_content 		= "halaman/form_content.php";
					$id_jenis			= $hsl_cek_grup["deskripsi"];
				}
				#echo '<li><a href="?halaman=content&dtl_cnt='.strtolower(str_replace(' ','-',$hsl_cek_grup[1])).'">'.ucwords($hsl_cek_grup[1]).'</a></li>';
			}
		}
	}
	#start other contetn here
	elseif ($panggil == "pesan_kontak") {
		$page_include = "hak_page2.php";
		$page_content		= $panggil;
		$call_content_info 	= "Pesan Masuk";
		$call_content 		= "halaman/inbox_web.php";
	} elseif ($panggil == "about") {
		$page_include =  "hak_page.php";
		$page_content		= $panggil;
		$content_hdr		= "about_us";
		$call_content_info 	= "Manage Halaman Tentang Kami";
		$call_content 		= "halaman/manage_content_hdr.php";
	} elseif ($panggil == "workshop") {
		$page_include =  "hak_page.php";
		$page_content		= $panggil;
		$content_hdr		= "workshop";
		$call_content_info 	= "Manage Halaman Workshop";
		$call_content 		= "halaman/manage_content_hdr.php";
	} elseif ($panggil == "hal_utama") {
		$page_include =  "hak_page.php";
		$page_content		= $panggil;
		$content_hdr		= "introduce";
		$call_content_info 	= "Halaman Utama";
		$call_content 		= "halaman/manage_content_hdr.php";
	} elseif ($panggil == "contact") {
		$page_include =  "hak_page.php";
		$page_content		= $panggil;
		$content_hdr		= "contact_us";
		$call_content_info 	= "Manage Halaman Kontak";
		$call_content 		= "halaman/manage_content_hdr.php";
	} elseif ($panggil == "manage_produk") {
		$page_include =  "hak_page.php";
		$page_content		= $panggil;
		$call_content_info 	= "Tambah, edit, nonaktif grup Produk";
		$call_content 		= "halaman/manage_produk.php";
	} elseif ($panggil == "manage_building") {
		$page_include =  "hak_page.php";
		$page_content		= $panggil;
		$call_content_info 	= "Tambah, edit, nonaktif grup Proyek";
		$call_content 		= "halaman/manage_building.php";
	} elseif ($panggil == "manage_proyek") {
		$page_include =  "hak_page.php";
		$page_content		= $panggil;
		$call_content_info 	= "Manage Proyek (Tambah/Edit/Hapus)";
		$call_content 		= "halaman/manage_proyek.php";
	} elseif ($panggil == "user_add") {
		$page_include =  "hak_page.php";
		$page_content		= $panggil;
		$call_content_info 	= "Tambah, edit, Hapus User";
		$call_content 		= "halaman/manage_user.php";
	} elseif ($panggil == "profile_manager") {
		$page_content		= $panggil;
		$call_content_info 	= "Manage Profile";
		$call_content 		= "halaman/manage_profile.php";
	} elseif ($panggil == "profile_web") {
		$page_include =  "hak_page.php";
		$page_content		= $panggil;
		$call_content_info 	= "Manage Web Gambar, Text Utama, Alamat";
		$call_content 		= "halaman/manage_web_profile.php";
	} elseif ($panggil == "footer_contact") {
		$page_include =  "hak_page.php";
		$page_content		= $panggil;
		$call_content_info 	= "Manage kontak di footer";
		$call_content 		= "halaman/manage_kontak.php";
	} elseif ($panggil == "keywords") {
		$page_include =  "hak_page.php";
		$page_content		= $panggil;
		$call_content_info 	= "Manage kata kunci";
		$call_content 		= "halaman/input_tags.php";
	} elseif ($panggil == "keluar") {
		$call_content_info = "Sedang logout halaman....";
		$jam = date("Y-m-d H:i:s");
		$db->query("update user_log set logout='$jam' where sesi='$_SESSION[key]'");
		if (isset($_SESSION)) {
			if (isset($_SESSION['key'])) {
				unset($_SESSION['key']);
			}
			session_destroy();
		} else {
			if (isset($_SESSION['key'])) {
				unset($_SESSION['key']);
			}
		}
		echo '<script language="javascript">';
		echo 'window.location.href="index.php";';
		echo '</script>';
		$call_content 		= "X";
	} else {
		$call_content_info 	= "Halaman belum tersedia";
		$call_content 		= "belum_rede.php";
	}
	if (isset($_GET["dtl_data"])) {
	} else {
	}

}
if (file_exists($call_content)) {
	$calling_content 		= $call_content;
} else {
	if ($call_content != "X") {
		$calling_content 		= "404.php";
	} else {
		$calling_content 		= "";
	}
}
#echo $calling_content.$call_content.$panggil;
if (isset($call_content_info)) {
	$calling_content_info 	= ucwords($call_content_info);
} else {
	$calling_content_info 	= "Halaman belum tersedia";
}
