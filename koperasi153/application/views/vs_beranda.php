<?php
if (!$iuran) {
  // dbg($rowdata);
  return false;
}

?>
<div class="content mt-3">
  <div class="animated fadeIn">
    <div class="row">

      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <strong class="card-title">JURNAL KEUANGAN</strong>
          </div>
          <div class="card-body">
            <table id="bootstrap-data-table-export" class="table table-striped table-bordered beranda">
              <thead>
                <tr>
                  <th>Deskripsi</th>
                  <th class='text-right'>Uang Masuk</th>
                  <th class='text-right'>Uang Keluar</th>
                  <th class='text-center'>Detail</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $cash_in = $cash_out = 0;
                foreach ($iuran as $key => $value) {
                  // dbg($value);
                  $cash_in = +$value->cash_in + $cash_in;
                  $cash_out = +$value->cash_out + $cash_out;
                  echo " 
                                        <tr>
                                            <td>" . Uw(str_replace(array("_", "-"), " ", $value->name)) . "</td>
                                            <td class='text-right'>" . currency($value->cash_in) . "</td>
                                            <td class='text-right'>" . currency($value->cash_out) . "</td>
                                            <td class='text-center'><a href='#' class='mst-dtl' data-toggle='modal' data-target='#modalPopup' id='" . $value->mid . "' title='" . Uw(str_replace(array("_", "-"), " ", $value->name)) . "'><i class='fa fa-folder-open'></a></td>
                                        </tr>";
                  // $value[$key];
                }
                echo "<tr class='text-primary h5'><td>TOTAL</td><td class='text-right'>" . currency($cash_in) . "</td><td class='text-right'>" . currency($cash_out) . "</td><td class='text-center'>" . currency($cash_in - $cash_out) . "</td></tr>";
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>


    </div>
  </div><!-- .animated -->
</div><!-- .content -->

<div class="modal fade" id="modalPopup" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalPopupLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg ">
    <!-- modal-dialog-centered  -->
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="modalPopupLabel">
          <h6>Global Data <b class="modalDtl"></b> <b class="moremodalDtl"></b></h6>
        </h5>
        <button type="button" class="close mst-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <button type="button" class="close hide mst-back" aria-label="Close">
          <span aria-hidden="true" class="fas fa-reply-all"></span>
        </button>
      </div>
      <div class="modal-body m-p-0 ">
        <div class="row">
          <div class="col-md-12 m-p-2">
            <div class="card shadow">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTableDtl" width="100%" cellspacing="0">
                  <thead>
                    <th>Tahun Bulan</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Detail</th>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
                <table class="table table-bordered" id="moredataTableDtl" width="100%" cellspacing="0">
                  <thead>
                    <th>Tanggal</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Deskripsi</th>
                    <th>Acc</th>
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
</div>