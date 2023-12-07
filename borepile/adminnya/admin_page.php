<?php
if (!isset($_SESSION)) {
	session_start();
	if (!isset($_SESSION['key'])) {
		echo '<script language="javascript">';
		echo 'window.location.href="index.php";';
		echo '</script>';
		die;
	}
	require_once "../seting/config_db.php";
	require_once "../seting/config_web.php";
	require_once "../seting/function_web.php";
	$db = new Db();
}
$Ms_name 			= $_SESSION['nama'];
$Ms_grup 			= $_SESSION['grup'];
$Ms_telp 			= $_SESSION['telp'];
$Ms_id   			= $_SESSION['user_id'];
$path_img_default 	= "../gambar/";
$path 				= "../galeri/";
$tgl_jam			= date("Y-m-d H:i:s");
function ready_profile($field)
{
	global $Ms_id, $db;
	$cek_data = "select deskripsi from profile_web where jenis='$field'";
	$hsl_data = $db->select($cek_data);
	return $hsl_data[0]["deskripsi"];
}
function user_previlage()
{
	global $Ms_grup;
	if ($Ms_grup != "admin") {
		$add_class = " hide_content ";
	} else {
		$add_class = "";
	}
	return $add_class;
}
function user_previlage2()
{
	global $Ms_grup;
	if ($Ms_grup != "admin" and $Ms_grup != "user") {
		$add_class = " hide_content ";
	} else {
		$add_class = "";
	}
	return $add_class;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />
	<link href="../gaya/dialog.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="../gaya/default.css" rel="stylesheet" type="text/css">
	<link href="../gaya/menu.css" rel="stylesheet" type="text/css">
	<link href="../gaya/content.css" rel="stylesheet" type="text/css">
	<link href="../gaya/modal.css" rel="stylesheet" type="text/css">
	<link href="../gaya/jquery-ui.css" rel="stylesheet" type="text/css">

	<script type="text/javascript" src="../skrip/dialog.js"></script>
	<script type="text/javascript" src="../skrip/ddaccordion.js"></script>
	<script type="text/javascript" src="../skrip/jquery.min.js"></script>
	<script type="text/javascript" src="../skrip/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../skrip/autosize.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#refresh").click(function() {
				var request_uri = location.pathname + location.search;
				window.location.href = request_uri;
			})
			/*
			var tinggi = window.innerHeight;
			$("#container").css("height", tinggi+"px"); */
			autosize(document.querySelectorAll('textarea'));
			$('#menu_admin').click(function() {
				var ada = $('#menu_accordion_admin').is(':hover');
				if (ada == false) {
					$("#menu_accordion_admin").hide("slide", {
						direction: "left"
					}, "fast");
					$('#menu_admin').fadeOut();
				}
			});

			$("#menu_mobile_admin").click(function() {
				$("#menu_admin").fadeIn();
				$("#menu_accordion_admin").show("slide", {
					direction: "left"
				}, "fast");
			});
			$("#closed").click(function() {
				$("#menu_accordion_admin").hide("slide", {
					direction: "left"
				}, "fast");
				$('#menu_admin').fadeOut();
			});
			/*loading gif*/
			var w_screen = window.innerWidth;
			var tinggi = window.innerHeight;
			var rumus_tinggi = ((tinggi - 150) / 2)
			$("#tinggi").val(tinggi);
			$("#lebar").val(w_screen);
			$("#kira").val(rumus_tinggi);
			$(".list_galery_dtl").css("margin-top", rumus_tinggi + "px");
		})
		$(window).resize(function() {
			var w_screen = window.innerWidth;
			if (w_screen > 1000) {
				$("#menu_accordion_admin").show();
				$('#menu_admin').show();
			}
		})
	</script>
	<script type="text/javascript" src="../skrip/content.js"></script>
	<title>CV.MITRA KARYA MANDIRI, Kontraktor Bored Pile, Bore pile, straus pile</title>
</head>

<body onload="buatjam()">
	<div id="container" style="background:#f9f9f9;">
		<div style="background:#006ab4;height:5px;box-shadow:1px 1px 5px #ccc;">
		</div>
		<div id="header" style="margin:0;">
			<div id="logo">
				<div id="profile_img">
					<img src="<?= $path_img_default . ready_profile("icon"); ?>" class="logo_img">
				</div>
				<div id="profile_text">
					<div class="tridi">
						<?= ready_profile("profile1"); ?><br />
						<?= ready_profile("profile2"); ?><br />
						<?= ready_profile("profile3"); ?><br />
						<?= ready_profile("profile4"); ?>
					</div>
				</div>
			</div>
			<div id="profile_menu">
				<ul>
					<li id="jam" style='padding:3px 5px'></li>
					<li><a class="active" href="?halaman=keluar">Logout <?= $Ms_name; ?></a></li>
				</ul>
			</div>
		</div>
		<div class="menu_mobile">
			<img src="../gambar/menu.png" height="40px" id="menu_mobile_admin" style="position:absolute;right:10px;top:10px;cursor:pointer;">
		</div>
		<div id="content" style="background:#f9f9f9;height:auto;min-height:auto;">
			<div id="menu_admin">
				<div id="menu_accordion_admin">
					<span class="closed1" id="closed">X</span>
					<div style="background-color:#006ab4;color:#f1f1f1;padding:11px;text-align:right;border-bottom:solid 5px;"><b style='margin-right:30px;'>Group : <?= $Ms_grup; ?></b></div>
					<div class="arrowlistmenu">
						<div class="menucenter expandable <?= user_previlage(); ?>">Home</div>
						<ul class="categoryitems">
							<li><a href="?halaman=pesan_kontak">Pesan Menu Kontak</a></li>
						</ul>
						<div class="menucenter expandable">Produk & Proyek</div>
						<ul class="categoryitems">
							<li><a href="?halaman=manage_building">Manage Building Name</a></li>
							<li><a href="?halaman=manage_produk">Manage Produk</a></li>
							<li><a href="?halaman=manage_proyek">Manage Proyek</a></li>
						</ul>
						<div class="menucenter expandable">Konten</div>
						<ul class="categoryitems">
							<?php
							$cek_grup = $db->select("select id_hdr_content,deskripsi from content_hdr order by urut");
							foreach ($cek_grup as $key => $hsl_cek_grup) {
								echo '<li class="' . user_previlage2() . '"><a href="?halaman=content&dtl_cnt=' . strtolower(str_replace(' ', '-', $hsl_cek_grup["deskripsi"])) . '">' . ucwords($hsl_cek_grup["deskripsi"]) . '</a></li>';
							}
							?>
							<li><a href="?halaman=content">Semua Content</a></li>
						</ul>
						<div class="menucenter expandable <?= user_previlage(); ?>">Menu</div>
						<ul class="categoryitems">
							<!--<li><a href="?halaman=konurai">Kondisi & Uraian</a></li> -->
							<li><a href="?halaman=hal_utama">Info Halaman Utama</a></li>
							<li><a href="?halaman=about">Tentang Kami</a></li>
							<li><a href="?halaman=workshop">Workshop</a></li>
							<li><a href="?halaman=contact">Kontak</a></li>
						</ul>
						<div class="menucenter expandable">Setting</div>
						<ul class="categoryitems">
							<li class="<?= user_previlage(); ?>"><a href="?halaman=user_add">Manage User</a></li>
							<li><a href="?halaman=profile_manager">Profile</a></li>
							<li class="<?= user_previlage(); ?>"><a href="?halaman=profile_web">Profile Web</a></li>
							<li class="<?= user_previlage(); ?>"><a href="?halaman=footer_contact">Kontak footer</a></li>
							<li class="<?= user_previlage(); ?>"><a href="?halaman=keywords">Kata Kunci </a></li>
							<li class="<?= user_previlage(); ?>"><a href="?halaman=footer_contact">Google Deskripsi</a></li>
						</ul>
						<a href="?halaman=petunjuk">
							<div class="menucenter"> Petunjuk web</div>
						</a>
						<a href="?halaman=keluar">
							<div class="menucenter out_user"> Logout <?= $Ms_name; ?></div>
						</a>
						<div style="padding:5px;color:#ccc;padding-bottom:10px;overflow:auto">
							<h3 style="padding:0;margin:0">Total Status Laporan</h3>
							<?php
							require_once "halaman/live_status.php";
							?>
						</div>
					</div>
				</div>
			</div>
			<div id="content_dtl" style="margin:0;overflow:auto;background:#f9f9f9;">
				<?php
				require_once "admin_panggil_content.php";
				/*
			if(isset($_GET["page"])){
				if($_GET["page"]!="home" and $_GET["page"]!=""){
				?>
				<div class="content_dtl_info">
					<?= $calling_content_info;?>
				</div>
				<?php 
				}
			}
			*/
				?>
				<div class="content_dtl_info_admin">
					<div style="padding:10px">
						<?= $calling_content_info; ?>
					</div>
				</div>
				<div class="content_dtl_admin">
					<div style="padding:5px">
						<?php
						#echo $calling_content." - ".$call_content;
						require_once $calling_content;
						?>
					</div>
				</div>
				<p />
			</div>
		</div>
	</div>
	<div id="footer">
		<div>
</body>

</html>