<?php
            echo "<table class='table table-bordered table-hover' width='100%' style='border:none'>
                          <thead>
                            <tr>
                              <th scope='col'>Tanggal</th>
                              <th scope='col'>Nama Jalan</th>
                              <th scope='col'>Foto</th>
                              <th scope='col'>Kelurahan</th>
                              <th scope='col'>Kecamatan</th>
                              <th scope='col'>Kordinat</th>
                              <th scope='col'>Jenis Konstruksi</th>
                              <th scope='col'>Status Lahan</th>
                              <th scope='col'>jenis</th>
                              <th scope='col'>Tahun Usulan</th>
                              <th scope='col'>Pengusul</th>
                              <th scope='col'>Nilai Pagu</th>
                            </tr>
                          </thead>
                          <tbody>";
            foreach ($data_table as $key => $hasil) {
              #debug($hasil->kordinat);
                if(kordinat($hasil->kordinat)=="1"){
                  $peta  = "OpenPopupCenter('".base_url("peta/".$hasil->id_pengaduan)."', 'TEST!?', 720, 480);return false;";  
                  $color = "";
                }else{
                  $peta  = "";
                  $color = "style='color:#000'";
                }

                $foto = "";
                #debug($hasil);
                if($hasil->foto==1){
                    $foto = "<i class='fa fa-picture-o foto' data-foto='".$hasil->id_pengaduan."' data-toggle='modal' data-target='#modalfoto'></i>";
                }elseif($hasil->foto>1){
                    $foto = "<i class='fa fa-object-group foto' data-foto='".$hasil->id_pengaduan."' data-toggle='modal' data-target='#modalfoto'></i>";
                }
                $jalan = "<a href='#' data-usulan='".$hasil->id_pengaduan."' class='card-link' data-toggle='modal' data-target='#modalusulan'>".$hasil->jalan."</a>";
                echo "
                            <tr data-toggle='modal' data-target='#modaldetail' data-foto='".$hasil->id_pengaduan."'>
                            <td>".tgl('ina',$hasil->upd_rec)."</td>
                            <td>".$jalan."</td>
                            <td>".$foto."</td>
                            <td>".$hasil->nama_kelurahan."</td>
                            <td>".$hasil->nama_kecamatan."</td>";
                ?>
                            <td><a href="#"  onclick="<?= $peta ?>" <?= $color ?>><?= $hasil->kordinat ?></td>
                <?php
                echo "
                            <td>".$hasil->konstruksi."</td>
                            <td>".$hasil->lahan."</td>
                            <td>".$hasil->jenis."</td>
                            <td>".$hasil->tahun."</td>
                            <td>".$hasil->pelapor."</td>
                            <td>".$hasil->pagu."</td>
                            </tr>";
            }
            echo "</tbody>
                </table>
            ";

?>