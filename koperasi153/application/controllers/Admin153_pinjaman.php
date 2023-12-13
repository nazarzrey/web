<?php

require_once(APPPATH . 'controllers/Settings.php');
class Admin153_pinjaman extends Settings
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('masuk') != TRUE) {
            redirect(base_url("login"));
        };
        if (!menu_admin("page", $this->session->userdata("type"), "")) {
            redirect(base_url("dashboard"));
        }
        $this->load->model(array('Mod_iuran', 'Mod_query'));
    }
    function index($value = "", $value2 = "")
    {
        $this->member();
    }
    function member($value = "", $value2 = "")
    {
        $this->all("member");
    }
    function non_member($value = "", $value2 = "")
    {
        $this->all("non-member");
    }
    function all($value = "")
    {
        $iuran    = $this->Mod_iuran->data_iuran($value, "input");
        $transaksi = $this->Mod_query->Query("tbl_master", array("jurnal" => "1"));
        $data["transaksi"]   = $transaksi;
        $data["iuran"] = $iuran;
        $data["title"] = "Iuran dan Pinjaman";
        $data["tahun"] = date("Y");
        $this->admin_template("vs_pinjaman", $data);
    }
}
