<?php 
class M_cetak extends CI_Model{
    
    function get_all_siswa(){
		$hsl=$this->db->query("SELECT * FROM tbl_daftar");
		return $hsl;
	}
	

}