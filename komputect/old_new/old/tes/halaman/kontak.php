<style>
zre{
	font-size:14px;
	font-weight:bold;
	overflow:hidden;
	border-bottom:solid 3px orange;
}
</style>
<?php 
if(empty($var_kontak)){
echo "<div style='font-weight:normal; color :black;font-size:10px;'>"?>
<table width="100%">
<?php
	$query_hdr = "WHERE ifnull(recid,'X')!='W' AND (id='phone' OR id='mail1' OR id='fax' OR id='mobile' OR id='mail1')  ORDER BY urut";
	$header = mysql_query("select * from profile ".$query_hdr) or die(mysql_error());
	while($header_content=mysql_fetch_array($header)){	
		$Id =$header_content['id'];
		/*
		echo "<tr><td class='Cntd'>".str_replace($str_arr,"",(strtoupper(substr($Id,0,1)).strtolower(substr($Id,1,20))))."</td><td class='Cntd'> : </td><td class='Cntd'>$header_content[content]</td></tr>";
		*/
		echo "<tr><td class='Cntd'>".strtoupper(substr($Id,0,1)).strtolower(substr($Id,1,20))."</td><td class='Cntd'> : </td><td class='Cntd'>$header_content[content]</td></tr>";
		
	}
	$mailx = mysql_fetch_array(mysql_query("select contact_email2 from contact where urut='1'"))or die (Myer);
	echo "<tr><td class='Cntd'>Mail2</td><td  class='Cntd'> : </td><td class='Cntd'>".$mailx [0]."</td></tr>";
	echo "</table></div>";
	?>
	<div style='border-top:solid 1px orange; border-bottom:solid 1px orange; padding:10px 0px 10px 0px;overflow:hidden;margin-bottom:15px;'>
	<?php
	/*
	$sql = mysql_query("select * from ym");
	if ($sql)
		{
			while($data=mysql_fetch_array($sql))
			{
				echo "<div style='float:left;padding-right:20px;'><strong>".$data['id']."</strong><br/>";
				echo '<a href="ymsgr:sendIM?'.$data['id_mail'].'"> <img src="http://opi.yahoo.com/online?u='.$data['id_mail'].'&amp;m=g&amp;t=2&amp;l=us"/></a></div>';
			}
		}else{
			echo "Maaf table mail belum tersedia";
		}
	/*	*/
	?>
	</div>
<?php    
}else{
	if($var_kontak=="contact_list"){
		$Ko_query = mysql_query("select  * from contact order by urut")or die(mysql_error());	
		echo "<div class='box'>";
		while ($Ko_result = mysql_fetch_array($Ko_query)){
				echo "<h4>".$Ko_result['contact_name']."</h4>";
				echo "&nbsp;&nbsp;&nbsp;".$Ko_result['contact_phone']."<br/>";
				echo "&nbsp;&nbsp;&nbsp;".$Ko_result['contact_email']."<br/>";
				echo "&nbsp;&nbsp;&nbsp;".$Ko_result['contact_email2'];		
		}	
		echo "</div>";
	}elseif($var_kontak=="contact_office"){
		$Ko_query = mysql_query("select * from profile where id='address' order by recid desc")or die(mysql_error());
		while ($Ko_result = mysql_fetch_array($Ko_query)){	
			echo "<div class='box' style='padding-top:-10px;'>";
				if($Ko_result['recid']=="X"){
					echo "<zre>Office</zre><p/>";
					echo $Ko_result['content'];
				}elseif($Ko_result['recid']=="W"){
					echo "<zre>Workshop</zre><p/>";
					echo $Ko_result['content'];
				}
			echo "</div><p/>";
		}
	}
}

?>