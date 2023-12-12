<?=  $this->uri->segment(count($this->uri->segment_array())-1); ?>

  <main id="main">

    <!-- ======= Portfoio Section ======= -->
    <section id="infaq" class="portfoio">
      <div class="container" >

        <div class="section-title" style="margin-top: 40px">
          <h2>Data Online Infaq Semua RT dan Kelas</h2>
          <p class="fbb">Input data terakhir <?= $max_tgl[0]->max_tgl ?> </p>
          <br/>
          <!-- <h3>input terakhir tgl 06-08-2020</h3> -->
        </div>

        <div class="row portfolio-container">
          <div class="container">
           <div class="row">            
            <div class="col-sm-12 col-md-6">
              <div class="cper1 p10 text-right"><b>persentase isian warga</b></div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="cper2 p10 text-right"><b>persentase Infaq Masuk</b></div>
            </div>
          </div>
          </div>
          <?php
            #debug($warga);
#setlocale(LC_TIME, 'IND'); 
          $m = 8;
          $y = 2020;
          //debug($persen);
          $ttl_bulan = total_bulan("2020-08-01",date("Y-m-d")) + 1;
          for ($i=1; $i<=$ttl_bulan; $i++) { 
            // $month = date('m', strtotime("$i month"))." ";
            // echo $month;
            if($m==13){
              $m=1;
              $y=$y+1;
            }else{
              $m=$m;
              $y=$y;
            }
            $bulan = bulan($m);
            //debug($this->Mod_query->persentase('2020-08-16',''));
            #echo date("Y-m-d", strtotime("fifth Sunday of ".date('M')." ".date('Y').""));
            // $minggu = weekOfMonth(date("Y-m-d"));
            echo "<div class='col-lg-12 col-md-12 col-sm-12 col-sx-12 portfolio-item filter-app table' style='overflow:auto'>";
            echo "<table border='1' width='100%' class='xtable'>";
            echo "<tr><td colspan='8' class='tdhdr text-center'>$bulan - $y</td></tr>";
            echo "<tr class='tdhdr2'><td>MINGGU</td><td>RT 01</td><td>RT 02</td><td>RT 03</td><td>RT 04</td><td>RT 05</td><td>Total</td></tr>";
            $ttl = 0;
            $gpers1 = $gpers2 = "";
            for($x=1;$x<=5;$x++){
              if($infaqdtl){
                $romawi = rome($x);
                $minggu = minggu($y,$m,$x);
                $key    = array_search($minggu, array_column($infaqdtl, 'tanggal'));
                //$keyp   = array_search($minggu, array_column($infaqdtl, 'tanggal'));
                $uang = 0;
                $tot = 0;
                echo "<tr><td class='text-center'>$romawi</td>";
                for($t=1;$t<=5;$t++){
                  $rp  = $pers1 = $pers2 = "";
                  foreach ($infaqdtl as $key => $value) {
                    $rt    = $value->rt;
                    if($value->tanggal==$minggu){
                      if(intval(substr($value->tanggal,5,2))==$m and $value->rt=="0".$t){
                        $prsen = $this->Mod_query->persen($minggu,$rt,"dtl");
                        if($prsen){
                          $pers1 = "<div class='per1' style='width:".pcent($prsen[0]->persen_warga)."% !important'><b>".$prsen[0]->persen_warga."%</b></div>";
                          $pers2 = "<div class='per2' style='width:".pcent($prsen[0]->persen_infaq)."% !important'><b>".$prsen[0]->persen_infaq."%</b></div>";
                          //$pers2 = $prsen[0]->persen_infaq;
                        };
                        $uang  = $value->total;
                        $rp    = "<b class='iin'>".currency($uang)."</b>";
                        $tot   += $uang;
                        //$ttl   = $this->Mod_query->persentase('2020-08-16','');
                      }
                    }         
                  }                  
                  echo "<td class='pr'>$pers1 $pers2 $rp</td>";
                }
                $tot = "<b class='ttl1'>".currency($tot)."</b>";         
                $gprsen = $this->Mod_query->persen($minggu,"","gabung");
                if(count($gprsen)>0){ 
                  $gpers1 = "<div class='per1' style='width:".pcent($gprsen[0]->persen_warga)."% !important'><b>".$gprsen[0]->persen_warga."%</b></div>";
                  $gpers2 = "<div class='per2' style='width:".pcent($gprsen[0]->persen_infaq)."% !important'><b>".$gprsen[0]->persen_infaq."%</b></div>";                
                }
                echo "<td class='pr'>$gpers1 $gpers2 $tot</td></tr>";
              }
            }
            echo "</tr>";
            echo "</table>";
            echo "</div>";
            $m++;
          } 
          ?>
        </div>

      </div>
    </section>

  </main><!-- End #main -->
