<?php
$hdr_page   = $db->escape($_GET[$page]);
$Redirected = $get_page . "=" . $hdr_page;
$table 		= "content_other";
$column		= "content_dtl";
$get_id 	= "id_content";
$get_fk_id 	= "about_us";
$get_content = select_data_func($table, $column, $get_id, $get_fk_id, $Redirected);
?>
<div style="padding:15px;">
	<div><?= $get_content; ?></div>
</div>