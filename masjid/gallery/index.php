<body>
<?php
$dir    = './';
$files1 = scandir($dir);
// $files2 = scandir($dir, 1);

foreach ($files1 as $key => $value) {
	if(strlen($value)>4){
		if($value!="index.php"){
		echo "<div  style='margin:20px 30px 30px 30px;float:left'><img src='$value'/><br/><br/>$value</div>";
	}
	};
}
?>
</body>