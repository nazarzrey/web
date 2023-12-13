<div class="modal fade" id="loadMore" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <!-- modal-dialog-centered  -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loadMore-title">Detail iuran <b></b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-12">
          <div class="row">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTableMore" width="100%" cellspacing="0">
                <thead>
                  <th class="text-center">Tanggal</th>
                  <th>Siswa</th>
                  <th>Debit</th>
                  <th>Kredit</th>
                  <th>Saldo</th>
                </thead>
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
        <a class="btn btn-primary" href="<?= base_url("logout") ?>">Logout</a>
      </div>
    </div>
  </div>
</div>
<input type="text" id="inputTmp" class="hide" style="position: fixed;bottom:0;" />
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
  $(document).ready(function() {

    // login new pass
    if ($("#myreport").length) {
      setTimeout(() => {

        $ttl = $("#jurnalTableDtl tr").length;
        $("#jurnal-all span").html("<b>" + ($ttl - 1) + "</b>");
        for ($x = 1; $x <= 6; $x++) {
          if ($(".jurnal-" + $x).length != 0) {
            $("#jurnal-" + $x + " span").html("<b>" + $(".jurnal-" + $x).length + "</b>");
          } else {
            $("#jurnal-" + $x + " span").html("");
          }
        }
      }, 100);
    }
    $("#Password").focusout(function() {
      var password = $("#Password").val();
      var confirmPassword = $("#ConfirmPassword").val();
      if (password.length) {
        if (password.length < 6) {
          $("#CheckPasswordMatch").html("Password minimal 6 karakter !").css("color", "red");
          $(".btn-pwd").prop("disabled", true);
        } else {
          $("#CheckPasswordMatch").html("");
          $(".btn-pwd").prop("disabled", false)
        }
      }
    })
    $("#ConfirmPassword").on('keyup', function() {
      var password = $("#Password").val();
      var confirmPassword = $("#ConfirmPassword").val();
      if (confirmPassword.length) {
        if (password != confirmPassword) {
          $("#CheckPasswordMatch").html("Password belum sama !").css("color", "red");
          $(".btn-pwd").prop("disabled", true);
        } else {
          if (confirmPassword.length < 6) {
            $("#CheckPasswordMatch").html("Password minimal 6 karakter !").css("color", "red");
            $(".btn-pwd").prop("disabled", true);
          } else {
            $("#CheckPasswordMatch").html("");
            $(".btn-pwd").prop("disabled", false)
          }
        }
      }
    });

    $(".btn-pwd-back").click(function() {
      window.location.href = "";
    })

    var width = screen.width;
    var height = screen.height;
    // var tanggal = new Date();
    // let myVar = setInterval(myTimer, 1000);

    // function myTimer() {
    //   const d = new Date();
    //   $("#waktu").text(d.toLocaleDateString() + " " + d.toLocaleTimeString());
    // }
    // if (width < 1024) {
    //   setTimeout(() => {
    //     window.location.href = window.location.href;
    //   }, 60000);
    // }
    $myid = $("#uid").attr("uid");
    $(".tobe").click(function() {
      alert("bloman ngaso dlu ya, nti di lanjut lagi");
    })
    $(".soon").click(function() {
      alert("menu belum tersedia...");
    })

    $len = window.innerWidth;
    if ($len < 1024) {
      $(".navbar-nav").addClass("toggled")
    } else {
      $(".navbar-nav").removeClass("toggled")
    }
    show_input("kredit", "show", "str");
    show_input("debit", "show", "str");
    if (localStorage.getItem("menu") == "1") {
      $("#uid").addClass("sidebar-toggled");
      $("#accordionSidebar").addClass("toggled");

    }
  })
  $(".Dec").autoNumeric('init', {
    mDec: '0'
  })
  $(document).on("keyup", ".deci", function() {
    rp($(this), "elem");
  })
  $(document).on("keyup", ".deci", function() {
    rp($(this), "elem");
  })
  // $(document).on('show.bs.modal',"#staticBackdrop", function(event) {
  //     $(this).removeAttr("saveIuran")
  // })
  $(document).on('hide.bs.modal', "#staticBackdrop", function(event) {
    if ($(this).attr("saveIuran")) {
      window.location.href = "";
    }
  })
  $(document).on("keydown", ".deci", function(event) {
    rp($(this), "elem");
  })

  $(document).on("click", "#iuranSave", function(event) {
    let formValid = true;
    $("#iuranFrm .inputan").each(function() {
      if ($(this).val() == '' || $(this).val() == '0') {
        console.log($(this).attr("class") + " " + $(this).val());
        formValid = false;
        $(this).addClass('border-danger');
      } else {
        $(this).removeClass('border-danger');
      }
    })

    if (!formValid) {
      alert('inputan tidak boleh kosong / 0');
    } else {
      date = new Date();
      year = date.getFullYear();
      $.ajax({
        type: 'POST',
        url: base_url() + 'xhr/iuransave',
        dataType: 'json',
        data: $("#iuranFrm").serialize(),
        success: function(data, status, xhr) {
          let cekit = false;
          if (data["status"] == "ok" || data["status"] == "ok2") {
            $(".popup").fadeIn()
            setTimeout(() => {
              $(".popup").fadeOut()
              $("#iuranFrm .inputan").each(function() {
                if ($(this).attr("name") == "nominal") {
                  $(this).val("");
                };
              })
              $(".refresh").attr("data-check", "true")
              show_dtliuran($(".siswa_id").val(), 0, year);
            }, 0);
          }
        },
        error: function(xhr, status, error) {
          alert(error)
        }
      })
    }
  })

  $(document).on("click", ".focus", function() {
    $(this).select().focus()
  })

  $(document).on("keypress", ".tab_in", function(event) {
    if (event.keyCode == 13) {
      console.log("Abc")
    }
  })

  $(document).on("focusout", ".tab_in", function() {
    // alert("gs")    ;
    $id = $(this).closest(".nilai").attr("id");
    $val = $("#" + $id).find("input").val().trim();
    $last = $("#" + $id).attr("vlast");
    save("Simpan", $id, $val, $(this), $last)
  })

  $(document).on("focusout", ".tab_out", function() {
    $id = $(this).closest(".nilai").attr("id");
    $val = $("#" + $id).find("input").val().trim();
    $last = $("#" + $id).attr("vlast");
    save("Ambil", $id, $val, $(this), $last)
  })

  $(document).on("click", "#debit", function() {
    if ($(this).prop("checked")) {
      show_input("debit", "show", "open");
    } else {
      show_input("debit", "hide", "open");
    }
  })

  $(document).on("click", ".settings", function() {
    $("#setting-dtl").toggle();
  })

  $(document).on("click", "#kredit", function() {
    if ($(this).prop("checked")) {
      show_input("kredit", "show", "open");
    } else {
      show_input("kredit", "hide", "open");
    }
  })

  $(document).on("click", ".iuran-dtl", function() {
    $id = $(this).attr("id");
    $th = $(this).attr("tahun");
    $nm = $(this).text();
    $("#modalDtl").html($nm).attr("uid", $id);
    show_dtliuran($id, 500, $th, $nm);
  })
  $(document).on("click", ".trans-iuran-dtl", function() {
    $id = $(this).attr("id");
    $th = $(this).attr("tahun");
    $nm = $(this).attr("nama");
    $("#modalDtl").html($nm).attr("uid", $id);
    $("#frm-iuran").show();
    if ($(".opsi-iuran").length == 0) {
      show_dtliuran($id, 500, $th, $nm);
    }
  })
  $(document).on("click", ".refresh-iuran", function() {
    $id = $(this).attr("id");
    $th = $(this).attr("tahun");
    $nm = $(this).attr("nama");
    $("#modalDtl").html($nm).attr("uid", $id);
    show_dtliuran($id, 0, $th, $nm);
  })

  $(document).on("click", ".more-dtl", function() {
    $id = $(this).attr("id");
    $nm = $(this).text();
    console.log($nm);
    $("#loadMore-title b").html("<b>" + $nm + "</b>");
    show_otheriuran($id, 500);
  })

  $(document).on("change", "#tab_tgl", function() {
    $uri = base_url() + $(this).val();
    // console.log($uri);
    window.location.href = $uri;
  })


  $(document).on("click", "#uid", function() {

    $nm = $(this).hasClass("sidebar-toggled");
    if ($nm) {
      localStorage.setItem("menu", "1");
    } else {
      localStorage.setItem("menu", "0");
    }
  })

  // beranda / home / dashboard

  $(document).on("click", ".mst-close", function() {
    $("#dataTableDtl,.mst-close").show();
    $("#moredataTableDtl,.mst-back").hide();
  })
  $(document).on("click", ".mst-back", function() {
    $("#dataTableDtl,.mst-close").show();
    $("#moredataTableDtl,.mst-back").hide();
    $(".moremodalDtl").html("");
  })
  $(document).on("click", ".mst-dtl", function() {
    $("#dataTableDtl,.mst-close").show();
    $("#moredataTableDtl,.mst-back").hide();
    $id = $(this).attr("id");
    $jdl = $(this).attr("title");
    $(".modalDtl").html($jdl);
    $(".moremodalDtl").html("");

    $time = 500;
    $rsl = call_api(base_url() + "xhr/master_data/" + $id);
    if ($rsl["status"] == "sukses") {
      $("#dataTableDtl tbody").html("");
      setTimeout(() => {
        $data = $rsl["data"];
        $ttl = $data.length;
        for ($x = 0; $x <= ($ttl - 1); $x++) {
          if ($data[$x]["detail"] == "n") {
            $detail = "<td>" + $data[$x]["description"] + "</td>";
          } else {
            $detail = "<td class='text-center'><a href='#' class='text-danger mst-more-dtl fas fa-folder-open' id='" + $data[$x]["periode"] + "' msid='" + $id + "' title='" + $data[$x]["bulan"] + " " + $data[$x]["tahun"] + "'></a></td>";
          }
          $("#dataTableDtl tbody").append("<tr><td class='text-left pl-5'>" + $data[$x]["tahun"] + " " + $data[$x]["bulan"] + "</td><td class='text-right'>" + $data[$x]["cash_in"] + "</td><td class='text-right'>" + $data[$x]["cash_out"] + "</td>" + $detail + "</tr>");
        }
      }, $time);
    } else {
      $("#dataTableDtl tbody").html(info_admin(4, $rsl["data"]));
    }
  })

  function info_admin($len, $text) {
    return "<tr><td colspan='" + $len + "'><h5>" + $text + "</h1></td></tr>";
  }
  $(document).on("click", ".mst-more-dtl", function() {
    $("#dataTableDtl,.mst-close").hide();
    $("#moredataTableDtl body").html("");
    $("#moredataTableDtl,.mst-back").show();
    $id = $(this).attr("id");
    $mid = $(this).attr("msid");
    $jdl = $(this).attr("title");
    $(".moremodalDtl").html("-" + $jdl);
    $time = 500;
    $rsl = call_api(base_url() + "xhr/master_data/" + $mid + "/" + $id);
    if ($rsl["status"] == "sukses") {
      $("#moredataTableDtl tbody").html("");
      setTimeout(() => {
        $mdata = $rsl["data"];
        $ttl = $mdata.length;
        for ($x = 0; $x <= ($ttl - 1); $x++) {
          $detail = "<td>" + $mdata[$x]["description"] + "</td><td>" + $mdata[$x]["detail"] + "</td>";
          $("#moredataTableDtl tbody").append("<tr><td class='text-left pl-5'>" + $mdata[$x]["periode"] + "</td><td class='text-right'>" + $mdata[$x]["cash_in"] + "</td><td class='text-right'>" + $mdata[$x]["cash_out"] + "</td>" + $detail + "</tr>");
        }
      }, $time);
    }
  })

  $(document).on("click", ".jurnal-dtl", function() {
    $("#dataTableDtl,.mst-close").show();
    $("#moredataTableDtl,.mst-back").hide();
    $id = $(this).attr("id");
    $jdl = $(this).text();
    $(".trans-iuran-dtl").attr({
      "id": $id,
      "nama": $jdl
    });
    $("#modalDtl").html($jdl).attr("uid", $id);

    $time = 500;
    $rsl = call_api(base_url() + "xhr/jurnal/" + $id);
    if ($rsl["status"] == "sukses") {
      $("#jurnalTableDtl tbody").html("");
      $("#frm-iuran").hide();
      $("#dataTableDtl tbody").html("");
      // $("#dataTableDtl").html("").hide();
      setTimeout(() => {
        $data = $rsl["data"];
        $ttl = $data.length;
        $("#jurnal-all span").html("<b>" + $ttl + "</b>");
        $z = "";
        $r = 1;
        for ($x = 0; $x <= ($ttl - 1); $x++) {
          $("#jurnalTableDtl tbody").append("<tr class='jurnal-" + $data[$x]["fk_mid"] + "'><td class='text-center '>" + $data[$x]["tanggal"] + "</td><td class='text-right'>" + $data[$x]["cash_in"] + "</td><td class='text-right'>" + $data[$x]["cash_out"] + "</td><td>" + $data[$x]["tipe"] + "</td><td>" + $data[$x]["description"] + "</td><td>" + $data[$x]["nama"] + "</td></tr>");
        }
        for ($x = 1; $x <= 6; $x++) {
          if ($(".jurnal-" + $x).length != 0) {
            $("#jurnal-" + $x + " span").html("<b>" + $(".jurnal-" + $x).length + "</b>");
          } else {
            $("#jurnal-" + $x + " span").html("");
          }
        }
      }, $time);
    }
  })

  $(document).on("click", ".info", function() {
    alert($(this).attr("info-text"));
  })
  $(document).on("change", ".opsi-pinjaman", function() {
    console.log($(this).val());
    $color = $(this).val() == "pinjam-in" ? "card-body bg-success text-light" : "card-body bg-warning text-dark";
    $("#frm-pinjam").attr("class", $color);
  })
  $(document).on("click", ".jurnal-menu", function() {

    $("#jurnalTableDtl").show();
    $("#frmBayarPinjaman").hide();
    $id = $(this).attr("id");
    console.log($id);
    if ($id == "jurnal-all") {
      for ($x = 1; $x <= 6; $x++) {
        $(".jurnal-" + $x).show();
      }
    } else {
      for ($x = 1; $x <= 6; $x++) {
        if ($x == $id.replace("jurnal-", "")) {
          $(".jurnal-" + $x).show();
        } else {
          $(".jurnal-" + $x).hide();
        }
      }
    }
    $(".jurnal-menu").removeClass("btn-secondary").addClass("btn-primary");
    $(this).addClass("btn-secondary");
  })




  $(document).on("click", ".simpan-edit-iuran", function() {
    save_iuran($(this), "edit");
  })
  $(document).on("click", ".simpan-iuran", function() {
    save_iuran($(this), "simpan");
  })
  $(document).on("click", ".hapus-iuran", function() {
    let text = "Apakah Anda yakin menghapuskan data ini";
    if (confirm(text) == true) {
      save_iuran($(this), "hapus");
    }
  })

  $(document).on("click", ".bayar-iuran-prd", function() {
    cekbox = $(this).prop("checked");
    $uid = $(this).attr("id");
    $opsi = $("#opsiBayar").val();
    $acc = $("#UserName").text();
    $tr = $(this).closest("tr");
    $nama = $tr.find(".iuran-dtl").text();
    if (cekbox === false) {
      let text = "Apakah Anda yakin membatalkan data iuran " + $nama;
      if (confirm(text) == false) {
        return false;
      } else {
        iuran_prd($uid, $tr, "", "hapus");
      }
    } else {
      iuran_prd($uid, $tr, $opsi, "simpan");
    }
    if ($(this).prop("checked")) {
      $iuran = $opsi;
      $accby = $acc;
    } else {
      $iuran = "";
      $accby = "";
    }
    $("#iuranPrd-" + $uid).text($iuran);
    $("#iuranAcc-" + $uid).text($accby);
  })

  $(document).on("click", ".bayar-iuran", function() {
    $(".opsi-iuran").find("input,.iuranaksi a, span").hide();
    $(".bayar-iuran,.aktif").show();
    $(this).hide();
    $msid = $(this).closest("tr").attr("id");
    $id = $(this).closest("tr").attr("mid");
    $acc = $("#UserName").text();
    $("#" + $msid).find("input,.batal-iuran,.simpan-iuran").show();
    $("#" + $msid).find(".iuranAcc").html("<span>" + $acc.toLowerCase() + "</span>");
  })
  $(document).on("click", ".edit-iuran", function() {
    $(".opsi-iuran").find("input,.iuranaksi a,span").hide();
    $(".edit-iuran,.aktif").show();
    $(this).hide();
    $msid = $(this).closest("tr").attr("id");
    $id = $(this).closest("tr").attr("mid");
    $acc = $("#UserName").text();
    $("#" + $msid).find(".aktif").hide();
    $("#" + $msid).find("input,.batal-iuran,.simpan-iuran,.simpan-edit-iuran,.hapus-iuran").show();
    // return false;
    $old_iur = $("#" + $msid).find(".iuranUser").text();
    $old_dsk = $("#" + $msid).find(".iuranDesk").text();
    $old_acc = $("#" + $msid).find(".iuranAcc .aktif").text();
    if (!$("#" + $msid).find(".iuranAcc span").length) {
      $("#" + $msid).find(".iuranAcc").append("<span>" + $acc.toLowerCase() + "</span>");
    } else {
      $("#" + $msid).find(".iuranAcc span").show();
    }
  })

  $(document).on("click", ".batal-iuran", function() {
    $msid = $(this).closest("tr").attr("id");
    bayar_iuran($msid, "batal");
  })

  $(document).on("change", "#periode", function() {
    console.log($(this).val().replace("-", ""));
    window.location.href = base_url() + "iuran/periode/" + $(this).val().replace("-", "");
  })

  $(document).on("click", "#bayar-pinjaman", function() {
    $("#jurnalTableDtl").hide();
    $("#frmBayarPinjaman").show();
  })

  function save_iuran($elem, $tipe) {
    $uid = $("#modalDtl").attr("uid");
    $msid = $elem.closest("tr").attr("mid");
    $elem = $elem.closest("tr").attr("id");
    $acc = $("#UserName").text();
    $inp = $("#input-iuran-" + $id).val();
    $des = $("#desc-iuran-" + $id).val();
    $json = {
      uid: $uid,
      msid: $msid,
      nominal: $inp,
      desc: $des
    }
    if ($inp == "" || $des == "" || $inp < 50000) {
      alert("inputan tidak boleh kosong / nominal iuran tidak boleh < dari 50.000");
      return false;
    }
    $.ajax({
      type: "POST",
      url: base_url() + "xhr/simpan_iuran/" + $myid + "/" + $tipe,
      dataType: "json",
      data: $json,
      success: function(data, status, xhr) {
        let cekit = false;
        if (data["status"] == "sukses") {
          if ($tipe == "hapus") {
            $("#" + $elem).remove();
            show_dtliuran($uid, 0, $msid.substr(0, 4), $("#modalDtl").text());
          } else {
            bayar_iuran($msid, "simpan");
            $("#" + $elem).find("input,.batal-iuran,.simpan-iuran").remove();
            // $("#" + $elem).find(".iuranaksi").html('<a href="#" class="fas fa-sync refresh-iuran" id=""></a>')
            $("#" + $elem).find(".iuranaksi").html('<a href="#" class="fas fa-sync refresh-iuran text-warning aktif" id="' + $uid + '" tahun="' + $msid.substr(0, 4) + '" nama="' + $("#modalDtl").text() + '"></a>')
            html_akt($elem, "iuranUser", rp($inp, ""));
            html_akt($elem, "iuranDesk", $des);
            html_akt($elem, "iuranAcc", $acc.toLowerCase());
            $("#staticBackdrop").attr("saveIuran", true);
            let $z = 0;
            $(".iuranUser label").each(function(params) {
              $z = $z + parseInt($(this).text().replace(".", "").replace(",", ""));
            })
            $(".total-iuran").text(rp($z, ""));
          }
        }
      }
    })
  }

  function html_akt($id, $class, $val) {
    $("#" + $id).find("." + $class).html("<label class='aktif'>" + $val + "</label>")
  }

  function iuran_prd($id, $elem, $nilai, $tipe) {
    $.ajax({
      type: "POST",
      url: base_url() + "xhr/iuran_prd/" + $tipe,
      dataType: "json",
      data: {
        "id": $elem.attr("trn_id"),
        "uid": $uid,
        "prd": $elem.attr("periode"),
        "nominal": $nilai.replace(".", ""),
        "nama": $elem.find(".iuran-dtl").text()
      },
      success: function(data, status, xhr) {
        let cekit = false;
        if (!data) {
          alert("gagal proses, silahkan coba lagi")
          return false;
        }
        if (data["status"] == "sukses") {
          if ($tipe == "simpan") {
            $elem.attr("trn_id", data["data"]);
            // 

            // let $z = 0;
            // $(".data-iuran-nominal").each(function(params) {
            //   $val = $(this).text().replace(".", "").replace(",", "");
            //   if ($val != "") {
            //     $z = $z + parseInt($(this).text().replace(".", "").replace(",", ""));
            //   }
            // })
            // $("#total-iuran-prd").text(rp($z, ""))
          } else {
            $elem.attr("trn_id", "");
            $elem.find(".data-iuran-prd,.data-iuran-nominal").text("")
          }
          $("#total-iuran-prd").text(rp(data["total"], ""))
        } else {
          alert(data["status"]);
          window.location.href = "";
          // $(".bayar-iuran-prd").prop("checked", false);
        }
      }
    })
  }

  function bayar_iuran($msid, tipe) {
    console.log($msid + " " + tipe);
    $("#" + $msid).find("input,.simpan-iuran,.simpan-edit-iuran,.batal-iuran,.hapus-iuran, span").hide();
    $("#" + $msid + " .aktif").show();
    // $("#" + $msid + " .iuranAcc").text("");
    if (tipe == "simpan") {

    }
  }

  function rp(params, tipe) {
    if (tipe == "elem") {
      value = params.val().replace(",", "").replace(".", "");
      output = new Intl.NumberFormat('de-DE').format(value);
      params.val(output)
    } else {
      console.log(params + " " + tipe);
      // value = '"' + params + '"'.replace(",", "").replace(".", "");
      output = new Intl.NumberFormat('de-DE').format(params);
      return output;
    }
  }

  function show_otheriuran($id, $time) {
    $rsl = call_api(base_url() + "xhr/other_iuran/" + $id);
    if ($rsl["status"] == "sukses") {
      $("#dataTableMore tbody").html("");
      setTimeout(() => {
        $data = $rsl["data"];
        $ttl = $data.length;
        for ($x = 0; $x <= ($ttl - 1); $x++) {
          if ($data[$x]["tab_tanggal"] == "total") {
            $("#dataTableMore tbody").append("<tr class='bg-primary text-light'><td>" + $data[$x]["tab_tanggal"] + "</td><td>" + $data[$x]["total"] + "</td><td>" + $data[$x]["tab_in"] + "</td><td>" + $data[$x]["tab_out"] + "</td><td>" + $data[$x]["saldo"] + "</td></tr>")
          } else {
            if ($x == 0) {
              $tdlast = "<td rowspan='" + ($ttl - 1) + "' class='bg-light'></td>";
            } else {
              $tdlast = "";
            }
            $("#dataTableMore tbody").append("<tr><td>" + $data[$x]["tab_tanggal"] + "</td><td>" + $data[$x]["total"] + "</td><td>" + $data[$x]["tab_in"] + "</td><td>" + $data[$x]["tab_out"] + "</td>" + $tdlast + "</tr>")
          }
        }
      }, $time);
    }

  }

  function show_dtliuran($id, $time, $tahun, $nm) {
    $rsl = call_api(base_url() + "xhr/dtl_iuran/" + $id + "/" + $tahun);
    if ($rsl["status"] == "sukses") {
      $("#dataTableDtl tbody").html("");
      setTimeout(() => {
        $data = $rsl["data"];
        $ttl = $data.length;
        $date = new Date();
        $fulldate = $date.toLocaleDateString();
        for ($x = 0; $x <= ($ttl - 1); $x++) {
          if ($data[$x]["bulan"] == "total") {
            $("#dataTableDtl tbody").append("<tr class='bg-primary text-light'><td>" + NN($data[$x]["bulan"]) + "</td><td class='text-right total-iuran' >" + NN($data[$x]["total_in"]) + "</td><td colspan='3'></td></tr>")
          } else {
            if ($x == 0) {
              $tdlast = "<td rowspan='" + ($ttl - 1) + "' class='bg-light'></td>";
            } else {
              $tdlast = "";
            }
            $iuid = $data[$x]["id"];
            if ($data[$x]["total_in"] != "") {
              $bayar = "<td class='text-center iuranaksi' id='" + $iuid + "'  anggota='" + $nm + "'>" +
                "<a href='#' class='text-primary  edit-iuran   fas fa-edit aktif'></a>" +
                "<a href='#' class='text-info  simpan-edit-iuran fas fa-save  hide'></a>" +
                "<a href='#' class='text-danger   hapus-iuran  fas fa-trash hide ml-3'></a>" +
                "<a href='#' class='text-warning   batal-iuran  fas fa-times hide ml-3'></a>" +
                "</td>";
              // $total = input_iuran("", $iuid) + " " + ;
              // $acc = $data[$x]["acc"];
              // $desk = desc_iuran($nm + " bayar iuran - " + $iuid, $iuid) + " " + $data[$x]["desk"];
              $total = input_iuran($data[$x]["total_in"].replace(".", ""), $iuid) + "<label class='aktif'>" + $data[$x]["total_in"] + "</label>";
              $acc = "<label class='aktif'>" + $data[$x]["acc"] + "</label>";
              $desk = desc_iuran($nm + " bayar iuran - " + $iuid, $iuid) + "<label class='aktif'>" + $data[$x]["desk"] + "</label>";
            } else {
              $bayar = "<td class='text-center iuranaksi' id='" + $iuid + "' anggota='" + $nm + "'>" +
                "<a href='#' class='text-danger   bayar-iuran aktif'>Bayar</a>" +
                "<a href='#' class='text-success  simpan-iuran fas fa-save  hide'></a>" +
                "<a href='#' class='text-danger   batal-iuran  fas fa-times    hide ml-3'></a>" +
                "</td>";
              $total = input_iuran("", $iuid);
              $acc = $data[$x]["acc"];
              $desk = desc_iuran($nm + " bayar iuran - " + $iuid, $iuid);
            }
            $("#dataTableDtl tbody").append("<tr class='opsi-iuran' mid='" + $iuid + "' id='listData-iuran-" + $iuid + "'>" +
              "<td class='text-right'>" + $data[$x]["bulan"] + "</td>" +
              "<td class='text-right iuranUser'>" + $total + "</td>" +
              "<td class='iuranDesk'>" + $desk + "</td>" +
              "<td class='iuranAcc'>" + $acc + " </td > " +
              $bayar + "</tr>")
          }
        }
      }, $time);
    }

  }

  function input_iuran($val, $mid) {
    if ($val == "") {
      $val = 50000;
    }
    return "<input type='number' name='input-iuran' class='input-iuran text-right hide' id='input-iuran-" + $mid + "' periode='" + $mid + "' value='" + $val + "' placeholder='Nominal'     oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength)' maxlength='6'>";
  }

  function desc_iuran($val, $mid) {
    return "<input type='text'     name='desc-iuran'  class='desc-iuran  hide' id='desc-iuran-" + $mid + "' periode='" + $mid + "' value='" + $val + "'>";
  }

  function show_input($class, $tipe, $str) {
    if ($str == "open") {
      if ($tipe == "hide") {
        localStorage.setItem($class, "0");
      } else {
        localStorage.setItem($class, "1");
      }
      if ($tipe == "show") {
        $("." + $class).fadeIn();
      } else {
        $("." + $class).fadeOut();
      }
    } else {
      // console.log($class+" "+$tipe+" "+$str+" "+localStorage.getItem($class))
      if (localStorage.getItem($class)) {
        if (localStorage.getItem($class) == "1") {
          $("." + $class).show();
          $("#" + $class).prop("checked", true);
        } else {
          $("." + $class).hide();
          $("#" + $class).prop("checked", false);
        }
      } else {
        localStorage.setItem($class, "1");
        $("." + $class).show();
        $("#" + $class).prop("checked", true);
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

  function base_url() {
    return $("#uid").attr("base-url");
  }

  function save($tipe, $id, $nilai, $class, $last) {
    if ($nilai != $last) {
      if (isNaN($nilai)) {
        console.log("basdsd");
      } else {
        $cls = $("#" + $id).find(".syn-status");
        $cls.fadeIn();
        $.ajax({
          type: 'POST',
          url: base_url() + '/xhr/iuran',
          dataType: 'json',
          data: {
            tipe_trans: $tipe,
            siswa_id: $id,
            nilai: $nilai.replace(".", ""),
            tanggal: $("#tab_tgl").val(),
            uid: $("#uid").attr("uid")
          },
          success: function(data, status, xhr) {
            // setTimeout(() => {      
            //   $class.html($tipe);
            // }, 500);
            let cekit = false;
            if (data["status"] == "ok") {
              if ($nilai == "0" || $nilai == "") {
                $class.addClass("border-info").removeClass("border-secondary  clr");
              } else {
                $class.removeClass("border-info").addClass("border-secondary  clr");
              }
              $("#" + $id).attr("vlast", $nilai);
              $cls.fadeOut();
              cekit = true;
            } else if (data["status"] == "ok2") {
              if ($nilai == "0" || $nilai == "") {
                $class.addClass("border-warning").removeClass("border-secondary  clr");
              } else {
                $class.removeClass("border-warning").addClass("border-secondary clr");
              }
              $("#" + $id).attr("vlast", $nilai);
              $cls.fadeOut();
              cekit = true;
            }
            if (cekit) {
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

  function NN($value) {
    return $value == 0 || $value == "" || $value.length == 0 ? '' : $value;
  }
</script>
</body>

</html>