
$('#dialog2_closed_dtl').click(function(){
	$('#result_dtl').fadeOut();	
	$('#input').focus();	
});
$('#save_kamus_edit').click(function(){	
	var judul = $('#judul_kamus_edit').val();
	var isi   = $('#isi_kamus_edit').val();
	if(isi.trim().length==0 || judul.trim().length==0){
		alert("datanya masih ada yang kosong");
		return false;
	}
	$.ajax({
		type: 'POST',
		url: 'ajax/ajax_request.php', 
		data: $("#form_kamus_edit").serialize()
	})
	.done(function(data){		
		$('#result_dtl').fadeOut();		
		$('#input').focus();		
		alert("datanya udah di simpen..");			
	})
	.fail(function(){			 
		alert( "Posting failed..." );
	});
	return false;
});
$("#delete_kamus").click(function(){
	var data_id = $("#kamus_id").val();
	var id_user = $("#id_user").val();
	var query_old = $("#query_old").val();
	$.get('ajax/ajax_request.php?delete='+data_id+'&id_user='+id_user,function(data,status){
		if(data=="Y"){
			$('#input').focus();	
			$('#result_dtl').fadeOut();	
			alert("Data sudah di hapus..!");
			$.get('ajax/ajax_request.php?data='+query_old+'&id_user='+id_user,function(data,status){
				$('#result').html(data);
			});
		}else if(data=="AF"){
			alert("Data tidak di temukan..!");
		}else{
			alert("Data gagal di hapus");
		}
	});
});