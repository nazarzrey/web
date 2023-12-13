<?php

require_once(APPPATH . 'controllers/Settings.php');
class Admin153_report extends Settings
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            redirect(base_url("login"));
        };
        $this->load->model(array('Mod_master'));
    }
    function index()
    {
        $uid = $this->session->userdata("idadmin");
        $sintak = "SELECT fk_mid,date_format(a.updrec_date,'%d-%m-%Y') as tanggal,currency(cash_in) as cash_in,currency(cash_out) as cash_out,description,b.name as tipe,c.nama
                FROM tbl_transaksi a LEFT JOIN tbl_master b ON a.`fk_mid`=b.`mid`                
                AND jurnal='1'
                LEFT JOIN tbl_user c ON a.`acc_by`=c.`uid`
                WHERE fk_uid='$uid'
                ORDER BY a.updrec_date desc";
        $get_dtl = each_query($this->db->query($sintak));
        if ($get_dtl) {
            $data["report"] = $get_dtl;
        } else {
            $data["report"] = "error";
        }
        $transaksi = $this->Mod_query->Query("tbl_master", array("jurnal" => "1"));
        $data["transaksi"]   = $transaksi;
        $this->admin_template("vs_report", $data);
    }
}
