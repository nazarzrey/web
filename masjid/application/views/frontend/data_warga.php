
  <!-- ======= Hero Section ======= -->
<style type="text/css">
  
    @media print{
      @page{
        /*size:8.5in 11in;*/
        /*size:8.5in 23in;*/
        /*size:213mm 328mm;*/
        size:landscape;           
      }
    }
</style>

  <main id="main">

    <!-- ======= Portfoio Section ======= -->
    <section id="infaq" class="portfoio">
      <div class="container" >

        <div class="section-title" style="margin-top: 40px">
          <h2>Data Online kartu Infaq<br/>Nama : <?= $warga[0]->nama.", RT ".$warga[0]->rt." Kelas Infaq ".$warga[0]->kelas ?></h2>
          <p>Data yang terdapat di sini sama dengan data yang di kumpulkan oleh masing-masing RT / minggu,<br/> jika belum berubah kemungkinan data belum di input oleh panitia</p>
          <p class="fbb">Input data terakhir <?= $max_tgl[0]->max_tgl ?> </p>
          <br/>
          <!-- <h3>input terakhir tgl 06-08-2020</h3> -->
        </div>

        <div class="row portfolio-container">
          <?php
            #debug($warga);
#setlocale(LC_TIME, 'IND'); 
          $m = 8;
          $y = 2020;
          for ($i=1; $i<=12; $i++) { 
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
            #echo date("Y-m-d", strtotime("fifth Sunday of ".date('M')." ".date('Y').""));
            // $minggu = weekOfMonth(date("Y-m-d"));
            echo "<div class='col-lg-3 col-md-3 col-sm-6 col-sx-12 portfolio-item filter-app xxtable'>";
            echo "<table border='1' width='100%' class='xtable'>";
            echo "<tr><td colspan='2' class='tdhdr'>$bulan - $y</td></tr>";
            echo "<tr><td rowspan='6' class='miring' width='40px;'><span>MINGGU</td></tr>";
            $ttl = 0;
            for($x=1;$x<=5;$x++){
              if($infaq){
                $romawi = rome($x);
                $minggu = minggu($y,$m,$x);
                $key = array_search($minggu, array_column($infaq, 'tanggal'));
                $rp  = "";
                $uang = 0;
                foreach ($infaq as $key => $value) {
                  if($value->tanggal==$minggu){
                    if(intval(substr($value->tanggal,5,2))==$m){
                      $uang  += $value->nominal;
                      $rp   .= "<b class='iin'>".currency($uang)."</b>";
                    }else{
                      $uang += 0;
                      $rp .= "";                      
                    }
                  }else{
                    $uang += 0;
                    $rp .= "";
                  }
                }
                echo "<tr><td>$romawi Rp. $rp</td></tr>";
              }else{          
                  $uang = 0;
                  echo "<tr><td>$romawi Rp.</td></tr>";
              }
              $ttl += $uang;
            }
            echo "<tr><td colspan='2'>Jumlah Rp. <b class='iin'>".currency($ttl)."</b></td></tr>";
            echo "</tr>";
            echo "</table>";
            echo "</div>";
            $m++;
          } 
          ?>
        </div>

      </div>
    </section><!-- End Portfoio Section -->

    <!-- ======= About Us Section ======= -->
    <!-- <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>About Us</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row content">
          <div class="col-lg-6">
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
              magna aliqua.
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
              <li><i class="ri-check-double-line"></i> Duis aute irure dolor in reprehenderit in voluptate velit</li>
              <li><i class="ri-check-double-line"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
              Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
              velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
              culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <a href="#" class="btn-learn-more">Learn More</a>
          </div>
        </div>

      </div>
    </section> --><!-- End About Us Section -->


    <!-- <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Pengerjaan</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">
          <div class="col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box">
              <i class="icofont-computer"></i>
              <h4><a href="#">Lorem Ipsum</a></h4>
              <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
            </div>
          </div>
          <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box">
              <i class="icofont-chart-bar-graph"></i>
              <h4><a href="#">Dolor Sitema</a></h4>
              <p>Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata</p>
            </div>
          </div>
          <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box">
              <i class="icofont-image"></i>
              <h4><a href="#">Sed ut perspiciatis</a></h4>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
            </div>
          </div>
          <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="400">
            <div class="icon-box">
              <i class="icofont-settings"></i>
              <h4><a href="#">Nemo Enim</a></h4>
              <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
            </div>
          </div>
          <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="500">
            <div class="icon-box">
              <i class="icofont-earth"></i>
              <h4><a href="#">Magni Dolore</a></h4>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
            </div>
          </div>
          <div class="col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up" data-aos-delay="600">
            <div class="icon-box">
              <i class="icofont-tasks-alt"></i>
              <h4><a href="#">Eiusmod Tempor</a></h4>
              <p>Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi</p>
            </div>
          </div>
        </div>

      </div>
    </section> --><!-- End Services Section -->

    <!-- ======= Cta Section ======= -->
    <!-- <section id="cta" class="cta">
      <div class="container">

        <div class="row" data-aos="zoom-in">
          <div class="col-lg-9 text-center text-lg-left">
            <h3>Form Laporan</h3>
            <p>Jika ada jalan yang rusak, yang becek dllnya untuk lingkungan wilayah depok silahkan buatkan laporannya disini </p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="#">Form Laporan</a>
          </div>
        </div>

      </div>
    </section> -->
    <!-- End Cta Section -->


    <!-- ======= Frequently Asked Questions Section ======= -->
    <!-- <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Form Laporan</h2>
        </div>

        <div class="row mt-1 d-flex justify-content-end" data-aos="fade-right" data-aos-delay="100">

          <div class="col-lg-5">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Location:</h4>
                <p>A108 Adam Street, New York, NY 535022</p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p>info@example.com</p>
              </div>

              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Call:</h4>
                <p>+1 5589 55488 55s</p>
              </div>

            </div>

          </div>


        </div>

      </div>
    </section> --><!-- End Frequently Asked Questions Section -->

  </main><!-- End #main -->
