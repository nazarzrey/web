<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
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
        $this->load->library('pdf');
		$this->load->model(array('Mod_query'));
	}
	public function unique($value='')
	{
		if($value!=""){
			return $this->session->userdata()[$value];
		}else{
			return $this->session->userdata();
		}		
	}
	public function index($value=""){
		echo json_encode("this ajax");
	}

    public function pdfAjax($value='',$value1=''){
    	echo base_url("xhr/xpdf");
    }
    public function xpr($input,$value=''){
    	if($value!="x"){
    		return " ".$input."='$value' and";
    	}
    }
    public function cari($v='',$v1=''){
    	$kec = $this->input->post("kecamatan");
    	$kel = $this->input->post("kelurahan");
    	if(count($kel)>1){
    		$kel = $kel[1];
    		if($kel==""){
    			$kel = "x";
    		}
    	}else{
    		$kel = $kel[0];
    	}
    	$jas = rTags($this->input->post("jasal"));
    	$kon = $this->input->post("konstruksi");
    	$lhn = $this->input->post("lahan");
    	$thn = $this->input->post("tahun");
    	$sts = $this->input->post("status_laporan");
    	$fnd = rTags(strtolower($this->input->post("find")));
    	$qry = "where ".str_replace("andxx","",$this->xpr("kecamatan",$kec).$this->xpr("kelurahan",$kel).$this->xpr("jasal",$jas).$this->xpr("konstruksi",$kon).$this->xpr("lahan",$lhn).$this->xpr("tahun",$thn).$this->xpr("status_laporan",$sts)."xx")." and jalan like '%$fnd%'";
    	$res = $this->Mod_query->find($qry);
        if(is_array($res)){
        	$data_table = $res;
			$file = APPPATH."/views/backend/table_report.php";
			include($file);
        }else{
            echo "<span class='title-3'>Data ".$fnd." tidak ditemukan</span>";
        }
    }

    public function xpdfAjax($v='',$v1=''){
    	$kec = $this->input->post("kecamatan");
    	$kel = $this->input->post("kelurahan");
    	if(count($kel)>1){
    		$kel = $kel[1];
    		if($kel==""){
    			$kel = "x";
    		}
    	}else{
    		$kel = $kel[0];
    	}
    	$jas = rTags($this->input->post("jasal"));
    	$kon = $this->input->post("konstruksi");
    	$lhn = $this->input->post("lahan");
    	$thn = $this->input->post("tahun");
    	$sts = $this->input->post("status_laporan");
    	$qry = "where ".str_replace("andxx","",$this->xpr("kecamatan",$kec).$this->xpr("kelurahan",$kel).$this->xpr("jasal",$jas).$this->xpr("konstruksi",$kon).$this->xpr("lahan",$lhn).$this->xpr("tahun",$thn).$this->xpr("status_laporan",$sts)."xx");
    	$res = $this->Mod_query->Expor($qry);


        $pdf = new FPDF('l','mm','A3');

        // membuat halaman baru
        $pdf->AddPage();
        $pdf->Image(assets('img/logo_depok.png'),10,6,20);
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Times','B',16);
        // mencetak string 
        $pdf->Cell(23);
        $pdf->Cell(190,7,'Dinas Pekerjaan Umum dan penataan ruang ',0,1,'L');        
        $pdf->Cell(23);
        $pdf->Cell(190,8,'Kota Depok',0,1,'L');
        $pdf->SetFont('Courier','i',12);    
        $pdf->Cell(23);
        $pdf->Cell(190,11,'*menggunakan kertas A3',0,1,'L');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,0,'',0,1);
        $pdf->SetFont('Arial','B',10);
        // $pdf->cMargin = 0;
    	$pdf->cell(15,6,'Tahun',1,0);
    	$pdf->cell(30,6,'Pelapor',1,0);
    	$pdf->cell(60,6,'Jalan',1,0);
    	// $pdf->cell(30,6,'Kordinat',1,0);
    	$pdf->cell(30,6,'Kecamatan',1,0);
    	$pdf->cell(35,6,'Kelurahan',1,0);
    	$pdf->cell(30,6,'Konstruksi',1,0);
    	$pdf->cell(30,6,'Lahan',1,0);
    	$pdf->cell(20,6,'Jenis',1,0);
    	$pdf->cell(35,6,'Status',1,0);
    	$pdf->cell(25,6,'Nilai Pagu',1,0);
    	$pdf->cell(95,6,'Alasan',1,1);
        $pdf->SetFont('Arial','',10);
		// debug(count($res[0]));
        if(!$res[0]){
        	$pdf->cell(435,6,"tidak ada data yang ditemukan",1,1);
        }else{
			foreach ($res[0] as $key => $rsl) {    		
		    	$pdf->cell(15,6,$rsl->tahun,1,0);
		    	$pdf->cell(30,6,$rsl->pelapor,1,0);
		    	$pdf->cell(60,6,$rsl->jalan,1,0);
		    	// $pdf->cell(15,6,$rsl->kordinat,1,0);
		    	$pdf->cell(30,6,$rsl->kecamatan,1,0);
		    	$pdf->cell(35,6,$rsl->kelurahan,1,0);
		    	$pdf->cell(30,6,$rsl->konstruksi,1,0);
		    	$pdf->cell(30,6,$rsl->lahan,1,0);
		    	$pdf->cell(20,6,$rsl->jenis,1,0);
		    	$pdf->cell(35,6,$rsl->status_lap,1,0);
		    	$pdf->cell(25,6,$rsl->pagu,1,0);
		    	$pdf->cell(95,6,substr($rsl->alasan,0,60),1,1);
				# code...
			}
		}

	   # $pdf->cell(400,6,$res[2],1,10);
        // $pdf->Output();
    	#debug($res[1]);
    	
        // $pdf = new FPDF('l','mm','A4');
        // membuat halaman baru
        // $pdf->AddPage();
        #$pdf->Image(assets('img/logo_depok.png'),10,6,20);
        // setting jenis font yang akan digunakan/*
        $pdf->Output();
    }
	public function get_content($value1='',$value2='',$value3='')
	{
		#echo $value1;
		if($value1=="peta"){
			$hasil  = $this->Mod_query->get_peta();
			// $peta[] = "";
			foreach ($hasil as $key => $maps) {
				$peta[] = array($maps->jalan,$maps->kordinat,"http://localhost/ci/uji/assets/img/favicon.png");
			}
            echo json_encode($peta);
		}
		if($value1=="usulan"){
			$data = $this->Mod_query->ttl_usulan($value2,$value3,"");
			echo json_encode($data);
		}
		if($value1=="kelurahan"){
			$kelurahan = $this->Mod_query->getCamatLurah("kel_only",$value2);
			echo json_encode($kelurahan);
		}
		if($value1=="gallery"){
			$gallery = $this->Mod_query->getGallery($value2);
			if($gallery){
				$galer = array();
				foreach ($gallery as $key => $value) {
					$hasil = explode(":",$value->img);
                	$path  = $hasil[0];
                	$gambar= $hasil[1];
					$big   = get_img($path,$gambar,"big");
					$small = get_img($path,$gambar,"small");
					$galer[] = array("id"=>$value->id,"img"=>$big,"small"=>$small);
				}
				echo json_encode($galer);
			}

		}
		if($value1=="kecamatan"){			
			$kelurahan = $this->Mod_query->getCamatLurah("kec_only",$value2);
			echo json_encode($kelurahan);
		}
		if($value1=="allcamat"){			
			$kelurahan = $this->Mod_query->getCamatLurah("kec_all",$value2);
			echo json_encode($kelurahan);
		}
		if($value1=="addopsi"){
			$addOpsi = $this->Mod_query->addOpsi($value2);
			echo json_encode($addOpsi);
		}
	}
	public function post_other()
	{
	 	$ttl = $this->input->post();
	 	#count($ttl["form"]);
	 	if(isset($ttl["users"])){	 		
	 		if($ttl["users"][0]=="new"){
	 			$tipe = "add";
	 		}elseif($ttl["users"][0]=="edit"){
	 			$tipe = "update";
	 		}else{
	 			$tipe = "delete";
	 		}
	 		if($ttl["users"][3]!="*****"){
	 			if($tipe=="add"){
	 				$array = array('name' => $ttl["users"][2],'pwd'=>md5($ttl["users"][3]),'tipe'=>$ttl["users"][4],'recid'=>$ttl["users"][5]);
	 			}else{
	 				$array = array('uid' => $ttl["users"][1],'pwd'=>md5($ttl["users"][3]),'name' => $ttl["users"][2],'tipe'=>$ttl["users"][4],'recid'=>$ttl["users"][5]);	 				
	 			}
	 		}else{
	 			$array = array('uid' => $ttl["users"][1],'name' => $ttl["users"][2],'tipe'=>$ttl["users"][4],'recid'=>$ttl["users"][5]);
	 		}	 		
	 		if($tipe=="add"){
	 			$cek_settings  = $this->Mod_query->cekOther("users",$array);
	 			if($cek_settings){
	 				echo json_encode(array("status"=>"0"));
	 			}else{
	 				$save_settings = $this->Mod_query->saveOther("users",$array,"add");	 			
	 				$this->status($save_settings,'admin/users');
	 			}	 			
	 		}else{
				$save_settings = $this->Mod_query->saveOther("users",$array,$tipe);
				if($this->unique("uid")==$ttl["users"][1]){
					$this->status($save_settings,'login/logout');
				}else{
					$this->status($save_settings,'admin/users');
				}
	 		}
	 	}elseif(isset($ttl["form"])){
	 		#echo "ok".$ttl["form"][0];
	 		$id    = $ttl["form"][0];
 			$data  = $ttl["form"][3];
 			$frm   = $ttl["form"][2];
 			$conf  = $ttl["form"][1];
 			$recid = $ttl["form"][4];
 			if($conf=="kecamatan" || $conf=="kelurahan"){
 				$xid = "id_kec";
 				$lat = $ttl["form"][5];
 				$lng = $ttl["form"][6];
 				$re  = "1";
		 		$array  = array('nama' => $data, 'recid' => $recid,'latitude'=>$lat,'longitude'=>$lng);
		 		$array2 = array($xid=>$id,'nama' => $data, 'recid' => $recid,'latitude'=>$lat,'longitude'=>$lng);
			 	$array3 = array($xid=>$id,'nama' => $data, 'recid' => $re,'latitude'=>$lat,'longitude'=>$lng);
 				if($conf=="kelurahan"){
 					$kec    = $ttl["form"][7];
 					$xid    = "id_kel";
		 			$array  = array('nama' => $data, 'recid' => $recid,'latitude'=>$lat,'longitude'=>$lng,'id_fk_kec'=>$kec);
		 			$array2 = array($xid=>$id,'nama' => $data, 'recid' => $recid,'latitude'=>$lat,'longitude'=>$lng,'id_fk_kec'=>$kec);
		 			$array3 = array($xid=>$id,'nama' => $data, 'recid' => $re,'latitude'=>$lat,'longitude'=>$lng,'id_fk_kec'=>$kec);
 				}
		 		if($id=="new"){
					#echo db_array($array,"update")	 			;
					#$builder->where($array);
		 			#$save_settings = $this->Mod_query->saveOther("table","desk","desk2")
		 			$cek_settings  = $this->Mod_query->cekOther($conf,$array);
		 			if($cek_settings){
		 				echo json_encode(array("status"=>"0"));
		 			}else{
		 				$save_settings = $this->Mod_query->saveOther($conf,$array,"add");	 				
		 				$this->status($save_settings,'');
		 			}
		 		}else{
		 			if($frm=="addel"){
			 			$save_settings = $this->Mod_query->saveOther($conf,$array2,"update");
		 				$this->status($save_settings,'');
			 		}else{
			 			$cekused = array($conf=>$id);
		 				$cekuse  = $this->Mod_query->cekOther("berkas_pengaduan",$cekused);
		 				if($cekuse){
		 					if(count($cekuse)==0){
								$save_settings = $this->Mod_query->saveOther($conf,$array3,"delete");
		 						$this->status($save_settings,'');
		 					}else{
			 					$re    = "0" ;
		 						$save_settings = $this->Mod_query->saveOther($conf,$array3,"update");
		 						$this->status($save_settings,'');
		 					}
		 				}else{
							$save_settings = $this->Mod_query->saveOther($conf,$array3,"delete");
		 					$this->status($save_settings,'');
		 				}
			 		}
		 		}

 			}else{
		 		if($id=="new"){
		 			$array = array('desk' => $data, 'config1' => $conf, 'recid' => $recid);
					#echo db_array($array,"update")	 			;
					#$builder->where($array);
		 			#$save_settings = $this->Mod_query->saveOther("table","desk","desk2")
		 			$cek_settings  = $this->Mod_query->cekOther("settings",$array);
		 			if($cek_settings){
		 				echo json_encode(array("status"=>"0"));
		 			}else{
		 				$save_settings = $this->Mod_query->saveOther("settings",$array,"add");	 				
		 				$this->status($save_settings,'');
		 			}
		 		}else{
		 			if($frm=="addel"){
			 			$array = array('id'=>$id,'desk' => $data, 'recid' => $recid);
			 			$save_settings = $this->Mod_query->saveOther("settings",$array,"update");
		 				$this->status($save_settings,'');
			 		}else{
			 			$cekused = array($conf=>$id);
		 				$cekuse  = $this->Mod_query->cekOther("berkas_pengaduan",$cekused);
			 			$array   = array('id'=>$id,'config1' => $conf,'recid' => '1');
		 				if($cekuse){
		 					if(count($cekuse)==0){
								$save_settings = $this->Mod_query->saveOther("settings",$array,"delete");
		 						$this->status($save_settings,'');
		 					}else{
			 					$array   = array('id'=>$id,'config1' => $conf,'recid' => '0');
		 						$save_settings = $this->Mod_query->saveOther("settings",$array,"update");
		 						$this->status($save_settings,'');
		 					}
		 				}else{
			 				$array   = array('id'=>$id,'config1' => $conf,'recid' => '1');
							$save_settings = $this->Mod_query->saveOther("settings",$array,"delete");
		 					$this->status($save_settings,'');
		 				}
			 		}
		 		}
		 	}
	 	}
	}
	public function status($return,$custom){
		if($return){
			if($custom!=""){
				echo json_encode(array("status"=>$custom));
			}else{
				echo json_encode(array("status"=>"1"));
			}
		}else{	 				
			echo json_encode(array("status"=>"0"));
		}
	}
	public function post_content()
	{
		#echo form_open_multipart('search/post_func');
		ini_set('display_errors', true);
		ini_set('max_execution_time', 0);
		ini_set('upload_max_filesize', '100M');
		ini_set('post_max_size', '100M');
		ini_set('client_max_body_size', '100M');
	    $this->load->library('upload');
	    $dataInfo 	= array();
	    $files 		= $_FILES;
	    if($this->input->post("id_laporan")){
	    	$gambar = "photos";
	    	$id 	= $this->input->post("id_laporan");
	    	$this->save_content($gambar,$files,$dataInfo,$id,"edit");
	    }else{

			if($this->input->post("jalan")){
		    	$gambar = "images";
			    $id     = $this->Mod_query->newId()->id;
			    if($id==""){
			    	$id ="1";
			    }
		    	$this->save_content($gambar,$files,$dataInfo,$id,"add");
			}else{
				$id = $this->input->post("dtl_id");
		    	$this->save_content("","","",$id,"delete");
			}
	    }
	}

	public function save_content($gambar,$files,$dataInfo,$id,$tipe){
		if($tipe=="delete"){
				$hapus  = $this->Mod_query->delete_data($id,"id_pengaduan","berkas_pengaduan");
				if($hapus){
			    	$picture = $this->Mod_query->update_gambar($id,"");
			    	if($picture){
				    	foreach ($picture as $key => $oimg) {		    		
			    			$this->Mod_query->update_gambar($oimg->id,"del");
			    			$file = APPPATH."../".$oimg->path.$oimg->nama_file;
			    			if(file_exists("../".$oimg->path.$oimg->nama_file)){
			    				unlink($file);
			    			};
				    	}
				    }
				    echo json_encode(array('status' =>"1"));
			    }else{
					echo json_encode(array('status' =>"0"));
			    }		    	
		}else{
			if(isset($_FILES[$gambar])){
			    $fls 	= $_FILES[$gambar]['name'];
			    if($fls[0]!=""){
				    $cpt 		= count($fls);
					$path 		= './gallery/'.date("ymd")."/";		   
					if (!is_dir($path)) { mkdir($path);}
					$config = array();
				    $config['upload_path'] = $path;
				    $config['allowed_types'] = 'gif|jpg|png|jpeg';
				    $config['max_size']      = '102400';
				    $config['overwrite']     = false;

				    $this->load->library('upload');
				    for($i=0; $i< $cpt; $i++)
				    {           
				        $_FILES[$gambar]['name']= $files[$gambar]['name'][$i];
				        $_FILES[$gambar]['type']= $files[$gambar]['type'][$i];
				        $_FILES[$gambar]['tmp_name']= $files[$gambar]['tmp_name'][$i];
				        $_FILES[$gambar]['error']= $files[$gambar]['error'][$i];
				        $_FILES[$gambar]['size']= $files[$gambar]['size'][$i];       

				        $this->upload->initialize($config);
				        if(!$this->upload->do_upload($gambar)){
				        	echo $this->upload->display_errors();
				        }else{
				        	$dataimg = $this->upload->data();
				        	$imgnama = $dataimg["file_name"];
				        	$imgpath = $dataimg["file_path"];
				        	$imgext  = $dataimg["file_ext"];
				        	echo imgResize($imgnama,$imgnama,1360,768,$imgext,$imgpath);
				        	echo imgResize($imgnama,"thumb-".$imgnama,450,300,$imgext,$imgpath);
				        }
				        $dataInfo[] = array('upload_data' => $this->upload->data());
				    }
				   #debug($dataInfo);
				}
			}else{
				$fls = "";
			}/*
			$this->form_validation->set_rules('jalan', 'jalan', 'trim|required|callback_html_clean|xss_clean');
			$this->form_validation->set_rules('alasan', 'alasan', 'trim|required|callback_html_clean|xss_clean');
			$this->form_validation->set_rules('pengusul', 'pengusul', 'trim|required|callback_html_clean|xss_clean');*/
			// $string = htmlentities($user_data->user_last_name, ENT_QUOTES, 'ISO-8859-15'); 
			$jalan = rTags($this->input->post("jalan",true));
			$maps  = rTags($this->input->post("longlat",true));
			$camat = $this->input->post("kecamatan");
			$lurah = $this->input->post("kelurahan");
			$jasal = $this->input->post("jasal"); #jalan / saluran
			$konst = $this->input->post("konstruksi");
			$lahan = $this->input->post("lahan");
			$tahun = $this->input->post("tahun");
			$nama  = rTags($this->input->post("pengusul",true));
			$alas  = rTags($this->input->post("alasan",true));
			$pagu  = $this->input->post("pagu");
			if($alas){
				$alas  = $alas;
			}else{
				$alas  = "";
			}
			if($tipe=="add"){
				$status = "1";
			}else{
				$status = $this->input->post("status");
			}
		    $ins1  = array(
		    	'id_pengaduan' => $id,
		    	'upd_rec' => date("Y-m-d H:i:s"),
		    	'pelapor' => $nama,
		    	'jalan' => $jalan,
		    	'kecamatan' => $camat,
		    	'kelurahan' => $lurah,
		    	'kordinat' => $maps,
		    	'konstruksi' => $konst,
		    	'jasal' => $jasal,
		    	'lahan' => $lahan,
		    	'tahun' => $tahun,
		    	'status_laporan' => $status,
		    	'lampiran' => '1',
		    	'aktif' => 'y',
		    	'alasan'=>$alas,
		    	'pagu'=>$pagu,
		     );
		    #debug($ins1);
		     $ins2 = array();

		    if($this->input->post("old")){
		    	$old    = $this->input->post("old");
		    	$picture = $this->Mod_query->update_gambar($id,"");
		    	#debug($old);
		    	#debug($gambar[0]->id);
		    	foreach ($picture as $key => $oimg) {
		    		if(!in_array($oimg->id,$old)){
		    			$this->Mod_query->update_gambar($oimg->id,"del");
		    			#unlink(APPPATH."../".$oimg->path.$oimg->nama_file);
		    			$file = APPPATH."../".$oimg->path.$oimg->nama_file;
		    			if(file_exists("../".$oimg->path.$oimg->nama_file)){
		    				unlink("../".$oimg->path.$oimg->nama_file);
		    			};
		    		}
		    	}
		    }
			if(isset($_FILES[$gambar])){
			   	if($fls[0]!=""){
			      foreach ($dataInfo as $key => $gambar){
			     	$ins2[] = array(
			     		'id_berkas' => $id,
			     		'nama_file' => $gambar["upload_data"]['file_name'],
			     		'path'	  	=> $path,
			     		'grup'  	=> 'gallery',
			     		'updrec_date' => date("Y-m-d H:i:s"),
			     		'recid' 	=> '1'
			     	);
			      }
			  }
			}
			if($tipe=="add"){
				$insert1 = $this->Mod_query->masukin_data($ins1,'berkas_pengaduan',"");
				if($fls){
				    if($fls[0]!=""){	    
				    	$insert2 = $this->Mod_query->masukin_data($ins2,'gallery',"batch");
				    }
				}
			}else{
				$insert1 = $this->Mod_query->editin_data($ins1,'berkas_pengaduan',"");

				if($fls){
				    if($fls[0]!=""){	    
				    	$insert2 = $this->Mod_query->masukin_data($ins2,'gallery',"batch");
				    }
				}
			}
		    if($insert1){
		    	echo json_encode(array('status' =>"1"));
		    }else{
		    	echo json_encode(array('status' =>"0"));
		    }

            $sess_data['pengusul']    = $nama;
            $this->session->set_userdata($sess_data);
		}
	}
	public function datasettings($data='',$id='')
	{
		#echo $data.$id;
		if($data=="kecamatan" || $data=="kelurahan"){
			$kolom = "";
			$row   = "";
			if($data=="kelurahan"){
				$kolom = "<th scope='col'>Kelurahan</th>";
			}
			$result = $this->Mod_query->kelurSettings($data,"id_".substr($data,0,3));
			#debug($result);
			echo "
            <table class='table table-bordered table-hover' width='100%' style='border:none'>
              <thead>
                <tr>
                  <th scope='col' width='50px'>Nomor</th>
                  <th scope='col'>Kecamatan</th>
                  $kolom
                  <th scope='col' class='text-center'>Digunakan</th>
                  <th scope='col' class='text-center'>Status</th>
                  <th scope='col' width='25%'>Aksi</th>
                </tr>
              </thead>
              <tbody>";
			foreach ($result as $key => $value) {
				if($data=="kelurahan"){
					$row   = "<td>$value->desk</td><td id='settings-$value->id' longlat='$value->latitude,$value->longitude'>$value->desk2</td>";
				}else{
					$row   = "<td id='settings-$value->id' longlat='$value->latitude,$value->longitude'>$value->desk</td>";
				}
				if($value->total>0){
					$totalan = "";
				}else{
					$totalan = "&nbsp;&nbsp;<a href='#' class='btn btn-sm btn-danger data-settings-delete' data-href='$value->id' data-desk='$value->desk' data-aktif='$value->recid' data-form='$data'>Hapus</a>";
				}
				if($value->recid=="1"){
					$stats = "<a href='#' class='badge badge-pill badge-success'>Aktif</a>";
					$aksi  = "<a href='#' class='btn btn-sm btn-primary data-settings-edit' data-href='$value->id' data-aktif='$value->recid' data-form='$data'>Edit</a>$totalan";
				}else{
					$stats = "<a href='#' class='badge badge-pill badge-warning'>Tidak Aktif</a>";
					$aksi  = "<a href='#' class='btn btn-sm btn-primary data-settings-edit' data-href='$value->id'  data-aktif='$value->recid' data-form='$data'>Edit</a>$totalan";
				}
				echo "<tr><td>".($key+1)."</td>$row<td class='text-center'>$value->total</td><td class='text-center'>$stats</td><td>$aksi</td></tr>";
			}
			echo "<tr><td colspan='5' class='text-center'><br/><label class='alert alert-info'>untuk data yang sudah di gunakan hanya bisa di nonaktifkan</label></td></tr>";
			echo "</tbody>
                </table>";
		}else{
			$result = $this->Mod_query->dataSettings($data,"");
			#debug($result);
			echo "
            <table class='table table-bordered table-hover' width='100%' style='border:none'>
              <thead>
                <tr>
                  <th scope='col' width='50px'>Nomor</th>
                  <th scope='col'>Deskripsi</th>
                  <th scope='col' class='text-center'>Digunakan</th>
                  <th scope='col' class='text-center'>Status</th>
                  <th scope='col' width='25%'>Aksi</th>
                </tr>
              </thead>
              <tbody>";
			foreach ($result as $key => $value) {
				if($value->total>0){
					$totalan = "";
				}else{
					$totalan = "&nbsp;&nbsp;<a href='#' class='btn btn-sm btn-danger data-settings-delete' data-href='$value->id' data-desk='$value->desk' data-aktif='$value->recid' data-form='$data'>Hapus</a>";
				}
				if($value->recid=="1"){
					$stats = "<a href='#' class='badge badge-pill badge-primary'>Aktif</a>";
					$aksi  = "<a href='#' class='btn btn-sm btn-primary data-settings-edit' data-href='$value->id' data-aktif='$value->recid' data-form='$data'>Edit</a>$totalan";
				}else{
					$stats = "<a href='#' class='badge badge-pill badge-danger'>Tidak Aktif</a>";
					$aksi  = "<a href='#' class='btn btn-sm btn-primary data-settings-edit' data-href='$value->id'  data-aktif='$value->recid' data-form='$data'>Edit</a>$totalan";
				}
				echo "<tr><td>".($key+1)."</td><td id='settings-$value->id'>$value->desk</td><td class='text-center'>$value->total</td><td class='text-center'>$stats</td><td>$aksi</td></tr>";
			}
			echo "<tr><td colspan='5' class='text-center'><br/><label class='alert alert-info'>untuk data yang sudah di gunakan hanya bisa di nonaktifkan</label></td></tr>";
			echo "</tbody>
                </table>";
		}
	}
	public function dataLaporan($id_laporan='')
	{
		$result = $this->Mod_query->dtlLaporan("","",$id_laporan);
		if($result[0]){
		
			$hdr	= $result[1];
			$dtl	= $result[0];
			$olstat = $result[0][0]->old_status;
			if($olstat<=2){
				$stat = "hilang";
			}else{
				$stat = "";
			}
			?>

	                          <div class="row">
	                            <div class="col-md-6">
	                              <div class="form-row">
	                                <div class="col-md-12 form-group hilang">
	                                  <input type="text" name="id_laporan" class="form-control" placeholder="id" data-rule="minlen:4" autocomplete="off" value="<?= $dtl[0]->id_pengaduan ?>" />
	                                  <div class="validate"></div>
	                                </div>
	                                <div class="col-md-12 form-group">
	                                  <zre>Nama Jalan</zre>
	                                  <input type="text" name="jalan" class="form-control" id="edit-jalan" placeholder="Nama jalan" data-rule="minlen:4" data-msg="silahkan isi setidaknya 4 karakter" autocomplete="off" value="<?= $dtl[0]->jalan ?>" />
	                                  <div class="validate"></div>
	                                </div>
	                              </div>
	                              <div class="form-row">
	                                  <div class="col-md-12 form-group">
	                                  <zre>Kordinat</zre>
	                                    <input type="text" class="form-control" name="longlat" id="edit-longlat" placeholder="Titik kordinat" data-rule="minlen:4" data-msg="titik kordinat harus di isi"  autocomplete="off" value="<?= $dtl[0]->kordinat ?>" />
	                                    <div class="validate"></div>
	                                  </div>
	                              </div>
	                              <div class="form-row">
	                                  <div class="form-group col-md-6">
	                                    <zre>Kecamatan</zre>
	                                    <select name="kecamatan" id="edit-kecamatan" class="form-control" data-msg="kecamatan belum di pilih" data-rule="required">
	                                        <!-- <option value="">Pilih Kecamatan</option> -->
	                                        <?php
	                                        foreach (explode(",",$dtl[0]->kecamatan) as  $has) {
	                                        	$hasil = explode(":",$has);
	                                        	echo "<option value='$hasil[0]'>$hasil[1]</option>";
	                                        }
	                                        ?>
	                                    </select>
	                                    <div class="validate"></div>
	                                  </div>
	                                  <div class="form-group  col-md-6">
	                                    <zre>Kelurahan</zre>
	                                    <select name="kelurahan" id="edit-kelurahan" class="form-control" data-msg="kelurahan belum di pilih" data-rule="required" >

	                                        <?php
	                                        foreach (explode(",",$dtl[0]->kelurahan) as  $has) {
	                                        	$hasil = explode(":",$has);
	                                        	echo "<option value='$hasil[0]'>$hasil[1]</option>";
	                                        }
	                                        ?>
	                                        </select>
	                                    <div class="validate"></div>
	                                  </div>
	                              </div>
	                              <div class="form-row">
	                                  <div class="form-group  col-md-6">
	                                    <zre>Jenis Jalan</zre>
	                                    <select name="jasal" id="edit-jasal" class="form-control" data-msg="jenis jalan / saluran belum di pilih" data-rule="required">
	                                        <?php
	                                        foreach (explode(",",$dtl[0]->jenis) as  $has) {
	                                        	$hasil = explode(":",$has);
	                                        	echo "<option value='$hasil[0]'>$hasil[1]</option>";
	                                        }
	                                        ?>
	                                        </select>
	                                    <div class="validate"></div>
	                                  </div>
	                                  <div class="form-group  col-md-6">
	                                    <zre>Jenis Konstruksi</zre>
	                                    <select name="konstruksi" id="edit-konstruksi" class="form-control" data-msg="jenis konstruksi belum di pilih" data-rule="required">
	                                        <?php
	                                        foreach (explode(",",$dtl[0]->konstruksi) as  $has) {
	                                        	$hasil = explode(":",$has);
	                                        	echo "<option value='$hasil[0]'>$hasil[1]</option>";
	                                        }
	                                        ?>
	                                        </select>
	                                    <div class="validate"></div>
	                                  </div>
	                              </div>
	                              <div class="form-row">
	                                  <div class="form-group  col-md-6">
	                                    <zre>Status Lahan</zre>
	                                    <select name="lahan" id="edit-lahan" class="form-control" data-msg="Status lahan belum di pilih" data-rule="required">
	                                        <?php
	                                        foreach (explode(",",$dtl[0]->lahan) as  $has) {
	                                        	$hasil = explode(":",$has);
	                                        	echo "<option value='$hasil[0]'>$hasil[1]</option>";
	                                        }
	                                        ?>
	                                        </select>
	                                    <div class="validate"></div>
	                                  </div>
	                                  <div class="form-group  col-md-6">
	                                    <zre>Tahun</zre>
	                                    <select name="tahun" id="edit-tahun" class="form-control" data-msg="" data-rule="required">
	                                    	<?php
		                                    $date = $dtl[0]->tahun;
		                                    echo "<option value='$date'>$date</option>";
		                                    for($x=$date-3;$x<=$date+2;$x++){
		                                        if($x!=$date){
		                                            echo "<option value='$x'>$x</option>";
		                                        }
		                                    }
		                                    ?>
		                                </select>
	                                    <div class="validate"></div>
	                                  </div>
	                              </div>
	                              <div class="form-row">
	                                <div class="col-md-6 form-group">
	                                  <zre>Pengusul</zre>
	                                  <input type="text" name="pengusul" class="form-control" id="edit-pengusul" placeholder="Nama Pengusul" data-rule="minlen:4" data-msg="silahkan isi setidaknya 4 karakter"  autocomplete="off"   value="<?= $dtl[0]->pelapor ?>"/>
	                                  <div class="validate"></div>
	                                </div>
	                                <div class="col-md-6 form-group">
	                                  <zre>Nilai Pagu</zre>
	                                  <input type="text" name="pagu" class="form-control Dec Num" id="edit-pagu" placeholder="Nilai Pagu" data-rule="minlen:4" data-msg="silahkan isi setidaknya 4 karakter"  autocomplete="off"   value="<?= $dtl[0]->pagu ?>"/>
	                                  <div class="validate"></div>
	                                </div>
	                              </div>
	                              <div class="form-row">
	                                  <div class="form-group  col-md-12">
	                                  <zre>Status</zre>
	                                    <select name="status" id="edit-status" class="form-control" data-msg="" data-rule="required">
	                                        <?php
	                                        foreach (explode(",",$dtl[0]->status_laporan) as  $has) {
	                                        	$hasil = explode(":",$has);
	                                        	echo "<option value='$hasil[0]'>$hasil[1]</option>";
	                                        }
		                                    ?>
		                                </select>
	                                    <div class="validate"></div>
	                                  </div>
	                              </div>
	                              <div class="form-row">
	                                <div class="col-md-12 form-group">
	                                  <zre class="span-info">Alasan</zre>
	                                  <textarea name="alasan" class="form-control <?= $stat ?>" id="edit-alasan" placeholder="Alasan Status" data-rule="minlen:4" data-msg="silahkan isi setidaknya 4 karakter"  autocomplete="off"><?= $dtl[0]->alasan ?></textarea>
	                                  <div class="validate"></div>
	                                </div>
	                              </div>
	                            </div>
	                          <div class="col-md-6">                            
	                              <div class="form-row">
	                                <div class="input-field col-md-12 form-group">
	                                    <div class="input-images-2" style="margin-top: -8px;height: 310px;overflow: auto;">
	                                    </div>
	                                </div>
	                              </div>
	                          </div>
	                         </div>

	                         
	                         	<?php
	                         	#if($dtl[0]->foto){
	                         		$prl = "prl".date("his").rand(0,999);
	                         		echo '<script type="text/javascript">
	                         			$(".Dec").autoNumeric("init",{mDec: "0"})
	                         				let '.$prl.' = [';
	                         				#debug($dtl[0]->foto);
	                         				if($dtl[0]->foto!="x"){
												foreach (explode(",",$dtl[0]->foto) as  $has) {
				                                	$hasil = explode(":",$has);
				                                	$id    = $hasil[0];
				                                	$path  = $hasil[1];
				                                	$gambar= $hasil[2];
				                                	echo "{id: ".$id.", src: '".get_img($path,$gambar,"small")."'},";
				                                }
				                            }
	                         		echo "
	                         				];
											$('.input-images-2').imageUploader({
											    preloaded: ".$prl.",
											    imagesInputName: 'photos',
											    preloadedInputName: 'old'
											});
	                         			</script>";
	                         	#}
			#debug($result[0]);
			#echo json_encode($result[0]);
		}else{
			echo "<h1 style='text-align:center'>data tidak ketemu, silahkan refresh browser kamu</h1>";
		}
	}
}
