<?php
	$path_img_default 	= "gambar/";
	$path_img   		= "galeri/";
	$page 				= "page";
	$get_page 			= "?".$page;
	$tgl_jam			= date("Y-m-d H:i:s");
	$ipnya	   			= getenv("REMOTE_ADDR");
	require_once "seting/config_db.php";	
	require_once "seting/config_web.php";	
	function ready_profile($field){
		global $Ms_id;
		$cek_data = mysql_query("select deskripsi from profile_web where jenis='$field'")or die();
		$hsl_data = mysql_fetch_array($cek_data);
		return trim($hsl_data[0]);
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />
<link href="gaya/dialog.css"  rel="stylesheet" type="text/css" media="screen"/>
<link href="gaya/default.css" rel="stylesheet" type="text/css">
<link href="gaya/menu.css" rel="stylesheet" type="text/css">
<link href="gaya/slides.css" rel="stylesheet" type="text/css">
<link href="gaya/content.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="skrip/dialog.js"></script>
<script type="text/javascript" src="skrip/ddaccordion.js"></script> 
<script type="text/javascript" src="skrip/jquery.min.js"></script>
<script type="text/javascript" src="skrip/jquery-ui.min.js"></script>
<script type="text/javascript" src="skrip/slides.min.jquery.js"></script>
<script type="text/javascript" src="skrip/jssor.js"></script>
<script type="text/javascript" src="skrip/jssor.slider.js"></script>
<script type="text/javascript" src="skrip/autosize.min.js"></script>
<script type="text/javascript" src="skrip/content.js"></script>
<script type="text/javascript" >
$(document).ready(function(){
	autosize(document.querySelectorAll('textarea'));
	/**/
	$('#menu').click(function() {
		var ada = $('#menu_mobile_hdr').is(':hover');
		if(ada==false){
			$("#menu_mobile_hdr").hide("slide", { direction: "left" }, "fast");
			$('#menu').fadeOut();
		}	
	});
	$("#menu_mobile").click(function(){
		$("#menu").fadeIn();
		$("#menu_mobile_hdr").show("slide", { direction: "left" }, "fast");
	});
	$("#closed").click(function(){ 
		$("#menu_mobile_hdr").hide("slide", { direction: "left" }, "fast");
		$('#menu').fadeOut();
	});
	var w_screen = window.innerWidth;
	var tinggi = document.documentElement.scrollHeight;
	if(w_screen<=1000){
		$("#menu").css('height',tinggi+'px');
		$("#menu_mobile_hdr ul li ").click(function(e){
			if($(this).has('ul')){
			  $('.dropdown').removeClass('dropdown').hide();
			}
			$(this).find('ul').addClass('dropdown').show();
		})	
	}
	$("#refresh").click(function(){	
		var request_uri = location.pathname + location.search;
		window.location.href=request_uri;
	})
})
$(window).resize(function() {
	var w_screen = window.innerWidth;
	var tinggi = document.documentElement.scrollHeight;
	if(w_screen>1000){
		$("#menu").css('height','auto');
		$("#menu_mobile_hdr").show();
		$('#menu').show();
		/*admin*/		
	}else{
		$("#menu").css('height',tinggi+'px');
		$("#menu_mobile_hdr ul li ").click(function(e){
			if($(this).has('ul')){
			  $('.dropdown').removeClass('dropdown').hide();
			}
			$(this).find('ul').addClass('dropdown').show();
		})			
	}
})
$(function() {
	$( "#tabs" ).tabs();
	$( "#tabs_thn" ).tabs();	
	$( "#tabs_bln" ).tabs();	
});
</script>
<title>Sistem informasi Pemeliharaan jalan dan jembatan dinas bina marga dan sumber daya air kota depok</title>
<style>

</style>
</head>
<body onload="buatjam()">
<div id="container">
	<div  style="background:#006ab4;height:5px;box-shadow:1px 1px 5px #ccc;" >
	</div>
	<div id="header">
		<div id="logo">
			<div id="profile_img" >
				<img src="<?php echo $path_img_default.ready_profile("icon"); ?>"  class="logo_img">
			</div>
			<div id="profile_text">
	            <div class="tridi">
	            	<?php echo ready_profile("profile1"); ?><br/>
	                <?php echo ready_profile("profile2"); ?><br/>
	                <?php echo ready_profile("profile3"); ?><br/>
	                <?php echo ready_profile("profile4"); ?>
				</div>
			</div>
		</div>
		<div id="profile_menu">
			<ul>
			  <li><a href="?page=news">News</a></li>
			  <li><a href="?page=kontak">Kontak</a></li>
			  <!--<li><a href="?page=contact">About</a></li> -->
			  <li><a  href="?page=admin_page"  class="active">Login</a></li>
			</ul>
		</div>
		<div class="menu_mobile">
			<img src="gambar/menu.png" height="35px" id="menu_mobile" style="position:absolute;right:5px;top:5px;cursor:pointer;">
		</div>
	</div>
	<div id="menu" >
		<div id="menu_mobile_hdr">
			<span class="closed1" id="closed">X</span>
			<ul>	 
				<li class="li_add">&nbsp;</li>
				<li class="menu_mbl">
					<a ><img src="<?php echo $path_img_default.ready_profile("icon"); ?>" width="37px;" height="48px" style="float:left;">
					<div  style="margin:-2px 0px -3px 40px;font-weight:bold;font-size:12px;">
	            	<?php echo ready_profile("profile1"); ?><br/>
	                <?php echo ready_profile("profile3"); ?>
					</div></a>
				</li>
				<li><a href="?page=home">Home</a></li>
				<li><a href="#">Laporan Pemeliharaan</a>
					<ul class="dropdown">
						<?php
						$cek_grup = mysql_query("select id_grup_pengaduan,deskripsi from pu_pengaduan_grup where aktif in ('Y','X') order by id_show")or die();
						while($hsl_cek_grup = mysql_fetch_array($cek_grup)){
							echo '<li><a href="?page=laporan&lap_dtl='.$hsl_cek_grup[0].'">'.ucwords($hsl_cek_grup[1]).'</a></li>';
						}
						?>
						<li><a href="?page=laporan&lap_dtl=all">Semua Laporan</a></li>
					</ul>
				</li>
				<li><a href="#">Grafik Permintaan</a>
					<ul class="dropdown">
						<li><a href="?page=g_bulan">Grafik Bulanan</a></li>
						<li><a href="?page=g_tahun">Grafik Tahunan</a></li>
					</ul>
				</li>			
				<li><a href="#">Kegiatan Fisik</a>
					<?php
						$cek_proses_pengaduan = mysql_query("SELECT DISTINCT DATE_FORMAT(upd_rec,'%Y') AS periode FROM pu_pengaduan_proses order by 1 desc")or die(mysql_error());
						if(mysql_num_rows($cek_proses_pengaduan)!=0){
							echo '<ul class="dropdown">';
								while($hsl_proses_pengaduan = mysql_fetch_array($cek_proses_pengaduan)){
									echo '<li><a href="?page=daftar_kegiatan&periode='.$hsl_proses_pengaduan[0].'">Daftar Kegiatan Fisik (TA '.$hsl_proses_pengaduan[0].')</a></li>';
								}
							echo '</ul>';
						}else{
							echo '<ul class="dropdown">';
								echo '<li><a href="#">Belum ada kegiatan</a></li>';
							echo '</ul>';						
						}
					?>
				</li>		
				<li><a href="?page=formulir_laporan">Formulir Laporan</a></li>	
				<li style="border:none;"><a href="#" >About</a>	
					<ul class="dropdown">
						<li><a href="?page=stru_organ">Struktur Organisasi</a></li>
						<li><a href="?page=visimisi">Visi Misi</a></li>
					</ul>
				</li>
				<div class="menu_mobile">
					<li><a href="?page=news">News</a></li>
					<li><a href="?page=kontak">Kontak</a></li>
					<li><a href="?page=admin_page" class="active" >Login</a></li>				    
				</div>
			</ul>
		</div>
	</div>
	<div id="content">
		<div id="menu_accordion">
			<div id="jam" class="jam"></div>
			<div class="arrowlist">	
					<div class="menu_arrow_dtl" style="height:auto;margin:0;padding:0" id="tabs">
					  <ul class="menu_arrow_ul">
						<li class="menu_arrow_li"><a href="#tabs-1" class="active">Favorit</a></li>
						<li class="menu_arrow_li"><a href="#tabs-2">Utama</a></li>
						<li class="menu_arrow_li"><a href="#tabs-3">Arsip</a></li>
					  </ul>
						<div id="tabs-1" class="menu_arrow_content">
							<ul>
							<?php 
								$Redirected = $get_page."=news";
								$cek_favorit = "select id_judul,judul from view_favorit limit 10";
								if(mysql_query($cek_favorit)){
									$query_data = mysql_query($cek_favorit);
									while($hsl_data = mysql_fetch_array($query_data)){
										echo "<a href='$Redirected&ct=$hsl_data[0]'><li>".trim(paragrap($hsl_data[1],5))."</li></a>";
									}
								}else{
									log_error($tgl_jam,$Redirected,$cek_favorit);
								}
							?>
							</ul>
						</div>
						<div id="tabs-2"  class="menu_arrow_content">
							<ul>
							<?php 
								$cek_favorit = "select id_judul,judul from pu_content_dtl where aktif='Y' and utama='Y' order by upd_rec limit 10";
								if(mysql_query($cek_favorit)){
									$query_data = mysql_query($cek_favorit);
									while($hsl_data = mysql_fetch_array($query_data)){
										echo "<a href='$Redirected&ct=$hsl_data[0]'><li>".trim(paragrap($hsl_data[1],5))."</li></a>";
									}
								}else{
									log_error($tgl_jam,$Redirected,$cek_favorit);
								}
							?>
							</ul>
						</div>
						<?php /*
							require_once "tabs.php";
						*/
						?>
					</div>
				<div class="arrow_menu"></div>
					<div class="menu_arrow_dtl" style="height:250px;margin:0;padding:0">
						<!---->
						<iframe src="https://web.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fpeliharajalandepok%2F&tabs=timeline&width=250&height=250&small_header=true&adapt_container_width=false&hide_cover=true&show_facepile=false&appId&_rdr" width="250" height="250" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
						<!---->
					</div>
				<div class="arrow_menu"></div>
					<div class="menu_arrow_dtl" style="height:250px;margin:0;padding:0">
					<!---->
						<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/jalan_depok" data-widget-id="735682090885226497">Tweet oleh @jalan_depok</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					<!---->
					</div>
			</div>
		</div>
		<?php 
		if(!isset($_GET["page"])){
			?>
			<div id="content_slide1">
				<div class="content_slide1_dtl">	
					<?php require_once "halaman/slides_top.php"; ?>		
				</div>
			</div>
			<?php 
		}else{
			if($_GET["page"]=="home" or $_GET["page"]==""){
			?>
			<div id="content_slide1">
				<div class="content_slide1_dtl">	
					<?php require_once "halaman/slides_top.php"; ?>		
				</div>
			</div>
			<?php 
			}
		}
		/***panggil kontennya*/
		require_once "panggil_content.php";
		/***/
		if(isset($page_content)){
			if($page_content!="g_bulan" and $page_content!="g_tahun"){
			?>
			<div id="content_slide2">
				<div class="content_slide2_dtl">
					<?php require_once "halaman/slides_bot.php";?>
				</div>
			</div>
			<?php 
			}
		}else{
			?>
			<div id="content_slide2">
				<div class="content_slide2_dtl">
					<?php require_once "halaman/slides_bot.php";?>
				</div>
			</div>
			<?php 
		}
		require_once "panggil_content.php";
		?>		
		<div id="content_dtl">
			<div class="content_dtl">
			<?php
			if(isset($_GET["page"])){
				if($_GET["page"]!="home" and $_GET["page"]!=""){
				?>
			<div class="content_dtl_info">
				<?php echo $calling_content_info;?>
			</div>
				<?php 
				}
			}
			require_once $calling_content;
			?>
			</div>
		</div>
	</div>
	<div id="footer">
		<div class="footer">
			<div class="footer_dtl">
				<h3 style="margin:0;padding:0;margin-bottom:10px;">Statistik Pengunjung</h3>
				<?php 
				require_once "counter.php"; 
				?>
			</div>
			<div class="footer_dtl">
			<h3 style="margin:0;padding:0;margin-bottom:10px;">Berita Utama</h3>
				<?php 
				$cek_favorit = "select id_judul,judul from pu_content_dtl where aktif='Y' order by upd_rec limit 10";
				if(mysql_query($cek_favorit)){
					$query_data = mysql_query($cek_favorit);
					while($hsl_data = mysql_fetch_array($query_data)){
						echo "<div class='news_footer' ><a href='$Redirected&ct=$hsl_data[0]'>".trim(paragrap($hsl_data[1],5))."</a></div>";
					}
				}else{
					log_error($tgl_jam,$Redirected,$cek_favorit);
				}
				?>			
			</div>
			<div class="footer_dtl">
				<h3 style="margin:0;padding:0;margin-bottom:10px;">Kontak</h3>
				<table>
				<tr><td><b>Alamat</b></td><td>
				<?php 
					echo ready_profile("address"); 
				?>
				</td></tr>			
				<?php 
					$hal = "index";
					require_once "halaman/kontak.php";
				?>
				</table>
			</div>
		</div>
	</div>
	<div id="footer"  style="background:#29343e;width:100%;float:left;">
		<div class="copyright">copyright sumber daya air kota depok @ 2016</div>
	</div>
</div>
</body>
</html>
