
            <section id="laporan-usulan" class="xhilang">
                <div id="data-href">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="container">
                                </div>
                                <!-- RECENT REPORT 2-->
                                <h4 style="margin-top: -10px;margin-bottom: 10px">Data Warga Kp Jeletreng <?= "per ".strtoupper($judul) ?></h4>
                                <div class="peta">
                                    <div class="row">
                                        <div class="col-lg-9 col-md-12">
                                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                              <?php
                                              if($warga){
                                                // for($x=1;$x<=5;$x++){
                                                foreach ($kolom as $key => $x) {
                                                    $id = $label.$x;
                                                    if($x==1){
                                                    ?>                                                    
                                                      <li class="nav-item">
                                                        <a class="nav-link active" id="<?= $id ?>-tab" data-toggle="tab" href="#<?= $id ?>" role="tab" aria-controls="<?= $id ?>" aria-selected="true"><?= str_replace("-"," ",strtoupper($id)) ?></a>
                                                      </li>
                                                    <?php
                                                    }else{
                                                    ?>                                                    
                                                      <li class="nav-item">
                                                        <a class="nav-link" id="<?= $id ?>-tab" data-toggle="tab" href="#<?= $id ?>" role="tab" aria-controls="<?= $id ?>" aria-selected="true"><?= str_replace("-"," ",strtoupper($id))  ?></a>
                                                      </li>
                                                    <?php
                                                    }
                                                }
                                              }
                                              ?>
                                            </ul>
                                            <div class="tab-content" id="myTabContent" style="overflow: auto">

                                              <?php
                                              if($warga){
                                                 for($x=1;$x<=5;$x++){
                                                    $irt = "0".$x;
                                                    $id  = "rt-".$irt;
                                                    if($x==1){
                                                    ?>       
                                                        <div class="tab-pane fade show active" id="<?= $id ?>" role="tabpanel" aria-labelledby="<?= $id ?>-tab" >
                                                            <table class='table table-bordered table-hover' style="border-top:none !important">
                                                                <thead class='no-brd-top'>
                                                                <th class='tgh t1'>Nomor</th><th class='t2'>Nama</th><th class='tgh'>Kelas</th><th class='tgh'>RT</th class='tgh'><th class="tgh">Aksi</th>
                                                                </thead>
                                                                <tbody style="overflow: auto;max-height: 700px;width: 100%">
                                                                    <?php 
                                                                    foreach ($warga as $key => $value) {
                                                                        $rt  = $value->rt;
                                                                        $kls = "class='k".$value->kelas."'";
                                                                        if($value->kelas==0){$kl = "";}else{$kl = $value->kelas;}
                                                                        $aks = "<a class='btn btn-warning btn-xs'>Edit</a> <a class='btn btn-danger btn-xs text-white'>Hapus</a>";
                                                                        if($rt==$irt){
                                                                            echo "<tr $kls><td class='tgh'>$value->nomor</td><td class='t2'>$value->nama</td><td class='tgh'>$kl</td><td class='tgh'>$value->rt</td><td class='t5 tgh'>$aks</td></tr>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    <?php
                                                    }else{
                                                    ?>      
                                                        <div class="tab-pane fade show" id="<?= $id ?>" role="tabpanel" aria-labelledby="<?= $id ?>-tab">
                                                            <table class='table table-bordered table-hover' style="border-top:none !important">
                                                                <thead class='no-brd-top'>
                                                                <th class='t1'>Nomor</th><th class='t2'>Nama</th><th class='t3'>Kelas</th><th class='t4'>RT</th class='t5'><th>Aksi</th>
                                                                </thead>
                                                                <tbody style="overflow: auto;max-height: 700px;width: 100%">
                                                                    <?php 
                                                                    foreach ($warga as $key => $value) {
                                                                        $rt = $value->rt;
                                                                        $kls = "class='k".$value->kelas."'";
                                                                        if($value->kelas==0){$kl = "";}else{$kl = $value->kelas;}
                                                                        $aks = "<a class='btn btn-warning btn-sm'>Edit</a> <a class='btn btn-danger btn-sm text-white'>Hapus</a>";
                                                                        if($rt==$irt){
                                                                            echo "<tr $kls><td class='t1'>$value->nomor</td><td class='t2'>$value->nama</td><td class='t3'>$kl</td><td class='t4'>$value->rt</td><td class='t5'>$aks</td></tr>";
                                                                        }
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    <?php
                                                    }
                                                 }
                                              }
                                              ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12 laporan-calur">
                                            <div class="title m-b-10 p-2" style="background: #fefefe;border: solid 1px #f1f1f1">
                                                <nav class="navbar-sidebar2">
                                                    <ul class="list-unstyled navbar__list">
                                                        <li >
                                                            <a href="#" data-href="mdl-add" class="mdl-open btn btn-success text-left text-white" >
                                                                <i class="fas fa-plus"></i>Tambah Warga</a>
                                                        </li>
                                                        <li class="<?= link_act($judul,"rt"); ?>">
                                                            <a href="<?= admin_url("rt") ?>">
                                                                <i class="fas fa-home"></i>Data Warga per RT</a>
                                                        </li>
                                                        <li class="<?= link_act($judul,"kelas"); ?>">
                                                            <a href="<?= admin_url("kelas") ?>">
                                                                <i class="fas fa-home"></i>Data Warga per Kelas</a>
                                                        </li>
                                                        <li class="<?= link_act($judul,"belumcetak"); ?>">
                                                            <a href="<?= admin_url("belumcetak") ?>">
                                                                <i class="fas fa-home"></i>Data Warga belum di cetak</a>
                                                        </li>
                                                        <li class="has-sub hilang">
                                                            <a class="js-arrow" href="#">
                                                                <i class="fas fa-cog"></i>Seting
                                                            </a>
                                                        </li>
                                                        <li class="<?= link_act($judul,"export"); ?>">
                                                            <a href="#">
                                                                <i class="fas fa-file-pdf-o"></i> Export</a>
                                                                <span class="inbox-num hilang">3</span>
                                                        </li>
                                                        <li class="<?= link_act($judul,"find"); ?>">
                                                            <a href="#">
                                                                <i class="fas fa-search"></i>Cari Data</a>
                                                                <span class="inbox-num hilang">3</span>
                                                        </li>
                                                        <li>
                                                            <div class="p-4 text-center info-kelas">
                                                                <span class="k1">Kelas 1</span>
                                                                <span class="k2">Kelas 2</span><br/>
                                                                <span class="k3">Kelas 3</span>
                                                                <span class="k0">Kosong</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- END RECENT REPORT 2             -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>