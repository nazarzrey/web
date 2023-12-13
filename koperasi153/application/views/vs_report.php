<?php
#dbg($transaksi);
?>

<div class="card shadow mb-4" id="myreport">
    <div class="card-body">
        <div class="col-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="card shadow brd3">
                        <div class="card-body p-3">
                            <div class="col-12">
                                <?php
                                if (isset($transaksi)) {
                                    if ($transaksi) {
                                        echo "<li class='text-left btn btn-md btn-secondary w-100 my-1 jurnal-menu'  id='jurnal-all'><a class='text-light w-100 '>All Trans <span class='badge float-right'></span></a></li>";
                                        foreach ($transaksi as $key => $value) {
                                            echo "<li class='text-left btn btn-md btn-primary w-100 my-1 jurnal-menu'  id='jurnal-" . $value->mid . "'><a class='text-light w-100 '>" . Uw($value->name) . " <span class='badge float-right'></span></a></li>";
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 m-p-2">
                    <div class="card shadow">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="jurnalTableDtl" width="100%" cellspacing="0">
                                <thead>
                                    <th class="text-center">Tanggal</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                    <th>Tipe</th>
                                    <th>Deskripsi</th>
                                    <th>Acc</th>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($report as $key => $rp) {
                                        echo "<tr class='jurnal-" . $rp->fk_mid . "'>
                                                    <td class='text-center '>" . $rp->tanggal . "</td>
                                                    <td class='text-right'>" . $rp->cash_in . "</td>
                                                    <td class='text-right'>" . $rp->cash_out . "</td>
                                                    <td>" . $rp->tipe . "</td>
                                                    <td>" . $rp->description . "</td>
                                                    <td>" . $rp->nama . "</td>
                                                    </tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>