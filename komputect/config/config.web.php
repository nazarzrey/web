<?php
date_default_timezone_set('Asia/Jakarta');  
error_reporting(E_ALL ^ E_DEPRECATED);
class Db {
    // The database connection
    protected static $connection;

    /**
     * Connect to the database
     * 
     * @return bool false on failure / mysqli MySQLi object instance on success
     */
    public function connect() {    
        // Try and connect to the database
        if(!isset(self::$connection)) {
            #self::$connection = new mysqli('agencyfish.com','agency_C0LoUr5','C0LoUR$1D@2R3Y','agency_cLoW');
          self::$connection = new mysqli(Z_Host,Z_Users,Z_Pass,Z_Db,Z_Port);      
            #self::$connection = new mysqli('localhost','garuda_C0LoUr5C0','C0LoUR$1D@2R3Y','garuda_cLot3W');
        }

        // If connection was not successful, handle the error
        if(self::$connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
            return false;
        }
        return self::$connection;
    }

    /**
     * Query the database
     *
     * @param $query The query string
     * @return mixed The result of the mysqli::query() function
     */
    public function query($query) {
        // Connect to the database
        $connection = $this -> connect();

        // Query the database
        $result = $connection -> query($query);

        return $result;
    }

    /**
     * Fetch rows from the database (SELECT query)
     *
     * @param $query The query string
     * @return bool False on failure / array Database rows on success
     */
    public function select($query) {
        $rows = array();
        $result = $this -> query($query);
        if($result === false) {
            return false;
        }
        while ($row = $result -> fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    /**
     * Fetch the last error from the database
     * 
     * @return string Database error message
     */
    public function error() {
        $connection = $this -> connect();
        return $connection -> error;
    }

    /**
     * Quote and escape value for use in a database query
     *
     * @param string $value The value to be quoted and escaped
     * @return string The quoted and escaped string
     */
    public function quote($value) {
        $connection = $this -> connect();
        return "'" . $connection -> real_escape_string($value) . "'";
    }
    public function escape($value) {        
        $connection = $this -> connect();
        return $connection -> real_escape_string($value);
    }
}
function exif_data($exif){  
  $db       = new Db();
  $sintak   = "select exif_data from photo_exif where exif_key='".$exif."'";
  $rows     = $db -> select($sintak);
  if(count($rows)>0){
    $explode = explode("|",$rows[0]["exif_data"]);
    echo "<table>";
    foreach($explode as $pecah){
        echo "<tr>";
        $pisah = explode("#",$pecah);       
        foreach($pisah as $has){
          echo "<td>$has</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
  }else{
    echo "exif data not found";
  }
  //if(count($db->rows)>0){
   # echo $rows["exif_data"];
  //}
  /*
  $exif = exif_read_data($img, "FILE,COMPUTED,ANY_TAG,IFD0,THUMBNAIL,COMMENT,EXIF", true);
  #echo "$img:<br />\n";
  #$exif[""]
  echo "<table>";
  foreach ($exif as $key => $section) {
      foreach ($section as $name => $val) {
          #echo "$key.$name: $val<br />\n";          
          #echo "<tr><td>$key.$name</td><td>$val</td></tr>";
          if(is_array($val)){
            echo "<tr><td>".ucwords(strtolower($name))."</td><td>";
            foreach($val as $value){
              echo $value;
            }
            echo "</td></tr>";
          }else{
            echo "<tr><td>".ucwords(strtolower($name))."</td><td>".strtolower($val)."</td></tr>";
          }
      }
  }
  echo "</table>";*/
}

function toDecimal($deg, $min, $sec, $hem) 
{
    $d = $deg + ((($min/60) + ($sec/3600))/100);
    return ($hem=='S' || $hem=='W') ? $d*=-1 : $d;
}

function no(){
  echo "<meta http-equiv='refresh' content='0;URL=404.html' />";
}
// get geo-data from image
function get_image_location($file) {
    if (is_file($file)) {
        $info = exif_read_data($file);
        if ($info !== false) {
            $direction = array('N', 'S', 'E', 'W');
            if (isset($info['GPSLatitude'], $info['GPSLongitude'], $info['GPSLatitudeRef'], $info['GPSLongitudeRef']) &&
                in_array($info['GPSLatitudeRef'], $direction) && in_array($info['GPSLongitudeRef'], $direction)) {

                $lat_degrees_a = explode('/',$info['GPSLatitude'][0]);
                $lat_minutes_a = explode('/',$info['GPSLatitude'][1]);
                $lat_seconds_a = explode('/',$info['GPSLatitude'][2]);
                $lng_degrees_a = explode('/',$info['GPSLongitude'][0]);
                $lng_minutes_a = explode('/',$info['GPSLongitude'][1]);
                $lng_seconds_a = explode('/',$info['GPSLongitude'][2]);

                $lat_degrees = $lat_degrees_a[0] / $lat_degrees_a[1];
                $lat_minutes = $lat_minutes_a[0] / $lat_minutes_a[1];
                $lat_seconds = $lat_seconds_a[0] / $lat_seconds_a[1];
                $lng_degrees = $lng_degrees_a[0] / $lng_degrees_a[1];
                $lng_minutes = $lng_minutes_a[0] / $lng_minutes_a[1];
                $lng_seconds = $lng_seconds_a[0] / $lng_seconds_a[1];

                $lat = (float) $lat_degrees + ((($lat_minutes * 60) + ($lat_seconds)) / 3600);
                $lng = (float) $lng_degrees + ((($lng_minutes * 60) + ($lng_seconds)) / 3600);
                $lat = number_format($lat, 7);
                $lng = number_format($lng, 7);

                //If the latitude is South, make it negative. 
                //If the longitude is west, make it negative
                $lat = $info['GPSLatitudeRef'] == 'S' ? $lat * -1 : $lat;
                $lng = $info['GPSLongitudeRef'] == 'W' ? $lng * -1 : $lng;

                return array(
                    'lat' => $lat,
                    'lng' => $lng
                );
            }
        }else{
          return "can't read picture";
        }
    }

    return false;
}
/**
 * Returns an array of latitude and longitude from the Image file
 * @param image $file
 * @return multitype:number |boolean
 */
function read_gps_location($file){
    if (is_file($file)) {
        $info = exif_read_data($file);
        if (isset($info['GPSLatitude']) && isset($info['GPSLongitude']) &&
            isset($info['GPSLatitudeRef']) && isset($info['GPSLongitudeRef']) &&
            in_array($info['GPSLatitudeRef'], array('E','W','N','S')) && in_array($info['GPSLongitudeRef'], array('E','W','N','S'))) {

            $GPSLatitudeRef  = strtolower(trim($info['GPSLatitudeRef']));
            $GPSLongitudeRef = strtolower(trim($info['GPSLongitudeRef']));

            $lat_degrees_a = explode('/',$info['GPSLatitude'][0]);
            $lat_minutes_a = explode('/',$info['GPSLatitude'][1]);
            $lat_seconds_a = explode('/',$info['GPSLatitude'][2]);
            $lng_degrees_a = explode('/',$info['GPSLongitude'][0]);
            $lng_minutes_a = explode('/',$info['GPSLongitude'][1]);
            $lng_seconds_a = explode('/',$info['GPSLongitude'][2]);

            $lat_degrees = $lat_degrees_a[0] / $lat_degrees_a[1];
            $lat_minutes = $lat_minutes_a[0] / $lat_minutes_a[1];
            $lat_seconds = $lat_seconds_a[0] / $lat_seconds_a[1];
            $lng_degrees = $lng_degrees_a[0] / $lng_degrees_a[1];
            $lng_minutes = $lng_minutes_a[0] / $lng_minutes_a[1];
            $lng_seconds = $lng_seconds_a[0] / $lng_seconds_a[1];

            $lat = (float) $lat_degrees+((($lat_minutes*60)+($lat_seconds))/3600);
            $lng = (float) $lng_degrees+((($lng_minutes*60)+($lng_seconds))/3600);

            //If the latitude is South, make it negative. 
            //If the longitude is west, make it negative
            $GPSLatitudeRef  == 's' ? $lat *= -1 : '';
            $GPSLongitudeRef == 'w' ? $lng *= -1 : '';

            return array(
                'lat' => $lat,
                'lng' => $lng
            );
        }           
    }
    return false;
}

function halaman($url,$action){ 
  if($action!="N"){
    $REQUEST_URI =  str_replace("/".basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)),"",$_SERVER["REQUEST_URI"]);
  }else{  
    $REQUEST_URI =  $_SERVER["REQUEST_URI"];
  }
  if(strtolower($url)=="get_uri"){
  $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
    if ($_SERVER["SERVER_PORT"] != "80")
    {
      $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$REQUEST_URI;
    } 
    else 
    {
      $pageURL .= $_SERVER["SERVER_NAME"].$REQUEST_URI;
    }
  }else{    
    $pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
    if ($_SERVER["SERVER_PORT"] != "80")
    {
      $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
    } 
    else 
    {
      $pageURL .= $_SERVER["SERVER_NAME"];
    }
  }
  return $pageURL;
}
function rows($query){
    $db       = new Db();
    $rows     = $db -> select($query);
    return count($rows);
}
function get_title($url,$lang,$tbl){
    $db       = new Db();    
    $url      = $db -> escape($url);
    $sintak   = "select title_".$lang." from $tbl where url='$url'";
    $language = $db -> select($sintak);
    if($language){
      return $language[0]["title_".$lang]; 
    }else{
      return "no title result";
    }
}
function get_content($url,$lang,$tbl){
    $db       = new Db();    
    $url      = $db -> escape($url);
    $sintak   = "select content_".$lang."  from $tbl where url='$url'";
    $language = $db -> select($sintak);
    if($language){
      return $language[0]["content_".$lang]; 
    }else{
      return "no content result ";
    }  
}
function get_judul($id,$lang){
    $db       = new Db();    
    $id      = $db -> escape($id);
    $sintak   = "select content_".$lang."  from content_language where id='$id'";
    $language = $db -> select($sintak);
    if($language){
      return $language[0]["content_".$lang]; 
    }else{
      return "no result ";
    }  
} 
function get_release($url,$lang){
    $db       = new Db();    
    $url      = $db -> escape($url);
    $sintak   = "select content_release from act where url='$url'";
    $result   = $db -> select($sintak);
    if(count($result)>0){
      return "
            <div>
              <a class='next_button mouse' href='http://agencyfish.com/page/".$result[0]["content_release"]."'>
                  ".get_judul("6",$lang)."             
              </a>
            </div>";
    }  
}
function get_media($url,$type,$tbl){
    $db       = new Db();    
    $url      = $db -> escape($url);
    $sintak   = "select media_name_url from content_media where media_id = (select id from $tbl where url='$url') and media_type='$type'";
    $result   = $db -> select($sintak);
    $output   = "";
    if($result){
      if(count($result)>0){
        if(strtolower($type)=="v"){
          $output = "<iframe width='560' height='315' src='".$result[0]["media_name_url"]."' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe>";
        }else{
          $output .= "<div id='act-gallery' >
                      <h1 class='scene-title'>BEHIND THE SCENE</h1>
                      <center>";
          foreach ($result as $has => $hasil) {
            $output .= "<div><img src='../assets/images/$tbl/sm_".$hasil["media_name_url"]."' class='pop'/></div>";
          }
          $output .= "</center></div>";
        }
      }
    }
    return $output;
}
function next_prev($url,$tipe,$tbl){
    $db     = new Db();
    $url    = $db -> escape($url);
    $script = " select (select url FROM $tbl WHERE id < (select id from $tbl where url='$url') and recid='y' ORDER BY id DESC LIMIT 1) as pf,
                       (select url FROM $tbl WHERE id > (select id from $tbl where url='$url') and recid='y' ORDER BY id ASC LIMIT 1) as nx";
    $query  = $db->select($script);
    if(!empty($query[0]["pf"])){
      #$prev = "href='press.php?release=".$query[0]["pf"]."'";
      $prev = "href='".$query[0]["pf"].".html'";
    }else{
      $prev = "";
    }
    if(!empty($query[0]["nx"])){
      #$next = "href='press.php?release=".$query[0]["nx"]."'";
      $next = "href='".$query[0]["nx"].".html'";
    }else{
      $next = "";
    }    
    if($tipe=="nx"){
      return $next;
    }else{
      return $prev;      
    }
}
function flag($lang){
  if($lang=="2nd"){
    echo '<img src="../assets/images/id.png" class="flag ina">';
  }else{
    echo '<img src="../assets/images/en.png" class="flag eng">';
  }
}
        
function get_url($lang,$id,$data_content){
  if(strtolower($id)=="x" || trim($id)==""){
    $get_id = "";
  }else{
    $get_id = " and lang_id='$id' ";    
  }  
  $db       = new Db(); 
  $sintak   = "select url from content_language where content='$data_content' $get_id ";
  $language = $db -> select($sintak);
  if($language){
    return strtolower($language[0]["url"]).".html"; 
  }else{
      return "home.html";
  }  
}
function gallery($img,$opt){
  $small_img = "gallery/small/".$img;
  if(strtolower($opt)=="sm"){
    if(file_exists($small_img)){
        $image = $small_img;
      }else{
        $image = "gallery/".$img;
        if(file_exists($image)){
            $image = $image;
          }else{
            $image = "assets/images/no_image.jpg";
          }
      }
  }else{    
    $image = "gallery/".$img;
    if(file_exists($image)){
        $image = $image;
      }else{
        $image = "assets/images/no_image.jpg";
      }
  }
  return str_replace("//", "/", $image);
}
function asset($img,$opt){
  $small_img = "assets/images/small/".$img;
  if(strtolower($opt)=="sm"){
    if(file_exists($small_img)){
        $image = $small_img;
      }else{
        $image = "assets/images/".$img;
        if(file_exists($image)){
            $image = $image;
          }else{
            $image = "assets/images/no_image.jpg";
          }
      }
  }else{    
    $image = "assets/images/".$img;
    if(file_exists($image)){
        $image = $image;
      }else{
        $image = "assets/images/no_image.jpg";
      }
  }
  return str_replace("//", "/", $image);
}
function get_img($img,$opt,$path){
  $small_img = "gallery/".$path."/small/".$img;
  if(strtolower($opt)=="sm"){
    if(file_exists($small_img)){
        $image = $small_img;
      }else{
        $image = "gallery/".$path."/".$img;
        if(file_exists($image)){
            $image = $image;
          }else{
            $image = "assets/images/no_image.jpg";
          }
      }
  }else{    
    $image = "gallery/".$path."/".$img;
    if(file_exists($image)){
        $image = $image;
      }else{
        $image = "assets/images/no_image.jpg";
      }
  }
  return str_replace("//", "/", $image);
}
function img_user($img,$opt){
  $small_img = "gallery/profile/small/".$img;
  if(strtolower($opt)=="sm"){
    if(file_exists($small_img) && strlen(trim($img))>0){
        #echo $img.$opt."Xxxxxx";
        $image = $small_img;
      }else{
        $image = "gallery/profile/".$img;
        if(file_exists($image) && strlen(trim($img))>0){
            $image = $image;
          }else{
            $image = "assets/images/profile.png";
          }
      }
  }else{
    $image = "gallery/profile/".$img;
    if(file_exists($image) && strlen(trim($img))>0){
        $image = $image;
      }else{
        $image = "assets/images/profile.png";
      }
  }
  return str_replace("//", "/", $image);
}
function img_cover($img,$opt){
  $small_img = "gallery/cover/small/".$img;
  if(strtolower($opt)=="sm"){
    if(file_exists($small_img)  && strlen(trim($img))>0){
        $image = $small_img;
      }else{
        $image = "gallery/cover/".$img;
        if(file_exists($image) && strlen(trim($img))>0){
            $image = $image;
          }else{
            $image = "assets/images/cover.jpg";
          }
      }
  }else{    
    $image = "gallery/cover/".$img;
    if(file_exists($image) && strlen(trim($img))>0){
        $image = $image;
      }else{
        $image = "assets/images/cover.jpg";
      }
  }
  return str_replace("//", "/", $image);
}
function encrypt_id($id){
  if(empty($id)){
    $id = md5(date("YmdH"));
  }
  $keyword = "adelia";
  $panjang_key  = strlen($keyword);
  $ins_key = $panjang_key;
  $hasil = "";
  for($key=0;$key<=$panjang_key;$key++){
    $rumus = $key*$ins_key;
    $hasil .= substr($keyword,$key,1).substr($id,$rumus,$ins_key);
  }
  //3252352-sdgds-sdgd-dsgs-sgs332fs3f
  #7,5,4,4;
  $hasil = substr($hasil,0,10)."-".substr($hasil,10,8)."-".substr($hasil,18,6)."-".substr($hasil,24,5)."-".substr($hasil,29,30);
  return trim($hasil);
}
function decrypt_id($id){
  $id    = str_replace("-","",$id);
  $keyword = "adelia";
  $panjang_key  = strlen($keyword);
  $ins_key = $panjang_key;
  $hasil = "";
  for($key=0;$key<=$panjang_key;$key++){
    $rumus = ($key*$ins_key);
      $char  = substr($keyword,$key,1); 
      $new = substr($id,$rumus,$ins_key);
      if(substr($id,$rumus,1)==$char){
        $hasil .= substr($id,$key+1,strlen($new));
      }else{
        $hasil .= substr($id,$rumus+$key+1,strlen($new));
      }
  }
  return $hasil;
}

function encrypt_pass($password){
  $keyword = "abizar";
  $panjang_key  = strlen($keyword);
  $panjang_pass = strlen($password);
  $ins_key = $panjang_key;
  $hasil = "";
  for($key=0;$key<=$panjang_key;$key++){
    $rumus = $key*$ins_key;
    $hasil .= substr($keyword,$key,1).substr($password,$rumus,$ins_key);
  }
  return $hasil;
}

function cek_insert($table,$column,$data,$msg){
    $db       = new Db(); 
    $sintak   = "select ".$column." from ".$table." where ".$column."='".$data."'";
    $rows     = $db -> select($sintak);
    if(count($rows)==0){
      $array =  array("Y","ok");
    }else{
      $array =  array("N","Email already exists");
    }
    return $array;
}
function cek_insert2($table,$column,$data,$column2,$data2,$msg){
    $db       = new Db(); 
    $sintak   = "select ".$column.",".$column2." from ".$table." where ".$column."='".$data."' and ".$column2."='".$data2."'";
    $rows     = $db -> select($sintak);
    if(count($rows)==0){
      $array =  array("N",$msg);
    }else{
      $array =  array("Y","ok");
    }
    return $array;
}
function insert_data($sk){
    $db       = new Db(); 
    $sintak   = $sk;
    $query     = $db -> query($sintak);
    if($query){
      $array =  array("Y","ok");
    }else{
      log_error($sintak);
      $array =  array("N","error query insert");
    }
    return $array;  
}
function msg($alert){
  echo "<script>alert('".$alert."')</script>";
}
function log_error($query){  
  $url       = halaman("get_uri","Y");
  $db        = new Db();    
  $erro      = $db -> escape($query);
  $skrip     = "insert into log_error values (now(),'$url','$erro')";
  $db ->query($skrip);
}
#login and page access
function login($tipe,$access){
  global $p_sign;  
  if(!isset($_SESSION['key'])){
    echo '<META http-equiv="refresh" content="0;URL='.$p_sign.'">';
  }else{
    if($access=="Y" && $tipe!="admin"){      
      echo '<META http-equiv="refresh" content="0;URL=home.html">';
    }
  }
}
function logout($key){
    $db     = new Db();
    $query  = "update log_user set  logout=now() where sesi='".$key."'";
    $rows   = $db -> query($query);
}
#bahasa    
function bahasa(){
    if(!isset($_SESSION)){
        session_start();
    }
    if(isset($_POST['bahasa'])){
        $_SESSION["bahasa"]=$_POST['bahasa'];
        $Lang=$_SESSION["bahasa"];
    }else{
        if(isset($_SESSION["bahasa"])){
            $Lang=$_SESSION["bahasa"];
        }else{                
            $Lang="en";
        }
    }
    return $Lang;
}
function get_bahasa($lang){
    $lang = strtolower($lang);
    if($lang=="en"){
        echo "<option value='en'>EN</option><option value='id'>ID</option>";
    }else{
        echo "<option value='id'>ID</option><option value='en'>EN</option>";
    }
}

function upload_image($data_img,$path_img){
	global $wmax1,$hmax1,$wmax3,$hmax3,$wmax5,$hmax5,$str_arr;
	$tmp_file 	= $data_img["tmp_name"];
	$random     = rand(1,999);
	$nama_file 	= str_replace(' ','',$data_img["name"]);
	$kaboom 	= explode(".", $nama_file); // Split file name into an array using the dot
	$fileExt 	= end($kaboom); // Now target the last array element to get the file extension
	$file_name	= strtolower(date("Ymdhis").$random.".".$fileExt);
	#$full_file 	= "full_".str_replace($str_arr,".",$file_name);
	$full_file 	= str_replace($str_arr,".",$file_name);
  $thumb_file = "small/".str_replace($str_arr,".",$file_name);
	$icon_file  = "small/".str_replace($str_arr,".",$file_name);
	#break;
	$upload_file = move_uploaded_file($tmp_file,$path_img.$file_name);	
	if($upload_file){
		/* 
		if($convert=="Y"){
			ak_img_resize($path_img.$file_name, $path_img.$full_file, $wmax1, $hmax1, $fileExt);
		} */
    $cropH  = "216";
    $cropW  = "216";
    $smallH = "400";
    $smallW = "400";
    if (strpos($path_img,"profile") !== false) {
      $cropH  = "216";
      $cropW  = "216";
    }elseif (strpos($path_img,"cover") !== false) {
      $cropH  = "223";
      $cropW  = "115";
    }
    $small = ak_img_resize($path_img.$file_name, $path_img.$thumb_file, $smallH, $smallW, $fileExt);
    $crop  = ak_img_thumb($path_img.$thumb_file, $path_img.$thumb_file, $cropH, $cropW, $fileExt);
		$result = $full_file;
	}else{			
		$result = "X";
	}	
	return $result;
}
function try_login($brs,$os,$ip,$post1){
  $db       = new Db();
  $insert   = "insert into try_login values (now(),'$brs','$os','$ip','$post1')";
  $rows     = $db -> query($insert);
}

function paragrap($sentence,$word_count){
  $space_count = 0;
  $print_string = '';
  for($i=0;$i<strlen($sentence);$i++){
    if($sentence[$i]==' ')
    $space_count ++;
    $print_string .= $sentence[$i];
    if($space_count == $word_count)
    break;
  }
  //#pakein ... klo lebih dari ketentuan
  if($word_count > $space_count ){
    return $print_string;
  }else{
    return trim($print_string)."...";
  }
}
function text($sentence,$word_count){
  $space_count = 0;
  $print_string = '';
  for($i=0;$i<strlen($sentence);$i++){
    if($sentence[$i]==' ')
    $space_count ++;
    $print_string .= $sentence[$i];
    if($space_count == $word_count)
    break;
  }
  return trim($print_string);
}
function alert($value){
  echo "<script>alert('$value')</script>";
}
function clearBrowserCache() {
    /*header("Pragma: no-cache");
    header("Cache: no-cache");
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: Mon, 9 Jul 1995 05:00:00 GMT");*//*
    echo '<meta http-equiv="Pragma" content="no-cache">
          <meta http-equiv="no-cache">
          <meta http-equiv="Expires" content="-1">
          <meta http-equiv="Cache-Control" content="no-cache">';*/
}
function cache($angka){
  $num = rand(1,30);
  if($angka<=10){    
    echo $num.date("di");
  }elseif($angka>10 || $angka<=20){    
    echo date("id").$num;
  }else{
    echo $num.date("id");
  }
}
function xpost($name,$value){
  $db = new Db;
  if(isset($_POST[$name])){
    echo $db->escape($_POST[$name]);
  }else{
    echo $value;
  }
}
function Num($dest)
{
    if ($dest)
        return ord(strtolower($dest)) - 96;
    else
        return 0;
}
function get_data_project($url,$column,$table){
  $db     = new Db();
  $sintak = "select $column from $table where url='$url'";
  $query  = $db->select($sintak);
  #var_dump($query);
  return $query[0][$column];
}
?>
