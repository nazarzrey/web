<html>
<head>
<style type="text/css">
.tags{
	color:#fff;
	float:left;
	overflow:hidden;
	padding:5px;
	width:98%;
}
.tags a{
	color:#ccc;
	text-decoration:none;
}
.tags a:hover{
	color:orange;
	text-decoration: underline;
}
</style>
</head>
<body>
<div class="tags">
Tags :
<a href="http://komputeclift.com">Lift Barang</a>,<?php
$sql = mysql_query("select * from  tags order by CAST(urut AS DECIMAL)");
if ($sql){
	while ($data = mysql_fetch_row($sql)){
		echo '<a href="http://'.$data[2].'">'.$data[1].'</a>,';
	}
}	
$sql1 = mysql_query("SELECT product_name,product_id FROM  produk WHERE IFNULL(recid,'0')!='X'");
if ($sql1){
	while($sql_out=mysql_fetch_row($sql1))
		{
			$data1 = $sql_out['0'];
			$data2 = $sql_out['1'];
		//      echo '<a href="product_id-'.$data2.'.html">'.$data1.'</a> ';				
			echo '<a href="http://komputeclift.com">'.$data1.'</a>,';
		}
}
?>
</div>
</body>
</html>