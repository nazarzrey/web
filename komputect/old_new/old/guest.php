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
				echo "<table border='1' width='100%'>";
				$Gs_query = mysql_query("select * from guest_book order by tanggal desc,jam desc") or die (mysql_error());
				while($Gs_result = mysql_fetch_array($Gs_query)){
					echo "<tr><td>$Gs_result[nama]</td><td>$Gs_result[email]</td><td>$Gs_result[pesan]</td><td>$Gs_result[tanggal] $Gs_result[jam]</td></tr>";
				}
				echo "</tr>";
			}
			echo "</table>";
		}
	}
}
?>