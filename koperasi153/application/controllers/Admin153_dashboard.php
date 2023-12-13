<?php

require_once(APPPATH . 'controllers/Settings.php');
class Admin153_dashboard extends Settings {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            redirect( base_url("login"));
        };
		$this->load->model(array('Mod_iuran'));
	}
	function index(){		
		$iuran = $this->Mod_iuran->laporan_keuangan("");
		$data[] = "";
		$data["iuran"] = $iuran;
		$this->admin_template("vs_beranda",$data);
	}	
}