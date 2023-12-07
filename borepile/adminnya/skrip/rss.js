$(function() {
	setInterval(function(){ 
		$(this).load("../title.php?page=ss", function(changeTitle){
			$(document).attr("title", changeTitle);
		});
		$("#error_new").load("../rss.php?dtl=ErNw");
		$("#msg_new").load("rss.php?dtl=MsNw&grup=<?php echo $Ms_grup."&user_id=".$Id_user;?>");                    
		$("#msg_new").load("rss.php?dtl=MsNw&grup=<?php echo $Ms_grup."&user_id=".$Id_user;?>");                    
		$("#msg_new").load("rss.php?dtl=MsNw&grup=<?php echo $Ms_grup."&user_id=".$Id_user;?>");                    
		$("#msg_new").load("rss.php?dtl=MsNw&kode_dc=<?php echo $Ms_dc; ?>");                    
	}, 1000);
});
