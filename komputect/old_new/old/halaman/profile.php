<?php
$query = mysql_query("select * from profile ")or die (mysql_error());
if(mysql_num_rows($query)<>0){
	$result = mysql_fetch_array($query);
	$gambar = "image/".$result[2];
	if(file_exists($gambar)){		
		echo "<img src='$gambar'/>";
	}
	echo "<div>$result[1]</div>";
}
?>