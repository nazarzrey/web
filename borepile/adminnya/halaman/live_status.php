<?php	
/*
	function cek_total($table,$get_id,$get_fk_id){
		$cek_ttl = "select count(1) from $table where $get_id='$get_fk_id'";
		if(mysql_query($cek_ttl)){
			$query_ttl  = mysql_query($cek_ttl);
			$result_ttl = mysql_fetch_array($query_ttl);
			$hasil_ttl  = $result_ttl[0];
		}else{
			$hasil_ttl  = "Error.. please cek log";
			log_error($tgl_jam,'?halaman=home',$cek_ttl);
		}
		return $hasil_ttl;
	}
	echo "<div style='float:left'>Laporan belum accept</div><div style='float:right'>".cek_total("pu_pengaduan_berkas","aktif","X")."</div>";
	echo "<div style='float:left'>Komentar laporan belum dicek</div><div style='float:right'>".cek_total("pu_komentar","status","X")."</div>";
	echo "<div style='float:left'>Pesan masuk belum dicek</div><div style='float:right'>".cek_total("pu_pesan","status","N")."</div>";
	*/
?>