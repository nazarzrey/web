$(document).ready(function(){

    if($('.input-images-1').length){
        $('.input-images-1').imageUploader();
    }
    if($("#error-login").length){
		setTimeout(
			function() {				
				$("#error-login").fadeOut();
			},
		2000);    	
    }

	// $(".Dec").autoNumeric('init',{mDec: '0'})
	//  let checkbox="true"==localStorage.getItem("checked");
	//  //alert(checkbox);
	//  $("#customSwitch2,#customSwitch3").prop('checked', checkbox)

	//  //if(checkbox ===  true){
	//  	transisi(checkbox);
	 //}
/*	 $.get("http://localhost/ci/uji/xhr/seting/lahan",function(data,status){
		if(status=="success"){
			$("#settings-data").find(".settings-content").html(data);
		}else{
			alert("error parse");
		}
	 })*/

	$(".show-pass").click(function(){
		$ps = $("#log-pass,#reg-pass");
		if($ps.attr("type")==="password"){
			$ps.attr("type","text");
		}else{
			$ps.attr("type","password");
		}
	})
	if($(".peta_detail").length){
		$id = $(".peta_detail").attr("data-href");
		$("#back_peta").attr("href",base_url("peta/"+$id));
		getHtml("xhr/dtl/"+$id,".peta_detail");
	}
	if($("#laporan-usulan").length){
		//alert("g");	
		$href  = $(this).find("#data-href");
		$kec   = $href.attr("data-kecamatan");
		$kel   = $href.attr("data-kelurahan");
		$data  = "usulan/"+$kec+"/"+$kel;

		call_json_get($data);
	}
	var $utipe   = $("#header-page").attr("user-tipe");
	$(".nav-item").click(function() {
		$tab   = $(this).find("a").attr("aria-controls");
		//alert("ok")
		$("#modalusulan").find("#usulan-button").show();
		if($utipe=="user"){
			if($tab=="layak" || $tab=="tidak-layak" || $tab=="bukan-kewenangan"){
				$("#modalusulan").find("#usulan-button").hide();
			}
		}
		
	})

	$("#laporan .nav-item").click(function(){
		$("#laporan").find("span").removeClass("nav-num2").addClass("nav-num")
		$id = $(this).find("a").attr("id").replace("-tab","");
		$cl = $(".num-"+$id);
		if($cl.html().length){
			$cl.removeClass("nav-num").addClass("nav-num2");
		}
	})	
	$("#customSwitch2,#customSwitch3").on("click",function(){
		let checkbox = $(this).is(":checked");
		transisi(checkbox);
 		localStorage.setItem("checked", checkbox);
	})
	// setttings

	$(document).on("click","#btn-setting-batal",function(){
		$("#btn-settings1").removeClass("hilang");		
		$("#btn-settings2").addClass("hilang");
		$("#settings-popup").removeClass("shadow-blow shadow-blow2");
		//$(this).hide();
		$(".data-form").attr("readonly",true).val("");
		$(".settings-disable").hide();
		// $("#data-desk").val("")
	})
	$(document).on("click","#btn-setting-add",function(){
		$fm = $(this).attr("data-form");
		if($fm=="kelurahan"){
			kecamatan($(".optional-data").find("#kecamatan"));
		}
		$("#btn-settings2").removeClass("hilang");
		$("#btn-settings1").addClass("hilang");
		$("#btn-settings2").find(".btn-danger").hide();
		$("#btn-settings2").find(".btn-primary").show();
		$("#data-id").val("new");
		$(".data-form").attr("readonly",false);
		$("#data-desk").focus();
		$("#data-form").val("addel");
		$("#data-settings").val($fm);
		data_aktif("1");
	})
	$(document).on("click",".data-settings-edit",function(){
		$id = $(this).attr("data-href");
		$ak = $(this).attr("data-aktif");
		$fm = $(this).attr("data-form");
		if($fm=="kelurahan"){
			kecamatan($(".optional-data").find("#kecamatan"));
		}
		//alert($id);
		$("#settings-popup").addClass("shadow-blow");
		$("#btn-settings2").removeClass("hilang");
		$("#btn-settings2").find(".btn-danger").hide();
		$("#btn-settings2").find(".btn-primary").show();
		$("#btn-settings1").addClass("hilang");
		$(".data-form").attr("readonly",false);
		$("#data-desk").focus();
		$("#data-form").val("addel");
		$(".settings-disable").show();
		$("#data-id").val($id);
		$("#data-settings").val($fm);
		$("#data-desk").val($("#settings-"+$id).html())
		if($("#settings-"+$id).attr("longlat")){
			$("#latitude").val($("#settings-"+$id).attr("longlat").split(",")[0]);
			$("#longitude").val($("#settings-"+$id).attr("longlat").split(",")[1]);
		}
		data_aktif($ak);
	})
	$(document).on("click",".data-settings-delete",function(){
		$id = $(this).attr("data-href");
		$ak = $(this).attr("data-aktif");
		$fm = $(this).attr("data-form");
		if($fm=="kelurahan"){
			kecamatan($(".optional-data").find("#kecamatan"));
		}
		$("#settings-popup").addClass("shadow-blow2");
		$("#btn-settings2").removeClass("hilang");
		$("#btn-settings2").find(".btn-danger").show();
		$("#btn-settings2").find(".btn-primary").hide();
		$("#btn-settings1").addClass("hilang");
		$(".data-form").attr("readonly",true);
		$("#data-desk").focus();
		$("#data-form").val("delete");
		$(".settings-disable").show();
		$("#data-id").val($id);
		$("#data-settings").val($fm);
		$("#data-desk").val($("#settings-"+$id).html());
		if($("#settings-"+$id).attr("longlat")){
			$("#latitude").val($("#settings-"+$id).attr("longlat").split(",")[0]);
			$("#longitude").val($("#settings-"+$id).attr("longlat").split(",")[1]);
		}
		data_aktif($ak);
	})
	$(document).on("click","#btn-setting-save,#btn-setting-delete",function(){
		$x=0;
		$fm  = $("#modal-form-settings").find("input,select");
		$frm = $(this).attr("id");
		$fm.each(function(){
			if($(this).val()==""){
				//alert($(this).attr("id"))
				//$(this).attr("id").show().removeClass("hide hilang");
				$(this).focus();
				$x=$x;
			}else{
				$x=$x+1;
			}
		})
		if($frm=="btn-setting-delete"){
			$xz = $fm.length;
		}else{
			$xz = $x;
		}
		if($xz!=$fm.length) {
			popup("msgpopup","data input masih ada yang kosong","warning");
		}else{
			if($(this).attr("id")=="btn-setting-delete"){
				var r = confirm("Apakah data ini akan di hapuskan...?");
				if (r == false) {
				  return true;
				}
			}
			$("#modal-form-settings").submit();
		}
	})
	$(document).on("click","#btn-user-save,#btn-user-delete",function(){
		$x=0;
		$fm  = $("#modal-form-users").find("input,select");
		$frm = $(this).attr("id");
		$fm.each(function(){
			if($(this).val()==""){
				//$(this).attr("id").show().removeClass("hide hilang");
				$(this).focus();
				$x=$x;
			}else{
				$x=$x+1;
			}
		})
		if($frm=="btn-user-delete"){
			$xz = $fm.length;
		}else{
			$xz = $x;
		}
		if($xz!=$fm.length) {
			popup("msgpopup","data input masih ada yang kosong","warning");
		}else{
			$userfrm = $("#modal-form-users").find("#users-frm");
			if($(this).attr("id")=="btn-user-delete"){
				var r = confirm("Apakah data ini akan di hapuskan...?");
				if (r == false) {
				  return true;
				}
				$userfrm .val("delete");
			}else{
				if($userfrm.val()=="new"){
					$userfrm .val("new");
				}else{
					$userfrm .val("edit");
				}
			}
			$("#modal-form-users").submit();
		}
	})
	$("#btn-export").click(function(){
		$("#export-form").submit();
	})
	$("#export-form").submit(function(evt){
        evt.preventDefault();
        var formData = new FormData(this);
		$.ajax({
			type : 'POST',
			url  : base_url('xhr/pdf'),
			// dataType : 'json',
			data : formData,
	        cache:false,
	        contentType: false,
	        processData: false,
	        xhr:function(){
	        	var xhr = new XMLHttpRequest();
	            xhr.responseType= 'blob'
	            return xhr;
	        },
			success: function(data, status){				
			if(data){
                var img = document.getElementById('iframe');
                var uri = window.URL || window.webkitURL;
                img.src = uri.createObjectURL(data);

				// $("#iframe").open(data);
				// popup("msgpopup","data sudah di "+$msg,$alt);
				// $("#btn-setting-batal").click();
				// refresh(base_url("admin/users"),"")
			}else{
				loader("hide","")

				// /popup("msgpopup","gagal simpan data, mungkin data sudah ada<br/>silahkan dicoba kembali","warning");
				alert("gagal export data, silahkan ulangi");				
			}
			},
			error: function(xhr, status, error) {
				//alert(error)
			}
		})		
	});
	$("#modal-form-settings,#modal-form-users").submit(function(evt){
		//loader("show","")
		//call_ajax("#modal-form",event);
		$msg = "simpan";
		$alt = "success";
		$frm  = $(this).find("#data-settings").val();
        evt.preventDefault();
        var formData = new FormData(this);
		$.ajax({
			type : 'POST',
			url  : base_url('xhr/settings/save'),
			dataType : 'json',
			data : formData,
	        cache:false,
	        contentType: false,
	        processData: false,
			success: function(data, status){				
			if(data["status"]=="1"){
				popup("msgpopup","data sudah di "+$msg,$alt);
				$("#btn-setting-batal").click();
				modal_open($frm);
				//refresh(window.location.href,"")
			}else if(data["status"].length>1){
				refresh(base_url(data["status"]),"");
			}else{
				loader("hide","")

				popup("msgpopup","gagal simpan data, mungkin data sudah ada<br/>silahkan dicoba kembali","warning");
				//alert("gagal simpan data, silahkan ulangi");				
			}
			},
			error: function(xhr, status, error) {
				//alert(error)
			}
		})
	})
	/*					if($("#laporan #"+data[num]['desk']+"-tab").hasClass("active")){
							$(".num-"+data[num]['desk']).attr("style","border:none");
						}

*/
	// Modal
	//$("#exampleModal").show();
	$(".mdl-open").on("click",function(){		
		$data = $(this).attr("data-href");
		if($(this).attr("data-frm")){
			$frm  = $(this).attr("data-frm");
		}else{
			$frm  = "laporan";
		};
		$("#"+$data).click();
		modal_open($frm);
	})

	function data_aktif($recid){
		// alert($recid);
		$akt = $("#data-aktif");
		$akt.find("option").remove();
		if($recid=="1"){			
			$akt.append($('<option>', { 
		        value: '1',
		        text : 'Aktif'
		    }));
			$akt.append($('<option>', { 
		        value: '0',
		        text : 'Tidak Aktif'
		    }));
		}else{					
			$akt.append($('<option>', { 
		        value: '0',
		        text : 'Tidak Aktif'
		    }));
			$akt.append($('<option>', { 
		        value: '1',
		        text : 'Aktif'
		    }));
		}
	}
	function modal_open($frm){
		if($frm!="laporan"){
			$ops = $(".optional-form").find(".optional-data");
			$ops.find("input,select").remove();
			if($frm=="kecamatan"){
				$ops.append($("<input>",{
					type:"text",
					name:"form[]",
					class:"form-control data-form",
					id:"latitude",
					placeholder:"Latitude",
					readonly:"readonly"
				}));
				$ops.append($("<input>",{
					type:"text",
					name:"form[]",
					class:"form-control data-form",
					id:"longitude",
					placeholder:"Longitude",
					readonly:"readonly"
				}));
			}else if($frm=="kelurahan"){
				$ops.append($("<input>",{
					type:"text",
					name:"form[]",
					class:"form-control data-form",
					id:"latitude",
					placeholder:"Latitude",
					readonly:"readonly"
				}));
				$ops.append($("<input>",{
					type:"text",
					name:"form[]",
					class:"form-control data-form",
					id:"longitude",
					placeholder:"Longitude",
					readonly:"readonly"
				}));
				$ops.append($("<select>",{
					type:"text",
					name:"form[]",
					class:"form-control data-form",
					id:"kecamatan",
					readonly:"readonly"
				}));
			}
			$("#exampleModalLabel2").html("Setting Data "+$frm);
			$(".setting-title").html($frm);
			$("#data-settings").val($frm);
			$("#data-form").val("addel");
			$("#data-id").val("new");
			$("#data-desk").val("").focus();
			$("#btn-setting-add").attr("data-form",$frm)
			if($utipe!="user"){
				 $.get(base_url('xhr/seting/'+$frm),function(data,status){
					if(status=="success"){
						$("#settings-data").html(data);
						/*if($frm=="kelurahan"){
							kecamatan();
						}*/
					}else{
						alert("error parse");
					}
				 })
			}else{
				$("#exampleModal2").find(".modal-body").html("<div style='height:50vh'><h1>anda tidak memiliki akses untuk form ini</h1></div>");
			}
		}
	}
	$('#exampleModal').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var recipient = button.data('whatever') // Extract info from data-* attributes
	  var btn = button.data('tombol');
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	  var modal = $(this)
	  addopsi(modal.find("#kecamatan"),"camat","Kecamatan")
	  addopsi(modal.find("#konstruksi"),"kons","Jenis Konstruksi")
	  addopsi(modal.find("#lahan"),"lahan","Status Lahan")
	// $data = jxhr("xhr/get/"+get);
	  modal.find('.modal-title').text(recipient);
	  modal.find("#btn-frm").attr("class","btn btn-"+btn);
	  // modal.find('.modal-body input').val(recipient)
	})

	// form
	$("#modal-form input,#modal-form select").focusout(function(){
		if($(this).val().length>0){
			$(this).parent().find(".validate").text("");
			$(this).removeAttr("style");
			$(this).find(".image-uploader").removeAttr("style");
		}
	});
	$("#modal-form input,#modal-form select").mouseleave(function(){
		if($(this).val().length>0){
			$(this).parent().find(".validate").text("");
			$(this).removeAttr("style");
			$(this).find(".image-uploader").removeAttr("style");
		}
	});
	$("#btn-frm").on("click",function(){
		$x=0;
		$fm = $("#modal-form input,#modal-form select");
		$len = $fm.length;
		$($fm).each(function(){
			//if($(this).prop("required")){
			//alert($frm)
			//}
			$frm = $(this).val();
			$msg = $(this).attr("data-msg");
			$(this).parent().find(".validate").text("");
			$(this).removeAttr("style");
			//$(this).parent().find(".image-uploader").removeAttr("style");
			$img = $(this).parent().attr("class");
			if($img=="image-uploader"){
				$(this).parent().removeAttr("style");
			}
			if($frm.trim().length==0){
				$(this).attr("style","border:solid 1px red !important;box-shadow:0 0 2px red");
				$(this).parent().find(".validate").text($msg);
				if($img=="image-uploader"){
					$(this).parent().attr("style","border:solid 1px red !important;box-shadow:0 0 2px red");
				}				
				$x=$x;
			}else{
				$x=$x+1;
			}
			return $x;
		})
		//alert($x+" "+$len);
		if($x==$len){
			$(".modal-footer").find(".alert").hide();
			$("#modal-form").submit();
		}else{
			$(".modal-footer").find(".alert").show();			
			setTimeout(
				function() {				
					$(".modal-footer").find(".alert").fadeOut();
				},
			1500);
		}
	})
	$("#kecamatan").change(function(){		
		$val = $(this).val();
		$value = "kelurahan/"+$val;
		$.getJSON(base_url('xhr/get/'+$value),function(data,status){
			if(status=="success"){
				//for($x=0;$x<=$z;$x++){
					//alert(data[$x]['desk']);
					$("#kelurahan").prop("disabled",false);
					$("#kelurahan").find("option").remove();
					if(data.length!=0){
						$('#kelurahan').append($('<option>', { 
					        value: '',
					        text : 'Pilih kelurahan '+data[0]["kecamatan"]
					    }));
					}else{
						$('#kelurahan').append($('<option>', { 
					        value: '',
					        text : 'Belum ada data'
					    }));
					}
					$.each(data,function(i,item){
					    $('#kelurahan').append($('<option>', { 
					        value: item.id_kel,
					        text : item.kelurahan 
					    }));
					})
					//
				//}
			}else{
				//loader("h");
				alert("error parse");
			}
		});
	})
	$(document).on("change","#edit-status",function(){		
		$frm = $(this);
		$val = $frm.val();
		//alert($val);
		if($val!="1" && $val!="2"){
			$("#edit-alasan").removeClass("hilang");
		}else{
			$("#edit-alasan").val("-").addClass("hilang");
		}
	})
	$(document).on("change","#edit-kecamatan",function(){
		$id   	= $(this).attr("id");
		if($id.includes("edit")){
			$kelur = "#edit-kelurahan";
		}else{
			$kelur = "#kelurahan";
		}
		$val 	= $(this).val();
		$value 	= "kelurahan/"+$val;
		$.getJSON(base_url('xhr/get/'+$value),function(data,status){
			if(status=="success"){
				//for($x=0;$x<=$z;$x++){
					//alert(data[$x]['desk']);
					$($kelur).prop("disabled",false);
					$($kelur).find("option").remove();
					if(data.length!=0){
						$($kelur).append($('<option>', { 
					        value: '',
					        text : 'Pilih kelurahan '+data[0]["kecamatan"]
					    }));
					}else{
						$($kelur).append($('<option>', { 
					        value: '',
					        text : 'Belum ada data'
					    }));
					}
					$.each(data,function(i,item){
					    $($kelur).append($('<option>', { 
					        value: item.id_kel,
					        text : item.kelurahan 
					    }));
					})
					//
				//}
			}else{
				//loader("h");
				alert("error parse");
			}
		});
	})
	$("#modal-form").submit(function(evt){
		loader("show","")
		//call_ajax("#modal-form",event);
        evt.preventDefault();
        var formData = new FormData(this);
		$.ajax({
			type : 'POST',
			url  : base_url('xhr/post/save_data'),
			dataType : 'json',
			data : formData,
	        cache:false,
	        contentType: false,
	        processData: false,
			success: function(data, status){				
			if(data["status"]=="1"){
				alert("data sudah di simpan");
				refresh(base_url("admin"),"")
			}else{
				loader("hide","")
				alert("gagal simpan data, silahkan ulangi");				
			}
			},
			error: function(xhr, status, error) {
				alert(error)
			}
		})
	})
	$(document).on("click","#edit-btn-frm",function(){
		$fxm = $(this).closest("section").attr("class");
		$x   = 0;
		$fm  = $("."+$fxm).find("#modal-edit input,#modal-edit select");
		$len = $fm.length;
		$($fm).each(function(){
			$frm = $(this).val();
			//alert($(this).attr("name")+" "+$frm)
			$msg = $(this).attr("data-msg");
			$(this).parent().find(".validate").text("");
			$(this).removeAttr("style");
			//$(this).parent().find(".image-uploader").removeAttr("style");
			$img = $(this).parent().attr("class");
			if($img=="image-uploader"){
				$(this).parent().removeAttr("style");
			}
			if($frm.trim().length==0 && $(this).attr("name")!="photos[]"){
				$(this).attr("style","border:solid 1px red !important;box-shadow:0 0 2px red");
				$(this).parent().find(".validate").text($msg);
				if($img=="image-uploader"){
					$(this).parent().attr("style","border:solid 1px red !important;box-shadow:0 0 2px red");
				}				
				$x=$x;
			}else{
				$x=$x+1;
			}
			return $x;
		})
		//alert($x+" "+$len);
		if($x==$len){
			$(".modal-footer").find(".alert").hide();
			$("#modal-edit").submit();
		}else{
			$(".modal-footer").find(".alert").show();			
			setTimeout(
				function() {				
					$(".modal-footer").find(".alert").fadeOut();
				},
			1500);
		}
	})
	$(document).on("keypress","#pagu,#longlat,#edit-longlat",function(event){
		return Num(event);
	})
/*	$(document).bind("paste","#pagu,#longlat,#edit-longlat",function(e){
		// return Num(event);
		var pasteData = e.originalEvent.clipboardData.getData('text')
		alert(pasteData+" "+angka(pasteData))
		// $(this).val(Num(pasteData));
	})*/
	$(document).on("keyup","#cari-input",function(){
		if($(this).val().length>=4){
			$("#btn-find").prop("disabled",false)
		}else{
			$("#btn-find").prop("disabled",true)
		}
	})
	$(document).on("click","#btn-find",function(){
		$fxm = $(this).closest("section").attr("class");
		$x   = 0;
		$fom = $("."+$fxm).find("form");
		$fm  = $fom.find("input,select");
		$len = $fm.length;
		$($fm).each(function(){
			$frm = $(this).val();
			// alert($(this).attr("name")+" "+$frm)
			$msg = $(this).attr("data-msg");
			$(this).parent().find(".validate").text("");
			$(this).removeAttr("style");
			//$(this).parent().find(".image-uploader").removeAttr("style");
			$img = $(this).parent().attr("class");
			if($img=="image-uploader"){
				$(this).parent().removeAttr("style");
			}
			if($frm.trim().length==0 && $(this).attr("name")!="photos[]"){
				$(this).attr("style","border:solid 1px red !important;box-shadow:0 0 2px red");
				$(this).parent().find(".validate").text($msg);
				if($img=="image-uploader"){
					$(this).parent().attr("style","border:solid 1px red !important;box-shadow:0 0 2px red");
				}				
				$x=$x;
			}else{
				$x=$x+1;
			}
			return $x;
		})
		// alert($x+" "+$len+" "+$fom.attr("id"));
		if($x==$len){
			$(".modal-footer").find(".alert").hide();
			$("#"+$fom.attr("id")).submit();
		}else{
			$(".modal-footer").find(".alert").show();			
			setTimeout(
				function() {				
					$(".modal-footer").find(".alert").fadeOut();
				},
			1500);
		}
	})
	$(document).on("click","#dele-btn-frm",function(evt){
		var r = confirm("Apakah data ini akan di hapuskan...?");
		if (r == false) {
		  return true;
		}
        evt.preventDefault();
        var id = $(this).attr("data-id");
		$.ajax({
			type : 'POST',
			url  : base_url('xhr/post/dele_data'),
			dataType : 'json',
			data : {'dtl_id':id},
	        cache:false,
	        // contentType: false,
	        // processData: false,
			success: function(data, status){				
			if(data["status"]=="1"){
				alert("data sudah di hapuskan");
				refresh("","")
			}else{
				loader("hide","")
				alert("gagal hapus data, silahkan ulangi");				
			}
			},
			error: function(xhr, status, error) {
				alert(error)
			}
		})
	})
	$("#cari-form").submit(function(evt){
		loader("show","")
		//call_ajax("#modal-form",event);
        evt.preventDefault();
        var formData = new FormData(this);
		$.ajax({
			type : 'POST',
			url  : base_url('xhr/find'),
			// dataType : 'json',
			data : formData,
	        cache:false,
	        contentType: false,
	        processData: false,
			success: function(data, status){				
			if(data){
				loader("hide","")
				$("#xframe").html(data)
			}else{
				loader("hide","")
				alert("gagal load data, silahkan ulangi");				
			}
			},
			error: function(xhr, status, error) {
				alert(error)
			}
		})
	})
	/*$(document).on("click",".dmaps",function(){
		$tr = $(this).closest("tr").find("td");
		alert($tr.length())
		$tr.each(function(){
			$td = $(this).text();
			alert($td);
		})
	})*/
	$("#modal-edit").submit(function(evt){
		loader("show","")
		//call_ajax("#modal-form",event);
        evt.preventDefault();
        var formData = new FormData(this);
		$.ajax({
			type : 'POST',
			url  : base_url('xhr/post/edit_data'),
			dataType : 'json',
			data : formData,
	        cache:false,
	        contentType: false,
	        processData: false,
			success: function(data, status){				
			if(data["status"]=="1"){
				alert("data sudah di simpan");
				refresh("","")
			}else{
				loader("hide","")
				alert("gagal simpan data, silahkan ulangi");				
			}
			},
			error: function(xhr, status, error) {
				alert(error)
			}
		})
	})
	$(".close-modalin").click(function(){
		$(".modalin").modal("toggle");
	})
	$(document).on('click','.foto', function (event) {
		loader("show","");
		foto = $(this).attr("data-foto");
		$.getJSON(base_url('xhr/get/gallery/'+foto),function(data,status){
			if(status=="success"){
				$(".carousel-inner").find('.carousel-item').remove();
				$(".carousel-indicators").find("li").remove();
				$ttl = data.length;
				for($x=0;$x<$ttl;$x++){
					if($x==0){
						$act = "active";
					}else{
						$act = "";
					}
					$img = data[$x]["img"];
					$sml = data[$x]["small"];
					$(".carousel-indicators").append('<li data-target="#carouselExampleIndicators" data-slide-to="'+$x+'" class="'+$act+'"><img src="'+$sml+'"></li>');
					$(".carousel-inner").append('<div class="carousel-item '+$act+'"><img class="d-block w-100" src="'+$img+'"><div>')				}
				/*
				$("#carouselExampleIndicators").append(data);
				$ttl = $("#carouselExampleIndicators").find(".carousel-inner").attr("data-total");
				for($x=0;$x<$ttl;$x++){
					if($x==0){
						$(".carousel-indicators").append('<li data-target="#carouselExampleIndicators" data-slide-to="'+$x+'" class="active"></li>')
					}else{
						$(".carousel-indicators").append('<li data-target="#carouselExampleIndicators" data-slide-to="'+$x+'"><img src="http://localhost/ci/uji/./gallery/200521/WIN_20190821_13_19_21_Pro.jpg"></li>')
					}
				}*/
				//alert($ttl)
			}
			loader("hide","")
		})
	})
	$('#exampleModal2').on('hide.bs.modal', function (event) {
		//$(this).find("input").val("");
		$(this).find("#btn-setting-batal").click();
	})
	$('#modalusulan').on('show.bs.modal', function (event) {
	  var button = $(event.relatedTarget) // Button that triggered the modal
	  var usulan = button.data('usulan');
	  var link   = 'xhr/dtl/'+usulan;
	  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

	  var modal  = $(this);
      //var cont   = JSON.parse(getJson(link));
      modal.find("#modal-edit").html(getHtml(link,"#modal-edit"));
      modal.find("#dele-btn-frm").attr("data-id",usulan);
	})
	$(".img-thumbnail").on("click",function() {
		md  = $(this);
		img = md.attr("data-image");
		/*image-gallery
		image-gallery-image*/
	})
/*
	$('#edit-magz').on('hide.bs.modal', function (event) {
	    $(this).find(".progress2").hide();
	    $(".progress2 .progress-bar").css("width","0");
	    clearInterval(event);
	})*/
    /*$('#edit-magz').on('show.bs.modal', function (event) {
        var btn   = $(event.relatedTarget); // Button that triggered the modal   
        var magz  = btn.data('magz'); // Extract info from data-* attributes
        var modal = $(this);
        var vcls  = btn.attr('class');
        var img   = btn.find('p').data('img');
        var txt   = "Total PDF page : "+btn.data('page');
        var cont  = JSON.parse(issue_content(magz));
        var xpath = cont.result["ipath"];
		//$id_class = "result-"+$frm_id.replace("#","").replace(".","");
        $(".emagz-tittle-button .btn").hide();
        if(cont.result["iconvert"]==0){
        	$(".st-2").show();
        }else if(cont.result["iconvert"]==1){
        	$(".st-3,.st-7").show();
        }else if(cont.result["iconvert"]==2  && cont.result["ipublish"]==0){
        	$(".st-4").show();
        }else{
			$(".st-5").attr("href",base_url(cont.result["dynamic_url"]));
        	$(".st-5,.st-6").show();
        }
        //msg1(cont.result["idesc"]);

	    modal.find(".progress2").hide();
        modal.find(".emagz-tittle-button h3").text(cont.result["ititle"]);
        modal.find(".emagz-img-desc").html("<p>"+cont.result["idesc"]+"</p>");
        modal.find(".emagz-img img").attr("src",img);
        //modal.find("#convert-issue,#convert-proses,#magazine-publish,#magazine-issue").attr("magz-id",magz);
		modal.find(".emagz-tittle-button").attr("magz-id",magz);
        modal.find(".issue-content-data").html(txt);
        modal.find(".edit-magz-button").attr("magz-id",magz);

        if(xpath && cont.result["iconvert"]==1){
        	var path  = xpath.replace("/","_");
	        modal.find(".progress2").fadeIn();
	        $(".progress2 .progress-bar").css("width","0");
			progress_convert(path,cont.result["ipage"]);
        }
    })*/
})

function kecamatan($form){
	$data = jxhr("xhr/get/allcamat");
	$form.remove("option");
	$.each($data,function(i,item){
	    $form.append($('<option>', { 
	        value: $data[i].id_kec,
	        text : $data[i].kecamatan 
	    }));
	})
}

function addopsi($form,$get,txt){
	$data = jxhr("xhr/get/addopsi/"+$get);
	$form.find("option").remove();
	//alert($form.attr("data-msg"));
    $form.append($('<option>', { 
        value: '',
        text : txt
    }));
	$.each($data,function(i,item){
	    $form.append($('<option>', { 
	        value: $data[i].qid,
	        text : $data[i].qvalue 
	    }));
	})
}
function jxhr(url){
	var jqXHR = $.ajax({
		url   : base_url(url),
		dataType: 'json',
		async : false
	});
	return JSON.parse(jqXHR.responseText);	
}
function transisi(status){
	if(status ===  true){
		$tab = $("#myTabContent .tab-pane");
		$tab.find("table,span").hide();
		$tab.find(".peta-data").fadeIn().removeClass("hilang");
		
		/*$tab.find("table").hide();
		$tab.find(".peta-data").animate({width:'100%',opacity:'1'},'slow');
		$tab.find(".peta-data").show();*/
	}else{
		$tab = $("#myTabContent .tab-pane");
		$tab.find("table,span").fadeIn();
		$tab.find(".peta-data").hide().addClass("hilang");
	}
}

function refresh(url,dtl){
	$("#loader").fadeIn(); 
	if(dtl.length==0){
		if(url=="home"){
			url = "";
		}else{
			url = url;
		}
		directed = url; 
		window.location.href=directed;	
	}else{	
		window.location.href=url;		
	}
}
function getJson(link){	
	var jqXHR = $.ajax({
		url   : base_url(link),
		async : false
	});
	return jqXHR.responseText;
}
function getHtml(link,$id){		
	$.get(base_url(link),function(data,status){
		if(status=="success"){
			//alert($id);
			$($id).html(data);
		}else{
			alert("error parse");
		}
	});
}
function call_ajax($id,event){
	loader("show","")
    event.preventDefault();
	$.ajax({
		type : 'POST',
		url  : base_url('xhr/post/save_data'),
		dataType : 'json',
		data : $($id).serialize(),
        cache:false,
        contentType: false,
        processData: false,
		success: function(data, status){
			loader("hide","")
			alert(data);
			if(data["status"]=="1"){
				alert("data sudah di simpan");
				refresh("","")
			}else{
				alert("gagal simpan data, silahkan ulangi");				
			}
		},
		error: function(xhr, status, error) {
			alert(error)
			loader("hide","")
		}
	})
}
function call_json_get($value){	
	$.getJSON(base_url('xhr/get/'+$value),function(data,status){
		if(status=="success"){
			//for($x=0;$x<=$z;$x++){
				//alert(data[$x]['desk']);
				//alert(data.length)
				//if(data.length>1){
					$.each(data,function(num){
						//alert(index);
						if(data[num]['ttl']>0){
							//alert(data[num]['ttl'])
							$("#laporan li a").addClass("nav-link2");
							$("#laporan").find(".num-"+data[num]['desk']).html(data[num]['ttl']).css("display","inline")
						}else{						
							$("#laporan li a").removeClass("nav-link2");
						}
					})
/*				}else{
					if(data['ttl']>0){
						//alert(data[num]['ttl'])
						$("#laporan li a").addClass("nav-link2");
						$("#laporan").find(".num-"+data['desk']).html(data['ttl']).css("display","inline")
					}else{						
						$("#laporan li a").removeClass("nav-link2");
					}					
				}*/
				//
			//}
		}else{
			//loader("h");
			alert("error parse");
		}
	});
}

function base_url($url){
	return $("#base_url").attr("href")+$url;
}

function loader(tipe,time){
	if(tipe=="show" || tipe=="s"){				
		$("#loader").fadeIn();
		if(time != ""){
			setTimeout(
				function() {				
					$("#loader").fadeOut();
				},
			500);
		}
	}else{
		$("#loader").fadeOut();
	}
}
function popup($class,$msg,$alert){
	$(".msgpopup").find("label").remove();
	$(".msgpopup").fadeIn().append("<label class='alert alert-"+$alert+" w100'>"+$msg+"</label>");
	setTimeout(
		function() {				
			$(".msgpopup").fadeOut();
		},
	2500);
}
function Num(input){
    var charCode = (input.which) ? input.which : event.keyCode
    if (charCode > 31 && (charCode < 44 || charCode > 57)){
		return false;
	}else{
		return true;		
	}      
}

function remove_currency(input){
	$hasil = input.replace('.','').replace(',','');
	return $hasil;
}
function currency(input) {
    var output = input
    if (parseFloat(input)) {
        input = new String(input); // so you can perform string operations
        var parts = input.split("."); // remove the decimal part
        parts[0] = parts[0].split("").reverse().join("").replace(/(\d{3})(?!$)/g, "$1.").split("").reverse().join("");
        output = parts.join(".");
    }
    return output;
}
function angka(input){
	output = input.replace(/\./g,'').replace(/\,/g,'');
	return output;
}
function addZero(i) {
  if (i < 10) {
    i = "0" + i;
  }
  return i;
}

function OpenPopupCenter(pageURL, title, w, h) {
	var left = (screen.width - w) / 2;
	var top = (screen.height - h) / 4;  // for 25% - devide by 4  |  for 33% - devide by 3
	var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
	targetWin.focus();
} 