<?php
	$path = "../image/galery/";
	include("config/convert_image.php");
	$wmax1 = 350;
	$hmax1 = 350;
	$wmax2 = 300;
	$hmax2 = 300;
	$wmax3 = 200;
	$hmax3 = 200;
	$wmax4 = 150;
	$hmax4 = 150;
	$wmax5 = 75;
	$hmax5 = 75;
	$Tbl = "content";
	/*
	
					$var_menu	="menu_contact";
					$Key 		= "CNT";
					$Nid 		= "Contact";
					*/
	$web_page = "halaman.php?page=".$var_menu;
?>		
<html>
<body>
<head>
<script type="text/javascript" src="js/nicEdit.js"></script>
 <script type="text/javascript">
//<![CDATA[
var area1, area2;

function toggleArea1() {
	if(!area1) {
			area1 = new nicEditor({fullPanel : true}).panelInstance('myArea1',{hasPanel : true});
	} else {
			area1.removeInstance('myArea1');
			area1 = null;
	}
}

function addArea2() {
	area2 = new nicEditor({fullPanel : true}).panelInstance('myArea2');
}
function removeArea2() {
	area2.removeInstance('myArea2');
}

bkLib.onDomLoaded(function() { toggleArea1(); });
//]]>
</script>
</head>
<div style='margin-bottom:30px;'>
<?php 
if($Nid=="Workshop"){
	if(isset($_GET['action'])){
		if($_GET['action']=="add_gal"){
			$var_workshop="add_galery";
			require_once "workshop/galery_workshop.php";
		}elseif($_GET['action']=="edit_gal"){
			$var_workshop="edit_galery";
			require_once "workshop/galery_workshop.php";
		}
	}
?>
	<div style="float:right;margin-top:-10px;">
		<a href="<?php echo $web_page; ?>&action=add_gal" class="button_x" >Add Galery</a> 
		<a href="<?php echo $web_page; ?>&action=edit_gal" class="button_x" >Manage Galery</a> 
	</div>
<?php 
}
?>	
	
	<span style="float:left;margin-bottom:5px; margin-top:5px; font-size:16px;font-weight:bold;">Manage <?php echo $Nid; ?></span>
	<br/>
	<hr width="100%" align="center" color="orange" style="float:left;">
</div>
<div id="name-list" style='height:auto;padding:10px;'>
	<form method="post" action="" enctype="multipart/form-data" >
		<?php 
			$data_workshop = mysql_fetch_row(mysql_query("select isi_content from content where id_content='$Key' and urut='$urut'"))or die(mysql_error());
		?>
		<table border='0' width='100%'>
			<?php
			if($Nid=="Workshop"){
				$wshp_dtl_query  = mysql_query("select count(recid) from galery where recid='$Key' and urut='$urut'")or die(mysql_error());
				$wshp_dtl_result= mysql_fetch_array($wshp_dtl_query);
				echo '<tr><td><b><em>Image Galery Have '.$wshp_dtl_result[0]." Image</em><b></td></tr>";
			}
			?>
			<input type='text' name='Keys' value='<?php echo $Key; ?>'style="display:none;" />
			<input type='text' name='Table' value='<?php echo $Tbl; ?>' style="display:none;" />
			<tr><td><b style="color:blue;">Content *</b></td></tr>
			<tr><td><textarea  type="text" name="cnt_id" class='textarea' <?php echo $text_id; ?> style="float:left;resize:none;"><?php echo $data_workshop[0]?></textarea></tr>		
			<tr><td><input type="submit" name="update_data" value="Update <?php echo $Nid;?>" class='button_s' style="width:auto"><i style='font-size:12px;padding-left: 50px;'>(*) isian tidak boleh kosong</i></td></tr>
		</table>
		<?php if($Key=="GOOGLE"){?>
		<p>Google Description <br/><img src="../image/Godesc.jpg"/></p>
		<?php } ?>
	</form>
</div>
<div style="float:left;">
<?php
	if(isset($_POST['update_data'])){
		$Keys = $_POST["Keys"];
		//echo $_POST['cnt_id'].$_POST['cnt_en'];
		if(!empty($_POST['cnt_en']) || !empty($_POST['cnt_id'])){
			$SSX= "update content set isi_content='$_POST[cnt_id]' where id_content='$Keys' and urut='$urut'";
			//echo $SSX;
			$update_workshop = mysql_query($SSX) or die(mysql_error());
			if($update_workshop){
				echo '<script>alert("Data '.$Nid.' sudah di update")</script>';
				echo '<meta http-equiv="refresh" content="0;'.$web_page.'">';
			}else{
				echo '<script>alert("Data '.$Nid.' tidak bisa di update, silahkan cek lagi...")</script>';
				echo '<meta http-equiv="refresh" content="0;'.$web_page.'">';
			}
		}
	}
?>
</div>
</body>
</html>