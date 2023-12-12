<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mod_siswa extends CI_Model
{
        
	public function siswa_sum()
	{
        $sintak = "SELECT kelas_nama,GROUP_CONCAT(ttl ORDER BY siswa_jenkel) AS siswa_jenkel,SUM(ttl) AS total FROM (
                SELECT b.`kelas_nama`,a.siswa_jenkel,COUNT(1) AS ttl
                FROM tbl_siswa a LEFT JOIN tbl_kelas b ON a.`siswa_kelas_id`=b.`kelas_id`
                GROUP BY b.`kelas_id`,siswa_jenkel
                ) ab GROUP BY kelas_nama";
        return each_query($this->db->query($sintak));
        }
	public function data_siswa($value="")
	{
                $ord = "order by siswa_kelas_id,siswa_nis";
                if(is_numeric($value)){
                        $value=" where siswa_kelas_id='$value'";
                }else{
                        if($value!=""){
                                if($value=="order"){
                                        $ord = " order by siswa_kelas_id,siswa_nama";
                                        $value = "";
                                }else{                                        
                                        $value = " where siswa_id='".explode("_",$value)[1]."'";
                                }
                        }else{
                                $value = "";
                        }
                }
                $sintak = "select * from tbl_siswa $value ".$ord;
                return each_query($this->db->query($sintak));
        }
}

