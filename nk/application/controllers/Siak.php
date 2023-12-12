<?php

require_once(APPPATH . 'controllers/Settings.php');
class Siak extends Settings{
	function __construct(){
		parent::__construct();
        $this->load->library('session');
		$this->load->library('form_validation');
// 		$this->m_pengunjung->count_visitor();
	}
	function index(){
    	#echo "<h1>Selamet dateng pak Latief SPidi gitu</h1>";
		// $this->load->view("siak/s_login");
        // redirect($this->siak("login"));		
        $data["page"] = false;
		$this->siak_template("vs_login",$data);
	}
	// function login(){
	// 	$this->view->load
	// }
}
