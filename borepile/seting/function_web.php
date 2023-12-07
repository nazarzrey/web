<?php
/*fungsi2*/



function romawi($value)
{
	if ($value == "1") {
		$result = "I";
	} elseif ($value == "2") {
		$result = "II";
	} elseif ($value == "3") {
		$result = "III";
	} elseif ($value == "4") {
		$result = "IV";
	} elseif ($value == "5") {
		$result = "V";
	} elseif ($value == "6") {
		$result = "VI";
	} elseif ($value == "7") {
		$result = "VII";
	} elseif ($value == "8") {
		$result = "VIII";
	} elseif ($value == "9") {
		$result = "IX";
	} elseif ($value == "10") {
		$result = "X";
	} elseif ($value == "11") {
		$result = "XI";
	} elseif ($value == "12") {
		$result = "XII";
	} else {
		$result = date("m");
	}
	return $result;
}
function select_data_func($table, $column, $get_id, $get_fk_id, $get_url)
{
	global $tgl_jam, $db;
	$syntax_select_data_func = "select $column from $table where $get_id='$get_fk_id'";
	$query_select_data_func = $db->select($syntax_select_data_func);
	if ($query_select_data_func) {
		$cek_query_select_data_func = $query_select_data_func[0][$column];
		if (empty($cek_query_select_data_func)) {
			$result_select_data_func = "data masih kosong ";
		} else {
			#echo "<b style='display:none'>xxx</b>";
			$result_select_data_func = $cek_query_select_data_func;
		}
	} else {
		log_error($get_url, $syntax_select_data_func);
		$result_select_data_func = "Error select...! (function web) hub admin web";
	}
	return $result_select_data_func;
}


function update_data_func($table, $upd_column, $get_id, $get_fk_id, $get_url)
{
	global $tgl_jam, $db;
	$update = "select 1 from $table where $get_id='$get_fk_id'";
	$upd_cek_first = $db->select($update);
	if (count($upd_cek_first) == 0) {
		$upd_column_add = $upd_column . ",$get_id='$get_fk_id'";
		$cek1 = trim(str_replace("'", "", str_replace("=", ",", $upd_column_add)));
		$pecah = explode(',', $cek1);
		$total_data = count($pecah);
		$data1 = "";
		$data2 = "";
		$z = 1;
		foreach ($pecah as $pecahin) {
			if ($z % 2 == 0) {
				$data1 .= "'" . $pecahin . "',";
			} else {
				$data2 .= $pecahin . ",";
			}
			$z++;
		}
		$column1 = substr($data1, 0, strlen($data1) - 1);
		$column2 = substr($data2, 0, strlen($data2) - 1);
		$upd_ins_first = "insert into $table ($column2) values ($column1)";
		if ($db->query($upd_ins_first)) {
			$result_update_data_func = "Y";
		} else {
			log_error($get_url, $upd_ins_first);
			$result_update_data_func = "error insert first..! cek error log";
		}
	} else {
		$syntax_update_data_func = "update $table set $upd_column where $get_id='$get_fk_id'";
		if ($db->query($syntax_update_data_func)) {
			$result_update_data_func = "Y";
		} else {
			log_error($get_url, $syntax_update_data_func);
			$result_update_data_func = "Error update..! (function web) hub admin web";
		}
	}
	return $result_update_data_func;
}
function insert_data_func($table, $column1, $column2, $get_id, $get_fk_id, $get_url)
{
	global $tgl_jam, $db;
	$syntax_insert_cek_data_func = "insert into $table ($column1) values ($column2)";
	if ($db->query($syntax_insert_cek_data_func)) {
		$result_insert_cek_data_func = "Y";
	} else {
		log_error($get_url, $syntax_insert_cek_data_func);
		$result_insert_cek_data_func = "Error insert_cek...! (function web) hub admin web";
	}
	return $result_insert_cek_data_func;
}
function insert_cek_data_func($table, $column1, $column2, $get_id, $get_fk_id, $get_url)
{
	global $tgl_jam, $db;
	$insert_cek_first = $db->select("select 1 from $table where $get_id='$get_fk_id'");
	if (count($insert_cek_first) > 0) {
		$result_insert_cek_data_func = "data $get_fk_id sudah ada";
	} else {
		$syntax_insert_cek_data_func = "insert into $table ($column1) values ($column2)";
		if ($db->query($syntax_insert_cek_data_func)) {
			$result_insert_cek_data_func = "Y";
		} else {
			log_error($get_url, $syntax_insert_cek_data_func);
			$result_insert_cek_data_func = "Error insert_cek...! (function web) hub admin web";
		}
	}
	return $result_insert_cek_data_func;
}
function insert_cek_data_func2($table, $column1, $column2, $get_id, $get_fk_id, $get_id2, $get_fk_id2, $get_url)
{
	global $tgl_jam, $db;
	$insert_cek_first = $db->select("select 1 from $table where $get_id='$get_fk_id' and $get_id2='$get_fk_id2'");
	if (count($insert_cek_first) > 0) {
		$result_insert_cek_data_func = "data $get_fk_id sudah ada";
	} else {
		$syntax_insert_cek_data_func = "insert into $table ($column1) values ($column2)";
		if ($db->query($syntax_insert_cek_data_func)) {
			$result_insert_cek_data_func = "Y";
		} else {
			log_error($get_url, $syntax_insert_cek_data_func);
			$result_insert_cek_data_func = "Error insert_cek...! (function web) hub admin web";
		}
	}
	return $result_insert_cek_data_func;
}
function delete_data_func($table, $get_id, $get_fk_id, $get_url)
{
	global $tgl_jam, $db;
	$query_cek_delete_data   = "select 1 as dt from $table where $get_id='$get_fk_id'";
	$syntax_delete_data_func = $db->select($query_cek_delete_data);
	if (!empty($syntax_delete_data_func[0]['dt'])) {
		$query_delete_data_func = "delete from $table where $get_id='$get_fk_id'";
		if ($db->query($query_delete_data_func)) {
			$result_delete_data_func = "Y";
		} else {
			log_error($get_url, $query_delete_data_func);
			$result_delete_data_func = "gagal di hapus (function web) hub admin web";
		}
	} else {
		$result_delete_data_func = "data tidak ada";
	}
	return $result_delete_data_func;
}
function delete_galery($get_fk_id, $get_url)
{
	global $tgl_jam, $db;
	$cek_dulu 		= "select full_file_name,thumb_file_name from galery where id_attach in (select galeri from master_grup where id_grup='$get_fk_id')";
	if ($sql = $db->select($cek_dulu)) {
		$cek_dulu = $sql;
		foreach ($cek_dulu as $hsl_cekdulu) {
			$full_img = "../galeri/" . $hsl_cekdulu[0];
			$icon_img = "../galeri/" . $hsl_cekdulu[1];
			if (file_exists($full_img)) {
				unlink($full_img);
			}
			if (file_exists($icon_img)) {
				unlink($icon_img);
			}
		}
		$hapus_deh = $db->query("delete from galery where id_attach in (select galeri from master_grup where id_grup='$get_fk_id')");
		if ($hapus_deh) {
			$Hapus_galery = "Y";
		} else {
			$Hapus_galery = " Gagal hapus gambar ";
		}
	} else {
		$Hapus_galery = " Gagal query cek galeri ";
	}
	return $Hapus_galery;
}
function cek_progress($idnya)
{
	global $tgl_jam, $db;
	$sintak  = "select progress from pu_pengaduan_proses where id_pengaduan='$idnya'  order by CAST(progress AS UNSIGNED) desc limit 1";
	if ($sql = $db->select($sintak)) {
		$query = $sql;
		if (count($query) == 1) {
			$result = $fetch[0]["progress"];
		} else {
			$result = "";
		}
	} else {
		log_error($get_url, $query_delete_data_func);
		$result = "";
	}
	#return $result.$sintak;
	return $result;
}
