<?php
class M_struktur extends CI_Model{

	function get_all_struktur(){
		$hsl=$this->db->query("SELECT tbl_struktur.* FROM tbl_struktur ORDER BY struktur_id ");
		return $hsl;
	}
	function get_all_struktur_option(){
		$hsl=$this->db->query("SELECT * FROM (
								SELECT a.`struktur_id`,a.`struktur_nama`,COUNT(b.`guru_mapel`) AS total,a.`struktur_unik` FROM tbl_struktur a LEFT JOIN tbl_pengajar b ON a.`struktur_id`=b.`guru_mapel`
								GROUP BY a.`struktur_id`) abc
							WHERE (struktur_unik-total)>0");
		return $hsl;
	}
	function simpan_struktur($nama_struktur,$butuh){
		$author=$this->session->userdata('nama');
		$hsl=$this->db->query("INSERT INTO tbl_struktur(struktur_nama,struktur_unik) VALUES ('$nama_struktur',$butuh)");
		return $hsl;
	}
	function update_struktur($kode,$nama_struktur,$butuh){
		$author=$this->session->userdata('nama');
		$hsl=$this->db->query("UPDATE tbl_struktur SET struktur_nama='$nama_struktur',struktur_unik=$butuh where struktur_id='$kode'");
		return $hsl;
	}
	function hapus_struktur($kode){
		$hsl=$this->db->query("DELETE FROM tbl_struktur WHERE struktur_id='$kode'");
		return $hsl;
	}

	//front-end
    /*
	function get_struktur_home(){
		$hsl=$this->db->query("SELECT tbl_struktur.*,DATE_FORMAT(struktur_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_struktur ORDER BY struktur_id DESC limit 3");
		return $hsl;
	}
	function struktur(){
		$hsl=$this->db->query("SELECT tbl_struktur.*,DATE_FORMAT(struktur_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_struktur ORDER BY struktur_id DESC");
		return $hsl;
	}
	function struktur_perpage($offset,$limit){
		$hsl=$this->db->query("SELECT tbl_struktur.*,DATE_FORMAT(struktur_tanggal,'%d/%m/%Y') AS tanggal FROM tbl_struktur ORDER BY struktur_id DESC limit $offset,$limit");
		return $hsl;
	}

    */
} 