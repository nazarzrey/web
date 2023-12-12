          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
                <a href="<?= base_url("master/siswa") ?>" class='<?= pilih("all",$pilih_kelas, "btn-sm btn-primary","btn-sm btn-success") ?>'>All Siswa</a>
                <?php 
                if(isset($kelas)){
                    foreach ($kelas as $key => $k) {
                        echo "<a href='".base_url("master/siswa/".$k->kelas_id)."' class='".pilih($k->kelas_id,$pilih_kelas, "btn-sm btn-primary","btn-sm btn-success")." m-1'>".$k->kelas_nama."</a>";
                    }
                }
                ?><span class="float-right font-weight-normal"><i>untuk bisa edit masuk ke halaman </i><a href="<?= admin_url("admin/siswa") ?>" target="_blank" class="btn btn-sm btn-secondary p-0 px-2 ml-2">administrator</a></span>
              </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nis</th>
                      <th>Nisn</th>
                      <th>Nama</th>
                      <th>Password</th>
                      <th>L/P</th>
                      <th>Ttl</th>
                      <th>Kelas</th>
                      <th>Detail</th>
                      <!-- <th>Ayah</th>
                      <th>Ibu</th>
                      <th>Alamat</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(isset($siswa)){
                        foreach ($siswa as $key => $s) {
                            echo 
                            "<tr>
                            <td>".$s->siswa_nis."</td>
                            <td>".$s->siswa_nisn."</td>
                            <td>".Uw($s->siswa_nama)."</td>
                            <td>".$s->siswa_password."</td>
                            <td>".$s->siswa_jenkel."</td>
                            <td>".$s->siswa_tempat_lahir.", ".$s->siswa_tanggal_lahir."</td>
                            <td>".$s->siswa_kelas_id."</td>
                            <td class='text-center'><a href='#' class='siswa-dtl' id='siswa-".$s->siswa_id."' >Klik</a></td>
                            </tr>";
                            
                            // <td>".Uw($s->siswa_ayah)."</td>
                            // <td>".Uw($s->siswa_ibu)."</td>
                            // <td>".$s->siswa_alamat."</td>
                        }
                        
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
