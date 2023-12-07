<form method="post" action="">
	User : <input type='text' name='user'/><br/>
	Pass : <input type='password' name='pass'/><br/>
	<input type='submit' value='cek' name='cek'/><br/>
</form>
<?php
if(isset($_POST['cek'])){
	require_once "definisi/config.php";
	$user = trim(htmlentities(mysql_real_escape_string($_POST['user'])));
	$pass = trim(htmlentities(mysql_real_escape_string($_POST['pass'])));
	if(empty($nama) and empty($pass)){
		echo "User / Password masih kosong";
	}else{
		$Login_query  = mysql_query("select id_user,id_pass from user where id_user='$user'")or die (Myer);
		if(mysql_num_rows($Login_query)==0){
			echo "Data tidak ditemukan";
		}else{
			$Login_result = mysql_fetch_array($Login_query);
			if($Login_result[1]<>md5($pass)){										
				echo "Password tidak sesuai";
			}else{
				echo "Berhasil";
				echo "<table border='1'>";
					$Vis_query = mysql_query("select*  from counter order by tanggal desc, jam desc limit 200");
					while($Vis_result = mysql_fetch_array($Vis_query)){
						echo "<tr>";
						for ($i = 0; $i <= 9; $i++) {
							if(empty($Vis_result[$i])){
								echo "<td>&nbsp;</td>";
							}else{
								echo "<td>".$Vis_result[$i]."</td>";
							}
						}
						echo "</tr>";
					}
				echo "</table>";
			}
		}
	}
}
?>