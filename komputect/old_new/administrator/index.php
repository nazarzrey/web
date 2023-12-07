<?php 
if(!isset($_SESSION)){ 
	session_start();			
} 
include "config/admin_config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!-- <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no" /> -->
<title>Halamana Admin 
    	<?php
			$query_hdr = "where id='company'";
			$header = mysql_query("select * from profile ".$query_hdr) or die(mysql_error());
			$header_content=mysql_fetch_array($header);
				echo strtolower($header_content['content']);
		?></title>
<link href="../css/admin-style.css"  rel="stylesheet" type="text/css" media="screen"	 />
<link href="<?php echo A_css;?>content.css"  rel="stylesheet" type="text/css" media="screen"	 />
<link href="<?php echo A_css;?>style_slide.css" rel="stylesheet" type="text/css" media="screen">   
<link href="<?php echo A_css;?>style_box.css" rel="stylesheet" type="text/css" media="screen">     
<link rel="stylesheet" href="<?php echo A_css;?>json.slider.css" type="text/css" media="screen" >
<link rel="shortcut icon" href="<?php echo A_Img."pmi.png"; ?>">
<!-- accordion js -->
</head>
<!-- <body background="image/bg.png"> -->
<body>
	<div id="admin-top">
    </div>
	<div id="login-container">
        <div id="admin-login">
        <h1>Silahkan login<br/> untuk dapat mengakses halaman admin</h1>
        <form method="post" action="" enctype="multipart/form-data" style="padding-left:10%;">
            <?php            
                $_SESSION['cha1'] = rand(1,20); //mendapatkan nilai 1
                $_SESSION['cha2'] = rand(1,20); //mendapatkan nilai 2
                $_SESSION['hasil'] = $_SESSION['cha1']+$_SESSION['cha2'];
            ?>
            User Name : <input type="text" name="User-name" size="20" maxlength="20" class="input-login" placeholder="Enter username" required/><br/>
            Password &nbsp;&nbsp;: <input type="password" name="password" size="20" maxlength="20" class="input-login" placeholder="Password" required/><br/>
            Security &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 
        <input class="input-login readonly" type="text" name="capcha1" size='1' style="width:20px;" readonly value="<?php echo $_SESSION['cha1']; ?>"> +
        <input class="input-login" type="text" name="capcha2" size='1' style="width:20px;" maxlength="2"> =
        <input class="input-login readonly" type="text" name="hasil" size='1' style="width:20px;" readonly value="<?php echo $_SESSION['hasil']; ?>">
        <br/> 
        <input type="submit" name="login" value="Login"  class="button_u" style="margin-right:20px;"/><div></div>
        <a href="../" class="button_c" style="padding-top:3px;height:19px;">Back to website<a>
        </form>
        	<?php
				$Tanggal = date("Y-m-d");
				$Jam     = date("H:i:s");
				$ip_cl  = getenv("REMOTE_ADDR");
				if(isset($_POST['login'])){						
					if(empty($_POST['capcha2'])){
						$msg = "Kode keamanan belum di isi";
						$oke = "id='error'";
					}else{		
						$cap1  = $_POST['capcha1'];
						$cap2  = $_POST['capcha2'];
						$hasil = $_POST['hasil'];
						$total = $cap1 + $cap2;
						if (md5($hasil)<>md5($total)){
							$msg = "Kode keamanan tidak sesuai";
							$oke = "id='error'";
						}else{
							$user = trim(htmlentities(mysql_real_escape_string($_POST['User-name'])));
							$pass = trim(htmlentities(mysql_real_escape_string($_POST['password'])));
							if(empty($nama) and empty($pass)){
								$msg = "User / Password masih kosong";
								$oke = "id='error'";
							}else{
								$Login_query  = mysql_query("select id_user,id_pass from user where id_user='$user'")or die (Myer);
								if(mysql_num_rows($Login_query)==0){
									$msg = "Data tidak ditemukan";
									$oke = "id='error'";
								}else{
									$Login_result = mysql_fetch_array($Login_query);
									if($Login_result[1]<>md5($pass)){										
										$msg = "Password tidak sesuai";
										$oke = "id='error'";
									}else{
										$key = md5($ip_cl.$Tanggal.$Jam.$user);
										$_SESSION['key']=$key;
										$sintak = "insert into user_log (tanggal,login,user_id,ip,key_log) values ('$Tanggal','$Jam','$user','$ip_cl','$key')";
										$insert_log_user  = mysql_query($sintak);
										if($insert_log_user){
											$msg = "Berhasil";
											$oke = "id='oke'";
											$_SESSION['User_admin']=$user;	
											$_SESSION['Key_admin']=$key;												
											echo '<script language="javascript">';
										 	echo 'window.location.href="halaman.php";';
										 	echo '</script>';
										}else{
											$msg = "Terjadi Error Pada saat simpan data ".$sintak;
											$oke = "id='error'";
										}
									}
								}
							}
						}
					}
					echo '<div '.$oke.'>'.$msg.'</div>';
				}
			?>
        </div>    
    </div>
    <div id="admin-bot" class="courier">
    	<?php
			$query_hdr = "where id='company'";
			$header = mysql_query("select * from profile ".$query_hdr) or die(mysql_error());
			$header_content=mysql_fetch_array($header);
				echo $header_content['content'].", Copyright &copy 2015 - All Right Reserved";
		?>
    </div>
</body>
</html>