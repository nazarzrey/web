<?php  
  $browser    = $this->agent->browser();
  $browser_version = $this->agent->version();
  $os   	  = $this->agent->platform();
  $ip_address = $this->input->ip_address();
  $logdetail  =  $ip_address."|".$os."|".$browser."|".$browser_version;
  $sql = "
  	INSERT INTO travel_favorite (konten_id, log_detail,log_date,log_create)
	SELECT * FROM (SELECT '$id_konten', '$logdetail', curdate(),now()) AS tmp
	WHERE NOT EXISTS (
	    SELECT 1 FROM travel_favorite WHERE log_detail = 'logdetail' and log_date=curdate() and konten_id=$id_konten
	) LIMIT 1";
  $this->db->query($sql);
?>