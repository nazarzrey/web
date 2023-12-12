<?php

require_once(APPPATH . 'controllers/Settings.php');
class Siak_dashboard extends Settings {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            redirect( base_url("login"));
        };
		$this->load->model(array('Mod_siswa','Mod_tabungan'));
	}
	function index(){		
		$guru     = $this->Mod_query->qryOther("SELECT guru_nama FROM tbl_guru");
		$siswa    = $this->Mod_siswa->siswa_sum();
		$tabungan = $this->Mod_tabungan->tabungan_sum("");
		$data[] = "";
		$data["guru"] = $guru;
		$data["siswa"] = $siswa;
		$data["tabungan"] = $tabungan;
		$this->siak_template("vs_beranda",$data);
	}
	
}