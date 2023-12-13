          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary"><span class="float-right font-weight-normal">
                  <i>edit klik nama anggota </i></span>
              </h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama</th>
                      <th>Member</th>
                      <th>Status</th>
                      <th>Gabung</th>
                      <th>Lama</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if (isset($member)) {
                      foreach ($member as $key => $ag) {
                        if ($ag->user_member == "member") {
                          $class  = "";
                        } else {
                          $class  = "class='bg-light text-success'";
                        }
                        echo
                        "<tr $class>
                            <td>" . ($key + 1) . "</td>
                            <td><a href='#' class='soon' id='user-" . $ag->uid . "' >" . Uw($ag->nama) . "</a></td>
                            <td>" . $ag->user_member . "</td>
                            <td>" . Uw($ag->user_status) . "</td>
                            <td>" . $ag->user_join . "</td>
                            <td>" . $ag->lama . "</td>
                            </tr>";
                      }
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>