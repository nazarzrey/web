<?php
	require_once "definisi/config.php";
	define("Web","http://localhost/cc/");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="<?php keywords();?>"/>
<?php  
function keywords(){
	$sql = mysql_query("select * from  tags   ORDER BY flag, tag1 ASC");
	if ($sql){
		while ($data = mysql_fetch_row($sql)){
			echo $data[1].",";
		}
	        echo "Komputeclift";
	}
}
?>
<title>Lift Barang  - Komputeclift - 
<?php
$sql1 = mysql_query("select distinct produk from project order by produk");
if ($sql1){
	while($sql_out=mysql_fetch_row($sql1))
		{
			$data1 = $sql_out['0'];
		//      echo '<a href="product_id-'.$data2.'.html">'.$data1.'</a> ';				
			echo $data1." | ";
		}
}
?>	
</title>
<link href="css/menu.css" 						rel="stylesheet" type="text/css" media="screen">
<link href="css/style.css" type="text/css" rel='stylesheet'>
<link rel="shortcut icon" href="image/komput.gif">
<meta name="robots" content="index, follow">
<meta name="description" content="Kontraktor Lift / Elevator / Eskalator Di Bogor Indonesia, Kami melayani penjualan dan service lift / elevator, eskalator, Panel Kontrol juga Maintenance lift serta penggantian suku cadang dan kelistrikannya" />
<script src="js/jquery.min.js" type="text/javascript"></script> 
<script src="js/jquery.tools.min.js" type="text/javascript"></script>  
<script src="js/zal.js" type="text/javascript"></script> 
<script src="js/ddaccordion.js" type="text/javascript"></script> 
<script type="text/javascript" src="js/jssor.js"></script>
<script type="text/javascript" src="js/jssor.slider.mini.js"></script>
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
</head>
<body>
<div id="container">
	<div id="header">
    </div>
    <div id="top-content">
		<div id="profile">
		<?php 
		if(!isset($_GET['halaman']) or $_GET['halaman']=='home'){
		 	$Pro_query = mysql_query("select * from profile where id in('company','phone') and recid='X' order by urut");// or die(mysql_error());
			while ($Pro_result = mysql_fetch_array($Pro_query)){
				if($Pro_result[0]=="company"){
					echo "<span class='PT' style='float:left;'>$Pro_result[1]</span>";
				}else{
					echo "<span class='PT2' style='float:right;'>$Pro_result[1]</span>";
				}
			}
		}
		?>
		</div>
		<?php 
		if(!isset($_GET['halaman']) or $_GET['halaman']=='home'){
			$id="id='content_menu'";
		?>
		<div>
			<img src="image/komput.png" width="180" height="200" 
                style="float:left;
                margin:5px 0 0 40px;
                position:absolute;
                border-radius:50px; 
                border:solid 3px #ddd;
                box-shadow:0 0 5px #ccc;
                padding:2px;"
                >
		</div>
		<div id="slide_image">
		<?php 
			require "slide.php";
		?>
		</div>
		<?php 
		}else{
			?>
            <div>
                <img src="image/komput.png" width="120" height="140" 
                style="float:left;margin:5px 0 0 10px; position:absolute;border-radius:50px; border:solid 3px #ddd; box-shadow:0 0 5px #ccc;padding:5px;"
                >
            </div> 
            <?php
			$id="id='content_menu2'";
			echo "<div id='xprofile'>";
				$Pro_query = mysql_query("select * from profile where id in('company','address','phone','mail2') and recid='X' order by urut");// or die(mysql_error());
				while ($Pro_result = mysql_fetch_array($Pro_query)){
					if($Pro_result[0]=="company"){
						echo "<span class='PT' style='color:#001B73;'>$Pro_result[1]</span><br/>";
					}else{
						echo "<br/>$Pro_result[1]";
					}
				}
			echo "</div>";
		}
		?>
   	  <div <?php echo $id;?> class="menu">
        	<ul >
            	<li><a href="home">Beranda</a></li>
            	<li><a href="product">Produk</a></li>
            	<li><a href="project">Proyek & Service</a></li>
            	<li><a href="about">Tentang Kami</a></li>
            	<li><a href="contact">Kontak Kami</a></li>
            </ul>
        </div>
	</div>
    <div id="bot-content">
        <div class="content-left">
        	<?php
				if(isset($_GET['halaman'])){
					$page= $_GET["halaman"];
				}else{
					$page="";
				}
				if(empty($page) or $page=="home"){
					$var_dtl="9";
					$proyek_type="";
					require_once "halaman/project_slide.php";
					require_once "halaman/box_profile.php";
				}elseif($page=="contact"){
					require "halaman/hubungi.php";
				}elseif($page=="about"){
					require "halaman/about_us.php";
				}elseif($page=="proyek"){
					$var_dtl="15";
					$proyek_type="where type='proyek'";
					require "halaman/project_slide.php";
					require "halaman/project.php";
				}elseif($page=="service"){
					$var_dtl="15";
					$proyek_type="where type='service'";
					require "halaman/project_slide.php";
					require "halaman/project.php";
				}elseif($page=="produk"){
					require "halaman/produk.php";
				}
			?>    	
        </div>
		<div class="content-right">
			<div class="arrowlistmenu menu">		
					<div class="menuheader">
						<?php require_once "halaman/kontak.php"; ?>
					</div>		
					<div class="menucenter expandable">			
						<?php
                            $query_hdr = "where id='company'";
                            $header = mysql_query("select * from profile ".$query_hdr) or die(mysql_error());
                            $header_content=mysql_fetch_array($header);
                                echo $header_content['content'];
                        ?>
            		</div>
						<ul class="categoryitems">
							<li><a href="home">Beranda</a></li>
							<li><a href="product">Produk</a></li>
							<li><a href="project">Proyek & Service</a></li>
							<li><a href="about">Tentang Kami</a></li>
							<li><a href="contact">Kontak Kami</a></li>
						</ul>	
					<div class="menucenter expandable">Produk</div>
						<ul class="categoryitems">
                        	<?php 
								$prod_query = mysql_query("SELECT DISTINCT product_id,product_name FROM produk WHERE IFNULL(recid,'0')<>'X' ORDER BY urut ") or die (mysql_eror());
								while($prod_result = mysql_fetch_array($prod_query)){
									echo '<li><a href="index.php?halaman=produk&product_id='.$prod_result[0].'">'.$prod_result[1].'</a></li>';
								}
							?>
						</ul>				
					<div class="menucenter expandable">Service & Project</div>
						<ul class="categoryitems">
							<?php 
								$prod_query = mysql_query("SELECT DISTINCT(COUNT( produk)),produk FROM project GROUP BY produk ") or die (mysql_eror());
								while($prod_result = mysql_fetch_array($prod_query)){
									$url_proyek=str_replace(",","",str_replace(" ","-",$prod_result[1]));
									echo '<li><a href="index.php?halaman=proyek&proyek_dtl='.$url_proyek.'">'.$prod_result[1].'</a></li>';
								}
							?>
						</ul>
						<!--
					<div class="menucenter expandable"><a href="#">CEK PB</a></div>
						<ul class="categoryitems">
							<li><a href="?page=Pbbh">PBBH</a></li>	
							<li><a href="?page=Pbsl">PBSL</a></li>
						</ul>
						-->					
					<div class="menubottom expandable">
						<span style='border-bottom:solid 2px orange;'>Visitor</span>
						<?php require_once "halaman/counter.php";?>
					</div>
				</div>
        <?php
				if(isset($_GET['halaman'])){
					$page= $_GET["halaman"];
				}else{
					$page="";
				}
				if(empty($page) or $page=="home"){
					//di sini di isi kalo misal home isinya apa
					//require_once "halaman/profile.php";
					//echo "Isi disini buat halaman ini</br>";
					//echo "Isi disini buat halaman ini</br>";
					//batas
				}
			?>
			</div>
    </div>
    <div id="footer">
    	<div style="float:left;width:30%;">
        	<?php
				$Ko_query = mysql_query("select * from profile where id='address' order by recid desc")or die(mysql_error());
				while ($Ko_result = mysql_fetch_array($Ko_query)){	
					echo "<div style='padding-top:-10px;color:#ddd;margin-top:20px;padding-left:10px;'>";
						if($Ko_result['recid']=="X"){
							echo "<zre>Office</zre><p/>";
							echo $Ko_result['content'];
						}elseif($Ko_result['recid']=="W"){
							echo "<zre>Workshop</zre><p/>";
							echo $Ko_result['content'];
						}
					echo "</div><p/>";
				}
			?>
        </div>
    	<div style="float:left">
<!--    <a href="http://info.flagcounter.com/W1WM"> -->
    <img src="http://s04.flagcounter.com/count/W1WM/bg_080633/txt_FFFFFF/border_02024F/columns_4/maxflags_24/viewers_3/labels_0/pageviews_0/flags_0/" 
    alt="Flag Counter" border="0">
    <!--</a>-->
    	</div>
    	<div style="float:left;width:35%;padding-left:10px;">
        	<?php
				require_once "halaman/tags.php";
			?>
        </div>
   	</div>
    <div id="footer-in">			
			<?php
                $query_hdr = "where id='company'";
                $header = mysql_query("select * from profile ".$query_hdr) or die(mysql_error());
                $header_content=mysql_fetch_array($header);
                    echo $header_content['content'].", Copyright &copy 2015 - All Right Reserved";
            ?>

    </div>
</div>
</body>
</html>