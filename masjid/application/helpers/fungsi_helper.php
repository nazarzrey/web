
<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



	if ( ! function_exists('debug'))
	{
		function debug($sintak)
		{
			echo "<pre style='position:fixed;z-index:999999999999;background:#ffffffc9'>".print_r($sintak,true)."</pre>";
		}
	}
	if ( ! function_exists('debug2'))
	{
		function debug2($sintak)
		{
			echo "<pre style='position:fixed;z-index:999999999999;background:#ffffffc9;right:0px'>".print_r($sintak,true)."</pre>";
		}
	}

	if ( ! function_exists('tgl_indo'))
	{
		function tgl_indo($tgl)
		{
			$ubah = gmdate($tgl, time()+60*60*8);
			$pecah = explode("-",$ubah);
			$tanggal = $pecah[2];
			$bulan = bulan($pecah[1]);
			$tahun = $pecah[0];
			return $tanggal.' '.$bulan.' '.$tahun;
		}
	}

	if ( ! function_exists('rome')){	
		function rome($num) {
		    // Be sure to convert the given parameter into an integer
		    $n = intval($num);
		    $result = ''; 
		 
		    // Declare a lookup array that we will use to traverse the number: 
		    $lookup = array(
		        'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 
		        'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 
		        'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1
		    ); 
		 
		    foreach ($lookup as $roman => $value)  
		    {
		        // Look for number of matches
		        $matches = intval($n / $value); 
		 
		        // Concatenate characters
		        $result .= str_repeat($roman, $matches); 
		 
		        // Substract that from the number 
		        $n = $n % $value; 
		    } 

		    return $result;
		}
	}
	if ( ! function_exists('bulan'))
	{
		function bulan($bln)
		{
			switch ($bln)
			{
				case 1:
					return "Januari";
					break;
				case 2:
					return "Februari";
					break;
				case 3:
					return "Maret";
					break;
				case 4:
					return "April";
					break;
				case 5:
					return "Mei";
					break;
				case 6:
					return "Juni";
					break;
				case 7:
					return "Juli";
					break;
				case 8:
					return "Agustus";
					break;
				case 9:
					return "September";
					break;
				case 10:
					return "Oktober";
					break;
				case 11:
					return "November";
					break;
				case 12:
					return "Desember";
					break;
			}
		}
	}

	if ( ! function_exists('day'))
	{
		function day($date)
		{
	    	$cnv = strtotime($date);
	    	$day = date('D', $cnv);
	    	return $day;
		}
	}
	if ( ! function_exists('rTags'))
	{
		function rTags($input)
		{
			$arr = array("'",'"',"~",";","$",">","<","?");
			return str_replace($arr," ",$input);
		}
	}

	if ( ! function_exists('nama_hari'))
	{
		function nama_hari($tanggal)
		{
			$ubah = gmdate($tanggal, time()+60*60*8);
			$pecah = explode("-",$ubah);
			$tgl = $pecah[2];
			$bln = $pecah[1];
			$thn = $pecah[0];

			$nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
			$nama_hari = "";
			if($nama=="Sunday") {$nama_hari="Minggu";}
			else if($nama=="Monday") {$nama_hari="Senin";}
			else if($nama=="Tuesday") {$nama_hari="Selasa";}
			else if($nama=="Wednesday") {$nama_hari="Rabu";}
			else if($nama=="Thursday") {$nama_hari="Kamis";}
			else if($nama=="Friday") {$nama_hari="Jumat";}
			else if($nama=="Saturday") {$nama_hari="Sabtu";}
			return $nama_hari;
		}
	}

	if ( ! function_exists('hitung_mundur'))
	{
		function hitung_mundur($wkt)
		{
			$waktu=array(	365*24*60*60	=> "tahun",
							30*24*60*60		=> "bulan",
							7*24*60*60		=> "minggu",
							24*60*60		=> "hari",
							60*60			=> "jam",
							60				=> "menit",
							1				=> "detik");

			$hitung = strtotime(gmdate ("Y-m-d H:i:s", time () +60 * 60 * 8))-$wkt;
			$hasil = array();
			if($hitung<5)
			{
				$hasil = 'kurang dari 5 detik yang lalu';
			}
			else
			{
				$stop = 0;
				foreach($waktu as $periode => $satuan)
				{
					if($stop>=6 || ($stop>0 && $periode<60)) break;
					$bagi = floor($hitung/$periode);
					if($bagi > 0)
					{
						$hasil[] = $bagi.' '.$satuan;
						$hitung -= $bagi*$periode;
						$stop++;
					}
					else if($stop>0) $stop++;
				}
				$hasil=implode(' ',$hasil).' yang lalu';
			}
			return $hasil;
		}
	}


	#custom function 
	if ( ! function_exists('tipe_user')){
		function tipe_user($tipe,$utipe){
			if($utipe=="super"){
				$arr  = array("super","admin","user");
			}else{
				$arr  = array("admin","user");
			}
			if($tipe!=""){
				$arr2 = array($tipe);
				foreach ($arr as $key => $value) {
					if($value!=$tipe){
						$arr2[] = $value;
					}
				}
			}else{
				foreach ($arr as $key => $value) {
					$arr2[] = $value;
				}
			}
			return $arr2;
		}
	}

	if ( ! function_exists('key_first')){
		function key_first(array $array){
			foreach ($array as $key => $value) { return $key; }
		}
	}
	if ( ! function_exists('db_array')){
		function db_array($array,$tipe){
			#debug($array);
			if($tipe=="select"){
				if(!is_array($array)){
					$result = "";
				}else{
					$result = "";
					$x=0;
					foreach ($array as $key => $value) {
						if($x==0){
							$where = " where ";
						}else{
							$where = " and ";
						}
						$result .= $where.$key."='".$value."'";
						$x++;
					}
				}
			}elseif($tipe=="update"){
				$result = "set ";
				$x=1;
				$z=count($array);
				#debug(key_first($array));
				foreach ($array as $key => $value) {
					if($x==$z){
						$where = " where ".key_first($array)."='".array_values($array)[0]."'";
					}else{
						$where = ",";
					}
					if($x!=1){
						$result .= $key."='".$value."'".$where;
					}
					$x++;
				}
			}elseif($tipe=="insert"){
				$result = "";
				$kolom  = "";
				$data   = "";
				$x=1;
				$z=count($array);
				foreach ($array as $key => $value) {
					if($x==1){
						$where = "(";
						$were  = "";
					}elseif($x==$z){
						$where = ",";
						$were  = ")";						
					}else{
						$where = ",";
						$were  = "";
					}
					$kolom .= $where.$key.$were;
					$data  .= $where."'".$value."'".$were;
					$x++;
				}
				$result = $kolom." values ".$data;
			}elseif($tipe=="delete"){
				$result = "";
				$x=0;
				foreach ($array as $key => $value) {
					if($x==0){
						$where   = " where ";
						$result .= $where.$key."='".$value."'";
					}else{
						$result .= "";
					}
					$x++;
				}
			}
			return $result;
		}
	}
	if ( ! function_exists('kordinat')){
		function kordinat($longlat){
			$total = substr_count($longlat,".") + substr_count($longlat,",");
			if($total==3){
				return "1";
			}else{
				return "0";
			}
		}
	}
	if ( ! function_exists('jasal')){
		function jasal($jasal){
			if($jasal=="jalan"){
				$img = "assets/img/jalan.jpg";
				#$img = "assets/img/hery.png";
			}else{
				$img = "assets/img/saluran.jpg";
			}
			return base_url($img);
		}
	}
	if ( ! function_exists('get_img')){
		function get_img($path,$image,$tipe){
			if(file_exists($path.$image)){
				if($tipe=="big"){
					$img = $path.$image;
				}else{
					if(file_exists($path."thumb-".$image)){
						$img = $path."thumb-".$image;
					}else{
						$img = $path.$image;
					}
				}
			}else{
				$img = "assets/img/noimage.png";
			}
			return base_url($img);
		}
	}
	if ( ! function_exists('nolnul')){
		function nolnul($value){
			if($value=="0"){
				$val = "";
			}else{
				$val = $value;
			}
			return $val;
		}
	}
	if ( ! function_exists('ttl')){
		function ttl($query){
			echo count($query);
		}
	}
	if ( ! function_exists('magz_img')){
		function magz_img($img_path){
			if(file_exists($img_path)){
				$img = $img_path;
			}else{
				$img = "assets/images/nomagz.png";
			}
			return base_url($img);
		}
	}
	if ( ! function_exists('get_cover')){
		function get_cover($img_path){
			if(file_exists($img_path)){
				$img = base_url($img_path);
			}else{
				$img = "x";
			}
			return $img;
		}
	}

	if ( ! function_exists('all_query')){
	    function all_query($sql){              
	      if($sql->num_rows()>1){
	        $result =  result_query($sql);    
	      }else{
	        if($sql->num_rows()!=0){
	          $result =  array(single_query($sql));    
	        }else{
	          $result = "";          
	        }
	      }
	      return $result;
	    }
	}
	if ( ! function_exists('each_query')){
		function each_query($sintak){
			$query  = $sintak;
	  		if($query){
	  			if(count($query->result())==0){
	  				// direct("404");
	  				// die();
	  				$result = "";
	  			}else{
		  			foreach ($query->result() as $row) {
		  				$result[] = $row;
		  			}
		  			return $result;
	  			}
	  		}
		}
	}
	if ( ! function_exists('single_query')){
		function single_query($sintak){
			$query  = $sintak;
	  		if($query){
	  			if(count($query->result())==0){
	  				// direct("404");
	  				// die();
	  				$result = "";
	  			}else{
	  				$result = $query->result()[0];
	  			}
	  		}else{
	  			$result = "not found";
	  		}
	  		return $result;
		}
	}
	if ( ! function_exists('result_query')){
		function result_query($sintak){
			$query  = $sintak;
			#echo h3($query->num_rows()."xxx".count($query->result()));
	  		if($query){
	  			#echo h3(count($query->result()));
	  			if($query->num_rows()==0){
	  				$result = "";
	  			}elseif($query->num_rows()==1){
	  				$result = $query->result()[0];	
	  			}else{
		  			foreach ($query->result() as $row) {
		  				$result[] = $row;
		  			}
		  			return $result;
	  			}
	  		}else{
	  			$result = "not found";
	  		}
	  		return $result;
		}
	}

	if ( ! function_exists('number')){
		function number($no){
			return str_replace(",","",str_replace(".","",$no));
		}
	}

	if ( ! function_exists('admin_url'))
	{
		function admin_url($url){
			return base_url('admin/'.$url);
		}
	}
	if ( ! function_exists('assets'))
	{
		function assets($url){
			return base_url('assets/'.$url);
		}
	}
	if ( ! function_exists('adm_assets'))
	{
		function adm_assets($url){
			return base_url('assets/admin/'.$url);
		}
	}
	if ( ! function_exists('magz'))
	{
		function magz($url){
			return base_url('magazine/'.$url);
		}
	}

	if ( ! function_exists('left')){
		function left($str, $length) {
			 return substr($str, 0, $length);
		}
	}
	if ( ! function_exists('right')){
		function right($str, $length) {
			 return substr($str, -$length);
		}
	}
	if ( ! function_exists('direct')){
		function direct($url){
	  		echo "<meta http-equiv='refresh' content='0;URL=".base_url("404")."' />";
		}
	}

	if ( ! function_exists('h3')){
		function h3($text){
	  		echo "<div><h3  style='margin-top:100px;text-align:center;background:black;color:#fff;padding:10px 0;'>".$text."</h3></div>";
		}
	}

	if ( ! function_exists('decimal')){
		function decimal($number){
			if(is_numeric($number)){
				$num = "";
				$ttl = 2 - strlen($number);
				for($x=0;$x<=$ttl;$x++){
					$num .= "0";
				}
				return $num.$number;
			}			
		}
	}

	if ( ! function_exists('tgl')){
		function tgl($tipe,$lok_val){
			if($tipe=="sort"){
				$result = date("ymdHi");
				if($lok_val=="id"){
					$result = date("dmyHi");
				}
			}elseif($tipe=="full"){
				$result = date("Y-m-d H:i:s");
				if($lok_val=="id"){
					$result = date("d-m-Y H:i:s");
				}
			}elseif($tipe=="tgl"){
				$result = date("Y-m-d");
				if($lok_val=="ina"){
					$result = date("d-m-Y");
				}
			}elseif($tipe=="waktu"){
				$result = date("H:i:s");
			}elseif($tipe=="eng"){
				#0123456789
				#01-05-2019
				$tgl    = substr($lok_val,6,4)."-".substr($lok_val,3,2)."-".substr($lok_val,0,2);
				$result = $tgl;
			}elseif($tipe=="ina"){
				#0123456789
				#01-05-2019
				$tgl    = substr($lok_val,8,2)."-".substr($lok_val,5,2)."-".substr($lok_val,0,4);
				$result = $tgl;
			}else{
				$result = date($tipe);
			}
			return $result;
		}
	}
	// struk function
	if ( ! function_exists('createlineText')){
		function createlineText($line,$jumlah) {
			$garis = "";
			for ($i=1; $i<=$jumlah; $i++){
				$garis=$garis."".$line;
			}	
			return $garis;
		}
	}
	if ( ! function_exists('text_space')){
		function text_space($rumus,$char){
			$sisa = $rumus - strlen(trim($char));
			$text = trim($char).createlineText('.', $sisa);
			return $text;
		}
	}
	if ( ! function_exists('karakter_kanankiri')){
		function karakter_kanankiri($rumus,$kiri,$kanan){
			$sisa = $rumus - strlen($kiri.$kanan);
			$text = $kiri.createlineText(' ', $sisa).$kanan;
			return $text;
		}
	}
	if ( ! function_exists('karakter_kanankiri_char')){
		function karakter_kanankiri_char($rumus,$kiri,$char,$kanan){
			$l_kiri   = 34;
			$l_char   = 2;
			$l_kanan  = 12;
			$text  = $kiri.createlineText(' ',($l_kiri - strlen($kiri)));
			$text .= createlineText(' ',($l_char - strlen($char))).$char;
			$text .= createlineText(' ',($l_kanan - strlen($kanan))).$kanan;
			return $text;
		}
	}
	if ( ! function_exists('karakter_bagi_tiga')){
		function karakter_bagi_tiga($rumus,$kiri,$tengah,$kanan,$space){
			$l_kiri     = $space;
			if(empty($space)){
				$l_kiri     = 25;	
			}
			$rumus      = 48;		
			$l_kanan    = $rumus - $l_kiri;
			$c_kiri 	= strlen($kiri);
			$c_tengah   = strlen($tengah);
			$x_tengah   = ($l_kiri - $c_kiri);
			$sisa       = $rumus-($c_kiri+$c_tengah+$x_tengah)-strlen($kanan);	
			$text 	    = $kiri.createlineText(' ',$x_tengah).$tengah.createlineText(' ',$sisa).$kanan;
			return $text;
		}
	}
	if ( ! function_exists('karakter_tengah')){
		function karakter_tengah($rumus,$karakter){
			$sisa = ($rumus - strlen($karakter))/2;
			$text = createlineText(' ', $sisa).$karakter;
			return $text;
		}
	}
	if ( ! function_exists('karakter_kiri_tengah_kanan')){
		function karakter_kiri_tengah_kanan($rumus,$kiri,$tengah,$kanan){
			$l_kiri   = 24;
			$l_tengah = 12;
			$l_kanan  = 12;
			$text  = $kiri.createlineText(' ',($l_kiri - strlen($kiri)));
			$text .= createlineText(' ',($l_tengah - strlen($tengah))).$tengah;
			$text .= createlineText(' ',($l_kanan - strlen($kanan))).$kanan;
			return $text;
		}
	}
	if ( ! function_exists('garis_baru')){
		function garis_baru($kolom,$char){
			global $create;
		}
	}
	if ( ! function_exists('currency')){
		function currency($input){
			if($input!=0){
				$output = number_format($input,0,",",".");
			}else{
				$output = "";
			}
			return $output;
		}
	}
	if ( ! function_exists('Uw')){
		function Uw($txt){
			return ucwords(strtolower($txt));
		}
	}
	if ( ! function_exists('imgResize')){	
		function imgResize($xtarget, $newcopy, $w, $h, $ext,$path) {
			$target  = $path.$xtarget;
			$newcopy = $path.$newcopy;
		    list($w_orig, $h_orig) = getimagesize($target);
		    $scale_ratio = $w_orig / $h_orig;
		    if (($w / $h) > $scale_ratio) {
		           $w = $h * $scale_ratio;
		    } else {
		           $h = $w / $scale_ratio;
		    }
		    $img = "";
		    #str_replace(search, replace, subject)
		    $ext = str_replace(".","",strtolower($ext));
		    if ($ext == "gif"){ 
		    $img = imagecreatefromgif($target);
		    } else if($ext =="png"){ 
		    $img = imagecreatefrompng($target);
		    } else { 
		    $img = imagecreatefromjpeg($target);
		    }
		    $tci = imagecreatetruecolor($w, $h);
		    // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
		    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
		    if ($ext == "gif"){ 
		        $has = imagegif($tci, $newcopy);
		    } else if($ext =="png"){ 
		        $has = imagepng($tci, $newcopy);
		    } else { 
		        $has = imagejpeg($tci, $newcopy, 84);
		    }
		    #imgThumb($xtarget, $path, $w, $h, $ext);
		   # echo $has;
		}
	}

	if ( ! function_exists('infaq')){
		function infaq($kls,$ttl){
			if($kls=="1"){
				$rp = 3000000;
			}elseif($kls=="2"){
				$rp = 2500000;
			}elseif($kls=="3"){
				$rp = 1500000;
			}else{
				$rp = 0;
			}
			return ($rp * $ttl);
		}
	}

	if ( ! function_exists('link_act')){
		function link_act($link,$text){
			if($link==$text){
				$act = "active";
			}else{
				$act = "";
			}
			return $act;
		}
	}
	if ( ! function_exists('weekOfMonth')){
			function weekOfMonth($date) {
		    //Get the first day of the month.
		    $firstOfMonth = strtotime(date("Y-m-01", $date));
		    //Apply above formula.
		    return intval(date("W", $date)) - intval(date("W", $firstOfMonth)) + 1;
		}
	}
	if ( ! function_exists('url_aktif')){
		function url_aktif($url,$page) {
		}
	}
	if ( ! function_exists('cari_infaq')){
		function cari_infaq($cari,$array) {
		}
	}
	if ( ! function_exists('minggu')){
		function minggu($thn,$bln,$ke) {
			if($ke==1){
				$ke_text = "first";
			}elseif($ke==2){
				$ke_text = "second";
			}elseif($ke==3){
				$ke_text = "third";
			}elseif($ke==4){
				$ke_text = "fourth";
			}else{				
				$ke_text = "fifth";
			}
			//echo date('M');
			$monthNum  = $bln;
			$monthName = date('M', mktime(0, 0, 0, $monthNum, 10)); // March
            return  date("Y-m-d", strtotime($ke_text." Sunday of ".$monthName." ".$thn));
		}
	}

	if (!function_exists('pcent')) {
		function pcent($persen) {
			if($persen>99){
				return 99;
			}else{
				return $persen;
			}
		}
	}
	if (!function_exists('total_bulan')) {
		function total_bulan($from, $to) {
		    $month_in_year = 12;
		    $date_from = getdate(strtotime($from));
		    $date_to = getdate(strtotime($to));
		    return ($date_to['year'] - $date_from['year']) * $month_in_year -
		        ($month_in_year - $date_to['mon']) +
		        ($month_in_year - $date_from['mon']);
		}
	}
	if (!function_exists('array_col')) {
	    /**
	     * Returns the values from a single column of the input array, identified by
	     * the $columnKey.
	     *
	     * Optionally, you may provide an $indexKey to index the values in the returned
	     * array by the values from the $indexKey column in the input array.
	     *
	     * @param array $input A multi-dimensional array (record set) from which to pull
	     *                     a column of values.
	     * @param mixed $columnKey The column of values to return. This value may be the
	     *                         integer key of the column you wish to retrieve, or it
	     *                         may be the string key name for an associative array.
	     * @param mixed $indexKey (Optional.) The column to use as the index/keys for
	     *                        the returned array. This value may be the integer key
	     *                        of the column, or it may be the string key name.
	     * @return array
	     */
	    function array_col($input = null, $columnKey = null, $indexKey = null)
	    {
	        // Using func_get_args() in order to check for proper number of
	        // parameters and trigger errors exactly as the built-in array_column()
	        // does in PHP 5.5.
	        $argc = func_num_args();
	        $params = func_get_args();

	        if ($argc < 2) {
	            trigger_error("array_col() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
	            return null;
	        }

	        if (!is_array($params[0])) {
	            trigger_error(
	                'array_col() expects parameter 1 to be array, ' . gettype($params[0]) . ' given',
	                E_USER_WARNING
	            );
	            return null;
	        }

	        if (!is_int($params[1])
	            && !is_float($params[1])
	            && !is_string($params[1])
	            && $params[1] !== null
	            && !(is_object($params[1]) && method_exists($params[1], '__toString'))
	        ) {
	            trigger_error('array_col(): The column key should be either a string or an integer', E_USER_WARNING);
	            return false;
	        }

	        if (isset($params[2])
	            && !is_int($params[2])
	            && !is_float($params[2])
	            && !is_string($params[2])
	            && !(is_object($params[2]) && method_exists($params[2], '__toString'))
	        ) {
	            trigger_error('array_col(): The index key should be either a string or an integer', E_USER_WARNING);
	            return false;
	        }

	        $paramsInput = $params[0];
	        $paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;

	        $paramsIndexKey = null;
	        if (isset($params[2])) {
	            if (is_float($params[2]) || is_int($params[2])) {
	                $paramsIndexKey = (int) $params[2];
	            } else {
	                $paramsIndexKey = (string) $params[2];
	            }
	        }

	        $resultArray = array();

	        foreach ($paramsInput as $row) {
	            $key = $value = null;
	            $keySet = $valueSet = false;

	            if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
	                $keySet = true;
	                $key = (string) $row[$paramsIndexKey];
	            }

	            if ($paramsColumnKey === null) {
	                $valueSet = true;
	                $value = $row;
	            } elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
	                $valueSet = true;
	                $value = $row[$paramsColumnKey];
	            }

	            if ($valueSet) {
	                if ($keySet) {
	                    $resultArray[$key] = $value;
	                } else {
	                    $resultArray[] = $value;
	                }
	            }

	        }

	        return $resultArray;
	    }

	}