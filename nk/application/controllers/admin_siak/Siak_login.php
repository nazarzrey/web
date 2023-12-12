<?php
require_once(APPPATH . 'controllers/Settings.php');
class Siak_login extends Settings{
    

	function __construct(){
		parent::__construct();        
        $this->load->library('encryption');
	}
	function index(){		
        $data["page"] = false;
		$this->siak_template("vs_login",$data);
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
            $cek = $this->Mod_query->Query("tbl_pengguna", array('pengguna_username' => $usr, 'pengguna_password' => md5($psw)));
            // dbg(md5($psw));
            // dbg($cek);
			// dbg(count($cek) );
            if (count($cek) > 0) {
                if ($cek[0]->pengguna_status == 0) {
                    $this->session->set_flashdata('result_login', 'User tidak aktif, silahkan hubungi admin');
                    redirect(base_url("login"));
					
                } else {   
                    $this->session->unset_userdata("passw");
                    $this->session->unset_userdata("qrcreate");
         			$this->session->set_userdata('masuk',true);
                    foreach ($cek as $qad) {
                        // die($qad->media_path . $qad->media_name);
                        $sess_data['idadmin']            = $qad->pengguna_id;
                        $sess_data['pengguna_username']           = $qad->pengguna_username;
                        $sess_data['nama']           = $qad->pengguna_nama;
                        $sess_data['pengguna_status']    = $qad->pengguna_status;
                        $sess_data['pengguna_level']           = $qad->pengguna_level;
                        $sess_data['kelas']           = $qad->pengguna_kelas_id;
                        #$sess_data['app']            = $qad->user_app;
                        // $sess_data['user_images']    = get_img_user($qad->media_path . $qad->media_name, "web");
                    }
                    // $insert_log = array("fk_uid"=>$qad->uid,"uq"=>$cek[0]->pengguna_id,"ip"=>get_client_ip());
                    $insert_log = array("fk_uid"=>$qad->pengguna_id,"ip"=>get_client_ip());
                    $this->Mod_query->masukin_data($insert_log,"user_log","");
                    $this->Mod_query->editin_data(array("last_login"=>date("Y-m-d H:i:s")),"tbl_pengguna","",array("pengguna_id"=>$qad->pengguna_id));
                    // editin_data($array, $table, $tipe, $where)
                    $this->session->set_userdata($sess_data);
                    $this->session->set_flashdata('success', 'Login Berhasil !');    
                    // if ($cek[0]->user_type == "admin") {
                        redirect(base_url("dashboard"));
                    // }
					
            die();
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
        if($value=="unsetcetaknis"){
                    $this->session->unset_userdata("qrcreate");
        }elseif($value=="cetaknis"){
            if($this->session->userdata('qrcreate')){
                
                $this->load->model('Mod_siswa','MS');
                $data["data_siswa"] = $this->MS->data_siswa("order");
                $this->load->view("siak/cetak_nis",$data);
            }else{
                ?>
                <form action="" method="post">
                    <input type="text" name="pwd" placeholder="Password Hari ini" required>
                    <button type="submit">submit</button>
                </form>
                <?php
                echo $rms = date("d")*date("m")+date("m")+date("Y");
                if(isset($_POST['pwd'])){
                    $pwd = $this->input->post('pwd');
                    if (md5($pwd)==md5($rms)) {
                        $this->session->set_userdata('qrcreate',true);
                    }else{
                        echo "Password salah";
                    }
                }
            }
        }elseif($value=="santunan"){
                $this->load->model('Mod_query');
                $sql = "SELECT *  FROM data_penerima 
                where status='Y' 
                -- and cetak='0' 
                -- and rt='4'
                and recid='1'
                order by rt,nama asc
                -- limit 50
                ";
                $data["data_santunan"] = $this->Mod_query->qryOther($sql);
                $this->load->view("siak/cetak_santunan",$data);
        }elseif($value=="cetaksantunan"){
                $this->load->model('Mod_query');
                $sql = "SELECT *  FROM data_penerima 
                where  rt='5'
                and recid='1'
                order by status desc,rt,nama asc
                -- limit 50
                ";
                $data["cetak_santunan"] = $this->Mod_query->qryOther($sql);
                $this->load->view("siak/cetak_santunan",$data);
        }else{
            echo "xx";
        }
	}

}
