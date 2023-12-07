<?php
/*fungsi2*/
function romawi($value){
	if($value=="1"){
		$result = "I";
	}elseif($value=="2"){
		$result = "II";
	}elseif($value=="3"){
		$result = "III";
	}elseif($value=="4"){
		$result = "IV";
	}elseif($value=="5"){
		$result = "V";
	}elseif($value=="6"){
		$result = "VI";
	}elseif($value=="7"){
		$result = "VII";
	}elseif($value=="8"){
		$result = "VIII";
	}elseif($value=="9"){
		$result = "IX";
	}elseif($value=="10"){
		$result = "X";		
	}elseif($value=="11"){
		$result = "XI";
	}elseif($value=="12"){
		$result = "XII";
	}else{		
		$result = date("m");
	}
	return $result;
}
function call_data($table,$column,$get_id,$get_fk_id,$get_url){
	global $tgl_jam;
	$syntax_call_data = "select $column from $table where $get_id='$get_fk_id'";
	$query_call_data = mysql_query();
	if($query_call_data){
		$cek_query_call_data = mysql_fetch_array($query_call_data);
		if(empty($cek_query_call_data[0])){
			$result_call_data = "row is null or empty";
		}else{
			$result_call_data = $cek_query_call_data[0];
		}
	}else{
		log_error($tgl_jam,$get_url,$syntax_call_data);
		$result_call_data = "Error...! please cek log";
	}
	return $result_call_data;
}
?>