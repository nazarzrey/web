<?php
	require_once "../config/config.web.php";
	require_once "../config/config.db.php";
	$db = New Db();
	//var_dump($db);
	if(isset($_POST["name"]) && isset($_POST["email"])){
		$name = $_POST["name"];
		$mail = $_POST["email"];
		$subj = $_POST["subject"];
		$mssg = $_POST["message"];
		$sintak = "insert into guest_book (tanggal,jam,nama,email,judul,pesan) values (CURDATE(),CURTIME(),'$name','$mail','$subj','$mssg')";
		if($db -> query($sintak)){
			mailing($name,$mail,$subj,$mssg);
			$result = "yes";
		}else{
			$result = "no";
		}
		echo $result;
	}

function mailing($name,$mail,$subj,$mssg){
	$subject  = "Auto message, from komputeclift.com @ $tgl $jam";
	//$to	 	  = "rahmat@komputeclift.com";
	//$to	 	  = "nazarudin@agencyfish.com";
	$to	  = "nazar.zrey@gmail.com";
	/*
	$message  = "<i><b>Message detail  	</b></i><br/>&nbsp;<br/>Nama&nbsp;&nbsp;:&nbsp;$name&nbsp;<br/>Email&nbsp;&nbsp;&nbsp;:&nbsp;$Value2&nbsp;<br/>Pesan&nbsp;&nbsp;:&nbsp;".$Value3; */
			$message  = "<i><b>Message detail  	</b></i><br/>&nbsp;<br/>Nama&nbsp;&nbsp;:&nbsp;".$name."&nbsp;<br/>Email&nbsp;&nbsp;&nbsp;:&nbsp;".$mail."&nbsp;<br/>Judul&nbsp;&nbsp;&nbsp;:&nbsp;".$subj."<br/>Pesan&nbsp;&nbsp;:&nbsp;".$mssg."<p/>&nbsp;<br/><i><b>Penting..</b> ini adalah pesan otomatis dari website.., untuk balas gunakan alamat email dari isi pesan, jangan gunakan menu forward / reply, tapi gunakan menu NEW EMAIL dan alamat yang tujuan adalah alamat di dalam pesan ini...!</i>";
	$headers  = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$headers .= 'From: Info Komputeclift.com <info@komputeclift.com>' . "\r\n";
	$headers .= 'Cc: komputeclift@gmail.com' . "\r\n";
	//$headers .= 'Cc: nazar.zrey@gmail.com' . "\r\n";
	@mail($to,$subject,$message,$headers); 
}	
?>