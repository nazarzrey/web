<?php

require_once(APPPATH . 'controllers/Settings.php');
class Siak_master extends Settings {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('masuk') !=TRUE){
            redirect( base_url("login"));
        };
		$this->load->model(array('Mod_siswa','Mod_kelas'));
	}
	function index(){
		$data[] = "";
		$this->siak_template("blank",$data);
	}
	function siswa($value=""){
		$data[] = "";
		$sql    = $this->Mod_siswa->data_siswa($value);
		$data["siswa"] = $sql;
		$data["kelas"] = $this->Mod_kelas->data_kelas();
		$data["pilih_kelas"] = $value;
		$this->siak_template("vs_siswa",$data);
	}
	
	function guru($value=""){
		
		$guru     = $this->Mod_query->qryOther("SELECT * FROM tbl_guru");
		$data["guru"] = $guru;
		$this->siak_template("vs_guru",$data);
		
	}
	
}