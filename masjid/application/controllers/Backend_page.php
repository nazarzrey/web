<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend_page extends CI_Controller {
	function __construct() {
		parent::__construct();
		// if ($this->session->userdata('username')) {
		//   redirect(base_url('site'));
		// }
		// $this->load->model(array('Mod_data',
		//                           'Mod_karyawan',
		//                           'Mod_siswa',
		//                           'Mod_proses'));
		#$this->load->model(array('Mod_query'));
		#$this->load->helper('fungsi');
		$this->load->model(array('Mod_query'));		
        $this->load->library('pdf');
    	$this->load->library('user_agent');
		if(!$this->session->userdata('uid')){
			redirect(base_url('login'));
		}
        #echo APPPATH . '/vendor/fpdf.php';
	}

	public function soon($value=""){
		$data = array();
		$this->template('backend/soon',$data);
	}
	public function sesi($value='')
	{
		if($value!=""){
			return $this->session->userdata()[$value];
		}else{
			return $this->session->userdata();
		}		
	}
	public function page($value=""){
			$data["session"] = $this->sesi("");
			$data["judul"]   = $value;
			if($value=="inshod"){
				$data = "";
				$this->template('backend/infaq_shodaqoh',$data);
			}else{
				$data["kolom"]   = array("1","2","3","4","5");
				$data["label"]   = "rt-0";
				if($value=="kelas"){
					$add = "ORDER BY kelas,nama,rt";
				}elseif($value=="belumcetak"){
					$add = "WHERE IFNULL(cetak,'x')='x'";
				}else{
					$add = "";
				}
				$data["warga"] 	 = $this->Mod_query->Query($sql1);
				$sql1 = "SELECT id,nomor,nama,if(kelas='','0',ifnull(kelas,'0')) as kelas,pwd,rt FROM warga ".$add;
				$this->template('backend/halaman',$data);
			}
	}
	public function index($value="",$kec='',$kel=''){
			$data["session"] = $this->sesi("");
			$sql1 			 = "SELECT * FROM warga_kelas";
			$data["sum"] 	 = $this->Mod_query->Query($sql1);
			echo 
			$this->template('backend/summary',$data);
	/*		$data  = array("");
			$data["calur"] = $this->Mod_query->getC";
amatLurah("","");
			$data["title"] = "Home / Dashboard";
			$data["overlay"] = "Mod -> Query,View -> backend/back_page, cont -> index";
			$this->template('backend/back_page',$data,);*/
	}

	public function report($value='',$kec='',$kel=''){
		$data["session"] = $this->sesi("");
		$data["calur"] = $this->Mod_query->getCamatLurah("","");
		$data["usulan"]= $this->Mod_query->dataSettings("status","");
		$data["title"] = "Data Laporan";
		$data["overlay"] = "Mod -> Query,View -> backend/data_laporan, cont -> backend_page : report";
		//$data["detail"]= $this->Mod_query->dtlCamatLurah($value,$kec,$kel);
		#echo $kec."XXXXXXXXXX".$kel;
		if($kec!="" && $kel==""){
			$data["kelur"] = $this->Mod_query->getCamatLurah("id_kec",$kec);
		}elseif($kec!=="" && $kel!=""){
			$data["kelur"] = $this->Mod_query->getCamatLurah($kec,$kel);
		}else{
			$data["kelur"] = "Semua Kecamatan";
		}
		$this->template('backend/data_laporan',$data);
	}
	public function users($value='',$value1='')
	{
		$uid   = $this->sesi("uid");
		$utipe = $this->sesi("utype");
		/*if($utipe=="super"){
			$adkol = "super,admin,user";
		}elseif($utipe=="admin"){
			$adkol = "admin,user";
		}else{
			$adkol = "user";
		}*/
		if($utipe=="super"){
			$sql = "select * from users";
		}elseif($this->sesi("utype")=="admin"){
			$sql = "select * from users where tipe!='super'";
		}else{
			$sql = "select * from users where tipe='user' and uid='".$uid."'";
		}
		$data["session"] = $this->sesi("");
		$data["users"] = $this->Mod_query->qryOther($sql);
		$data["uid"]   = array($uid,$utipe);
		$data["useredit"] = $value;
		$data["value2"] = $value1;
		if($value!=""){
			if($value=="new"){
				$data["useredit"] = $value;
			}else{							
				/*IF(tipe='super',CONCAT(a.tipe,',',(SELECT GROUP_CONCAT(DISTINCT(tipe)) FROM users b WHERE b.tipe!=a.tipe)),
				IF(tipe='admin',CONCAT('admin',',','user'),'user')) AS gtipe,*/

				$kolom = "a.*,
						tipe as gtipe,
						IF(recid='1',CONCAT('1:aktif',',','0:tidak aktif'),CONCAT('0:tidak aktif',',','1:aktif')) AS grecid";
				if($utipe=="super"){
					$sql 	= "select $kolom from users a where a.uid='$value'";
				}elseif($utipe=="admin"){
					$sql 	= "select $kolom from users a where a.uid='$value'";
				}else{
					$sql 	= "select $kolom from users a where a.uid='$uid'";
				}
			#echo $sql;
				$data["useredit"] = $this->Mod_query->qryOther($sql);
			}
		}
#		debug($data["useredit"]);
		$this->template('backend/data_users',$data);
	}
    public function xpdf($value='',$value1=''){
        $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        $pdf->AddPage();
        #$pdf->Image(assets('img/logo_depok.png'),10,6,20);
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Times','B',16);
        // mencetak string 
        $pdf->Cell(190,7,'Dinas Pekerjaan Umum dan penataan ruang ',0,1,'L');
        $pdf->Cell(190,7,'Kota Depok',0,1,'L');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);

        #275
        $pdf->Cell(20,6,'NIM',1,0);
        $pdf->Cell(85,6,'NAMA MAHASISWA',1,0);
        $pdf->Cell(27,6,'NO HP',1,0);
        $pdf->Cell(100,6,'TANGGAL LHR',1,1);
        $pdf->SetFont('Arial','',10);

        $mahasiswa = $this->db->get('berkas_pengaduan')->result();
        foreach ($mahasiswa as $row){
            $pdf->Cell(20,6,$row->id_pengaduan,1,0);
            $pdf->Cell(85,6,$row->jalan,1,0);
            $pdf->Cell(27,6,$row->kecamatan,1,0);
            $pdf->Cell(25,6,$row->kelurahan,1,1); 
        }
        $pdf->Output();
    }

    public function export($value='',$value1=''){
		$data["session"] = $this->sesi("");
    	$data["data"] = "";
		$this->template('backend/data_export',$data);    	
    }
    public function cari($value='',$value1=''){
		$data["session"] = $this->sesi("");
    	$data["data"] = "";
		$this->template('backend/data_search',$data);    	
    }

    public function maps($value='')
    {
    	$data["peta"] = $this->Mod_query->find("where id_pengaduan='$value'");
		#$this->template('backend/peta',$data);
		$this->load->view("backend/peta",$data);
    }

    public function detail($value='',$value2='')
    {
		$data["session"] = $this->sesi("");
    	$data["xid"] = $value;
		$this->template("backend/data_detail",$data);
    }

	#template
	public function header($data)
	{
		$this->load->view("templates/backend_header",$data);
	}
	public function footer()
	{
		$this->load->view("templates/backend_footer");
	}
	
	public function template($view,$data)
	{
		$this->header($data);
		if(is_array($data)){
			$this->load->view($view,$data);
		}else{
			echo h3($view);
		}
		$this->footer();
	}
}
