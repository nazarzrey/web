<?php
require_once(APPPATH . 'controllers/Settings.php');
class Siswa_login extends Settings{
    
	function __construct(){
		parent::__construct();        
        $this->load->library('encryption');
        // $this->load->model(array('Mod_query'));
// 		$this->m_pengunjung->count_visitor();
	}

	function index(){		
        $data["page"] = false;
		$this->siswa_template("vsw_login",$data);
	}
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url("login"));
    }
    function validate()
    {
        $u = $this->form_validation->set_rules('uname', 'uname', 'required|trim');
        $p = $this->form_validation->set_rules('upwd', 'upwd', 'required|trim');
		// dbg($this->input->post());
        // $c = $this->form_validation->set_rules('captcha', 'captcha', 'required|trim');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('result_login', 'Username atau Password tidak boleh ada yang kosong');
            redirect(base_url("login"));
        } else {
            
            // $gre = $this->input->post('g-recaptcha-response');
            $usr = $this->input->post('uname');
            $psw = $this->input->post('upwd');
            // $recha = get_recapture_score($gre);

            // if ($recha==0) {
            //     $this->session->set_userdata(array('user'=> $usr,"passw"=>$psw));
            //     $this->session->set_flashdata('result_login', 'Pastikan anda buka robot ');
            //     redirect(base_url("login"));
            // }
            $cek = $this->Mod_query->Query("tbl_siswa", array('siswa_nis' => $usr, 'siswa_password' => $psw));
            if (count($cek) > 0) {
                if ($cek[0]->siswa_status == 0) {
                    $this->session->set_flashdata('result_login', 'User tidak aktif tidak ada, silahkan hubungi admin');
                    redirect(base_url("login"));
					
                } else {   
                    $this->session->unset_userdata("passw");
         			$this->session->set_userdata('masuk',true);
                    foreach ($cek as $qad) {
                        // die($qad->media_path . $qad->media_name);
                        $sess_data['idadmin']            = $qad->siswa_id;
                        $sess_data['pengguna_username']           = $qad->siswa_nama;
                        $sess_data['pengguna_level']           = "siswa";
                        $sess_data['nama']           = $qad->siswa_nama;
                        $sess_data['kelas']           = $qad->siswa_kelas_id;
                    }
                    // $insert_log = array("fk_uid"=>$qad->uid,"uq"=>$cek[0]->pengguna_id,"ip"=>get_client_ip());
                    $insert_log = array("fk_uid"=>$qad->siswa_id,"ip"=>get_client_ip(),'login'=>'siwa');
                    $this->Mod_query->masukin_data($insert_log,"user_log","");                    
                    $this->Mod_query->editin_data(array("siswa_last_login"=>date("Y-m-d H:i:s")),"tbl_siswa","",array("siswa_id"=>$qad->siswa_id));
                    $this->session->set_userdata($sess_data);
                    $this->session->set_flashdata('success', 'Login Berhasil !');  
                    // if ($cek[0]->user_type == "admin") {
                        redirect(base_url("profile"));
                    // }
                }
            } else {
                $break = $this->session->set_flashdata('result_login', 'Username atau Password yang anda masukkan salah.');
                redirect(base_url("login"));
            }
        }
	}
    function qrcreate($value='')
    {
        $this->load->library('ciqrcode');
        $params['data'] = 'This is a text to encode become QR Code';
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH . 'tes.png';
        $this->ciqrcode->generate($params);
    }
    function qrlogin($value='')
    {
        if($value==""){
            $this->session->set_flashdata('result_login', 'QR Code tidak boleh kosong, silahkan login manual');
            redirect(base_url("login"));
        }else{
            // $encrypted_string = $this->encryption->encrypt($value);
            $input = $this->input->get($value, true); 
            $cek = $this->Mod_query->Query("tbl_siswa", array('siswa_qr' => $value));
            // dbg(md5($psw));
            // dbg($cek);
            if (count($cek) > 0) {
                if ($cek[0]->siswa_status == 0) {
                    $this->session->set_flashdata('result_login', 'User tidak aktif tidak ada, silahkan hubungi admin');
                    redirect(base_url("login"));
					
                } else {   
                    $this->session->unset_userdata("passw");
         			$this->session->set_userdata('masuk',true);
                    foreach ($cek as $qad) {
                        // die($qad->media_path . $qad->media_name);
                        $sess_data['idadmin']            = $qad->siswa_id;
                        $sess_data['pengguna_username']           = $qad->siswa_nama;
                        $sess_data['pengguna_level']           = "siswa";
                        $sess_data['nama']           = $qad->siswa_nama;
                        $sess_data['kelas']           = $qad->siswa_kelas_id;
                    }
                    // $insert_log = array("fk_uid"=>$qad->uid,"uq"=>$cek[0]->pengguna_id,"ip"=>get_client_ip());
                    $insert_log = array("fk_uid"=>$qad->siswa_id,"ip"=>get_client_ip(),'login'=>'siwa_qr');
                    $this->Mod_query->masukin_data($insert_log,"user_log","");
                    $this->Mod_query->editin_data(array("siswa_last_login"=>date("Y-m-d H:i:s")),"tbl_siswa","",array("siswa_id"=>$qad->siswa_id));
                    // editin_data($array, $table, $tipe, $where)
                    $this->session->set_userdata($sess_data);
                    $this->session->set_flashdata('success', 'Login Berhasil !');  
                    // if ($cek[0]->user_type == "admin") {
                        redirect(base_url("profile"));
                    // }
                }
            } else {
                $break = $this->session->set_flashdata('result_login', 'Qr code anda tidak ditemukan');
                redirect(base_url("login"));
            }
        }
	}

}
