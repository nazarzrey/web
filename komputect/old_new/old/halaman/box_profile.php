<style>
#box_profile{
	overflow:auto;
	padding:1px;
	background:#fff;
	border:solid 1px #001B73;
	box-shadow:0 0 10px #001B73; 
	border-radius:5px;
	padding:10px;
}	
.box3 {
	width:96.7%;
	background: linear-gradient(#ffffff,#f7f7f7);
	padding:5px 5px 15px 15px;
	box-shadow:0px 0px 10px #ddd;
	border:solid 1px #ccc;
	border-radius:5px;
	margin-bottom:10px;
	line-height:18px;
	text-align:justify;
}
.box3:hover{
	color: #0641B8;
	background: linear-gradient(#f7f7f7,#ffffff);
}
h1{
	font-family:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
	font-style:italic;
}
</style>
<div id='box_profile'>
        <div class="box3">
            <h1>Profile</h1>
	<?php 
		$query_profile = mysql_query("select judul,isi_content from content where id_content='X_MASTER_X'") or die ("Error : ".mysql_error());
		$result_profile = mysql_fetch_array($query_profile);
		echo $result_profile['1']."<p/>&nbsp;<p/>";    
			$Koh_query = mysql_query("select  * from contact where urut='1'")or die(mysql_error());	
			echo "<div>";
				$Koh_result = mysql_fetch_array($Koh_query);
					echo "<h4><i>".$Koh_result['contact_name']."</i></h4>";
					echo "&nbsp;&nbsp;&nbsp;".$Koh_result['contact_phone']."<br/>";
					echo "&nbsp;&nbsp;&nbsp;".$Koh_result['contact_email']."<br/>";
					echo "&nbsp;&nbsp;&nbsp;".$Koh_result['contact_email2'];			       
			echo "</div>";             
	?>
        
        </div>
        <div class="box3">
            <h1>Kenggulan</h1>
            <div>
        <strong>    KEUNGGULAN YANG DIMILIKI KOMPUTECLIFT</strong><p/>
            1.	Ukuran LIFT disesuaikan dengan lubang LIFT yang ada (menyesuaikan HOISTWAY)  <Br/>
            2.	Interior sesuai permintaan<Br/>
            3.	Arrival Buzzer, Gong dan Sound<Br/>
            4.	Harga Ekonomis tentunya dengan kwalitas yang bagus <Br/>
            5.	Kami menyediakan jasa kontrak service ( survey terlebih dahulu)<Br/>
        </div>
    </div>
        <div class="box3">
        <h1>Kontak</h1>
            <table width="100%" >
          <tbody>
            <tr>
              <td><strong>Marketing</strong></td>
              <td>:</td>
              <td>0817-6109-29</td>
            </tr>
            <tr>
              <td colspan="2">&nbsp;</td>
              <td >0812-9698-5375</td>
            </tr>
            <tr>
              <td><strong>Tlp/Fax</strong>	</td>
              <td>:</td>
              <td>021-96916962</td>
            </tr>
            <tr>
              <td><strong>Pin BB</strong></td>
              <td>:</td>
              <td>271820FD</td>
            </tr>
            <tr>
              <td><strong>Email</strong></td>
              <td>:</td>
              <td>komputeclift@gmail.com</td>
            </tr>
          </tbody>
        </table>
    </div>
</div>