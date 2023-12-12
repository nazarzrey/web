
<script>
window.onload = function() {
  document.getElementById("qrinput").focus();
};
</script>
<body style="margin:auto;width:100%;text-align:center;">
<?php
/*function get_current_url($s, $use_forwarded_host=false)
{
    $ssl = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on') ? true:false;
    $sp = strtolower($s['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port = $s['SERVER_PORT'];
    $port = ((!$ssl && $port=='80') || ($ssl && $port=='443')) ? '' : ':'.$port;
    $host = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
    $host = isset($host) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;# . $s['REQUEST_URI'];
}*/
#echo generateRandomString();
#echo $randomNumber = izrand(32, true); // generates 32 digit number as string 
#echo $randomAlphaNumeric = izrand(); // generates 32 digit alpha numeric string
?>
<h1>Auto genereate QR with sort link</h1>
<h3>and save to dateabase</h3>
 <form method="post" action="" >
    Size : 
    <select name="number" style="padding:5px">
        <?php 
        if(isset($_POST["number"])){
            echo "<option value='".$_POST["number"]."'>".$_POST["number"]."</option>";
        }else{
            echo "<option value='4'>4</option>";
        }
        ?>
        <?php
            for($xz=1;$xz<=20;$xz++){
                echo "<option value='$xz'>$xz</option>";
            }
        ?>
    </select> Url : 
    <input type="link" name="qrinput" id="qrinput" style="width:60%;padding:5px" autocomplete="off" placeholder="input URL here" value="https://siswa.nurulkarimah.sch.id/qrlogin/"/>
    <input type="submit" name="submit" value="Generate QR Barcode" style="padding:5px" />
 </form>
 <div style="text-align: left;margin-left:10%">
 <?php
 
function izrand($length = 32, $numeric = false) {

    $random_string = "";
    while(strlen($random_string)<$length && $length > 0) {
        if($numeric === false) {
            $randnum = mt_rand(0,61);
            $random_string .= ($randnum < 10) ?
                chr($randnum+48) : ($randnum < 36 ? 
                    chr($randnum+55) : $randnum+61);
        } else {
            $randnum = mt_rand(0,9);
            $random_string .= chr($randnum+48);
        }
    }
    return $random_string;
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 5; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
function right($value,$num){
	#$value." </br>";
	$len = strlen($value);
	$rms = $len - $num;
	$has = substr($value,$rms,$num);
	return $has;
}
    $link = "https://siswa.nurulkarimah.sch.id/qrlogin/";
 	$sql    = "SELECT siswa_id,siswa_nama as nama,siswa_qr , qr_recid , CONCAT('".$link."',siswa_qr) AS link FROM tbl_siswa";
 	$qrpath = "../gallery/";
 	$qrname = date("ymdhis"); 	
    include "qrlib.php";    
    $mysqli = new mysqli("localhost:3308","root","toor","nk");
    $errorCorrectionLevel = 'L';

	// Check connection
	if ($mysqli -> connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
	  exit();
	}
	$ukuran = "3";
	// Perform query
	if ($result = $mysqli -> query($sql)) {
	  while($row = $result->fetch_assoc()) {
	  	$qrname2 = "qr".substr($row["siswa_qr"],0,15).".png";
	  	$file    = $qrpath.$qrname2;
	  	if($row["qr_recid"]=="1"){
	  		echo $row["nama"]." img qr : ".$row["qr_recid"];
	  		echo "<br/>";
	  	}else{
		  	if(!file_exists($file)){
			  	echo $upd = "update tbl_siswa set qr_recid='0' where siswa_id='$row[siswa_id]'";
			  	if($mysqli->query($upd)){
			  		QRcode::png($row["link"], $file, $errorCorrectionLevel, $ukuran, 1);
			  	}	
		  	}else{
		  	 	$upd = "update tbl_siswa set qr_recid='1' where siswa_id='$row[siswa_id]'";  		
                if($mysqli->query($upd)){
                    echo "suskess.</br>";
                }
		  	}
		}
	  }
	  // Free result set

	  $result -> free_result();
	}

	$mysqli -> close();


 if(!isset($_POST["submit"])){
     die();
 }
 
require_once "config.lib.php";
$db 	= new Db();
 $post = $_POST["qrinput"];
 $size = $_POST["number"];
 if(strlen($post)==0){
     die("data masih kosong ");
 }
    if (strpos($post, "http") === false) {
        die("must insert link");
    }
    $data = $post;
    $keys   = randomPassword();
    $lampiran = $db->escape($post);
    echo "<b>Generate qr barcode for attch</b><br/> $lampiran<hr/>";
    
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    
    $filename = $PNG_TEMP_DIR.'test.png';
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'L';
    $matrixPointSize = $size;
    if (isset($data)) { 
        if (trim($data) == ''){
            die('data cannot be empty! <a href="?">back</a>');
        }
        
        #$http   = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
        #$path   = $http.$_SERVER['HTTP_HOST']."/qr/";
        
        $filename = $PNG_TEMP_DIR.'azaf'.md5(date("Y-m-d H:i:s").'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        if(stripos($data,"goo.gl") !== false || stripos($data,"google") !== false || stripos($data,"youtu") !== false){
            QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
        }else{
            QRcode::png($path.$keys, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        }
        
    }   
    echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';  

    ?>
    </div>
    </body>
