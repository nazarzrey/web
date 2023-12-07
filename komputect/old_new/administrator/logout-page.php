<?php
$jam = date("H:i:s");
$sx = "update user_log set logout='$jam' where key_log='$_SESSION[Key_admin]'";
//echo $sx;
mysql_query($sx) or die ("error ".mysql_error());
if(isset($_SESSION)) { 
		if(isset($_SESSION['User_admin']))
		{
			unset($_SESSION['Key_admin']);
			unset($_SESSION['User_admin']);
		}
//		echo $_SESSION['user'];		
	session_destroy();
}else{	
		if(isset($_SESSION['User_admin']))
		{
			unset($_SESSION['Key_admin']);
			unset($_SESSION['User_admin']);
		}
}
echo '<script language="javascript">';
echo 'window.location.href="index.php";';
echo '</script>';
?>