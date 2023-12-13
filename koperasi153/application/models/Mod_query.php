<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mod_query extends CI_Model
{
	function Query($table, $where_array)
	{
		$qry = $this->db->get_where($table, $where_array);
		$rsl = $qry->result();
		return $rsl;
	}

	function Query_in($table, $kolom, $where_array)
	{
		$this->db->get($table);
		$qry = $this->db->where_in($kolom, $where_array);
		$rsl = $qry->result();
		return $rsl;
	}


	function qryOther($sql)
	{
		$sql   =  $this->db->query($sql);
		return all_query($sql);
	}
	function cekOther($tabel, $array)
	{
		$query = "select * from $tabel " . db_array($array, "select");
		$sql   =  $this->db->query($query);
		return all_query($sql);
	}
	function saveOther($tabel, $array, $tipe)
	{
		if ($tipe == "add") {
			$query = " insert into $tabel " . db_array($array, "insert");
		} elseif ($tipe == "update") {
			$query = "update $tabel " . db_array($array, "update");
		} elseif ($tipe == "delete") {
			$query = "delete from $tabel " . db_array($array, "delete");
		}
		#debug($query);
		$sql   =  $this->db->query($query);
		return $sql;
	}
	public function get_content($tbl, $kolom, $id, $tipe)
	{
		if (is_array($kolom)) {
			$has =  $this->db->get_where($tbl, $kolom);
		} else {
			$has =  $this->db->get_where($tbl, array($kolom => $id));
		}
		$ttl = count($has->result());
		return each_query($has);
	}
	public function gallery($limit)
	{
		$sintak = "SELECT media_id,media_path,media_name,media_size,media_res,media_ext FROM new_media WHERE media_type='gallery' ORDER BY 1 DESC $limit";
		return each_query($this->db->query($sintak));
	}
	public function getmedia($id, $tipe)
	{
		if ($tipe == "get") {
			$sintak = "SELECT galeri_id,galeri_fk_id,galeri_nama,galeri_judul,galeri_gambar FROM tbl_galeri WHERE galeri_fk_id='$id'";
			return single_query($this->db->query($sintak));
		} elseif ($tipe == "del") {
			return $this->hapusin_data("tbl_galeri", "galeri_id", $id);
		}
	}
	public function get_gallery($id, $content)
	{
		$sintak = "SELECT * FROM new_media WHERE content_media='$content' AND content_fk_id='$id'";
		return each_query($this->db->query($sintak));
	}

	function updLog($tbl, $kolom, $data_array, $url, $tgl)
	{
		$has =  $this->db->get_where($tbl, $kolom);
		if (count($has->result()) == 0) {
			$this->db->insert($tbl, $data_array);
			$id = $this->db->insert_id();
		} else {
			// $tgl = substr($tgl, 0, 8);
			$sintak = "UPDATE new_page_visit SET total=total+1 WHERE url='$url' AND DATE_FORMAT(updrec_date,'%y-%m-%d %H:%i')='$tgl'";
			$select = "SELECT id FROM new_page_visit WHERE url='$url' AND DATE_FORMAT(updrec_date,'%y-%m-%d  %H:%i')='$tgl'";
			$this->db->query($sintak);
			$data_array  = array(
				'url'               => $url,
				"time_stamp" => $tgl
			);
			$data = $this->db->get_where("new_page_visit", $data_array);
			$id = $data->result()[0]->id;
		}
		return $id;
	}


	function updDataForm($tbl, $tipe, $kolom, $uid,  $data_array)
	{
		if (is_array($kolom)) {
			$has =  $this->db->get_where($tbl, $kolom);
		} else {
			$has =  $this->db->get_where($tbl, array($kolom => $uid));
		}
		$ttl = count($has->result());
		if ($tipe == "Hapus") {
			$result = $this->hapusin_data($tbl, $kolom, $uid);
		} else {
			if ($ttl == 0) {
				$result = $this->masukin_data($data_array, $tbl, "");
			} else {
				if (is_array($kolom)) {
					$where  = $kolom;
				} else {
					$where  = array($kolom => $uid);
				}
				$result = $this->editin_data($data_array, $tbl, "", $where);
			}
		}
		return $result;
	}

	function masukin_data($array, $table, $tipe)
	{
		if ($tipe == "batch") {
			$this->db->insert_batch($table, $array);
		} else {
			$this->db->insert($table, $array);
		}
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		}
		return FALSE;
	}

	function editin_data($array, $table, $tipe, $where)
	{
		if ($tipe == "batch") {
			$y = $this->db->insert_batch($table, $array);
		} else {
			$this->db->where($where);
			$y = $this->db->update($table, $array);
		}
		return $y;
	}

	function hapusin_data($table, $kolom, $id)
	{
		$this->db->where($kolom, $id);
		$y = $this->db->delete($table);
		return $y;
	}

	function cekUser($username, $password)
	{
		/*$this->db->where("name", $username);
      $this->db->where("pwd", md5($password));*/
		$has =  $this->db->get_where("users", array('name' => $username, 'pwd' => md5($password)));
		return $has;
	}

	function delete_data($id, $column, $table)
	{
		$query = "delete from $table where $column='$id'";
		$sql   =  $this->db->query($query);
		return $sql;
	}
	function update_gambar($id, $tipe)
	{
		if ($tipe == "del") {
			$query = "delete from gallery where  id='$id'";
			$sql =  $this->db->query($query);
			return $sql;
		} else {
			$query = "select id,nama_file,path from gallery where id_berkas='$id'";
			$sql =  $this->db->query($query);
			return all_query($sql);
		}
	}
	function newId()
	{
		$sintak = "SELECT MAX(id_pengaduan + 1) AS id FROM berkas_pengaduan";
		#$sintak = "SELECT IFNULL((SELECT MAX(id_pengaduan + 1) AS id FROM berkas_pengaduan),1) AS id_pengaduan";
		return result_query($this->db->query($sintak));
	}

	function random_key()
	{
		$keys   = ranKey("6");
		$this->db->where("link_url", $keys);
		$query  = $this->db->get("new_link");
		if ($query->num_rows($query) == 0) {
			$url  = $keys;
		} else {
			$url  = tgl("sort");
		}
		return $url;
	}
	function dynKey()
	{
		$keys   = ranKey("5");
		$this->db->where("link_url", $keys);
		$query  = $this->db->get("new_link");
		if ($query->num_rows($query) == 0) {
			$url  = $keys;
		} else {
			$url  = $this->random_key();
		}
		return $url;
	}
	function dataSettings($value1 = '', $value2 = '')
	{
		if ($value1 == "status") {
			$conf2 = "";
			if ($value2 != '') {
				$conf2 = "and config2='$value2'";
			}
			$query = "select id,desk,lower(replace(desk,' ','-')) as class_id,recid from settings where config1='$value1' " . $conf2;
		} else {
			$query = "SELECT id,desk,lower(replace(desk,' ','-')) as class_id,COUNT($value1) AS total,a.recid FROM settings a LEFT JOIN berkas_pengaduan b ON a.id=b.$value1 where config1='$value1' GROUP BY id";
		}
		#echo $query;
		$sql   =  $this->db->query($query);
		return all_query($sql);
	}
	function kelurSettings($value1 = '', $value2 = '')
	{
		#$query = "SELECT id,desk,lower(replace(desk,' ','-')) as class_id,COUNT($value1) AS total,a.recid FROM settings a LEFT JOIN berkas_pengaduan b ON a.id=b.$value1 where config1='$value1' GROUP BY id";
		$query = "SELECT a." . $value2 . " AS id,a.nama AS desk,LOWER(REPLACE(a.nama,' ','-')) AS class_id,COUNT(b." . $value1 . ") AS total,a.recid,a.latitude,a.longitude FROM " . $value1 . " a LEFT JOIN berkas_pengaduan b ON a." . $value2 . "=b." . $value1 . " GROUP BY a." . $value2;
		if ($value1 == "kelurahan") {
			$query = "SELECT
                    a." . $value2 . " AS id,
                    c.nama AS desk,
                    a.nama AS desk2,
                    LOWER(REPLACE(a.nama, ' ', '-')) AS class_id,
                    COUNT(b." . $value1 . ") AS total,
                    a.recid,
                    a.latitude,a.longitude
                  FROM
                    " . $value1 . " a
                    LEFT JOIN berkas_pengaduan b
                      ON a." . $value2 . " = b." . $value1 . "
                    LEFT JOIN kecamatan c
                      ON a.`id_fk_kec` = c.`id_kec`
                  GROUP BY a." . $value2 . "
                  ORDER BY desk";
		}

		#echo $query;
		$sql   =  $this->db->query($query);
		return all_query($sql);
	}
	function getGallery($id)
	{
		if ($id != "") {
			$sintak = "select id,concat(path,':',nama_file) as img from gallery where grup='gallery' and id_berkas='$id'";
			$sql   =  $this->db->query($sintak);
			return all_query($sql);
		} else {
			return "";
		}
	}
	function getIsp($id)
	{
		if (empty($id) || $id == "") {
			$sintak = "";
		} else {
			$sintak = " where nomor='$id'";
		}
		$query = "select * from isp " . $sintak . " order by nomor";
		return result_query($this->db->query($query));
	}
	function getLink($link)
	{
		if (empty($link) || $link == "" || $link == "all") {
			$sintak = "";
		} else {
			$sintak = " where grup='$link'";
		}
		$query = "select * from link " . $sintak . " order by id";
		return result_query($this->db->query($query));
	}
	function saveData($sintak)
	{
		return $this->db->query($sintak);
	}
	function resultPeserta($peserta)
	{
		$query = "select * from data_peserta order by id";
		$field = $this->db->list_fields("data_peserta");
		return array(result_query($this->db->query($query)), $field);
	}

	#koperasi query
	function koperasi_report_all(){
		$sql = "SELECT b.id,`name`,ifnull(desk,'') as desk,`in`,`out` FROM 
				(SELECT mst_id,SUM(cash_in) AS `in`,SUM(cash_out)  AS `out` FROM tbl_transaksi
				GROUP BY mst_id
				UNION ALL
				SELECT mst_id,SUM(cash_in),SUM(cash_out)  FROM tbl_jurnal
				GROUP BY mst_id) AS ab
				LEFT JOIN tbl_master b ON ab.mst_id=b.`id`
				ORDER BY 1";
		$result = $this->qryOther($sql);
		if($result){
			return $result;
		}
	}
}
