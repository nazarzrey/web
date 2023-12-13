<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //$this->load->library('session');
        $this->load->model(array('Mod_query', 'Mod_iuran'));
        if (!$this->session->userdata('masuk')) {
            redirect(base_url("login"));
        }
    }
    public function index()
    {
        echo json_encode(array("result" => "this ajax"));
    }
    public function iuran()
    {
        if (!$this->input->post("siswa_id")) {
            $this->index();
        } else {
            $tipe = $this->input->post("tipe_trans");
            $id = $this->input->post("siswa_id");
            $nilai = $this->input->post("nilai");
            $tgl = $this->input->post("tanggal");
            $by = $this->input->post("uid");
            if ($tipe == "Simpan") {
                $tab = "in";
            } else {
                $tab = "out";
            }
            $sid = explode("_", $id)[1];
            $process = $this->Mod_iuran->save($tab, $sid, str_replace(".", "", $nilai), $by, $tgl);
            $sisa    = $this->Mod_iuran->saldo($sid, $tgl);
            if ($process) {
                if ($tipe == "Simpan") {
                    echo json_encode(array("status" => "ok", "saldo" => $sisa));
                } else {
                    echo json_encode(array("status" => "ok2", "saldo" => $sisa));
                }
            } else {
                echo json_encode(array("status" => "error"));
            };
        }
    }
    function other_iuran($sid)
    {
        $hasil = json_encode(array("status" => "error get other iuran"));
        if ($sid != "") {
            $get_dtl = $this->Mod_iuran->other_iuran($sid);
            if ($get_dtl) {
                $hasil = json_encode(array("status" => "sukses", "data" => $get_dtl));
            }
        }
        echo $hasil;
    }
    function dtl_iuran($sid, $thn)
    {
        $thn = str_replace("-", ",", $thn);
        $hasil = json_encode(array("status" => "error get detail iuran"));
        if ($sid != "") {
            $get_dtl = $this->Mod_iuran->dtl_iuran($sid, $thn);
            if ($get_dtl) {
                $hasil = json_encode(array("status" => "sukses", "data" => $get_dtl));
            }
        }
        echo $hasil;
    }
    function jurnal($uid)
    {
        $hasil = json_encode(array("status" => "error get detail iuran"));
        if ($uid != "") {
            $get_dtl = $this->Mod_iuran->jurnal($uid);
            if ($get_dtl) {
                $hasil = json_encode(array("status" => "sukses", "data" => $get_dtl));
            }
        }
        echo $hasil;
    }
    function simpan_iuran($by = "", $tipe = "")
    {
        $hasil = json_encode(array("status" => "error get detail iuran"));
        if ($this->input->post()) {
            $uid = $this->input->post("uid");
            $msid = $this->input->post("msid");
            $nilai = $this->input->post("nominal");
            $desc = $this->input->post("desc");
            $acc = $this->session->userdata("idadmin");
            if ($tipe == "hapus") {
                $sql = "INSERT INTO tbl_transaksi_hapus ( id,link_id,fk_mid,fk_uid,cash_in,cash_out,description,updrec_by,acc_by,updrec_date,updrec_update,recid) SELECT id,link_id,fk_mid,fk_uid,cash_in,cash_out,description,$acc,acc_by,updrec_date,updrec_update,'d'  from tbl_transaksi where fk_uid=' $uid ' and  fk_mid='2' and date_format(updrec_date,'%Y%m')='$msid'";
                $backup = $this->db->query($sql);
                if ($backup) {
                    $query = "delete from tbl_transaksi where fk_uid=' $uid ' and  fk_mid='2' and date_format(updrec_date,'%Y%m')='$msid'";
                    $backup = $this->db->query($query);
                    $save_data = true;
                } else {
                    $save_data = false;
                }
            } else {
                if ($tipe == "edit") {
                    $sql = "INSERT INTO tbl_transaksi_hapus ( id,link_id,fk_mid,fk_uid,cash_in,cash_out,description,updrec_by,acc_by,updrec_date,updrec_update,recid) SELECT id,link_id,fk_mid,fk_uid,cash_in,cash_out,description,$acc,acc_by,updrec_date,updrec_update,'u'  from tbl_transaksi where fk_uid=' $uid ' and  fk_mid='2' and date_format(updrec_date,'%Y%m')='$msid'";
                    // $sql = "INSERT INTO tbl_transaksi_hapus select * from tbl_transaksi where fk_uid=' $uid ' and  fk_mid='2' and date_format(updrec_date,'%Y%m')='$msid'";
                    $backup = $this->db->query($sql);
                    if ($backup) {
                        $query = "delete from tbl_transaksi where fk_uid=' $uid ' and  fk_mid='2' and date_format(updrec_date,'%Y%m')='$msid'";
                        $backup = $this->db->query($query);
                    }
                }
                $sql = "INSERT INTO tbl_transaksi (fk_uid, fk_mid, updrec_date, cash_in, description, acc_by) VALUES ('" . $uid . "', '2',STR_TO_DATE('" . $msid . date("d") . "','%Y%m%d'), '" . $nilai . "', '" . $desc . "', '" . $by . "')";
                $save_data = $this->db->query($sql);
            }
            if ($save_data) {
                $hasil = json_encode(array("status" => "sukses", "data" => $save_data));
            }
        }
        echo $hasil;
    }

    function iuran_prd($tipe = "")
    {
        $hasil = json_encode(array("status" => "error save iuran periode"));
        if ($this->input->post()) {
            $id = $this->input->post("id");
            $uid = $this->input->post("uid");
            $msid = $this->input->post("prd");
            $nilai = $this->input->post("nominal");
            $desc = strtolower($this->input->post("nama")) . " bayar iuran - " . $msid;
            $acc = $this->session->userdata("idadmin");
            $sintak = "select sum(cash_in) as cash_in from tbl_transaksi where fk_mid='2' and date_format(updrec_date,'%Y%m')='$msid'";
            if ($tipe == "hapus") {
                $sql = "INSERT INTO tbl_transaksi_hapus ( id,link_id,fk_mid,fk_uid,cash_in,cash_out,description,updrec_by,acc_by,updrec_date,updrec_update,recid) SELECT id,link_id,fk_mid,fk_uid,cash_in,cash_out,description,$acc,acc_by,updrec_date,updrec_update,'x'  from tbl_transaksi where id='$id'";
                $backup = $this->db->query($sql);
                if ($backup) {
                    $query = "delete from tbl_transaksi where id='$id'";
                    $backup = $this->db->query($query);
                    $save_data = true;
                } else {
                    $save_data = false;
                }
                $total = $this->db->query($sintak)->row()->cash_in;
                $hasil = json_encode(array("status" => "sukses", "data" => $save_data, "total" => $total));
            } else {
                $sql = "INSERT INTO tbl_transaksi 
                    (fk_uid, fk_mid, updrec_date, cash_in, description, acc_by) VALUES
                    ('" . $uid . "', '2',STR_TO_DATE('" . $msid . date("d") . "','%Y%m%d'), '" . $nilai . "', '" . $desc . "', '" . $acc . "')";
                $save_data = $this->db->query($sql);
                if ($save_data) {
                    $get_id = "select id from tbl_transaksi where fk_uid='$uid' and fk_mid='2' and date_format(updrec_date,'%Y%m')='$msid' order by id desc limit 1";
                    $nid = $this->db->query($get_id)->row()->id;
                    $total = $this->db->query($sintak)->row()->cash_in;
                    $hasil = json_encode(array("status" => "sukses", "data" => $nid, "total" => $total));
                } else {
                    $hasil = json_encode(array("status" => "gagal proses, data tidak dapat disimpan, silahkan coba lagi", "data" => "", "total" => ""));
                }
            }
        }
        echo $hasil;
    }

    function master_data($id, $periode = "")
    {
        $hasil = json_encode(array("status" => "error get master data"));
        if ($id != "") {
            $sql = "CALL data_master('$id','$periode')";
            $get_dtl = $this->Mod_query->qryOther($sql);
            if ($get_dtl) {
                if (menu_admin("page", $this->session->userdata("type"), $get_dtl)) {
                    $hasil = json_encode(array("status" => "sukses", "data" => $get_dtl));
                } else {
                    $hasil = json_encode(array("status" => "gagal", "data" => "menu hanya bisa di buka dengan user admin"));
                }
            }
        }
        echo $hasil;
    }



    function iuransave()
    {
        if (!$this->input->post("siswa_id")) {
            $this->index();
        } else {
            $tipe = $this->input->post("tipe_trans");
            $sid = $this->input->post("siswa_id");
            $nilai = $this->input->post("nominal");
            $tgl = $this->input->post("tanggal");
            $by = $this->input->post("uid");
            if ($tipe == "debit") {
                $tab = "in";
            } else {
                $tab = "out";
            }
            $process = $this->Mod_iuran->save($tab, $sid, str_replace(".", "", $nilai), $by, $tgl);
            $sisa    = $this->Mod_iuran->saldo($sid, $tgl);
            if ($process) {
                if ($tipe == "debit") {
                    echo json_encode(array("status" => "ok", "saldo" => $sisa));
                } else {
                    echo json_encode(array("status" => "ok2", "saldo" => $sisa));
                }
            } else {
                echo json_encode(array("status" => "error"));
            };
        }
    }
}
