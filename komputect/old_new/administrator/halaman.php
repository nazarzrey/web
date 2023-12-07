<?php 
if(!isset($_SESSION)){ 
	session_start();
	if(!isset($_SESSION['User_admin'])){
		echo '<script language="javascript">';
		echo 'window.location.href="index.php";';
		echo '</script>';
		die;
	}			
} 
include "config/admin_config.php";
$query_hdr = "where id='company'";
$header = mysql_query("select * from profile ".$query_hdr) or die(mysql_error());
$header_content=mysql_fetch_array($header);
//echo $header_content['content'].", Copyright &copy 2015 - All Right Reserved";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no" /> -->
<title>Halamana Admin <?php echo  $header_content['content']; ?></title>
<link href="<?php echo A_css;?>admin-style.css"	rel="stylesheet" type="text/css" media="screen">
<link href="<?php echo A_css;?>datepicker.css"	rel="stylesheet" type="text/css" media="screen">
<link href="css/menu.css" 						rel="stylesheet" type="text/css" media="all">
<link href='css/admin.css' 						rel="stylesheet" type="text/css" media="all">
<script src="js/jquery.tools.min.js" type="text/javascript"></script>  
<script type="text/javascript" src="../js/jquery.min.js" ></script>
<script type="text/javascript" src="../js/jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="../js/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="../js/jquery.ui.accordion.min.js"></script>
<script type="text/javascript" src="../js/jquery.ui.datepicker.min.js"></script>
<script type="text/javascript" src="js/ddaccordion.js" ></script> 
<script type='text/javascript'>
ddaccordion.init({
	headerclass: "expandable", //Shared CSS class name of headers group that are expandable
	contentclass: "categoryitems", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", "openheader"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["prefix", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script> 
<link rel="shortcut icon" href="<?php echo A_Img."pmi.png"; ?>">
<!-- accordion js -->
</head>
<!-- <body background="image/bg.png"> -->
<body>
<div id="admin-top">
	<div id="tiga_d">ADMINISTRATOR PAGE</div>
	<a href="?page=logout" class="button_x">Logout</a>
	<a href="../index.php" target="_blank" class="button_x">Lihat Web</a>
</div>
<div id="admin-container">
	<div style="float:left;width:22%">
		<div id="content-left1">
			<div class="arrowlistmenu menu">
				<a href="halaman.php"><div class="menuheader">Home</div></a> 				
				<div class="menucenter expandable">Master Web</div>
					<ul class="categoryitems">
					<!--
						<li><a href="?page=M_utama">Menu Utama</a></li>
						<li><a href="?page=M_bawah">Menu List</a></li>
						<li><a href="?page=M_language">Master Bahasa</a></li>	
						<li><a href="?page=M_berita">Berita Utama</a></li>	
					-->
						<li><a href="?page=slide_galery">Slide Utama</a></li>
						<li><a href="?page=input_tags">Tags</a></li>
						<li><a href="?page=google_desc">Google Description</a></li>
						<li><a href="?page=menu_about">Tentang Kami</a></li>
						<li><a href="?page=menu_contact">Kontak Kami</a></li>
						<li><a href="?page=menu_profile">Hal Utama Profile</a></li>
						<li><a href="?page=menu_unggul">Hal Utama Keunggulan</a></li>
					</ul>				
				<div class="menucenter expandable">Proudk & Project</div>
					<ul class="categoryitems">
						<li><a href="?page=project_input">Proyek dan Servis</a></li>			
						<li><a href="?page=product_input">Produk</a></li>
						<!-- <li><a href="?page=Agent">Distributor</a></li> -->
					</ul>
				<div class="menucenter expandable">A D M I N</div>
					<ul class="categoryitems">
						<li><a href="?page=profile_update">Profile</a></li>		
						<li><a href="?page=kontak_update">Kontak</a></li>
						<li><a href="?page=messenger">Yahoo Messenger</a></li>	
						<!--<li><a href="?page=menu_workshop">Workshop</a></li> -->
					</ul>
				<a href="?page=visitor"><div class="menubottom">Pengunjung</div></a>
			</div>
		</div>
		<!--
		<div id="content-left2">
		</div>
		-->
	</div>
	<div style="float:right; width:76.5%;">
		<div id="content-right1">
			<?php echo date("l").", ".date("d-m-Y");?>
			<div class="admint-stat"><?php echo "Login As : ".$_SESSION['User_admin']; ?></div>
		</div>
		<div id="content-right2">
			<?php 
				if(isset($_GET['page'])){
					$page = $_GET['page'];
				}else{
					$page = "";
				}
				if($page==""){
					$var_baca="N";
					require_once "halaman/guest.php";
				}elseif($page=="guest"){
					$var_baca="Y";
					require_once "halaman/guest.php";
				}elseif($page=="logout"){
					require_once "logout-page.php";
				}elseif($page=="visitor"){
					require_once "halaman/pengunjung.php";
				}elseif($page=="M_utama"){
					require_once "halaman/menu_utama.php";
				}elseif($page=="M_bawah"){
					require_once "halaman/menu_bawah.php";
				}elseif($page=="M_language"){
					require_once "halaman/master_bahasa.php";
				}elseif($page=="M_berita"){
					require_once "halaman/input_berita.php";
				}elseif($page=="project_input"){
					require_once "halaman/input_proyek.php";
				}elseif($page=="product_input"){
					require_once "halaman/input_produk.php";
				}elseif($page=="Agent"){
					require_once "halaman/input_agent.php";
				}elseif($page=="slide_galery"){
					require_once "halaman/galery_slide.php";
				}elseif($page=="input_tags"){
					require_once "halaman/input_tags.php";
				}elseif($page=="profile_update"){
					require_once "halaman/input_profile.php";
				}elseif($page=="kontak_update"){
					require_once "halaman/input_kontak.php";
				}elseif($page=="messenger"){
					require_once "halaman/input_messenger.php";
				}elseif($page=="menu_workshop"){
					$var_menu	="menu_workshop";
					$Key 		= "WSH";
					$urut		= "1";
					$Nid 		= "Workshop";
					$text_id 	= "id='myArea1'";
					require_once "halaman/lain_lain.php";
				}elseif($page=="menu_about"){
					$var_menu	="menu_about";
					$Key 		= "X_MASTER_X";
					$Nid 		= "About";
					$urut		= "1";
					$text_id 	= "id='myArea1'";
					require_once "halaman/lain_lain.php";
				}elseif($page=="menu_contact"){
					$var_menu	="menu_contact";
					$Key 		= "CNT";
					$urut		= "1";
					$Nid 		= "Contact";
					$text_id 	= "id='myArea1'";
					require_once "halaman/lain_lain.php";
				}elseif($page=="google_desc"){
					$var_menu	="google_desc";
					$Key 		= "GOOGLE";
					$urut		= "1";
					$Nid 		= "Google Description";
					$text_id 	= "id='myArea2'";
					require_once "halaman/lain_lain.php";
				}elseif($page=="menu_profile"){
					$var_menu	="menu_profile";
					$Key 		= "box_profile";
					$urut		= "1";
					$Nid 		= "Halaman Utama - Profile";
					$text_id 	= "id='myArea1'";
					require_once "halaman/lain_lain.php";
				}elseif($page=="menu_unggul"){
					$var_menu	="menu_unggul";
					$Key 		= "box_profile";
					$urut		= "2";
					$Nid 		= "Halaman Utama - Keunggulan";
					$text_id 	= "id='myArea1'";
					require_once "halaman/lain_lain.php";
				}else{
					require_once "404.php";
				}
			?>
		</div>
	</div>
</div>
<div id="admin-bot" class="courier">
    	<?php
			$query_hdr = "where id='company'";
			$header = mysql_query("select * from profile ".$query_hdr) or die(mysql_error());
			$header_content=mysql_fetch_array($header);
				echo $header_content['content'].", Copyright &copy 2015 - All Right Reserved";
		?>
</div>
</body>
</html>