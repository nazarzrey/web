<?php 
class M_guru extends CI_Model{

	function get_all_guru(){
		$hsl=$this->db->query("SELECT * FROM tbl_guru");
		return $hsl;
	}
	function get_last_nip(){
		$hsl=$this->db->query("SELECT MAX(CAST(guru_nip AS DECIMAL)+1) AS last_nip FROM tbl_guru");
		return single_query($hsl);
	}

	function simpan_guru($nip,$nama,$jenkel,$tmp_lahir,$tgl_lahir,$mapel,$photo){
		$hsl=$this->db->query("INSERT INTO tbl_pengajar (guru_nip,guru_nama,guru_jenkel,guru_tmp_lahir,guru_tgl_lahir,guru_mapel,guru_photo) VALUES ('$nip','$nama','$jenkel','$tmp_lahir','$tgl_lahir','$mapel','$photo')");
		return $hsl;
	}
	function simpan_guru_tanpa_img($nip,$nama,$jenkel,$tmp_lahir,$tgl_lahir,$mapel){
		$hsl=$this->db->query("INSERT INTO tbl_pengajar (guru_nip,guru_nama,guru_jenkel,guru_tmp_lahir,guru_tgl_lahir,guru_mapel) VALUES ('$nip','$nama','$jenkel','$tmp_lahir','$tgl_lahir','$mapel')");
		return $hsl;
	}

	function update_guru($kode,$nip,$nama,$jenkel,$tmp_lahir,$tgl_lahir,$mapel,$photo){
		if($photo==""){
			$img = "";
		}else{
			$img = ",guru_photo='$photo'";
		}
		$hsl=$this->db->query("UPDATE tbl_pengajar SET guru_nip='$nip',guru_nama='$nama',guru_jenkel='$jenkel',guru_tmp_lahir='$tmp_lahir',guru_tgl_lahir='$tgl_lahir',guru_mapel='$mapel' $img WHERE guru_id='$kode'");
		return $hsl;
	}
	// function update_guru_tanpa_img($kode,$nip,$nama,$jenkel,$tmp_lahir,$tgl_lahir,$mapel){
	// 	$hsl=$this->db->query("UPDATE tbl_pengajar SET guru_nip='$nip',guru_nama='$nama',guru_jenkel='$jenkel',guru_tmp_lahir='$tmp_lahir',guru_tgl_lahir='$tgl_lahir',guru_mapel='$mapel' WHERE guru_id='$kode'");
	// 	return $hsl;
	// }
	function hapus_guru($kode){
		$hsl=$this->db->query("DELETE FROM tbl_pengajar WHERE guru_id='$kode'");
		return $hsl;
	}

	//front-end
	function kepsek(){
		$hsl=$this->db->query("SELECT * FROM tbl_guru where struktur_id=4");
		return $hsl;
	}
	function guru(){
		$hsl=$this->db->query("SELECT * FROM tbl_guru");
		return $hsl;
	}
	function guru_perpage($offset,$limit){
		$hsl=$this->db->query("SELECT * FROM tbl_guru limit $offset,$limit");
		return $hsl;
	}

}