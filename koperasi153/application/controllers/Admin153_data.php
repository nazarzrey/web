<?php

require_once(APPPATH . 'controllers/Settings.php');
class Admin153_data extends Settings
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
	function index()
	{
		$this->all();
	}
	function all($value = "")
	{
		$iuran    = $this->Mod_iuran->data_iuran($value, "input");
		$transaksi = $this->Mod_query->Query("tbl_master", array("jurnal" => "1"));
		$data["transaksi"]   = $transaksi;
		$data["iuran"] = $iuran;
		$data["title"] = "Iuran dan Pinjaman";
		$data["tahun"] = date("Y") . "-" . (date("Y") - 1);
		$this->admin_template("vs_alldata", $data);
	}
}
