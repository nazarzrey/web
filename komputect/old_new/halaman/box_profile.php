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
.bold{
	font-weight:bold;
}
</style>
<div id='box_profile'>
	<?php
		$Box_query  = mysql_query("select judul,isi_content from content where aktif='Y' and id_content='box_profile' order by urut") or die(mysql_error());
		while($Box_result = mysql_fetch_array($Box_query)){
			echo "<div class='box3'><h1>".$Box_result[0]."</h1>
					<div>".$Box_result[1]."</div>
				  </div>";
		}
	?>
        <div class="box3">
        <h1>Kontak</h1>
            <table width="100%" >
			<?php
			$Koh_query  = mysql_query("select contact_name,contact_phone,contact_phone2,contact_pinbb,contact_email,contact_email2 from contact where urut='1'")or die(mysql_error());	
			$Koh_result = mysql_fetch_array($Koh_query);
				echo "<tr><td class='bold'>Marketing</td><td>:</td><td>$Koh_result[0]</td></tr>";
				echo "<tr><td class='bold'>Telp</td><td>:</td><td>$Koh_result[1]</td></tr>";
				echo "<tr><td class='bold'>Mobile</td><td>:</td><td>$Koh_result[2]</td></tr>";
				echo "<tr><td class='bold'>Pin BB</td><td>:</td><td>$Koh_result[3]</td></tr>";
				echo "<tr><td class='bold'>Email1</td><td>:</td><td>$Koh_result[4]</td></tr>";
				echo "<tr><td class='bold'>Email2</td><td>:</td><td>$Koh_result[5]</td></tr>";
			?>
        </table>
    </div>
</div>