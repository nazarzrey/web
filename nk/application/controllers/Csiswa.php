<?php

require_once(APPPATH . 'controllers/Settings.php');
class Csiswa extends Settings{
	function __construct(){
		parent::__construct();
        $this->load->library('session');
		$this->load->library('form_validation');
	}
	function index(){	
        $data["page"] = false;
		$this->siswa_template("vsw_login",$data);
	}
}
