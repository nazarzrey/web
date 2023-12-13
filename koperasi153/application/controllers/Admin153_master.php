<?php

require_once(APPPATH . 'controllers/Settings.php');
class Admin153_master extends Settings
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
		$this->load->model(array('Mod_master'));
	}
	function index()
	{
		$data[] = "";
		$this->admin_template("blank", $data);
	}
	function user($value = "")
	{
		$data[] = "";
		$sql    = $this->Mod_master->data_user($value);
		$data["member"] = $sql;
		$this->admin_template("vs_master", $data);
	}

	function anggota($value = "")
	{
		$data[] = "";
		$sql    = $this->Mod_master->data_anggota($value);
		$data["member"] = $sql;
		$this->admin_template("vs_master", $data);
	}
}
