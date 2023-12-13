<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mod_master extends CI_Model
{
        public function data_anggota($value = "")
        {
                $sintak = "SELECT uid,username,nama,IF(user_member='1','member','non-member') AS user_member,IF(user_status='1','aktif','non-aktif') AS user_status,user_join,umur(user_join,'') AS lama
                        FROM tbl_user ORDER BY nama ASC";
                return each_query($this->db->query($sintak));
        }
        public function data_user($value = "")
        {
                $sintak = "SELECT uid,username,nama,IF(user_member='1','member','non-member') AS user_member,IF(user_status='1','aktif','non-aktif') AS user_status,user_join,umur(user_join,'') AS lama
                        FROM tbl_user where user_type!='user' ORDER BY nama ASC";
                return each_query($this->db->query($sintak));
        }
}
