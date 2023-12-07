<html>
<style>
.client{
	padding-top:10px;
	float:left;
	width:220px;
	height:200px;
	margin:5px;
	box-shadow:0px 0px 5px #ccc;
	border-radius:5px;
	overflow:hidden;
}
.client1{
	font-size:13px;
	font-weight:bold;
	padding-bottom:10px;
	margin-bottom:5px;
	text-align:center;
}
.client>a{
	text-decoration:none;
	font-size:12px;
	color:#666;
}
.client>a:hover{
	color: #D57D0C;
}
.navi{
	border-bottom:solid 1px orange;
	border-top:solid 1px orange;
	overflow:hidden;
	width:100%;
	text-align:right;
	padding:3px;
}
.paging{
	text-decoration:none;
	font-weight:bold;
	color:blue;
}
.paging_text{
	color:#ccc;	
}
.paging_pilih{
	color:#ccc;		
}
.box>a{
	color: #D57D0C;
}
.box>a:hover{
	color: blue;
}
.box>a:active{
	color: green;
}
.box>a:focus{
	color: green;
}
.project_image{
	border-radius:5px;
	box-shadow: 0 0 5px rgba(0,0,0,0.9);
	float:left;
	height:200px;
	width:200px;
	margin:8px; 
}

</style>
<body>
<?php
if(!empty($var_project)){
	echo '<p>Project by produk</p><div class="box">';
		$Prl_sintak = "SELECT DISTINCT produk,COUNT(produk) as total FROM project GROUP BY produk ORDER BY 1 DESC";
		$Prl_query  = mysql_query($Prl_sintak)or die (mysql_error());
		while($Prl_result = mysql_fetch_array($Prl_query)){
			echo "
			<a href='project_dtl-$Prl_result[0].html' class='Prl_unit'>
				<div style='float:left;'>$Prl_result[0]</div><div style='float:right;'>$Prl_result[1] Unit</div>
			</a><br/>";
		}
	echo "</div><p>Project by tahun</p>";
	echo '<div class="box">';
		$Prl_sintak = "SELECT DISTINCT tahun,COUNT(tahun) as total FROM project GROUP BY tahun ORDER BY 1 DESC";
		$Prl_query  = mysql_query($Prl_sintak)or die (mysql_error());
		while($Prl_result = mysql_fetch_array($Prl_query)){
			echo "
			<a href='project_thn-$Prl_result[0].html' class='Prl_unit'>
				<div style='float:left;'>$Prl_result[0]</div><div style='float:right;'>$Prl_result[1] Unit</div>
			</a><br/>";
		}
	echo "</div>";
	echo "<p>Project by Distributor</p>";
	echo '<div class="box">';
		$Prl_sintak = "SELECT b.desk,COUNT(b.desk),a.agent_id FROM project a,agent b  WHERE a.agent_id=b.agent_id GROUP BY b.desk,a.agent_id";
		$Prl_query  = mysql_query($Prl_sintak)or die (mysql_error());
		while($Prl_result = mysql_fetch_array($Prl_query)){
			echo "
			<a href='project_agent-$Prl_result[2].html' class='Prl_unit'>
				<div style='float:left;'>".strtolower($Prl_result[0])."</div><div style='float:right;'>$Prl_result[1] Unit</div>
			</a><br/>";
		}
	echo "</div>";
}else{
	if(isset($_GET['project_id'])){
		$Prld_query = mysql_query("SELECT a.*,b.desk,b.id FROM project a,agent b  WHERE a.agent_id=b.agent_id  and a.project_id='".$_GET['project_id']."'") or die (mysql_error());
		$Prld_rows  = mysql_num_rows($Prld_query);
		if($Prld_rows==1){
			$Prld_result = mysql_fetch_array($Prld_query);
			$Prld_img = $Prld_result['project_img'];
			if(strlen($Prld_img)==0 || !file_exists(Img."project/".$Prld_img)){
				$Prld_img_show = Img."no_image.jpg";
			}else{
				$Prld_img_show = Img."project/".$Prld_img;
			}	
			echo '<div class="box2">
						<table style="float:left;">
						<tr><td colspan="3" class="client1">'.$Prld_result['build_name'].'<br/></td></tr>
						<tr><td width="20%">Type</td>	<td>:</td>	<td> '.$Prld_result['produk'].'</td></tr>
						<tr><td>User</td>				<td>:</td>	<td> '.$Prld_result['user'].'</td></tr>
						<tr><td>Lokasi</td>				<td>:</td>	<td> '.$Prld_result['lokasi'].'</td></tr>
						<tr><td>Kapasitas</td>			<td>:</td>	<td> '.$Prld_result['kapasitas'].'</td></tr>
						<tr><td>Unit</td>				<td>:</td>	<td> '.$Prld_result['unit'].'</td></tr>
						<tr><td>Tahun</td>				<td>:</td>	<td> '.$Prld_result['tahun'].'</td></tr>
						<tr><td>Distributor</td>	    <td>:</td>	<td> '.strtoupper($Prld_result['desk']).'</td></tr>
						</table>
					<img style="width:150px;height:150px; float:right; border:solid 5px #ccc;border-radius:10px;box-shadow:0px 0px 5px #ccc;" src="'.$Prld_img_show.'" />
				  </div>';		  
				  echo "<div class='box2'>";
					$Proj_dtl_query  = mysql_query("select small_img,big_img from project_detail where project_id='$_GET[project_id]' and recid='X' order by urut")or die (Myer);
					while($Proj_dtl_result = mysql_fetch_array($Proj_dtl_query)){
						$Img_ico = Img."project/".$Proj_dtl_result['0'];
						if(file_exists($Img_ico)){
							$Img_ico_x = $Img_ico;
						}else{							
							$Img_ico_x = Img."no_image.jpg";
						}
						$Img_full = Img."project/".$Proj_dtl_result['1'];
						if(file_exists($Img_full)){
							$Img_full_x = $Img_full;
						}else{							
							$Img_full_x = Img."no_image.jpg";
						}
						echo  "<a href='".$Img_full_x."' target='_blank'><img src='".$Img_ico_x."' class='project_image' style='float:left;width:144px; height:144px;' /></a>"; 
					}				  
				echo "</div>";
		}else{			
			require_once E_404;	
		}
	}else{
?>
<div class="navi"">
<?php
$batesan = 9;
if(isset($_GET['project_page'])){
	$project_page=$_GET['project_page'];
}else{	
	$project_page=1;
}
	if(isset($_GET['project_thn'])){
		$M_query="SELECT a.*,b.desk,b.id FROM project a,agent b  WHERE a.agent_id=b.agent_id  and a.tahun='".$_GET['project_thn']."'";	
		$Q_batas = mysql_fetch_row(mysql_query("select count(*) from project  where tahun='".$_GET['project_thn']."'")) or die (Myer);
		if($Q_batas){
			$batas = $Q_batas[0];
		}else{
			$batas = $batesan;
		}
	}elseif(isset($_GET['project_dtl'])){		
		$M_query="SELECT a.*,b.desk,b.id FROM project a,agent b  WHERE a.agent_id=b.agent_id  and a.produk='".$_GET['project_dtl']."'";	
		$Q_batas = mysql_fetch_row(mysql_query("select count(*) from project  where produk='".$_GET['project_dtl']."'")) or die (Myer);
		if($Q_batas){
			$batas = $Q_batas[0];
		}else{
			$batas = $batesan;
		}	
	}elseif(isset($_GET['project_agent'])){		
		$M_query="SELECT a.*,b.desk,b.id FROM project a,agent b  WHERE a.agent_id=b.agent_id  and a.agent_id='".$_GET['project_agent']."'";	
		$Q_batas = mysql_fetch_row(mysql_query("select count(*) from project  where agent_id='".$_GET['project_agent']."'")) or die (Myer);
		if($Q_batas){
			$batas = $Q_batas[0];
		}else{
			$batas = $batesan;
		}	
	}else{
		$M_query="SELECT a.*,b.desk,b.id FROM project a,agent b  WHERE a.agent_id=b.agent_id ";
		$batas=$batesan;	
	}
	//$M_query="select * from project";
    $jmldata=mysql_num_rows(mysql_query($M_query));	
	//echo $jmldata;
	if($jmldata!=0){	
		$jmlproject_page=ceil($jmldata/$batas);
			if($project_page > 1)
				{
					$previous=$project_page-1;
					echo "<a href=project_page-1.html class='paging'>First</a> | 
						  <a href=project_page-$previous.html class='paging'> Prev</a> ";
				}else{ 
					echo "<a class='paging_text'>First</a> | <a class='paging_text'>Prev</a>";
				}
				
				$angka=($project_page > 3 ? " ... " : " ");
				for($i=$project_page-2;$i<$project_page;$i++){
				  if ($i < 1) 
					  continue;
				  $angka .= "<a href=project_page-$i.html class='paging'>$i</a> ";
				}
				
				$angka .= " <span class='paging_pilih'>$project_page</span> ";
				for($i=$project_page+1;$i<($project_page+3);$i++)
				{
				  if ($i > $jmlproject_page) 
					  break;
				  $angka .= "<a href=project_page-$i.html class='paging'>$i</a> ";
				}
				
				$angka .= ($project_page+2<$jmlproject_page ? " ...  
						  <a href=project_page-$jmlproject_page.html class='paging'>$jmlproject_page</a> " : " ");				
				echo $angka;
				if($project_page < $jmlproject_page)
				{
					$next=$project_page+1;
					echo "  <a href=project_page-$next.html class='paging'>Next</a> |   
				  <a href=project_page-$jmlproject_page.html class='paging'>Last</a> ";
				}else{ 
					echo " <a class='paging_text'>Next</a> | <a class='paging_text'>Last</a>";
				}
	}else{
		require_once E_404;	
	}
?>
</div>
<div>
<?php
	if(empty($project_page)){
		$posisi=0;
		$project_page=1;
	}else{
		$posisi = ($project_page-1) * $batas;
	}
	$Ma_query=$M_query." order by tahun desc,upd_data desc limit $posisi,$batas";	
//	echo $Ma_query;
	$Pr_query=mysql_query($Ma_query) or die (mysql_error());
	while ($Pr_result = mysql_fetch_array($Pr_query)){
		$Pr_img = $Pr_result['project_img'];
		if(strlen($Pr_img)==0 || !file_exists(Img."project/".$Pr_img)){
			echo '<div class="client">
					<a href="project_id-'.$Pr_result['project_id'].'.html">
						<table>
						<tr><td colspan="3" class="client1">'.$Pr_result['build_name'].'<br/></td></tr>
						<tr><td width="20%">Type</td>	<td>:</td>	<td> '.$Pr_result['produk'].'</td></tr>
						<tr><td>User</td>				<td>:</td>	<td> '.$Pr_result['user'].'</td></tr>
						<tr><td>Lokasi</td>				<td>:</td>	<td> '.$Pr_result['lokasi'].'</td></tr>
						<tr><td>Kapasitas</td>			<td>:</td>	<td> '.$Pr_result['kapasitas'].'</td></tr>
						<tr><td>Unit</td>				<td>:</td>	<td> '.$Pr_result['unit'].'</td></tr>
						<tr><td>Tahun</td>				<td>:</td>	<td> '.$Pr_result['tahun'].'</td></tr>
						<tr><td>Distributor</td>	    <td>:</td>	<td> '.strtoupper($Pr_result['id']).'</td></tr>
						</table>
					</a>
				  </div>';
		}else{
			echo '<div class="client">
					<a href="project_id-'.$Pr_result['project_id'].'.html" class="tooltip">
						<div class="client1">'.$Pr_result['build_name'].'</div>
						<span>
							Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$Pr_result['produk'].'<br/>
							Kapasitas : '.$Pr_result['kapasitas'].'<br/>
							Unit&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$Pr_result['unit'].' Unit<br/>
							Lokasi&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: '.$Pr_result['lokasi'].'
						</span>
						<img style="width:100%;height:84.5%;" src="'.Img."project/".$Pr_img.'" />
					</a>
				 </div>';
		}
	}
	echo "</div>";
	}
}	
?>
</body>
</html>