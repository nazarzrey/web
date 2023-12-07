$(document).ready(function(){
	$('.carousel[data-type="multi"] .item').each(function(){
	  var next = $(this).next();
	  if (!next.length) {
		next = $(this).siblings(':first');
	  }
	  next.children(':first-child').clone().appendTo($(this));
	  
	  for (var i=0;i<2;i++) {
		next=next.next();
		if (!next.length) {
			next = $(this).siblings(':first');
		}
		
		next.children(':first-child').clone().appendTo($(this));
	  }
	});
	$(".submit-button").click(function(){
		$nama = $("#name").val();
		$mail = $("#email").val();
		$sub  = $("#subject").val();
		$msg  = $("#message").val();
		if($nama.length!=0 && $mail.length!=0 && $sub.length!=0 && $msg.length!=0){
			$("form-contact").submit();
		}
	})
		
});