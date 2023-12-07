<?php
if (!isset($_SESSION)) {
	session_start();
	if (isset($_SESSION['key'])) {
		echo '<script language="javascript">';
		echo 'window.location.href="admin_page.php";';
		echo '</script>';
	}
	require_once "../seting/config_db.php";
	require_once "../seting/config_web.php";
	require_once "../seting/browser.php";
	$db = new Db();
}
$path_img_default 	= "../gambar/";
function ready_profile($field)
{
	global $Ms_id, $db;
	$cek_data = "select deskripsi from profile_web where jenis='$field'";
	$hsl_data = $db->select($cek_data);
	return $hsl_data[0]["deskripsi"];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0, user-scalable=no" />
	<link href="../gaya/dialog.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="gaya/default_admin.css" rel="stylesheet" type="text/css">
	<link href="../gaya/default.css" rel="stylesheet" type="text/css">
	<link href="../gaya/menu.css" rel="stylesheet" type="text/css">
	<link href="../gaya/slides.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="../skrip/dialog.js"></script>
	<script type="text/javascript" src="../skrip/jquery.min.js"></script>
	<script type="text/javascript" src="../skrip/jquery-ui.min.js"></script>
	<!-- <script src='https://www.google.com/recaptcha/api.js'></script> -->

	<script type="text/javascript">
		$(document).ready(function() {
			$("#username").focus();
		})

		function buatjam() {
			var date = new Date();
			var h = date.getHours();
			var i = date.getMinutes();
			var s = date.getSeconds();
			var y = date.getFullYear();
			var d = date.getDate();
			var m = date.getMonth() + 1;

			h = cek(h);
			m = cek(m);
			s = cek(s);
			i = cek(i);
			y = cek(y);
			d = cek(d);

			document.getElementById("jam").innerHTML = d + "-" + m + "-" + y + " " + h + ":" + i + ":" + s;
			setTimeout("buatjam()", 1000);
		}

		function cek(x) {
			if (x < 10) {
				x = "0" + x;
			}
			return x;
		}

		function isNumberKey(evt) {
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57))
				return false;
			return true;
		}
	</script>
	<title>CV.MITRA KARYA MANDIRI, Kontraktor Bored Pile, Bore pile, straus pile</title>
</head>

<body onload="buatjam()">
	<div id="container">
		<div style="background:#006ab4;height:5px;box-shadow:1px 1px 5px #ccc;"></div>
		<div id="header" style="margin:0;box-shadow:0 0 5px #999">
			<div id="logo">
				<div id="profile_img">
					<img src="<?= $path_img_default . ready_profile("icon"); ?>" class="logo_img">
				</div>
				<div id="profile_text">
					<div class="tridi">
						<?= ready_profile("profile1"); ?><br />
						<?= ready_profile("profile2"); ?><br />
						<?= ready_profile("profile3"); ?><br />
						<?= ready_profile("profile4"); ?>
					</div>
				</div>
			</div>
			<div id="profile_menu">
				<div id="jam" style="color:#fefefe;text-align:center;padding:2px;margin:0"></div>
			</div>
		</div>
		<div id="content" style="background:none;height:auto;min-height:auto;">
			<div class="form_login">
				<div class="img_form">
					<img src="../gambar/lock.png" class="img_form_dtl">
				</div>
				<div class="form_login_content" style="margin:auto;padding:5px">
					<div class="login_text">
						<b style="font-size:20px">Administrator</b><br />
						Silahkan login untuk mengakses menu
					</div>
					<form class="input_login" method="post" action="">
						<input type='text' class='input w100' style="padding:10px;" required name='username' id='username' maxlength="20" autocomplete="off" placeholder="Username" value="<?php if (isset($_POST["simpan"])) {
																												echo escape($_POST["username"]);
																											} ?>" />
						<p />
						<input type='password' class='input w100' style="padding:10px;" required name='userpass' id='userpass' maxlength="20" autocomplete="off" placeholder="Password" value="" />
						<p />
						<?php
						$_SESSION['cha1'] = rand(1, 20); //mendapatkan nilai 1
						$_SESSION['cha2'] = rand(1, 20); //mendapatkan nilai 2
						$_SESSION['hasil'] = $_SESSION['cha1'] + $_SESSION['cha2'];
						?>
						<div style="float:left;margin-bottom:10px;">
							<input class="input wx35  button4 tengah" style="color:green;" name="key1" value="<?= $_SESSION['cha1']; ?>" readonly> +
							<input type="text" class="input wx35 tengah" maxlength="2" name="key2" onkeypress="return isNumberKey(event)" pattern="[0-9]+([,\.][0-9]+)?" required value="<?php #echo $_SESSION['cha2']; 
																											?>">
							=
							<input class="input wx35 tengah button4" style="color:green;" name="key3" value="<?= $_SESSION['hasil']; ?>" readonly>
						</div>
						<!--
					<div class="g-recaptcha"  data-sitekey="6LcQWx8TAAAAAFjdSpw0rQgQD_w06j9Vq_B9Tx6K" style='transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;width:100px;height:60px;'></div>
					<p/>
					-->
						<input type='submit' class='input w100 button3' name='simpan' id='simpan' value="L o g i n" />
					</form>
					<a href="../" class="more_x">Kembali</a>
					<?php
					if (isset($_POST["simpan"])) {
						$user_name =  escape($_POST["username"]);
						$pass_pass =  escape($_POST["userpass"]);
						if (empty($user_name) and empty($pass_pass)) {
							$Msg = "Username / password masih kosong";
						} else { /* 
							if(isset($_POST['g-recaptcha-response'])){
								$captcha=$_POST['g-recaptcha-response'];
							}else{			
								return;
								exit;
								die();
							}
							$privatekey = "6LcQWx8TAAAAAOFu4FoIqOKuv-F1c6vl7hmV8D_2";
							$response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$privatekey."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
							if($response['success'] == false){
							  $Msg = 'wrong Capcha are you robot...';
							}else{
										
								 */
							$cap1  = escape($_POST['key1']);
							$cap2  = escape($_POST['key2']);
							$hasil = escape($_POST['key3']);
							$total = $cap1 + $cap2;
							if (md5($hasil) <> md5($total)) {
								$Msg = "Kode keamanan tidak sesuai";
							} else {
								$user_name =  $_POST["username"];
								$pass_pass =  $_POST["userpass"];
								$pass  = encrypt_pass(md5($pass_pass));
								$query = $db->select("select * from master_user where user_name='$user_name' and password='$pass'");
								if (count($query) == 1) {
									$sintak     = $query[0];
									$status     = $sintak["aktif"];
									if ($status != 'Y') {
										$Msg = "User anda tidak aktif, hubungi admin";
									} else {
										$id_user   	= $sintak["id_user"];
										$nama      	= substr($sintak["nama"], 0, 30);
										$user_grup 	= $sintak["user_grup"];
										$user_telp	= $sintak["telp"];
										$ip		   	= getenv("REMOTE_ADDR");
										$browser    = $browser_name;
										$tgl = date("Y-m-d H:i:s");
										$key = md5($ip . $tgl . $id_user . $nama . $browser);
										$_SESSION['user_id'] = $id_user;
										$_SESSION['nama'] = $nama;
										$_SESSION['telp'] = $user_telp;
										$_SESSION['grup'] = $user_grup;
										$_SESSION['key'] = $key;
										$insert = "insert into user_log (sesi,login,ip_komputer,browser,id_user,nama,grup) value ('$key','$tgl','$ip','$browser_name','$id_user','$nama','$user_grup')";
										if ($db->query($insert)) {
											$Msg = "Y";
										} else {
											$Msg = "Error Query please try again ";
										}
									}
								} else {
									$Msg = "Username / password tidak terdaftar";
								}
							}
						}
						if ($Msg == "Y") {
					?>
							<META http-equiv="refresh" content="0;URL=admin_page.php">
						<?php
							/*
							<script>	
								alert("sukses");
								setTimeout(
									function() {
										window.location.href="admin_page.php";	
									},
								500);
							</script> 
							*/
						} else {
						?>
							<script>
								alert("<?= $Msg; ?>");
							</script>
					<?php
						}
					}
					?>
				</div>
			</div>
		</div>
		<!--
	<div id="footer" style="position:fixed;bottom:0;">
		<div class="footer">
			<div class="footer_dtl">
			</div>
			<div class="footer_dtl">
				Footer2
			</div>
			<div class="footer_dtl">
				Footer3
			</div>
		</div>
	</div>
	-->
	</div>
</body>

</html>