<div style="padding:10px; background:#fff;border-radius:5px;box-shadow:0 0 3px #fff;border:solid 1px #ccc;line-height:18px;">
<?php 
	$query_profile = mysql_query("select judul,isi_content from content where id_content='box_profile' and urut='1'") or die ("Error : ".mysql_error());
	$result_profile = mysql_fetch_array($query_profile);
	echo $result_profile['1']."<p/>&nbsp;<p/>";    
		$Koh_query = mysql_query("select  * from contact where urut='1'")or die(mysql_error());	
		echo "<div>";
			$Koh_result = mysql_fetch_array($Koh_query);
				echo "<h4><i>".$Koh_result['contact_name']."</i></h4>";
				echo "&nbsp;&nbsp;&nbsp;".$Koh_result['contact_phone']."<br/>";
				echo "&nbsp;&nbsp;&nbsp;".$Koh_result['contact_email']."<br/>";
				echo "&nbsp;&nbsp;&nbsp;".$Koh_result['contact_email2'];			       
		echo "</div>";             
?>
</div>