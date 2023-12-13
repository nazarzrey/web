<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mod_iuran extends CI_Model
{

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
    public function min_max()
    {
        $lvl = $this->session->userdata("pengguna_level");
        $kls = $this->session->userdata("kelas");
        $kelas = $lvl != "admin" ? "where siswa_kelas_id='$kls'" : "";
        $sintak = "SELECT IFNULL(MIN(tab_tanggal),CURDATE()) AS min_tanggal ,IFNULL(MAX(tab_tanggal),CURDATE()) AS max_tanggal FROM tbl_transaksi a LEFT JOIN tbl_siswa b ON a.siswa_fk_id=b.siswa_id " . $kelas;
        return each_query($this->db->query($sintak));
    }
    public function iuran_tahun()
    {
        $sql = "";
    }
    public function iuran_data()
    {
        $sintak = "call grup_iuran()";
        return each_query($this->db->query($sintak));
    }

    public function iuran_sum($tgl)
    {

        $tgl != "" ? $tgl = "WHERE recid='1' and tab_tanggal='" . $tgl . "'" : $tgl = "where recid='1' GROUP BY c.kelas_id";
        $sintak = "SELECT kelas_id,kelas_nama,tab_in,tab_out,SUM(tab_in-tab_out) AS total FROM (
                SELECT c.kelas_id,c.kelas_nama,SUM(a.tab_in) AS tab_in,SUM(a.tab_out) AS tab_out
                FROM tbl_transaksi a LEFT JOIN tbl_siswa b
                ON a.siswa_fk_id=b.siswa_id
                LEFT JOIN tbl_kelas c ON b.siswa_kelas_id=c.kelas_id 
                $tgl
                ORDER BY c.kelas_id
                ) iuran
                GROUP BY 1";
        return each_query($this->db->query($sintak));
    }
    public function laporan_keuangan()
    {

        $sql = "SELECT b.mid,name,ifnull(desk,'') as desk,cash_in,cash_out FROM 
                        (SELECT fk_mid,SUM(cash_in) AS cash_in,SUM(cash_out)  AS cash_out FROM tbl_transaksi
                        GROUP BY fk_mid
                        UNION ALL
                        SELECT mst_id,SUM(cash_in),SUM(cash_out)  FROM tbl_jurnal
                        GROUP BY mst_id) AS ab
                        LEFT JOIN tbl_master b ON ab.fk_mid=b.mid
                        ORDER BY 1";
        return $result = $this->qryOther($sql);
    }
    public function data_iuran($value = "")
    {
        $member = $value != "" ? "AND b.user_member='$value'" : "";
        $sql = "SELECT b.uid,b.nama,
                SUM(
                CASE WHEN fk_mid = 2 THEN cash_in ELSE 0 END
                ) AS iuran,
                SUM(
                CASE WHEN fk_mid = 3 AND link_id IS NULL THEN (cash_out -cash_in) ELSE 0 END
                ) AS pinjaman, 
                SUM(
                CASE WHEN fk_mid = 4 AND link_id IS NULL THEN CAST(((cash_out +(cash_out * 10/100))-cash_in) AS INT)  ELSE 0 END
                ) AS istimewa, 
                SUM(
                CASE WHEN fk_mid = 5 AND link_id IS NULL  THEN (cash_out-cash_in)  ELSE 0 END
                ) AS emergency, 
                IF(b.user_member='1','member','non member') AS member
                FROM tbl_transaksi a RIGHT JOIN tbl_user b
                ON a.fk_uid=b.uid
                AND b.recid='1'                
                AND fk_mid IN (select mid from tbl_master where jurnal='1')
                -- $member
                GROUP BY uid
                ORDER BY nama";
        // echo $sql;
        return $result = $this->qryOther($sql);
    }
    public function dtl_iuran($uid, $tahun)
    {
        $sq0 = "SELECT concat(bulan,' -',";
        $sq1 = ") as bulan,ifnull(IF(COUNT(1)>1, GROUP_CONCAT(CONCAT(DATE_FORMAT(b.updrec_date,'%m-%d'),'#',c.`nama`)),c.`nama`),'') AS acc,
                ifnull(format(SUM(b.`cash_in`),0,'de_DE'),'') AS total_in,CAST(CONCAT('";
        $sq2 = "',IF(a.id<10,CONCAT('0',a.id),a.id)) AS INT) AS  id,ifnull(description,'') as desk
                FROM tbl_bulan a LEFT JOIN tbl_transaksi b ON a.`bulan`=MONTHNAME(b.updrec_date)                 
                AND fk_uid=$uid ";
        $sq3 = "  AND fk_mid=2  AND fk_mid=2 LEFT JOIN tbl_user c ON b.`acc_by`=c.`uid` GROUP BY bulan ";
        if ($tahun != "") {
            $tahu = explode(",", $tahun);
            if (count($tahu) > 1) {
                $squery = "";
                $year = "AND YEAR(b.updrec_date) in ('$tahun')";
                foreach ($tahu as $key => $tah) {
                    $thn = "AND YEAR(b.updrec_date)='$tah' ";
                    $th  = $tah;
                    $squery .= $sq0 . $th . $sq1 . $th . $sq2 . $thn . $sq3;
                    if ($key < count($tahu) - 1) {
                        $squery .= " UNION ALL ";
                    }
                }
            } else {
                $thn = "AND YEAR(b.updrec_date)='$tahun' ";
                $th  = $tahun;
                $squery = $sq0 . $th . $sq1 . $th . $sq2 . $thn . $sq3;
                $year = $thn;
            }
        } else {
            $thn = "";
            $th  = date("Y");
            $squery = $sq0 . $th . $sq1 . $th . $sq2 . $thn . $sq3;
            $year = $thn;
        }
        $sintak = "
                SELECT * FROM (
                $squery
                UNION ALL
                SELECT 'total','',ifnull(format(SUM(b.`cash_in`),0,'de_DE'),'') AS total_in,999 AS  id,'' as desk
                FROM tbl_transaksi b WHERE fk_uid=$uid $year AND fk_mid=2  AND fk_mid=2
                ) abc
                ORDER BY id desc";
        return each_query($this->db->query($sintak));
    }
    public function jurnal($uid = "")
    {
        $sintak = "SELECT fk_mid,date_format(a.updrec_date,'%d-%m-%Y') as tanggal,currency(cash_in) as cash_in,currency(cash_out) as cash_out,description,b.name as tipe,c.nama
                FROM tbl_transaksi a LEFT JOIN tbl_master b ON a.`fk_mid`=b.`mid`                
                AND jurnal='1'
                LEFT JOIN tbl_user c ON a.`acc_by`=c.`uid`
                WHERE fk_uid='$uid'
                ORDER BY a.updrec_date desc";
        return each_query($this->db->query($sintak));
    }
    public function report_iuran($value = "", $value2 = "")
    {
        $lvl = $this->session->userdata("pengguna_level");
        $kls = $this->session->userdata("kelas");
        $id = $this->session->userdata("idadmin");
        $value != "" ? $value = "'" . $value . "'" : $value = "curdate()";
        if ($lvl == "admin") {
            $kelas = "";
        } elseif ($lvl == "guru") {
            $kelas = "and siswa_kelas_id='$kls'";
        } else {
            $kelas = "and siswa_id='$id'";
        }
        $sintak = "SELECT date_format(tab_tanggal,'%Y-%m') as tgl_id,CONCAT(MONTHNAME_IND(MONTH(tab_tanggal)), ' ',YEAR(tab_tanggal)) AS tab_tanggal,
                sum(tab_in) AS tab_in,sum(tab_out) AS tab_out,sum(tab_in - tab_out) AS total
                FROM tbl_transaksi a LEFT JOIN tbl_siswa b ON a.siswa_fk_id=b.siswa_id 
                WHERE recid=1 
                $kelas
                group by 1 ORDER BY 1 DESC";
        return each_query($this->db->query($sintak));
    }
    public function input_iuran($value = "", $value2 = "")
    {
        $lvl = $this->session->userdata("pengguna_level");
        $kls = $this->session->userdata("kelas");
        $value != "" ? $value = "'" . $value . "'" : $value = "curdate()";
        $kelas = $lvl != "admin" ? "where siswa_kelas_id='$kls'" : "";
        if ($value2 == "list") {
            $kelas = $kelas != "" ? $kelas . " and (tab_in>0 or tab_out>0)" : $kelas . " where (tab_in>0 or tab_out>0)";
        }

        $sintak = "SELECT b.siswa_id,b.siswa_nis,b.siswa_nama,
	        ifnull(sum(a.tab_in),0) as tab_in,ifnull(sum(a.tab_out),0) as tab_out,ifnull(IFNULL(sum(a.tab_in),0) - IFNULL(sum(a.tab_out),0),0) as total, 
                c.kelas_nama,b.siswa_kelas_id
                FROM tbl_transaksi a right JOIN tbl_siswa b
                ON a.siswa_fk_id=b.siswa_id 
                AND tab_tanggal=$value
                AND recid='1'
                LEFT JOIN tbl_kelas c ON b.siswa_kelas_id=c.kelas_id 
                $kelas
                GROUP BY b.siswa_id
                ORDER BY siswa_nama";
        return each_query($this->db->query($sintak));
    }

    function cektanggal($tgl)
    {
        $tgl != "" ? $tgl = "'$tgl'" : $tgl = "curdate()";
        $sintak = "(SELECT (SELECT DATE_FORMAT(updrec_date,'%Y-%m-%d') AS option FROM tbl_transaksi WHERE DATE_FORMAT(updrec_date,'%Y-%m-%d')<$tgl ORDER BY 1 DESC LIMIT 1 ) AS option)
                        UNION ALL 
                        (SELECT (SELECT DATE_FORMAT(updrec_date,'%Y-%m-%d') AS option FROM tbl_transaksi WHERE DATE_FORMAT(updrec_date,'%Y-%m-%d')>$tgl ORDER BY 1 ASC LIMIT 1 ) AS option)";
        return each_query($this->db->query($sintak));
    }
    function save($tipe, $sid, $nilai, $by, $tgl)
    {
        $sintak = "call iuran('$tipe','$sid','$nilai','$by','$tgl');";
        return $this->db->query($sintak);
    }
    function saldo($sid, $tgl)
    {
        $sintak = "SELECT COUNT(1) AS total,FORMAT(SUM(tab_in),0,'de_DE') AS tab_in, FORMAT(SUM(tab_out),0,'de_DE') AS tab_out,FORMAT(SUM(tab_in-tab_out),0,'de_DE') AS sisa from (
                        SELECT COUNT(1) AS total,SUM(tab_in) AS tab_in, SUM(tab_out) AS tab_out,SUM(tab_in-tab_out) AS sisa FROM tbl_transaksi a LEFT JOIN tbl_siswa b ON a.siswa_fk_id=b.siswa_id
                        WHERE tab_tanggal='$tgl' AND siswa_kelas_id=(SELECT siswa_kelas_id FROM tbl_siswa WHERE siswa_id='$sid') AND recid='1' group by siswa_id) iuran";
        return single_query($this->db->query($sintak));
    }
}
