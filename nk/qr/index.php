<?php
function insert($keys,$url){
	global 	$db,$path;
	$select = "select 1 from qr_direct where data_uniq='$keys'";
	$insert = "insert into qr_direct (data_uniq,data_url,updrec_date)values ('$keys','$url',now())";
	if(count($db->select($select))==0){
		if($db->query($insert)){
			echo "share this link bellow <br/><a href='".$path.$keys."'>".$path.$keys."</a>";
		}else{
			echo "error generate QR";
		}
	}elseif(count($db->select($select))==1){
		$new_keys = randomPassword();
		insert($new_keys,$url);
	}else{				
		echo "error generate QR";
	}
}
	if(isset($_GET["kode"])){
		require_once "config.lib.php";
		$db 	= new Db();
		$kode 	= $db->escape($_GET["kode"]);
		//$path   = $http.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."/";
		//$path   = $http.$_SERVER['HTTP_HOST']."/agencyfish/qr/";
		if(strtolower($kode=="create")){
			require_once "create.php";
			$file   = $filename;
			$url    = $post;
			insert($keys,$url);
		}else{
			$ip   	= "";
			$med	= "1366x768";
			$brs 	= "chrome";
			$cek    = "SELECT IFNULL((SELECT data_url FROM qr_direct WHERE data_uniq='$kode'),'X') AS result";
			if($db->select($cek)[0]["result"]=="X"){
				$result = "X";
			}else{
				$url = $db->select($cek)[0]["result"];
				$ins = "INSERT INTO qr_data (qr_id,DATE,ipaddr,browser,media,updrec_date) SELECT id,CURDATE(),'$ip','$brs','$med',NOW() FROM qr_direct WHERE data_uniq='$kode'";
				if($db->query($ins)){
					$result = "Y";
				}else{
					$result = "X";
				}
			}
		//  echo $db->select($cek)[0]["result"];
		// 	$sintak = "CALL qrcode('$kode','$ip','$med','$brs')";
		// 	$query  = $db->select($sintak);
		// 	#var_dump($query);
		// 	$url 	= $query[0]["url"];
			if($result!='X'){
				//<meta http-equiv='refresh' content='0;URL=$url'>
				#echo "<a href='$url'>goto page</a><br/>";
				#echo $url;
				echo "			    
			    <script type='text/javascript'>
			      window.location.href='$url';
			    </script>";
			}else{
				echo "data not found..!";
			}
		}
	}
?>