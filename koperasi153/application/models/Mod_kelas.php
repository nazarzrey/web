<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mod_kelas extends CI_Model
{
        
	public function data_kelas()
	{
        $sintak = "select a.kelas_id,kelas_nama from tbl_kelas a right join tbl_siswa b on a.kelas_id=b.siswa_kelas_id
                    GROUP BY kelas_nama
                    order by 1
                    ";
            return each_query($this->db->query($sintak));
        }
}

