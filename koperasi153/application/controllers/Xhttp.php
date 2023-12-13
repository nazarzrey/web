<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Xhttp extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        echo json_encode(array("result" => "this ajax"));
    }
    public function xhr($uid = "")
    {
        $hasil = json_encode(array("status" => "error get detail iuran"));
        if ($uid != "") {
        }
        echo $hasil;
    }
}
