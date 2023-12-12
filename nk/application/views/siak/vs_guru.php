          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">
                All Data Guru
                ?><span class="float-right font-weight-normal"><i>untuk bisa edit masuk ke halaman </i><a href="<?= admin_url("admin/guru") ?>" target="_blank" class="btn btn-sm btn-secondary p-0 px-2 ml-2">administrator</a></span>
              </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Nip</th>
                      <th>Nama</th>
                      <th>L/P</th>
                      <th>Ttl</th>
                      <th>Kelas</th>
                      <th>Photo</th>
                      <th>Detail</th>
                      <!-- <th>Ayah</th>
                      <th>Ibu</th>
                      <th>Alamat</th> -->
                    </tr>
                  </thead>
                  <!-- <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Position</th>
                      <th>Office</th>
                      <th>Age</th>
                      <th>Start date</th>
                      <th>Salary</th>
                    </tr>
                  </tfoot> -->
                  <tbody>
                    <?php
                    if(isset($guru)){
                        foreach ($guru as $key => $g) {
                          $img = get_img_user($g->guru_photo);
                            echo 
                            "<tr>
                            <td>".$g->guru_nip."</td>
                            <td>".Uw($g->guru_nama)."</td>
                            <td>".$g->guru_jenkel."</td>
                            <td>".$g->guru_tmp_lahir.", ".$g->guru_tgl_lahir."</td>
                            <td>".$g->guru_mapel."</td>
                            <td class='text-center'><img src='".$img."' style='max-height:40px'/></td>
                            <td class='text-center'><a href='#' class='siswa-dtl' id='siswa-".$g->guru_id."' >Klik</a></td>
                            </tr>";
                            
                            // <td>".Uw($g->ayah)."</td>
                            // <td>".Uw($g->ibu)."</td>
                            // <td>".$g->alamat."</td>
                        }
                        
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
