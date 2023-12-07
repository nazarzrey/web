<div style="padding:10px; background:#fff;border-radius:5px;box-shadow:0 0 3px #fff;border:solid 1px #ccc;overflow:auto;">
    <div style='line-height:18px;'>
    <?php
    $Ws_query  = mysql_query("select isi_content from content where id_content='CNT' and aktif='Y'")or die (mysql_error());
    $Ws_resutl = mysql_fetch_array($Ws_query);
    echo $Ws_resutl['0'];
    ?>
    </div>
    <p/>
    <form action="" method="post">	
    <?php 
    $_SESSION['cha1'] = rand(1,20); //mendapatkan nilai 1
    $_SESSION['cha2'] = rand(1,20); //mendapatkan nilai 2
    $_SESSION['hasil'] = $_SESSION['cha1']+$_SESSION['cha2'];
    $Co_sintak = "select input_name,input,input_type,input_size,input_max,input_desc from master_input where input_desc='contact_us' order by input_sort";
    $Co_query  = mysql_query($Co_sintak) or die (mysql_error());
    while ($Co_result = mysql_fetch_array($Co_query)){
        if($Co_result['2']<>'textarea'){
            echo $Co_result['1'].'<br/>
            <input class="box"  style="width:350px;" type="'.$Co_result['2'].'" size="'.$Co_result['3'].'" maxlength="'.$Co_result['4'].'" name="'.$Co_result['0'].'"/><p/>
            ';
        }else{
            echo 
            $Co_result['1'].'<br/>
            <textarea class="box"  style="resize:none; overflow:auto; border-radius:5px;" name="'.$Co_result['0'].'" cols="'.$Co_result['3'].'" rows="'.$Co_result['4'].'" maxlength="'.($Co_result['4']*$Co_result['3']*3).'"></textarea><p/>';		
        }
    }
    ?>
    <input style="border-radius:5px;text-align:center;border:solid 1px #ccc; font-weight:bold;" type="text" name="capcha1" size='1' readonly value="<?php echo $_SESSION['cha1']; ?>"> + 
    <input style="border-radius:5px;text-align:center;border:solid 2px red; font-weight:bold; cursor:pointer;" type="text" name="capcha2" size='1' maxlength="2"> =
    <input style="border-radius:5px;text-align:center;border:solid 1px #ccc;font-weight:bold;" type="text" name="hasil" size='1' readonly value="<?php echo $_SESSION['hasil']; ?>">
    <input type="submit" value="Simpan Data" name="submit" />
    </form>
    <?php
    if (isset($_POST['submit'])){	
        if(empty($_POST['capcha2'])){
            $msg = "Capcha belum di isi";
            echo "<div class='alert1'>".$msg."</div>";
        }else{			
            $cap1  = $_POST['capcha1'];
            $cap2  = $_POST['capcha2'];
            $hasil = $_POST['hasil'];
            $total = $cap1 + $cap2;
            if (md5($hasil)<>md5($total)){
                $msg = "request kode tidak sesuai";		
                echo "<div class='alert1'>".$msg."</div>";
            }else{
                $Co_name = mysql_query("select input_name from master_input where input_desc='contact_us' and input_key='c01'") or die(mysql_error());
                $Co_email = mysql_query("select input_name from master_input where input_desc='contact_us' and input_key='c02'") or die(mysql_error());
                $Co_msg = mysql_query("select input_name from master_input where input_desc='contact_us' and input_key='c03'") or die(mysql_error());
                $Co_result1 = mysql_fetch_array($Co_name);
                $Co_result2 = mysql_fetch_array($Co_email);
                $Co_result3 = mysql_fetch_array($Co_msg);										
                $Value1 = trim(htmlentities(mysql_real_escape_string($_POST[$Co_result1['0']])));
                $Value2 = trim(htmlentities(mysql_real_escape_string($_POST[$Co_result2['0']])));
                $Value3 = trim($_POST[$Co_result3['0']]);
                if(empty($Value1) or empty($Value2) or empty($Value3)){
                    $msg = "isian masih ada yang kosong";
                    echo "<div class='alert1'>".$msg."</div>";
                }else{
                    $tgl = date("Y-m-d");
                    $jam = date("H:i:s");
                    $guest_id = md5($tgl.$jam.$Value1.$Value2.$Value3);
                    $insert="insert into guest_book (tanggal,jam,nama,email,pesan,guest_id)
                             values  ('$tgl','$jam','$Value1','$Value2','$Value3','$guest_id')";
                    $proses=mysql_query($insert) or die ($insert.mysql_error());
                    if($proses){
                    
	                    	$name	  =$Value1;
				$subject  = "Auto message, from komputeclift.com @ $tgl $jam";
				$to	  = "rahmat@komputeclift.com";
				//$to	  = "nazar.zrey@gmail.com";
				/*
				$message  = "<i><b>Message detail  	</b></i><br/>&nbsp;<br/>Nama&nbsp;&nbsp;:&nbsp;$name&nbsp;<br/>Email&nbsp;&nbsp;&nbsp;:&nbsp;$Value2&nbsp;<br/>Pesan&nbsp;&nbsp;:&nbsp;".$Value3; */
						$message  = "<i><b>Message detail  	</b></i><br/>&nbsp;<br/>Nama&nbsp;&nbsp;:&nbsp;$name&nbsp;<br/>Email&nbsp;&nbsp;&nbsp;:&nbsp;$Value2&nbsp;<br/>Pesan&nbsp;&nbsp;:&nbsp;".$Value3."<p/>&nbsp;<br/><i><b>Penting..</b> ini adalah pesan otomatis dari website.., untuk balas gunakan alamat email dari isi pesan, jangan gunakan menu forward / reply, tapi gunakan menu NEW EMAIL dan alamat yang tujuan adalah alamat di dalam pesan ini...!</i>";
				$headers  = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
				$headers .= 'From: Info Komputeclift.com <info@komputeclift.com>' . "\r\n";
				$headers .= 'Cc: komputeclift@gmail.com' . "\r\n";
				//$headers .= 'Cc: zrey_adhe@yahoo.com' . "\r\n";
				@mail($to,$subject,$message,$headers);                    
                        $msg = "Pesan sudah di simpan, kami akan follow up pesan anda";
                        $msg_direct = 'window.location.href="'.Web.'?halaman=contact";';	
                    }else{
                        $msg = "Terjadi error pada saat simpan harap input kembali";
                        $msg_direct = 'window.location.href="'.Web.'?halaman=contact";';	
                    }
                    echo "<script>alert('".$msg."');";
                    echo $msg_direct;
                    echo '</script>';
                }
            }
        }
    }
    ?>
</div>