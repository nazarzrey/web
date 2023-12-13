<?php

require_once(APPPATH . 'controllers/Settings.php');
class Admin153 extends Settings
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
	}
	function index()
	{
		$data["page"] = false;
		$this->admin_template("vs_login", $data);
	}
	function soon()
	{
		$data["page"] = false;
		$this->admin_template("soon", $data);
	}
}
