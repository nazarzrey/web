<style>
td{
	border-bottom:solid 1px  #03199F;
}
</style>
<?php
$query = mysql_query("select * from pemain order by id_pemain ")or die (mysql_error());
if(mysql_num_rows($query)<>0){
	if($var_player=="play"){
		if(isset($_GET['id_player'])){
			$query3 = mysql_query("select * from pemain where id_pemain='$_GET[id_player]'")  or die (mysql_error());
			if(mysql_num_rows($query3)<>0){
				$resutl3 = mysql_fetch_array($query3);
				$gambar2 = "image/".$resutl3[10];
				if(file_exists($gambar2)){	
					$img1 = 	$gambar2;
				}else{							
					$img1 = 	"image/no_image.php";
				}
				echo "<table width='50%' style='float:left'>";
				echo "<tr><td width='30%'>Nama </td><td>$resutl3[1]</td></tr>";
				echo "<tr><td>Kebangsaan </td><td>$resutl3[2]</td></tr>";
				echo "<tr><td>Tgl Lahir </td><td>$resutl3[3]</td></tr>";
				echo "<tr><td>Tinggi </td><td>$resutl3[4]</td></tr>";
				echo "<tr><td>Berat </td><td>$resutl3[5]</td></tr>";
				echo "<tr><td>No punggung </td><td>$resutl3[6]</td></tr>";
				echo "<tr><td>Klub </td><td>$resutl3[7]</td></tr>";
				echo "<tr><td>Posisi </td><td>$resutl3[8]</td></tr>";
				echo "</table>";
				echo "<img src='$img1' height='200' width='200' style='border:solid 5px #fff;border-radius:10px;margin-left:100px;'/>";
				echo "<div style='margin-bottom:50px;'><h3 style='border-bottom:solid 3px orange;'>Profile $resutl3[1]</h3>$resutl3[9]</div>";
			}
		}else{
			while($result = mysql_fetch_array($query)){
				$gambar = "image/".$result[10];
				if(file_exists($gambar)){	
					$img = 	$gambar;
				}else{							
					$img = 	"image/no_image.php";
				}
				echo "<a href='?halaman=pemain&id_player=$result[0]' style='cursor:pointer'>
						<div style='float:left;overflow:height:200px;text-align:center;padding:5px;'>
							<img src='$img' height='100' width='100' style='border:solid 2px #fff;'/><br/>$result[1]
						</div>
					  </a>";
			}
		}
	}elseif($var_player=="list"){
		echo "<ul>";
		$x=1;
		while($result2 = mysql_fetch_array($query)){
			echo "<li><a href='?halaman=pemain&id_player=$result2[0]'>$result2[1] - $result2[8]</a></li>";
			$x++;
		}
		echo "</ul>";
	}
	
}
?>