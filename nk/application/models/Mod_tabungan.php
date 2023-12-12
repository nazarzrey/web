<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mod_tabungan extends CI_Model
{
        public function min_max(){
                // $lvl = $this->session->userdata("pengguna_level");
                // $kls = $this->session->userdata("kelas");
                // $kelas = $lvl!="admin"?"where siswa_kelas_id='$kls'":"";
                // $sintak = "SELECT IFNULL(MIN(tab_tanggal),CURDATE()) AS min_tanggal ,IFNULL(MAX(tab_tanggal),CURDATE()) AS max_tanggal FROM tbl_tabungan a LEFT JOIN tbl_siswa b ON a.siswa_fk_id=b.siswa_id ".$kelas;
                $sintak = "SELECT value1 min_tanggal,CURDATE() AS max_tanggal FROM tbl_settings WHERE nama='min_max'";
                return each_query($this->db->query($sintak));
        }
        public function tabungan_sum($tgl)
	{
                
        $tgl !=""?$tgl="WHERE recid='1' and tab_tanggal='".$tgl."'":$tgl="where recid='1' GROUP BY c.kelas_id";
        $sintak = "SELECT kelas_id,kelas_nama,tab_in,tab_out,SUM(tab_in-tab_out) AS total FROM (
                SELECT c.kelas_id,c.kelas_nama,SUM(a.tab_in) AS tab_in,SUM(a.tab_out) AS tab_out
                FROM tbl_tabungan a LEFT JOIN tbl_siswa b
                ON a.siswa_fk_id=b.siswa_id
                LEFT JOIN tbl_kelas c ON b.siswa_kelas_id=c.kelas_id 
                $tgl
                ORDER BY c.kelas_id
                ) tabungan
                GROUP BY 1";
        return each_query($this->db->query($sintak));
    }
    public function data_tabungan($value="",$value2=""){  
        $lvl = $this->session->userdata("pengguna_level");
        $kls = $this->session->userdata("kelas");
        $value !=""?$value="where siswa_kelas_id='".$value."'":"";
        $kelas = $lvl!="admin"?"where siswa_kelas_id='$kls'": $value;
        if($value2=="list"){
                $kelas = $kelas!=""?$kelas." and (tab_in>0 or tab_out>0)":$kelas." where (tab_in>0 or tab_out>0)";
        }
        
        $sintak = "SELECT b.siswa_id,b.siswa_nis,b.siswa_nama,
	        ifnull(sum(a.tab_in),0) as tab_in,ifnull(sum(a.tab_out),0) as tab_out,ifnull(IFNULL(sum(a.tab_in),0) - IFNULL(sum(a.tab_out),0),0) as total, 
                c.kelas_nama,b.siswa_kelas_id
                FROM tbl_tabungan a right JOIN tbl_siswa b
                ON a.siswa_fk_id=b.siswa_id 
                AND recid='1'
                LEFT JOIN tbl_kelas c ON b.siswa_kelas_id=c.kelas_id 
                $kelas
                GROUP BY b.siswa_id
                ORDER BY siswa_nama";
        return each_query($this->db->query($sintak)); 
    }
    public function dtl_tabungan($id){
        $sintak = "SELECT DATE_FORMAT(tab_tanggal,'%d-%m-%Y') as tab_tanggal,FORMAT(tab_in,0,'de_DE') as tab_in,FORMAT(tab_out,0,'de_DE') as tab_out,FORMAT(tab_in - tab_out,0,'de_DE') as saldo  from tbl_tabungan
                where siswa_fk_id=$id and recid=1
                union 
                select 'total',FORMAT(SUM(tab_in),0,'de_DE') as tab_in,FORMAT(SUM(tab_out),0,'de_DE')  as tab_out,FORMAT(sum(tab_in - tab_out),0,'de_DE') as saldo from tbl_tabungan
                where siswa_fk_id=$id and recid=1 order by 1 desc";
                return each_query($this->db->query($sintak)); 
    }
    public function other_tabungan($value=""){
        $lvl = $this->session->userdata("pengguna_level");
        $kls = $this->session->userdata("kelas");
        $id = $this->session->userdata("idadmin");
        $value !=""?$value="and date_format(tab_tanggal,'%Y-%m')='".$value."'":"and date_format(tab_tanggal,'%Y-%m')='".date("Y-m")."'";
        
        if($lvl=="admin"){
                $kelas = $value;
        }elseif($lvl=="guru"){
                $kelas = "and siswa_kelas_id='$kls' ".$value;
        }else{
                $kelas = "and siswa_id='$id' ".$value;
        }
        #$kelas = $lvl!="admin"?"and siswa_kelas_id='$kls' ".$value:$value;
         $sintak = "SELECT date_format(tab_tanggal,'%d-%m-%Y') as tab_tanggal,COUNT(1) AS total,
                FORMAT(SUM(tab_in),0,'de_DE') AS tab_in,FORMAT(SUM(tab_out),0,'de_DE') AS tab_out,FORMAT(SUM(tab_in - tab_out),0,'de_DE') AS saldo FROM (
                        SELECT tab_tanggal,COUNT(1) AS total,
                        SUM(tab_in) AS tab_in,SUM(tab_out) AS tab_out,SUM(tab_in - tab_out) AS saldo
                        FROM tbl_tabungan a LEFT JOIN tbl_siswa b ON a.siswa_fk_id=b.siswa_id 
                        WHERE recid=1 
                        $kelas
                        GROUP BY 1 ,siswa_fk_id 
                ) tabungan GROUP BY tab_tanggal 
                        union 
                SELECT 'total' AS tab_tanggal,COUNT(total),
                FORMAT(SUM(tab_in),0,'de_DE') AS tab_in,FORMAT(SUM(tab_out),0,'de_DE') AS tab_out,FORMAT(SUM(tab_in - tab_out),0,'de_DE') AS saldo FROM (
                        SELECT tab_tanggal,COUNT(1) AS total,
                        SUM(tab_in) AS tab_in,SUM(tab_out) AS tab_out,SUM(tab_in - tab_out) AS saldo
                        FROM tbl_tabungan a LEFT JOIN tbl_siswa b ON a.siswa_fk_id=b.siswa_id 
                        WHERE recid=1 
                        $kelas                
                GROUP BY siswa_fk_id ) 
                tab_group
                ORDER BY tab_tanggal DESC
                ";
                return each_query($this->db->query($sintak)); 
    }
    public function report_tabungan($value="",$value2=""){
        $lvl = $this->session->userdata("pengguna_level");
        $kls = $this->session->userdata("kelas");
        $id = $this->session->userdata("idadmin");
        $value !=""?$value="'".$value."'":$value="curdate()";
        if($lvl=="admin"){
                $kelas = "";
        }elseif($lvl=="guru"){
                $kelas = "and siswa_kelas_id='$kls'";
        }else{
                $kelas = "and siswa_id='$id'";
        }
        $sintak = "SELECT date_format(tab_tanggal,'%Y-%m') as tgl_id,CONCAT(MONTHNAME_IND(MONTH(tab_tanggal)), ' ',YEAR(tab_tanggal)) AS tab_tanggal,
                sum(tab_in) AS tab_in,sum(tab_out) AS tab_out,sum(tab_in - tab_out) AS total
                FROM tbl_tabungan a LEFT JOIN tbl_siswa b ON a.siswa_fk_id=b.siswa_id 
                WHERE recid=1 
                $kelas
                group by 1 ORDER BY 1 DESC";
                return each_query($this->db->query($sintak)); 
    }
    public function input_tabungan($value="",$value2=""){
        $lvl = $this->session->userdata("pengguna_level");
        $kls = $this->session->userdata("kelas");
        $value !=""?$value="'".$value."'":$value="curdate()";
        $kelas = $lvl!="admin"?"where siswa_kelas_id='$kls'":"";
        if($value2=="list"){
                $kelas = $kelas!=""?$kelas." and (tab_in>0 or tab_out>0)":$kelas." where (tab_in>0 or tab_out>0)";
        }
        
        $sintak = "SELECT b.siswa_id,b.siswa_nis,b.siswa_nama,
	        ifnull(sum(a.tab_in),0) as tab_in,ifnull(sum(a.tab_out),0) as tab_out,ifnull(IFNULL(sum(a.tab_in),0) - IFNULL(sum(a.tab_out),0),0) as total, 
                c.kelas_nama,b.siswa_kelas_id
                FROM tbl_tabungan a right JOIN tbl_siswa b
                ON a.siswa_fk_id=b.siswa_id 
                AND tab_tanggal=$value
                AND recid='1'
                LEFT JOIN tbl_kelas c ON b.siswa_kelas_id=c.kelas_id 
                $kelas
                GROUP BY b.siswa_id
                ORDER BY siswa_nama";
        return each_query($this->db->query($sintak));    
        }

	function cektanggal($tgl){                
		$tgl!=""?$tgl="'$tgl'":$tgl="curdate()";
                $sintak ="(SELECT (SELECT DATE_FORMAT(updrec_date,'%Y-%m-%d') AS option FROM tbl_tabungan WHERE DATE_FORMAT(updrec_date,'%Y-%m-%d')<$tgl ORDER BY 1 DESC LIMIT 1 ) AS option)
                        UNION ALL 
                        (SELECT (SELECT DATE_FORMAT(updrec_date,'%Y-%m-%d') AS option FROM tbl_tabungan WHERE DATE_FORMAT(updrec_date,'%Y-%m-%d')>$tgl ORDER BY 1 ASC LIMIT 1 ) AS option)";
                return each_query($this->db->query($sintak));
        }
	function save($tipe,$sid,$nilai,$by,$tgl){   
                $sintak = "call tabungan('$tipe','$sid','$nilai','$by','$tgl');";
                return $this->db->query($sintak);
        }
	function saldo($sid,$tgl){
                $sintak = "SELECT COUNT(1) AS total,FORMAT(SUM(tab_in),0,'de_DE') AS tab_in, FORMAT(SUM(tab_out),0,'de_DE') AS tab_out,FORMAT(SUM(tab_in-tab_out),0,'de_DE') AS sisa from (
                        SELECT COUNT(1) AS total,SUM(tab_in) AS tab_in, SUM(tab_out) AS tab_out,SUM(tab_in-tab_out) AS sisa FROM tbl_tabungan a LEFT JOIN tbl_siswa b ON a.siswa_fk_id=b.siswa_id
                        WHERE tab_tanggal='$tgl' AND siswa_kelas_id=(SELECT siswa_kelas_id FROM tbl_siswa WHERE siswa_id='$sid') AND recid='1' group by siswa_id) tabungan";
                return single_query($this->db->query($sintak));
        }        
}