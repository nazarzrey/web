<?php
	$path = "../image/agent/";
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
?>				
<html>
<body>
<head>
<style>
	.ipro{
		width:300px;
		border:solid 1px #ccc;
		box-shadow:0 0 5px #ddd;
		border-radius:2px;
		font-family:courier;
	}
	#name-list input{
		margin:2px;
		padding:2px;
	}
	#name-list select{
		margin:2px;
		width:160px;
		font-family:courier;
	}
	.ro{
		background-color:#ddd;
	}
	#content-menu{
		padding:0px 5px 0px 5px;
		width:100%;
	/*	padding:1% 3.5% 1% 3.5% ; */
		overflow:hidden;
		float:right;
	}
	.judul{
		float:left;
		width:20%;
		padding-top:5px;
		padding-left:5px;
		font-weight:bold;
		color:#888;
		font-size:12px;
	}
	.isi{
		float:left;
		width:70%;		
	}
	.info{
		height:30px;
		margin-bottom:2px;
		width;100%;
		border:solid 1px #ddd;
		border-radius:5px;
		background-color:#fff;
		padding:2px;
	}
.img_agent_x{
	border:solid 1px blue;
}
.box-del{
	width:550px;
	height:auto;
	padding:50px;
	background-color:orange;
	position:absolute;
	top:250px;
	box-shadow:0 0 20px 10px orange;
	border:solid 1px brown;
	border-radius:10px;
	overflow:auto;
	z-index:1;
}
</style>
<script type="text/javascript" src="js/nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
	<script>
	$(function() {
		$( "#accordion" ).accordion({
			heightStyle: "content"
		});
	});
	</script>
</head>
<div style='margin-bottom:30px;'>
<?php if(isset($_GET['action'])){
		echo '<div style="margin-left:5px;margin-top:-5px;">
				<a href="halaman.php?page=Agent" class="button_x" >List Agent</a> 
			  </div>';
		if($_GET['action']=="add_agen"){
			require_once "agent/tambah_agent.php";
		}elseif($_GET['action']=="ins_gal"){
			require_once "agent/tambah_galery_agent.php";
		}elseif($_GET['action']=="edit_agent"){
			require_once "agent/edit_agent.php";
		}elseif($_GET['action']=="add_brosur"){
			require_once "agent/tambah_brosur.php";
		}
	}else{
?>
	<div style="float:right;margin-top:-10px;">
		<a href="halaman.php?page=Agent&action=add_agen" class="button_x" >Add agent</a> 
		<a href="halaman.php?page=Agent&action=add_brosur" class="button_x" >Add agent brosur</a> 
	</div>
	<span style="float:left;margin-bottom:5px; margin-top:5px; font-size:16px;font-weight:bold;">List agent </span>
	<br/>
	<hr width="100%" align="center" color="orange" style="float:left;">
	<div id="name-counter">
		<div class="x7a">Urut</div>
		<div class="x5a">Agent Id</div>
		<div class="x2b">Agent Name</div>
		<div class="x2a">Agent Desc ID</div>
		<div class="x2">Agent Desc En</div>
		<div class="x7b">Brosur</div>
		<div class="x7">Img Master</div>
		<div class="x7">Img Galery</div>
		<div class="x7b">Action</div>
	</div>
	<div id="name-list" style='height:350px;overflow:auto;'>
	<?php
	$agent_query = mysql_query("SELECT urut,desc_id,desc_name,agent_desc_id,agent_desc_en,img,brosure,agent_id FROM agent ORDER BY urut");
		$no=1;
		while($agent_result = mysql_fetch_array($agent_query)){
			$agent_dtl_query  = mysql_query("select  count(agent_id) from agent_detail where agent_id='$agent_result[agent_id]'")or die (mysql_error());
			$agent_dtl_result = mysql_fetch_array($agent_dtl_query);
			if($agent_dtl_result[0]==0){
				$img_agent_dtl= "<a href='halaman.php?page=Agent&action=ins_gal&data_agent=$agent_result[agent_id]'>Add Galery</a>";
			}else{
				$img_agent_dtl= "<b style='color:green'>".$agent_dtl_result[0]." Image</b>";
			}
			$angka =  $no;
			if( $angka%2 == 1 ){
			$warna = 'style="background-color:#B5E9FF"';
			}
			if( $angka%2 == 0 )
			{
			$warna = 'style="background-color: #DDF8FF"';
			}
			$url = "<a href='?page=Agent&action=edit_agent&agent_id=$agent_result[7]'>Edit</a>";
			$img_agen_utama = $agent_result[5];
			if($img_agen_utama=="-" || strlen(trim($img_agen_utama))==0){
				$img_agent_utama="<b style='color:brown'>no image insert</b>";
			}elseif(!file_exists($path.$img_agen_utama)){
				$img_agent_utama="<b style='color:red;text-align:center;'>not found</b>";
			}else{
				if(file_exists($path.str_replace("full","thumb",$img_agen_utama))){				
					$img_agent_utama="<img src='".$path.str_replace("full-","thumb-",$img_agen_utama)."' width='100%' height='100%' />";
				}else{
					$img_agent_utama="<b style='color:green;text-align:center;'>Have Image</b>";	
				}
			}
			$brosur = $agent_result[6];
			if($brosur=="-" || strlen(trim($brosur))==0){
				$agent_brosur="<b style='color:brown'>no attc</b>";
			}elseif(!file_exists($path."brosur/".$brosur)){
				$agent_brosur="<b style='color:red;text-align:center;'>not found</b>";
			}else{
				$agent_brosur="<b style='color:green;text-align:center;'>Yes</b>";	
			}
			echo '
			<div class="content_g">
				<div id="name-list_x_g" class="x7a Bleft" '.$warna.'>'.$agent_result[0].'</div>
				<div id="name-list_x_g" class="x5a Bi" '.$warna.'><a href="../agent_dtl-'.$agent_result[7].'.html" target="_blank" style="color:blue;text-decoration:none;">'.$agent_result[1].'<a></div>
				<div id="name-list_x_g" class="x2b" '.$warna.'>'.$agent_result[2].'</div>
				<div id="name-list_x_g" class="x2a" '.$warna.'>'.$agent_result[3].'</div>
				<div id="name-list_x_g" class="x2" '.$warna.'>'.$agent_result[4].'</div>
				<div id="name-list_x_g" class="x7b" '.$warna.'>'.$agent_brosur.'</div>
				<div id="name-list_x_g" class="x7" '.$warna.'>'.$img_agent_utama.'</div>
				<div id="name-list_x_g" class="x7" '.$warna.'>'.$img_agent_dtl.'</div>
				<div id="name-list_x_g" class="x7b" '.$warna.'>'.$url.'</div>
			</div>';
		$no++;	
		}
	?>
	</div><br/><i class="notif">* Klik agent name untuk melihat detail</i> 
<?php } ?>
</div>
</body>
</html>