
<div class="modal fade" id="loadMore" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <!-- modal-dialog-centered  -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loadMore-title">Detail Tabungan <b></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-12">
          <div class="row">               
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTableMore" width="100%" cellspacing="0">
                <thead><th class="text-center">Tanggal</th><th>Siswa</th><th>Debit</th><th>Kredit</th><th>Saldo</th></thead>
                <tbody>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?=  base_url("logout") ?>">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <input type="text" id="inputTmp" class="hide" style="position: fixed;bottom:0;"/>
  <!-- End of Page Wrapper -->


  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url() ?>assets/js/autoNumeric.js"></script>
  <script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>

  <?php /*
  <script src="<?= base_url() ?>assets/vendor/chart.js/Chart.min.js"></script>

  <script src="<?= base_url() ?>assets/js/demo/chart-area-demo.js"></script>
  <script src="<?= base_url() ?>assets/js/demo/chart-pie-demo.js"></script>
*/ ?>

  <script src="<?= base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?= base_url() ?>assets/js/demo/datatables-demo.js"></script>

  <script>
    $(document).ready(function () { 
      $(".tobe").click(function () {
        alert("bloman ngaso dlu ya, nti di lanjut lagi");        
      })
      
      $len = window.innerWidth;
      if($len<1024){
        $(".navbar-nav").addClass("toggled")
      }else{
        $(".navbar-nav").removeClass("toggled")
      }
      show_input("kredit","show","str");
      show_input("debit","show","str");
    })
	    $(".Dec").autoNumeric('init',{mDec: '0'})
    $(document).on("keyup",".deci",function(){
      rp($(this));
    })
    $(document).on("keyup",".deci",function(){
      rp($(this));
    })
    $(document).on('show.bs.modal',"#staticBackdrop", function(event) {
      var callerId = $(event.relatedTarget).attr('id');
      $(".siswa_id").val(callerId);      
      $(".refresh").attr("data-check","false")
    })
    $(document).on('hide.bs.modal',"#staticBackdrop", function(event) {      
      if($(".refresh").attr("data-check")=="true"){
        window.location.href="";
      }
    })

    $(document).on("keydown",".deci",function(event){
      rp($(this));
    })

    $(document).on("click","#TabunganSave",function(event){
      let formValid = true;
      $("#TabunganFrm .inputan").each(function(){   
        if ($(this).val() == '' || $(this).val() == '0') {
        console.log($(this).attr("class")+" "+$(this).val());
          formValid = false;
          $(this).addClass('border-danger');
        } else {
          $(this).removeClass('border-danger');
        }
      })
      
      if (!formValid) {
        alert('inputan tidak boleh kosong / 0');
      }else{
        $.ajax({
          type : 'POST',
          url  : '/xhr/tabungansave',
          dataType : 'json',
          data : $("#TabunganFrm").serialize(),
          success: function(data, status, xhr){
            let cekit = false;
            if(data["status"]=="ok" || data["status"]=="ok2"){
              $(".popup").fadeIn()
              setTimeout(() => {
                $(".popup").fadeOut()   
                $("#TabunganFrm .inputan").each(function(){ 
                  if($(this).attr("name")=="nominal"){
                    $(this).val("");
                  };
                })
                $(".refresh").attr("data-check","true")
                show_dtltabungan($(".siswa_id").val(),0);
              }, 0);      
            }
          },
          error: function(xhr, status, error) {
            alert(error)
          }
        })
      }
    })
    
    $(document).on("click",".focus",function(){      
        $(this).select().focus()
    })    

    $(document).on("keypress",".tab_in",function(event){
      if(event.keyCode==13){
        console.log("Abc")
      }
    })
    
    $(document).on("focusout",".tab_in",function(){
      // alert("gs")    ;
      $id = $(this).closest(".nilai").attr("id");
      $val = $("#"+$id).find("input").val().trim();
      $last = $("#"+$id).attr("vlast");
      save("Simpan",$id,$val,$(this),$last)
    })

    $(document).on("focusout",".tab_out",function(){
      $id = $(this).closest(".nilai").attr("id");
      $val = $("#"+$id).find("input").val().trim();
      $last = $("#"+$id).attr("vlast");
      save("Ambil",$id,$val,$(this),$last)
    })

    $(document).on("click","#debit",function(){
      if($(this).prop("checked")){
        show_input("debit","show","open");
      }else{
        show_input("debit","hide","open");
      }
    })
    
    $(document).on("click",".settings",function(){
      $("#setting-dtl").toggle();
    })

    $(document).on("click","#kredit",function(){
      if($(this).prop("checked")){
        show_input("kredit","show","open");
      }else{
        show_input("kredit","hide","open");
      }
    })

    $(document).on("click",".tabungan-dtl",function(){
      $id = $(this).attr("id");
      $nm = $(this).text();
      $kl = $(this).attr("data-kelas");
      $("#modalDtl").html($nm+",</b><b style='font-weight:normal'> Kelas </b><b>"+$kl)
      show_dtltabungan($id,500);
    })

    $(document).on("click",".more-dtl",function(){
      $id = $(this).attr("id");
      $nm = $(this).text();
      console.log($nm);
      $("#loadMore-title b").html("<b>"+$nm+"</b>");
      show_othertabungan($id,500);
    })

    $(document).on("change","#tab_tgl",function(){
      $uri = base_url()+$(this).val();
      // console.log($uri);
      window.location.href=$uri;
    })
    
    function rp(params) {            
      value  = params.val().replace(",","").replace(".","");
      output = new Intl.NumberFormat('de-DE').format(value);
      params.val(output)
    }
    
    function show_othertabungan($id,$time) {
      $rsl = call_api("/xhr/other_tabungan/"+$id);
      if($rsl["status"]=="sukses"){
        $("#dataTableMore tbody").html("");
        setTimeout(() => {
          $data = $rsl["data"];
          $ttl = $data.length;
          for($x=0;$x<=($ttl-1);$x++){
            if($data[$x]["tab_tanggal"]=="total"){
              $("#dataTableMore tbody").append("<tr class='bg-primary text-light'><td>"+$data[$x]["tab_tanggal"]+"</td><td>"+$data[$x]["total"]+"</td><td>"+$data[$x]["tab_in"]+"</td><td>"+$data[$x]["tab_out"]+"</td><td>"+$data[$x]["saldo"]+"</td></tr>")
            }else{
              if($x==0){
                $tdlast = "<td rowspan='"+($ttl-1)+"' class='bg-light'></td>";
              }else{
                $tdlast = "";
              }
              $("#dataTableMore tbody").append("<tr><td>"+$data[$x]["tab_tanggal"]+"</td><td>"+$data[$x]["total"]+"</td><td>"+$data[$x]["tab_in"]+"</td><td>"+$data[$x]["tab_out"]+"</td>"+$tdlast+"</tr>")
            }
          }          
        }, $time);
      }
      
    }
    function show_dtltabungan($id,$time) {
      $rsl = call_api("/xhr/dtl_tabungan/"+$id);
      if($rsl["status"]=="sukses"){
        $("#dataTableDtl tbody").html("");
        setTimeout(() => {
          $data = $rsl["data"];
          $ttl = $data.length;
          for($x=0;$x<=($ttl-1);$x++){
            if($data[$x]["tab_tanggal"]=="total"){
              $("#dataTableDtl tbody").append("<tr class='bg-primary text-light'><td>"+NN($data[$x]["tab_tanggal"])+"</td><td>"+NN($data[$x]["tab_in"])+"</td><td>"+NN($data[$x]["tab_out"]+"</td><td>"+$data[$x]["saldo"])+"</td></tr>")
            }else{
              if($x==0){
                $tdlast = "<td rowspan='"+($ttl-1)+"' class='bg-light'></td>";
              }else{
                $tdlast = "";
              }
              $("#dataTableDtl tbody").append("<tr><td>"+$data[$x]["tab_tanggal"]+"</td><td>"+$data[$x]["tab_in"]+"</td><td>"+$data[$x]["tab_out"]+"</td>"+$tdlast+"</tr>")
            }
          }          
        }, $time);
      }
      
    }
    function show_input($class,$tipe,$str){
      if($str=="open"){
        if($tipe=="hide"){
          localStorage.setItem($class,"0");
        }else{          
          localStorage.setItem($class,"1");
        }
        if($tipe=="show"){
          $("."+$class).fadeIn();
        }else{
          $("."+$class).fadeOut();
        }
      }else{        
        // console.log($class+" "+$tipe+" "+$str+" "+localStorage.getItem($class))
        if(localStorage.getItem($class)){
          if(localStorage.getItem($class)=="1"){          
            $("."+$class).show();
            $("#"+$class).prop("checked",true);
          }else{
            $("."+$class).hide();
            $("#"+$class).prop("checked",false);
          }
        }else{
          localStorage.setItem($class,"1");
          $("."+$class).show();
          $("#"+$class).prop("checked",true);
        }
      }
    }
    function call_api($url) {
        var jqXHR = $.ajax({
            url: $url,
            type: "GET",
            dataType: "json",
            async: false,
        });
        return jqXHR.responseJSON;
    }
    function base_url(){
      return $("#uid").attr("base-url");
    }
    function save($tipe,$id,$nilai,$class,$last){
        if($nilai!=$last){
          if(isNaN($nilai)){
            console.log("basdsd");
          }else{          
            $cls = $("#"+$id).find(".syn-status");
            $cls.fadeIn();              
            $.ajax({
              type : 'POST',
              url  : '/xhr/tabungan',
              dataType : 'json',
              data : {tipe_trans:$tipe,siswa_id:$id,nilai:$nilai.replace(".",""),tanggal:$("#tab_tgl").val(),uid:$("#uid").attr("uid")},
              success: function(data, status, xhr){
                // setTimeout(() => {      
                //   $class.html($tipe);
                // }, 500);
                let cekit = false;
                if(data["status"]=="ok"){
                  if($nilai=="0" || $nilai==""){
                    $class.addClass("border-info").removeClass("border-secondary  clr");
                  }else{
                    $class.removeClass("border-info").addClass("border-secondary  clr");
                  }
                  $("#"+$id).attr("vlast",$nilai);
                  $cls.fadeOut();
                  cekit = true;
                }else if(data["status"]=="ok2"){
                  if($nilai=="0" || $nilai==""){
                    $class.addClass("border-warning").removeClass("border-secondary  clr");
                  }else{
                    $class.removeClass("border-warning").addClass("border-secondary clr");
                  }
                  $("#"+$id).attr("vlast",$nilai);
                  $cls.fadeOut();
                  cekit = true;
                }
                if(cekit){
                  $("#total i").html(data["saldo"]["total"]);
                  $("#tab_in i").html(data["saldo"]["tab_in"]);
                  $("#tab_out i").html(data["saldo"]["tab_out"]);
                  $("#sisa i").html(data["saldo"]["sisa"]);
                }
              },
              error: function(xhr, status, error) {
                alert(error)
              }
            })
        }
      }
    }
    function NN($value)
    {
      return $value==0 || $value=="" || $value.length==0?'':$value;
    }
  </script>
</body>

</html>
