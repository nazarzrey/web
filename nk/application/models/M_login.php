<?php
class M_login extends CI_Model{
    function cekadmin($u,$p){
		$sql = "SELECT * FROM tbl_pengguna WHERE pengguna_username='$u' AND pengguna_password=md5('$p')";
        $hasil=$this->db->query($sql);
        return $hasil;
    }

}
