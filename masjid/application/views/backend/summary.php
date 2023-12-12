
            <section id="laporan-usulan" class="xhilang">
                <div id="data-href">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="container">
                                </div>
                                <!-- RECENT REPORT 2-->
                                <h4 style="margin-top: -10px;margin-bottom: 10px">Perkiraan Warga Kp Jeletreng </h4>
                                <div class="peta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <?php
                                                if($sum){
                                                    echo "<table class='table table-bordered table-hover' style='border-top:none !important'>";
                                                    echo "<thead><th>RT</th><th>Kelas</th><th>Total</th><th>Rupiah</th></thead>";
                                                    echo "<tbody>";
                                                    $rp1 = $rp2 = 0;
                                                    $rt  = "";
                                                    $xr  = $k1 = $k2 = $k3 = $k4 = 0;
                                                    foreach ($sum as $key => $kelas) {
                                                        $total = infaq($kelas->kelas,$kelas->total);
                                                        $xr    =  $total + $xr;
                                                        if($kelas->kelas=="1"){
                                                            $k1 = $total + $k1;
                                                        }elseif($kelas->kelas=="2"){
                                                            $k2 = $total + $k2;
                                                        }elseif($kelas->kelas=="3"){
                                                            $k3 = $total + $k3;
                                                        }else{
                                                            $k4 = $total + $k4;
                                                        }
                                                        /*
                                                        if($kelas->rt!=$rt){
                                                            echo "<tr><td>$kelas->rt</td><td>$kelas->kelas</td><td>$kelas->total</td><td class='kanan'>".currency($total)."</td></tr>";
                                                        }else{*/
                                                            echo "<tr><td>$kelas->rt</td><td>$kelas->kelas</td><td>$kelas->total</td><td class='kanan'>".currency($total)."</td></tr>";/*
                                                            echo "<tr><td colspan='3'>Total</td><td class='kanan'>".currency($total)."</td></tr>";
                                                        }
                                                        $rt = $kelas->rt;*/
                                                    }              
                                                            echo "<tr><td colspan='3'>total Kelas 1</td><td class='kanan'>".currency($k1)."</td></tr>";
                                                            echo "<tr><td colspan='3'>total Kelas 2</td><td class='kanan'>".currency($k2)."</td></tr>";
                                                            echo "<tr><td colspan='3'>total Kelas 3</td><td class='kanan'>".currency($k3)."</td></tr>";
                                                            echo "<tr><td colspan='3'>total ALL </td><td class='kanan'>".currency($xr)."</td></tr>";
                                                    echo "</tbody>";                                      
                                                    echo "</table>";
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>