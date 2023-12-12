<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
	function __construct() {
		parent::__construct();
    	//$this->load->library('session');
    	$this->load->model(array('Mod_query','Mod_tabungan'));
        if(!$this->session->userdata('masuk')){
            $this->index();
        }
	}
	public function index(){
        echo json_encode(array("result"=>"this ajax"));
	}
	public function tabungan(){
            if(!$this->input->post("siswa_id")){
                $this->index();
            }else{
                $tipe = $this->input->post("tipe_trans");
                $id = $this->input->post("siswa_id");
                $nilai = $this->input->post("nilai");
                $tgl = $this->input->post("tanggal");
                $by = $this->input->post("uid");
                if($tipe=="Simpan"){
                    $tab = "in";
                }else{
                    $tab = "out";
                }
                $sid = explode("_",$id)[1];      
                $process = $this->Mod_tabungan->save($tab,$sid,str_replace(".","",$nilai),$by,$tgl);
                $sisa    = $this->Mod_tabungan->saldo($sid,$tgl);
                if($process){
                    if($tipe=="Simpan"){
                        echo json_encode(array("status"=>"ok","saldo"=>$sisa));  
                    }else{
                        echo json_encode(array("status"=>"ok2","saldo"=>$sisa));  
                    }
                }else{
                    echo json_encode(array("status"=>"error"));  
                };
            }
	}
    function other_tabungan($sid){
        $hasil = json_encode(array("status"=>"error get other tabungan"));
        if($sid!=""){
            $get_dtl = $this->Mod_tabungan->other_tabungan($sid);
            if($get_dtl){
                $hasil = json_encode(array("status"=>"sukses","data"=>$get_dtl));
            }
        }
        echo $hasil;
    }
    function dtl_tabungan($sid){
        $hasil = json_encode(array("status"=>"error get detail tabungan"));
        if($sid!=""){
            $get_dtl = $this->Mod_tabungan->dtl_tabungan($sid);
            if($get_dtl){
                $hasil = json_encode(array("status"=>"sukses","data"=>$get_dtl));
            }
        }
        echo $hasil;
    }
    function tabungansave(){
        if(!$this->input->post("siswa_id")){
            $this->index();
        }else{
            $tipe = $this->input->post("tipe_trans");
            $sid = $this->input->post("siswa_id");
            $nilai = $this->input->post("nominal");
            $tgl = $this->input->post("tanggal");
            $by = $this->input->post("uid");
            if($tipe=="debit"){
                $tab = "in";
            }else{
                $tab = "out";
            }
            $process = $this->Mod_tabungan->save($tab,$sid,str_replace(".","",$nilai),$by,$tgl);
            $sisa    = $this->Mod_tabungan->saldo($sid,$tgl);
            if($process){
                if($tipe=="debit"){
                    echo json_encode(array("status"=>"ok","saldo"=>$sisa));  
                }else{
                    echo json_encode(array("status"=>"ok2","saldo"=>$sisa));  
                }
            }else{
                echo json_encode(array("status"=>"error"));  
            };
        }
    }

// 	public function backupdb($value="")
// 	{
// 		shell_exec('c:\WINDOWS\system32\cmd.exe /c bck.bat'); 
// 	}
// 	public function crud($value='',$value1='')
// 	{
// 		#echo $value,$value1;
// 		#echo $value1;
// 		if($this->input->post("name")){
// 			#post form
// 			if (strpos($value, 'plasma') !== false) {
// 				$id = $this->input->post("id");
// 				$nm = $this->input->post("name");
// 				$lp = strtolower($this->input->post("lapak"));
// 				if($value=="plasma-add"){					
// 					echo $data["result"] = $this->Mod_plasma->crud_pls($id,$nm,$lp,"add");
// 				}elseif($value=="plasma-edit"){
// 					$id = explode("_",$id)[1];
// 					echo $data["result"] = $this->Mod_plasma->crud_pls($id,$nm,$lp,"upd");
// 				}elseif($value=="plasma-delete"){
// 					$id = explode("_",$id)[1];
// 					echo $data["result"] = $this->Mod_plasma->crud_pls($id,$nm,$lp,"del");
// 				}
// 			}
// 			if (strpos($value, 'barang') !== false) {
// 				$id = $this->input->post("id");
// 				$nm = $this->input->post("name");
// 				$lp = strtolower($this->input->post("lapak"));
// 				if($value=="barang-add"){					
// 					echo $data["result"] = $this->Mod_master->crud_brg($id,$nm,$lp,"add");
// 				}elseif($value=="barang-edit"){
// 					$id = explode("_",$id)[1];
// 					echo $data["result"] = $this->Mod_master->crud_brg($id,$nm,$lp,"upd");
// 				}elseif($value=="barang-delete"){
// 					$id = explode("_",$id)[1];
// 					echo $data["result"] = $this->Mod_master->crud_brg($id,$nm,$lp,"del");
// 				}
// 			}
// 			if (strpos($value, 'sumber') !== false) {
// 				$id = $this->input->post("id");
// 				$nm = $this->input->post("name");
// 				$lp = strtolower($this->input->post("lapak"));
// 				if($value=="sumber-add"){					
// 					echo $data["result"] = $this->Mod_master->crud_supp($id,$nm,$lp,"add");
// 				}elseif($value=="sumber-edit"){
// 					$id = explode("_",$id)[1];
// 					echo $data["result"] = $this->Mod_master->crud_supp($id,$nm,$lp,"upd");
// 				}elseif($value=="sumber-delete"){
// 					$id = explode("_",$id)[1];
// 					echo $data["result"] = $this->Mod_master->crud_supp($id,$nm,$lp,"del");
// 				}
// 			}
// 			if($value=="bloklapak"){
// 				$tp = explode("-",$value1);
// 				$id = $this->input->post("id");
// 				$nm = $this->input->post("name");
// 				if(!empty($id)){
// 					$id = explode("_", $id)[1];
// 				}
// 				echo $data["result"] = $this->Mod_master->crud_blok($id,$nm,$tp[1]);
// 			}
// 		}else{
// 			#get form
// 			if (strpos($value, 'editrans') !== false) {
// 				$brg    = explode("_", $value)[1];
// 				$id  	= $this->input->post("trans_id");
// 				$qty1   = number($this->input->post("trans_qty1"));
// 				$qty0   = number($this->input->post("trans_qty0"));
// 				$harga  = number($this->input->post("trans_hrg1"));
// 				$keter  = number($this->input->post("trans_smpel"));
// 				if($qty1<=0){
// 					echo "error qty tidak boleh lebih kecil dari 1";
// 				}else{
// 					$sintak = "update  pt_transaksi_temp set qty='$qty1',keter='$keter',harga='$harga' where trans_id='$id'";
// 					if($this->db->query($sintak)){
// 						/*$trans_id = $this->Mod_trans->showtrans($id)[0]->plasma;
// 						$update = "call upd_harga_trtemp('$trans_id','$harga')";
// 						$this->db->query($update);*/
// 						echo "reload";
// 					}else{
// 						echo "gagal";
// 					};
// 				}
// 			}elseif (strpos($value, 'deltrans') !== false) {
// 				$id = explode("_", $value)[1];
// 				$sintak = "delete from pt_transaksi_temp where trans_id='$id'";
// 				if($this->db->query($sintak)){
// 					echo "reload";
// 				}else{
// 					echo "gagal";
// 				};
// 			}elseif (strpos($value, 'delhistrans') !== false) {
// 				$id = explode("_", $value)[1];
// 	  			$datatran = $this->Mod_trans->showhistrans($id);
// 	  			if($datatran){
// 	  				$tgl_tran = "'".$datatran[0]->tgl_tran."'";
// 	  				$brg_tran = $datatran[0]->brg_id;
// 					$sintak   = "delete from pt_transaksi_dtl where tran_dtl_id='$id' and dtl_qty_trf=0";
// 	  				if($this->db->query($sintak)){
// 						$hitul = "CALL hitung_ulang('$brg_tran',$tgl_tran,CURDATE())";
// 						if($this->db->query($hitul)){
// 							echo "refresh";
// 						}else{						
// 							echo "sukses sukses...!!! namun harus di hitung ulang manual";
// 						}
// 					}else{
// 	  					echo "error gagal hapus coba lagi";
// 					}
// 	  			}else{
// 	  				echo "error gagal hapus data tidak ditemukan";
// 	  			}
// 			}elseif (strpos($value, 'delalltrans') !== false) {
// 				$sintak = "delete from pt_transaksi_temp";
// 				if($this->db->query($sintak)){
// 					echo "reload";
// 				}else{
// 					echo "gagal";
// 				};
// 			}elseif (strpos($value, 'panen') !== false) {
// 				$id = explode("_", $value)[2];
// 				$sintak = "update pt_transaksi_plasma set panen_status='".date("ymd")."' where plasma_id='$id'";
// 				echo $this->db->query($sintak);
// 			}elseif (strpos($value, 'history') !== false) {
// 				$id = explode("_", $value)[2];
// 				$result = $this->Mod_request->histrans($id);
// 				if($result){
// 				$data = "";
// 					foreach ($result as $key => $hasil) {
// 						$keys = $key +1;
// 						$data .= "<tr><td>$keys</td><td>".$hasil->brg."</td><td>".$hasil->ttl."</td></tr>";
// 					}
// 				echo $data;
// 				}
// 			}elseif (strpos($value, 'erasetrans') !== false) {
// 				$id  = explode("_", $value)[1];
// 				$qry = "CALL transaksi('erase','$id')";
// 				if($this->db->query($qry)){
// 					echo "refresh";
// 				}else{					
// 					echo "error gagal hapus semua data silahkan coba lagi";
// 				}
// 			}elseif (strpos($value, 'ptrans_') !== false) {
// 				$jenis = explode("_", $value)[1];
// 				$brg    = $this->input->post("brg_id");
// 				$supp   = $this->input->post("sumber_id");
// 				$qty    = number($this->input->post("ttl_qty"));
// 				$ket    = $this->input->post("keter");
// 				$qry = "CALL insert_trans_hdr('$brg','$qty','$supp','$ket')";
// 				if($this->db->query($qry)){  
// 					echo "refresh";
// 				}else{
// 					echo "pls-no";
// 				};

// 			}elseif (strpos($value, 'edithisrans') !== false) {
// 				$brg    = number($this->input->post("brg_id"));
// 				$id  	= $this->input->post("trans_id");
// 				$qty1   = number($this->input->post("trans_qty1"));
// 				$qty0   = number($this->input->post("trans_qty0"));
// 				$harga  = number($this->input->post("trans_hrg1"));
// 				$keter  = number($this->input->post("trans_smpel"));
// 				if($qty1<=0){
// 					echo "error qty tidak boleh lebih kecil dari 1";
// 				}else{
// 					#*/**/*

// 		  			$datatran = $this->Mod_trans->showhistrans($id);
// 		  			if($datatran){
// 		  				$tgl_tran = "'".$datatran[0]->tgl_tran."'";
// 		  			}else{
// 		  				$tgl_tran = "CURDATE()";
// 		  			}
// 					$sintak   = "update pt_transaksi_dtl set dtl_qty_out='$qty1',dtl_ket='$keter',dtl_price='$harga',edit_qty='$qty0',edit_date=now() where tran_dtl_id='$id'";
// 					if($this->db->query($sintak)){
// 			  			if($datatran[0]->trf_id!=0){
// 			  				$updtrf = "update pt_transaksi_dtl SET dtl_qty_out=dtl_qty_out + (dtl_qty_trf-$qty1),dtl_qty_trf=$qty1 where tran_dtl_id='".$datatran[0]->trf_id."'";
// 			  				$this->db->query($updtrf);
// 			  			}
// 						$hitul = "CALL hitung_ulang('$brg',$tgl_tran,CURDATE())";
// 						if($this->db->query($hitul)){
// 							echo "refresh";
// 						}else{						
// 							echo "sukses sukses...!!! namun harus di hitung ulang manual";
// 						}
// 					}else{
// 						echo "gagal";
// 					};
// 				}
// 			}else{
// 				if($value=="prostrans"){
// 					$tgl      = tgl("eng",$value1);
// 					$jam 	  = substr($value1,11,8);
// 					$tgl_jam  = $tgl." ".$jam;
// 					$uid 	  = $this->session->userdata('uid');
// 	        		$jenis	  = $this->Mod_trans->getHdrbooking("","cek");
// 					$cektrans = $this->Mod_trans->showtrans("");
// 					if($cektrans){
// 						$sql = "CALL proses_trans_loop('trn-plsm','$uid','$tgl_jam')";
// 						if($query = $this->db->query($sql)){						
// 							$struk = $this->Mod_struk->cetak_struk("","all");
// 							if($struk){
// 								foreach ($struk as $key => $cetak) { #data yg belum kesetruk akan di struk semua
// 									$faktur = $cetak->nofak;	
// 									$data   = $this->Mod_struk->struk_trans($cetak->nofak);
// 									$update = $this->Mod_struk->cetak_struk($faktur,"upd");
// 								}
// 								shell_exec('c:\WINDOWS\system32\cmd.exe /c cetak_pt'); 
// 							}
// 							echo "refresh";
// 						}else{
// 							echo "0";
// 						}
// 					}else{						
// 	        			if($jenis->jenis=="pakan" || $jenis->jenis=="obat"){	        				
// 							$sql = "CALL proses_barang('masuk','$uid','$tgl_jam')";
// 							if($query = $this->db->query($sql)){
// 								echo "sukses sukses...!!! data barang sudah di masukan ke transaksi dan stock";
// 							}else{
// 								echo "gagal";
// 							}
// 	        			}else{
// 							echo "error belum ada data transaksi";
// 						}
// 					}
// 				}
// 				if($value=="prostrans_in"){
// 					$tgl 	= tgl("eng",$value1);
// 					$jam 	= substr($value1,11,8);
// 					$tgljam = $tgl." ".$jam;
// 					$uid 	= $this->session->userdata('uid');
// 					$brg    = $this->input->post("brg_id_in");
// 					$supp   = $this->input->post("sumber_id_in");
// 					$qty    = number($this->input->post("ttl_qty_in"));
// 					$qry    = "CALL insert_trans_hdr('$brg','$qty','$supp','')";
// 					if($this->db->query($qry)){
// 						$sql = "CALL proses_barang('masuk','$uid','$tgljam')";
// 						if($query = $this->db->query($sql)){
// 							echo "sukses sukses...!!! data barang sudah di masukan ke transaksi dan stock";
// 						}else{
// 							echo "0";
// 						}
// 					}else{
// 						echo "pls-no";
// 					};
// 				}
// 				if($value=="prostrans_upd"){
// 					$tgl 	= tgl("eng",$value1);
// 					$jam 	= substr($value1,11,8);
// 					$tgljam = $tgl." ".$jam;
// 					$trn    = $this->input->post("tran_id");
// 					$uid 	= $this->session->userdata('uid');
// 					$brg    = $this->input->post("brg_id_in");
// 					$supp   = $this->input->post("sumber_id_in");
// 					if(empty($supp)){ $supp = 0; }
// 					$qty    = number($this->input->post("ttl_qty_in"));
// 					$dtl    = "update pt_transaksi_dtl set barang_fk_id='$brg',supplier='$supp',dtl_qty_in='$qty',updrec_date='$tgljam' where tran_dtl_id='$trn'";					
// 					$hdr    = "UPDATE pt_transaksi_hdr a LEFT JOIN pt_transaksi_dtl b ON tran_hdr_id=tran_dtl_id
// 							   SET a.ttl_item=b.dtl_qty_in,a.ttl_qty_in=b.dtl_qty_in,tran_supp=supplier,tran_date=b.updrec_date
// 							   WHERE b.tran_dtl_id = '$trn'";					
// 		  			$data   = $this->Mod_trans->showhistrans($trn);
// 		  			$hitul  = "";
// 		  			if($data){
// 		  				if($tgl > $data[0]->tgl_tran ) {
// 		  					$tgl_tran = "'".$data[0]->tgl_tran."'";
// 		  				}else{
// 		  					$tgl_tran = "'".$tgl."'";
// 		  				} 
// 		  				$brg_tran = $data[0]->brg_id;
// 						$hitul = "CALL hitung_ulang('$brg_tran',$tgl_tran,CURDATE())";
// 					}
// 					if($this->db->query($dtl)){
// 						if($query = $this->db->query($hdr)){
// 							echo "sukses sukses...!!! data barang masuk sudah di update";
// 						}else{
// 							echo "0";
// 						}
// 						if(!empty($hitul)){
// 							$this->db->query($hitul);
// 						}
// 					}else{
// 						echo "pls-no";
// 					};
// 				}elseif($value=="cetakstruk"){
// 					$struk = $this->Mod_struk->cetak_struk("","all");
// 					if($struk){
// 						foreach ($struk as $key => $cetak) {		
// 							$faktur = $cetak->nofak;	
// 							$data   = $this->Mod_struk->struk_trans($cetak->nofak);
// 							$update = $this->Mod_struk->cetak_struk($faktur,"upd");
// 						}
// 						shell_exec('c:\WINDOWS\system32\cmd.exe /c cetak_pt'); 
// 					}
// 				}elseif($value=="plasma"){
// 					$trans  = $this->input->post("trans_id");
// 					$brg    = $this->input->post("barang_id");
// 					$plasma = $this->input->post("plasma_id");
// 					$kolam  = $this->input->post("kolam_id");
// 					$supp   = $this->input->post("supp_id");
// 					$ket  = $this->input->post("keter");
// 					$qty    = number($this->input->post("qty_trans"));
// 					$sisa   = number($this->Mod_trans->getHdrbooking($brg,"brg")->sisa);
// 					$hrg 	= number($this->input->post("hargabarang"));
// 					$total  = $sisa - $qty;
// 					if($total>=0){
// 						$qry1 = "CALL insert_trans('$brg','$qty','$plasma','$supp','$kolam','$hrg','$ket')";
// 						if($this->db->query($qry1)){
// 							$this->db->query("call upd_harga_trtemp('$plasma','$hrg')");
// 							echo "show modal result";
// 						}else{
// 							echo "pls-no";
// 						}
// 					}else{
// 						echo "gacukup";
// 					}
// 				}elseif($value=="laporan"){
// 					$brg    = $this->input->post("find_data");
// 					$tgl1   = tgl("eng",$this->input->post("tgl1"));
// 					$tgl2   = tgl("eng",$this->input->post("tgl2"));
// 					$grup   = $this->input->post("grup");
// 					if(is_numeric($brg)){
// 						$jenis  = $this->Mod_master->getDtlBarang($brg)->jenis;
// 						$where  = " and b.barang_fk_id='$brg'";
// 						$where2 = " and d.barang_id='$brg'";
// 						$bar    = $this->Mod_master->getDtlBarang($brg)->nama;
// 					}else{
// 						$jenis  = $brg;
// 						$where  = " and d.barang_jenis='$brg'";
// 						$where2 = $where;
// 						$bar    = strtoupper($brg);
// 					}
// 					#echo $jenis;
// 					$colls  = "3";
// 					$banyak = "sum(b.dtl_qty_out) AS banyak,";
// 					$stokin = "sum(stk_in) as masuk";
// 					$stokout = "sum(stk_out) as keluar";
// 					$stokot2 = "sum(dtl_qty_out) as keluar";
// 					$stokssa = "sum(stk_in) - sum(stk_out)  as sisa";
// 					$select  = "SELECT DATE_FORMAT(stk_tgl,'%d-%m-%Y') AS tanggal,";
// 					if($grup=="dtl"){
// 						$group = "";
// 						$banyak = "b.dtl_qty_out AS banyak,";
// 						$tglan  = "DATE_FORMAT(b.updrec_date,'%d-%m-%Y') AS tanggal,";
// 						$colls  = "4";
// 						$group1 = "";
// 						$group2 = "";
// 						$stokin = "stk_in as masuk";
// 						$stokout = "stk_out as keluar";
// 						$stokot2 = "dtl_qty_out as keluar";
// 						$stokssa = "stk_akhir as sisa";
// 					}elseif($grup=="day"){
// 						$group  = " group by DATE_FORMAT(b.updrec_date,'%Y-%m-%d'),b.supplier,b.barang_fk_id";
// 						$tglan  = "DATE_FORMAT(b.updrec_date,'%d-%m-%Y') AS tanggal,";						
// 						$group1 = "";
// 						$group2 = "";
// 						$stokin = "stk_in as masuk";
// 						$stokout = "stk_out as keluar";
// 						$stokot2 = "dtl_qty_out as keluar";
// 						$stokssa = "stk_akhir as sisa";
// 					}elseif($grup=="month"){
// 						$group = " group by DATE_FORMAT(b.updrec_date,'%Y-%m'),b.supplier,b.barang_fk_id";
// 						$tglan  = "DATE_FORMAT(b.updrec_date,'%m-%Y') AS tanggal,";
// 						$group1 = " group by DATE_FORMAT(stk_tgl,'%Y-%m'),b.barang_fk_id";
// 						$group2 = " group by DATE_FORMAT(stk_tgl,'%Y-%m'),e.barang_id";
// 						$select  = "SELECT DATE_FORMAT(stk_tgl,'%m-%Y') AS tanggal,";
// 					}elseif($grup=="year"){
// 						$group = " group by DATE_FORMAT(b.updrec_date,'%Y'),b.supplier,b.barang_fk_id";
// 						$tglan  = "DATE_FORMAT(b.updrec_date,'%Y') AS tanggal,";
// 						$group1 = " group by DATE_FORMAT(stk_tgl,'%Y'),b.barang_fk_id";
// 						$group2 = " group by DATE_FORMAT(stk_tgl,'%Y'),e.barang_id";
// 						$select  = "SELECT DATE_FORMAT(stk_tgl,'%Y') AS tanggal,";
// 					}
// 					if($jenis=="pakan" || $jenis=="obat"){
// 						if(!is_numeric($brg)){
// 							$sintak = "
// 							$select 
// 							b.barang_name AS barang,
// 							$stokin ,
// 							$stokout ,
// 							$stokssa
// 							FROM pt_master_stock e LEFT JOIN pt_master_barang b ON e.barang_id=b.barang_id
// 							";
// 							$sql = $sintak.str_replace("and d.","where b.",$where2)." and stk_tgl BETWEEN '$tgl1' AND '$tgl2' 
// 									$group2
// 									ORDER BY stk_tgl asc";
// 							$hdr = "
// 							<thead>
// 								<th>Tanggal</th>
// 								<th>Barang</th>
// 								<th>Masuk</th>
// 								<th>Keluar</th>
// 								<th>Sisa</th>
// 							</thead>
// 							<tbody>";
// 						}else{
// 							$sintak = "
// 							$select 
// 							d.barang_name AS barang,
// 							$stokin ,
// 							$stokot2 ,
// 							$stokssa ,
// 							CONCAT(c.nama,' ',IFNULL(g.kolam_nama,'')) AS ke,
// 							b.barang_fk_id
// 							FROM pt_transaksi_hdr a 
// 							LEFT JOIN pt_transaksi_dtl b ON b.tran_hdr_fk_id=a.tran_hdr_id 
// 							LEFT JOIN pt_plasma c ON a.tran_plasma=c.id 
// 							LEFT JOIN pt_master_barang d ON b.barang_fk_id=d.barang_id 
// 							LEFT JOIN pt_kolam_hdr g ON b.dtl_kolam=g.kolam_id
// 							LEFT JOIN pt_master_stock e ON b.barang_fk_id=e.barang_id 
// 							AND e.stk_tgl=DATE_FORMAT(b.updrec_date,'%Y-%m-%d')
// 							where dtl_qty_out>0
// 							";
// 							$sql = $sintak.$where2." and DATE_FORMAT(b.updrec_date,'%Y-%m-%d') BETWEEN '$tgl1' AND '$tgl2' 
// 								$group1
// 								ORDER BY b.updrec_date,d.barang_name ";
// 							$hdr = "
// 							<thead>
// 								<th>Tanggal</th>
// 								<th>Barang</th>
// 								<th>Masuk</th>
// 								<th>Keluar</th>
// 								<th>Ke</th>
// 								<th>Sisa</th>
// 							</thead>
// 							<tbody>";
// 						}
// 						echo $sql;
// 						$query = $this->db->query($sql);
// 						#var_dump($query);
// 						if($result = $query->result()){
// 							echo $hdr;
// 		                    $tgl1 = "";
// 		                    $msk1 = "";
// 		                    $out1 = "";
// 		                    $t    = "";
// 							foreach ($result as $key => $v) {
// 								if($tgl1 == $v->tanggal){
// 									$tgl1 = $v->tanggal;
// 									$tgl  = "";
// 									$brd  = "";
// 								}else{
// 									$tgl1 = $v->tanggal;		
// 									$tgl  = $tgl1;			
// 									$brd  = "class='brdx'";
// 								}
// 								if($msk1==$v->masuk){
// 									$msk1 = $v->masuk;
// 									$msk  = "";
// 								}else{
// 									$msk1 = $v->masuk;
// 									$msk  = $msk1;
// 								}
// 								if($out1==$v->sisa){
// 									$out1 = $v->sisa;
// 									$out  = "";
// 								}else{
// 									$out1 = $v->sisa;
// 									$out  = $out1;
// 								}
// 								/*
// 								if($t!=$v->tanggal){
// 									if($tgl!=""){
// 										$sisa = "<tr style='background:#BFFFD7'><td colspan='5'><h5>Sisa Pakan</h5></td><td><h5>$v->sisa</h5></td></tr>";
// 									}else{
// 										$sisa = "";
// 									}
// 								}else{
// 									$sisa = "";
// 								}*/
// 								if(!is_numeric($brg)){
// 									echo "<tr>
// 											<td>$tgl</td>
// 											<td>$v->barang</td>
// 											<td class='txr'>".currency($v->masuk)."</td>
// 											<td class='txr'>".currency($v->keluar)."</td>			
// 											<td class='txr'>".currency($v->sisa)."</td
// 									</tr>";
// 									#echo $sisa;
// 								}else{
// 									echo "<tr $brd>
// 											<td>$tgl</td>
// 											<td>$v->barang</td>
// 											<td class='txr'>".currency($msk)."</td>
// 											<td class='txr'>".currency($v->keluar)."</td>
// 											<td>$v->ke</td>										
// 											<td class='txr'>".currency($out)."</td>
// 									</tr>";
// 									#echo $sisa;
// 								}
// 								$t = $v->tanggal;
// 							}
// 						}else{
// 							echo "<div class='txc msg-result' style='padding:10px'>untuk data <b>$bar</b><br/> pada tanggal <b>$tgl1</b> s/d <b>$tgl2</b> tidak ditemukan transaksinya</div>";
// 						}
// 					}elseif($jenis=="bibit" || $jenis=="limbah"){
// 						if($jenis=="bibit"){
// 							$outnya = " and b.dtl_qty_out>0";
// 						}else{
// 							$outnya = "";
// 						}
// 						#WHERE b.dtl_qty_in>0
// 						$sintak = "
// 							SELECT b.updrec_date AS tgl,
// 							$tglan
// 							e.supplier_name AS sumber,
// 							d.barang_name AS barang,
// 							b.dtl_ket AS keter,
// 							$banyak
// 							b.dtl_qty_in as masuk,
// 							CONCAT(c.nama,' ',IFNULL(g.kolam_nama,'')) AS ke,
// 							b.dtl_price  AS harga,
// 							b.dtl_kolam
// 							FROM pt_transaksi_hdr a LEFT JOIN pt_transaksi_dtl b ON b.tran_hdr_fk_id=a.tran_hdr_id 
// 							LEFT JOIN pt_plasma c ON a.tran_plasma=c.id 
// 							LEFT JOIN pt_master_barang d ON b.barang_fk_id=d.barang_id 
// 							LEFT JOIN pt_master_supplier e ON b.supplier=e.supplier_id 
// 							LEFT JOIN pt_lapak f ON c.lapak= f.id 
// 							LEFT JOIN pt_kolam_hdr g ON b.dtl_kolam=g.kolam_id
// 							";
// 						$sql = $sintak.str_replace("and","where", $where)." $outnya and DATE_FORMAT(b.updrec_date,'%Y-%m-%d') BETWEEN '$tgl1' AND '$tgl2' 
// 							$group
// 							ORDER BY b.updrec_date,d.barang_name";
// 						$query = $this->db->query($sql);
// 						if($result = $query->result()){
// 							echo "<thead>";
// 							if($grup=="dtl"){
// 								if($jenis=="bibit"){
// 									echo "
// 									<th>Tanggal</th>
// 									<th>Dari</th>
// 									<th>Ukuran</th>
// 									<th>Semplingan</th>
// 									<th class='txr'>Banyak</th>
// 									<th>Ke</th>
// 									<th>Harga</th>";
// 								}else{
// 									echo "
// 									<th>Tanggal</th>
// 									<th>Dari</th>
// 									<th class='txr'>Masuk</th>
// 									<th class='txr'>Keluar</th>
// 									<th>Ke</th>";									
// 								}
// 							}else{
// 								if($jenis=="bibit"){
// 									echo "
// 									<th>Tanggal</th>
// 									<th>Dari</th>
// 									<th>Ukuran</th>
// 									<th class='txr'>Banyak</th>";
// 								}else{
// 									echo "
// 									<th>Tanggal</th>
// 									<th>Dari</th>
// 									<th class='txr'>Banyaknya</th>";									
// 								}
// 							}	
// 							echo "
// 							</thead>
// 							<tbody>";
// 		                    $tgl1 = "";
// 		                    $sbr1 = "";
// 		                    $ttl  = 0;
// 							foreach ($result as $key => $v) {
// 								if($tgl1 == $v->tanggal){
// 									$tgl1 = $v->tanggal;
// 									$tgl  = "";
// 								}else{
// 									$tgl1 = $v->tanggal;		
// 									$tgl  = $tgl1;					
// 								}	
// 								if($sbr1 == $v->sumber){
// 									$sbr1 = $v->sumber;
// 									$sbr  = "";
// 								}else{
// 									$sbr1 = $v->sumber;		
// 									$sbr  = $sbr1;					
// 								}
// 								if($grup=="dtl"){
// 									if($jenis=="bibit"){
// 									echo "<tr>
// 											<td>$tgl</td>
// 											<td>$sbr</td>
// 											<td>$v->barang</td>
// 											<td>$v->keter</td>
// 											<td class='txr'>".currency($v->banyak)."</td>
// 											<td>$v->ke</td>
// 											<td class='txr'>Rp. $v->harga</td>
// 									</tr>";
// 									}else{
// 									echo "<tr>
// 											<td>$tgl</td>
// 											<td>$sbr</td>
// 											<td class='txr'>".currency($v->masuk)."</td>
// 											<td class='txr'>".currency($v->banyak)."</td>
// 											<td>$v->ke</td>
// 									</tr>";
// 									}
// 								}else{
// 									if($jenis=="bibit"){
// 									echo "<tr>
// 											<td>$tgl</td>
// 											<td>$sbr</td>
// 											<td>$v->barang</td>
// 											<td class='txr'>".currency($v->banyak)."</td>
// 										</tr>";
// 									}else{
// 									echo "<tr>
// 											<td>$tgl</td>
// 											<td>$sbr</td>
// 											<td class='txr'>".currency($v->banyak)."</td>
// 										</tr>";								
// 									}
// 								}
// 								$ttl = $ttl + $v->banyak;
// 							}
// 							echo "</tbody>";
// 						}else{
// 							echo "<div class='txc msg-result' style='padding:10px'>untuk data <b>$bar</b><br/> pada tanggal <b>$tgl1</b> s/d <b>$tgl2</b> tidak ditemukan transaksinya</div>";
// 						}
// 					}else{
// 						echo "";
// 					}
// 				}elseif($value=="laporan_plasma"){
// 					$id      = $this->input->post("plasma-id");
// 					$panen   = $this->input->post("lapak-panen");
// 					$data    = $this->Mod_plasma->PlasmaReport($id,"",$panen);					
//                     if($data){
//                       $jen = "";
//                      /* $jml = 0;
//                       $ttl = 0;*/
//                       if(count($data)>0){
// 	                      foreach ($data as $key => $v) {
// 	                        $jenis = $v->jenis;
// 	                        /*if($jen!=$jenis){
// 	                        	$jml   = $v->item;
// 	                        	$ttl   = $jml;
// 	                        }else{
// 	                        	$jml   = $v->item;
// 	                        	$ttl   = $jml;
// 	                        }*/
// 	                        if($jenis=="bibit"){
// 	                          $hdr = "<thead class='brdb'><th>Tanggal</th><th>Ukuran</th><th>Banyak</th><th>Harga</th><th>Dari</th></thead>";
// 	                          $dtl = "<tr><td>$v->tanggal</td><td>$v->brg</td><td class='txr'>$v->item</td><td class='txr'>$v->harga</td><td>$v->supplier</td></tr>";
// 	                        }elseif($jenis=="limbah"){
// 	                          $hdr =  "<thead class='brdl'><th>Tanggal</th><th>Dari</th><th>Banyak</th><th>Ket</th><th class='bgrl'>Limbah</th></thead>";
// 	                          $dtl = "<tr><td>$v->tanggal</td><td>$v->supplier</td><td class='txr'>$v->item</td><td></td></tr>";
// 	                        }elseif($jenis=="pakan"){
// 	                          $hdr =  "<thead class='brdp'><th>Tanggal</th><th>Jenis</th><th>Banyak</th><th>Ket</th><th class='bgrp'>Pakan</th></thead>";
// 	                          $dtl = "<tr><td>$v->tanggal</td><td>$v->brg</td><td class='txr'>$v->item</td><td>$v->keter</td></tr>";
// 	                        }elseif($jenis=="obat"){
// 	                          $hdr =  "<thead class='brdo'><th>Tanggal</th><th>Jenis</th><th>Banyak</th><th>Ket</th><th class='bgro'>Obat</th></thead>";
// 	                          $dtl = "<tr><td>$v->tanggal</td><td>$v->brg</td><td class='txr'>$v->item</td><td></td></tr>";
// 	                        }
// 	                        if($jen!=$jenis){
// 	                          echo $hdr;
// 	                          echo $dtl;
// 	                          $jen = $jenis;
// 	                        }else{
// 	                          echo $dtl;
// 	                          $jen = $jenis;
// 	                        }
// 	                      }	                
// 						  $history = $this->Mod_struk->riwayat($id);
// 						  echo "<thead class='brdh'><th>Jenis</th><th>Barang</th><th>Item</th><th class='bgrh' colspan='2'>Riwayat</th></thead>";
// 			              foreach ($history as $key => $h) {
// 			                  echo "<tr><td>$h->title</td><td>$h->brg</td><td class='txr'>$h->item</td></tr>";
// 			              }
// 	                    }
// 	                }else{
// 	                	echo "<div class='txc msg-result' style='padding:10px'><h5>data tidak ditemukan transaksinya</h5></div>";
// 	                }
// 				}elseif($value=="transferan"){
// 					$id     = $this->input->post("trf_id");
// 					$brg    = number($this->input->post("trf_brg"));
// 					$qty2   = number($this->input->post("trf_qty2"));
// 					$to     = $this->input->post("trf_plasma");
// 					$from   = $this->input->post("dari_plasma");
// 					$uid	= $this->session->userdata('uid');
// 					$tgl  	= tgl("full","en");
// 					# (IN brg CHAR(10),IN tf_id CHAR(10),IN tf_qt CHAR(10),IN pls CHAR(10),IN tf_ket CHAR(20))
// 					$qry1 = "CALL insert_trans_retur('$brg','$id','$qty2','$to','transferan dari $from')";
// 					if($this->db->query($qry1)){
// 						if(empty($value1)){
// 							$sql = "call proses_trans('trn-plsm','$uid','$tgl')";
// 							if($query = $this->db->query($sql)){
// 								echo "printdata-".$query->result()[0]->result;
// 							}else{
// 								echo "error transaksi transferan tidak dapat di proses";
// 							}
// 						}else{
// 							echo 'redirect trans/bon/'.$to.'/new';
// 						}
// 					}else{
// 						echo "pls-no";
// 					}
// 				}elseif($value=="ceklist"){
// 					$data = explode("-",$value1);
// 					if(count($data)==1){
// 						#cek_limbah( IN xid CHAR(10),IN tipe CHAR(10), IN stat CHAR(100))
// 						$prc = "call cek_limbah('".$data[0]."','cek','')";
// 					}else{
// 						$prc = "call cek_limbah('".$data[0]."','cek','1')";
// 					}
// 					if($this->db->query($prc)){
// 	        			$translimbah =  $this->Mod_trans->trans_limbah("","");
// 						if($translimbah){
// 							require_once(APPPATH.'views/include/showlimbah.php');
// 						}
// 					}
// 					echo "ok";
// 				}elseif($value=="masaksumber"){
// 					$id     = $this->input->post("lbh_id");
// 					$tipe   = $this->input->post("lbh_tipe");
// 					$des    = $this->input->post("lbh_desk");
// 					$prc    = "call cek_limbah('".str_replace("b-","",str_replace("m-","",$id))."','$tipe','$des')";
// 					if($this->db->query($prc)){
// 	        			$translimbah =  $this->Mod_trans->trans_limbah("","");
// 	        			#echo "sukses sukses...!!! di update";
// 						echo "ok|$id|$des";
// 						/*if($translimbah){
// 							require_once(APPPATH.'views/include/showlimbah.php');
// 						}*/
// 					}
// 				}
// 			}
// 		}
// 	}
// 	public function showhistrans($id){
// 		$showhistrans = $this->Mod_trans->showhistrans($id);
// 		if($showhistrans){
// 			require_once(APPPATH.'views/include/showhistrans.php');
// 		}
// 	}
// 	public function showtrans($id){		
// 		$showtrans = $this->Mod_trans->showtrans($id);
// 		if($showtrans){
// 			require_once(APPPATH.'views/include/showtrans.php');
// 		}
// 	}
// 	public function showtrans2(){		
// 		$showtrans = $this->Mod_trans->showtrans2();
// 		if($showtrans){
// 			require_once(APPPATH.'views/include/showtrans2.php');
// 		}
// 	}
// 	public function booking($value='',$value1='')
// 	{
// 		$data  = $this->Mod_request->booking($value,$value1);
// 		if($value=="lock"){
//         	//$hasil = $this->Mod_trans->histrans($value1);
//         	echo $data;
// 		}else{
// 			echo $data;
// 		}
// 	}
// 	public function transfer($value='',$value1='')
// 	{		
// 		$result = $this->Mod_trans->load_history($value);
// 		if(empty($value1)){
// 			echo json_encode($result);
// 		}
// 	}
// 	public function transplasm($value='',$value1='')
// 	{
// 		#echo $value." ".$value1;
// 		if(!empty($value)){
// 			$mst  = explode(":", $value);
// 			#if($this->input->post("plasma-id")){
// 				if(count($mst)>1){
// 					$tipe = $mst[0];
// 					$uid  = $mst[1];
// 					if($tipe=="proses"){
// 						$tgl = tgl("eng",$value1)." ".date("H:i:s");
// 						$sql = "call proses_trans('trn-plsm','$uid','$tgl')";
// 						//proses_trans(IN tpr CHAR(20),IN uid CHAR(10), IN tgl CHAR(20)
// 						//CALL proses_trans_barang(tpr,uid,tgl,az_plasma,az_kolam);
// 						if($query = $this->db->query($sql)){
// 							/*
// 							if($value1=="struk"){
// 								$nofak = $query->result_array()[0]["result"];
// 								echo $nofak;
// 								$this->Mod_struk->struk_trans($nofak);
// 							}else{*/
// 								//var_dump($query->result());
// 								echo $query->result()[0]->result;
// 							//}
// 						}else{
// 							echo "0";
// 						}
// 					}
// 				}else{
// 					if($value=="struk"){
// 						$data = $this->Mod_struk->struk_trans($value1);
// 						//shell_exec("type ".$data." >prn");						
// 						//if($data){
// 							shell_exec('c:\WINDOWS\system32\cmd.exe /c cetak_pt'); 
// 						//}
// 					}
// 					if($value=="restruk"){
// 						$data = $this->Mod_struk->restruk_trans($value1);
// 						//shell_exec("type ".$data." >prn");						
// 						//if($data){
// 							shell_exec('c:\WINDOWS\system32\cmd.exe /c cetak_pt'); 
// 						//}
// 					}
// 				}
// 			#}
// 		}else{			
// 			if($this->input->post("plasma-id")){
// 				$pls 			= $this->input->post("plasma-id");
// 				#$bibit_brg 		= $this->input->post("bibit_brg");
// 				#$bibit_sumber 	= $this->input->post("bibit_sumber");
// 				#$bibit_qty 		= number($this->input->post("bibit_qty"));
// 				#$limbah_brg 	= $this->input->post("limbah_brg");
// 				#$limbah_qty 	= number($this->input->post("limbah_qty"));
// 				$obat_brg 		= $this->input->post("obat_brg");
// 				$obat_qty 		= number($this->input->post("obat_qty"));
// 				$pakan_brg 		= $this->input->post("pakan_brg");
// 				$pakan_qty 		= number($this->input->post("pakan_qty"));
// 				//if($bibit_brg=="x" &&  $limbah_brg=="x" && $obat_brg=="x" && $pakan_brg=="x"){
// 				if($obat_brg=="x" && $pakan_brg=="x"){
// 					$data = "x";
// 				}else{			
// 					#$qry1 = "CALL insert_trans('$brg','$qty','$plasma','$supp','$kolam','$hrg','$ket')";	
// 					#$qry1 = "CALL insert_trans('$bibit_brg','$bibit_qty','$pls','$bibit_sumber','0','','')";
// 					#$qry2 = "CALL insert_trans('$limbah_brg','$limbah_qty','$pls','0','0','','')";
// 					$qry3 = "CALL insert_trans('$obat_brg','$obat_qty','$pls','0','0','','')";
// 					$qry4 = "CALL insert_trans('$pakan_brg','$pakan_qty','$pls','0','0','','')";
// 					#$this->db->query($qry1);
// 					#$this->db->query($qry2);
// 					$this->db->query($qry3);
// 					$this->db->query($qry4);
// 					$result = $this->Mod_request->load_trans($pls);
// 					$data   = "";
// 					foreach ($result as $key => $hasil) {
// 						$keys = $key +1;
// 						$data .= "<tr><td>$keys</td><td>".$hasil->brg."</td><td class='txr'>".$hasil->qty."</td></tr>";
// 					}
// 				}
// 				echo $data;
// 			}else{
// 				echo "x";
// 			}
// 		}
// 	}
// 	public function transbon($value='',$value1='')
// 	{	
// 		if($this->input->post("plasma_id")){
// 			$pls 			= $this->input->post("plasma_id");			
// 			$bibit_brg 		= $this->input->post("bibit_brg");
// 			$bibit_sumber 	= $this->input->post("bibit_sumber");
// 			$bibit_sample	= number($this->input->post("bibit_sample"));
// 			$bibit_hrg 		= number($this->input->post("bibit_hrg"));
// 			$bibit_qty 		= number($this->input->post("bibit_qty"));
// 			$bibit_kolam	= number($this->input->post("bibit_kolam"));

// 			$limbah_brg 	= $this->input->post("limbah_brg");
// 			$limbah_qty 	= number($this->input->post("limbah_qty"));			
// 			$limbah_sumber 	= $this->input->post("limbah_sumber");
// 			$limbah_kolam	= number($this->input->post("limbah_kolam"));

// 			$obat_brg 		= $this->input->post("obat_brg");
// 			$obat_qty 		= number($this->input->post("obat_qty"));
// 			$pakan_brg 		= $this->input->post("pakan_brg");
// 			$pakan_qty 		= number($this->input->post("pakan_qty"));
// 			if($this->input->post("bibit_kolam")){
// 				$kolam1 	= $this->input->post("bibit_kolam");
// 			}else{
// 				$kolam1		= 0;
// 			}
// 			if($this->input->post("limbah_kolam")){
// 				$kolam2 	= $this->input->post("limbah_kolam");
// 			}else{
// 				$kolam2		= 0;
// 			}
// 			if($bibit_brg=="x" &&  $limbah_brg=="x" && $obat_brg=="x" && $pakan_brg=="x"){
// 			//if($obat_brg=="x" && $pakan_brg=="x"){
// 				$data = "x";
// 			}else{			
// 				if($bibit_brg!="x"){
// 					//$qry1 = "CALL insert_trans('$bibit_brg','$bibit_qty','$pls','$bibit_sumber,'0','','')";
// 					$qry1 = "CALL insert_trans('$bibit_brg','$bibit_qty','$pls','$bibit_sumber','$kolam1','$bibit_hrg','$bibit_sample')";
// 					$this->db->query($qry1);
// 				}elseif($limbah_brg!="x"){
// 					$qry2 = "CALL insert_trans('$limbah_brg','$limbah_qty','$pls','$limbah_sumber','$kolam2','','')";
// 					$this->db->query($qry2);
// 				}elseif($obat_brg!="x"){
// 					$qry3 = "CALL insert_trans('$obat_brg','$obat_qty','$pls','0','0','','')";	
// 					$this->db->query($qry3);
// 				}elseif($pakan_brg!="x"){
// 					$qry4 = "CALL insert_trans('$pakan_brg','$pakan_qty','$pls','0','0','','')";
// 					$this->db->query($qry4);
// 				}
// 				$this->load_trans2();
// 			}
// 		}else{
// 			echo "x";
// 		}
// 	}
// 	public function load_trans($pls)
// 	{
// 		$variable = $this->Mod_request->load_trans($pls);
// 		foreach ($variable as $key => $value) {
// 			echo "<tr><td>$value->name</td><td>$value->qty</td>";
// 		}
// 	}
// 	public function load_trans2()
// 	{
// /*
// 		$showtrans = $this->Mod_trans->showtrans($id);
// 		if($showtrans){
// 			require_once(APPPATH.'views/include/showtrans.php');
// 		}*/

// 		$result = $this->Mod_trans->load_trans2("");
// 		if($result){
// 			require_once(APPPATH.'views/include/showtransbon.php');			
// 		}
// 		/*
// 		foreach ($result as $key => $h) {
// 			$keys = $key +1;
// 			$btn  = '
//                 <span class="btn btn-success btn-sm " data-trans="'.$h->trans_id.'" data-id="hapus-trans" data-toggle="modal" data-target="#frm-confirm">
//                     <i class="fas  fa-pencil-square-o"></i>
//                 </span>';
// 			echo "<tr><td>$keys</td><td>".$h->brg."</td><td>".$h->keter."</td><td class='txr'>".$h->harga."</td><td class='txr'>".$h->qty."</td><td class='txr'>".$btn."</td></tr>";
// 		}*/
// 	}
// 	public function price($value=''){
// 		if(!empty($value)){	
// 			$r = explode("-",$value);
// 			$jenis  = $this->Mod_master->getDtlBarang($r[1])->jenis;
// 			$harga    = $this->Mod_master->getHarga($r[0],$r[1],$r[2]);
// 			#var_dump($harga);
// 			echo json_encode(array($jenis,$harga));
// 		}
// 	}
// 	public function result($value='',$value1='')
// 	{
// 		#echo $value,$value1;
// 		if($value=="kolam"){
// 			$variable = $this->Mod_request->get_kolam("plasma",$value1);
// 			if(count($variable)>0){
// 				$nama     = $this->Mod_plasma->getNamaPlasma($value1,"id")->nama;			
// 				echo "<div class='form-group klm-select'>
//                         <select name='kolam_id' class='form-control kolam-select'>
//                         	<option value='x'>--- Pilih Kolam - ".ucwords(strtolower($nama))." ---</option>";
// 							foreach ($variable as $key => $result) {
// 								echo "<option value='$result->id'>$result->nama</option>";
// 							}
// 				echo "</select>
// 				</div>";
// 			}
// 		}elseif($value=="plasma"){
// 			$id = explode("-",$value1);
// 			$variable = $this->Mod_plasma->getDataPlasma($id[1]);
// 			if(count($variable)>0){
// 				$nama     = $this->Mod_plasma->getNamaPlasma($id[1],"lapak_id")->lapak;
// 				$harga    = $this->Mod_master->getPrice($id[1]);
// 				if($id[1]=="6"){
// 					$kolam = "data-kolam='prd'";
// 				}else{
// 					$kolam = "data-kolam='pls'";
// 				}
// 				echo "
// 					<div class='form-group pls-select'>
//                         <select name='plasma_id' class='form-control plasma-select' data-price='$harga' $kolam>
//                         	<option value='x'>--- Pilih Plasma - ".ucwords(strtolower($nama))." ---</option>";
// 							foreach ($variable as $key => $result) {
// 								echo "<option value='$result->id'>$result->nama</option>";
// 							}
// 				echo "</select>
// 					</div>";
// 					// <div class='hargabarang hilang fl'>
//      //                    <input  id='hargabarang' name='hargabarang' class='form-control wx100 Dec Num' placeholder='harga' value='$harga' autocomplete='off'>
//      //                </div>
// 			}
// 		}elseif($value=="sisa"){
// 			$brg    = $value1;
// 			$sisa   = number($this->Mod_trans->getHdrbooking($brg,"brg")->sisa);
// 			echo $sisa;
// 		}
// 	}
}