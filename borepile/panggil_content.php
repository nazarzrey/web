<?php

#$page = "halaman";
$path_img1 = "galeri/";
$path_img2 = "gambar/";
$get_page = "?" . $page;
$adeliaabizar = "AZAF";
if (!isset($_GET[$page])) {
	$call_content = "halaman/content_utama.php";
} else {
	$panggil = trim(htmlentities($db->escape($_GET[$page])));
	#echo $panggil;
	if ($panggil == "home" or strlen($panggil) == 0) {
		$page_content		= "home";
		$content_dtl		= "";
		$call_content_info 	= "Home";
		$call_content 		= "halaman/content_utama.php";
	} elseif ($panggil == "produk") {
		if (!isset($_GET["prod_dtl"])) {
			$page_content		= "all";
			$call_content_info 	= "Semua Produk";
			$content_dtl		= "all";
			$call_content 		= "halaman/produk_list.php";
		} else {
			if (!isset($content_dtl)) {
				$page_content		= "";
				$call_content_info 	= "Halaman tidak tersedia";
				$content_dtl		= "";
				$call_content 		= "";
			}
			if (strlen($_GET["prod_dtl"]) == 0) {
				$page_content		= "all";
				$call_content_info 	= "Semua Produk";
				$content_dtl		= "all";
				$call_content 		= "halaman/produk_list.php";
			}
			$cek_grup = $db->select("SELECT url_grup,deskripsi FROM master_grup WHERE aktif IN ('Y','X') AND grup='produk'");
			foreach ($cek_grup as $hsl_cek_grup) {
				if ($_GET["prod_dtl"] == $hsl_cek_grup['url_grup']) {
					$page_content		= $hsl_cek_grup['url_grup'];
					$call_content_info 	= "produk - " . ucwords($hsl_cek_grup['deskripsi']);
					$content_dtl		= $hsl_cek_grup['url_grup'];
					$call_content 		= "halaman/produk_list.php";
				}
			}
		}
	} elseif ($panggil == "proyek") {
		if (isset($_GET["proy_dtl"])) {
			$get_dtl = escape($_GET['proy_dtl']);
			$sintak = "SELECT  url_dtl,nama_proyek,detail_proyek,tahun,lokasi,id_dtl_img,galeri FROM proyek where url_dtl='$get_dtl'";
			$cek_grup = $db->select($sintak);
			foreach ($cek_grup as $hsl_cek_grup) {
				if ($_GET["proy_dtl"] == $hsl_cek_grup['url_dtl']) {
					$page_content		= $hsl_cek_grup['url_dtl'];
					$call_content_info 	= "Proyek - " . ucwords($hsl_cek_grup['nama_proyek']);
					$content_dtl		= $hsl_cek_grup['url_dtl'];
				}
			}
			$call_content 		= "halaman/proyek_list.php";
		} elseif (isset($_GET["proy_grup"])) {
			$page_content		= "all";
			$call_content_info 	= "Proyek - " . ucwords(str_replace("-", " ", $_GET["proy_grup"]));
			$content_dtl		= "all";
			$call_content 		= "halaman/proyek_list.php";
		} else {
			$page_content		= "all";
			$call_content_info 	= "Semua Proyek";
			$content_dtl		= "all";
			$call_content 		= "halaman/proyek_list.php";
		}
	} elseif ($panggil == "kontak") {
		$page_content		= $panggil;
		$call_content_info 	= "Kontak Kami";
		$call_content 		= "halaman/kontak_page.php";
	} elseif ($panggil == "about") {
		$page_content		= $panggil;
		$call_content_info 	= "Tentang Kami";
		$call_content 		= "halaman/about.php";
	} elseif ($panggil == "news") {
		$page_content		= "news";
		$call_content_info 	= "Konten Info";
		$call_content 		= "halaman/content_data.php";
	} elseif ($panggil == "workshop") {
		$page_content		= $panggil;
		$call_content_info 	= "Workshop";
		$call_content 		= "halaman/workshop_page.php";
	} elseif ($panggil == "gal_vid") {
		$page_content		= $panggil;
		$call_content_info 	= "Workshop";
		$call_content 		= "halaman/galery_page.php";
	} elseif ($panggil == "gal_img") {
		$page_content		= $panggil;
		$call_content_info 	= "Workshop";
		$call_content 		= "halaman/galery_page.php";
	} elseif ($panggil == "search") {
		$page_content		= $panggil;
		if (!isset($_GET["label"])) {
			$call_content_info 	= "Konten cari";
		} else {
			$call_content_info 	= "Konten cari " . str_replace("-", " ", $_GET["label"]);
		}
		$call_content 		= "halaman/find_page.php";
	} elseif ($panggil == "admin_page") {
		$page_content		= $panggil;
		$call_content_info 	= "Administrator Page";
		echo '<script language="javascript">';
		echo 'window.location.href="adminnya/admin_page.php";';
		echo '</script>';
		die();
		#$call_content 		= "halaman/form_pengaduan.php";					
	} else {
		$page_content		= "";
		$call_content_info 	= "Halaman tidak tersedia";
		$call_content 		= "404.php";
	}
	if (isset($_GET["dtl_data"])) {
	} else {
	}
}
if (file_exists($call_content)) {
	$calling_content 		= $call_content;
} else {
	$calling_content 		= "404.php";
}
if (isset($call_content_info)) {
	#echo $call_content_info.$_GET["lap_dtl"];
	$Redirected = "produk/" . $page_content;
	#$Redirected = "?page=laporan&lap_dtl=".$page_content;
	if (isset($_GET["dtl1"]) and isset($_GET["dtl2"])) {
		$url_info = "<div style='float:left;'><a href='$Redirected'  class='more_x' >" . ucwords($call_content_info) . "</a></div><div class='data_dtl'><div class='arrow_r'></div><div style='float:left;color:#555'>" . strtoupper($_GET["dtl2"]) . "</div></div>";
		#		$url_info = "<div style='float:left;'><a href='$Redirected'>".ucwords($call_content_info)."</a></div><div class='data_dtl'><div class='arrow_r'></div><div style='float:left;color:#555'>".strtoupper($_GET["dtl2"])."</div><div class='arrow_r'></div></div>";
		$calling_content_info 	= $url_info;
	} elseif (isset($_GET["data_dtl"])) {
		if (!isset($_GET["periode"])) {
			$periode = "&periode=2016";
		} else {
			$periode = "&periode=" . $_GET["periode"];
		}
		$url_info = "<div style='float:left;'><a href='?page=daftar_kegiatan&periode=" . date("Y") . "'  class='more_x'>" . ucwords($call_content_info) . "</a></div><div class='data_dtl'><div class='arrow_r'></div><div style='float:left;color:#555'></div></div>";
		#		$url_info = "<div style='float:left;'><a href='$Redirected'>".ucwords($call_content_info)."</a></div><div class='data_dtl'><div class='arrow_r'></div><div style='float:left;color:#555'>".strtoupper($_GET["dtl2"])."</div><div class='arrow_r'></div></div>";
		$calling_content_info 	= $url_info;
	} else {
		$Redirected = "news";
		if (isset($_GET["ct"])) {
			$url_info = "<div style='float:left;'><a href='$Redirected'  class='more_x'>Konten Info</a></div><div class='data_dtl'><div class='arrow_r'></div></div>";
			#			$url_info = "<div style='float:left;'><a href='$Redirected'>Konten Berita</a></div><div class='data_dtl'><div class='arrow_r'></div><div style='float:left;color:#555'>".ucwords(str_replace('-',' ',$_GET["ct"]))."</div><div class='arrow_r'></div></div>";
			$calling_content_info 	= $url_info;
		} else {
			$calling_content_info 	= ucwords($call_content_info);
		}
	}
} else {
	$calling_content_info 	= "Halaman belum tersedia";
}
