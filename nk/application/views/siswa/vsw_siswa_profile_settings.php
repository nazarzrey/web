<div class="card shadow mb-4">
    <div class="card-body">
        <div class="container-fluid">    
            <form class="row col-sm-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>N I S</label>
                        <input type="email" class="form-control" disabled value="<?= $profile[0]->siswa_nis ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>N I S N</label>
                        <input type="email" class="form-control" disabled value="<?= $profile[0]->siswa_nisn ?>"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>N A M A</label>
                        <input type="email" class="form-control" disabled value="<?= $profile[0]->siswa_nama ?>"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>TEMPAT & TANGGAL LAHIR</label>
                        <input type="text" class="form-control" disabled value="<?= $profile[0]->siswa_tempat_lahir.", ".tgl_indo($profile[0]->siswa_tanggal_lahir) ?>"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>PASSWORD SIAK</label>
                        <input type="email" class="form-control" disabled value="<?= $profile[0]->siswa_password ?>"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>JENIS KELAMIN</label>
                        <input type="email" class="form-control" disabled value="<?= $profile[0]->siswa_jenkel=="L"?"Laki-laki":"Perempuan" ?>"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>AGAMA</label>
                        <input type="email" class="form-control" disabled value="<?= $profile[0]->siswa_agama ?>"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>KELAS</label>
                        <input type="text" class="form-control" disabled value="<?= $profile[0]->siswa_kelas_id ?>"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>AYAH</label>
                        <input type="text" class="form-control" disabled value="<?= $profile[0]->siswa_ayah ?>"  >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>IBU</label>
                        <input type="text" class="form-control" disabled value="<?= $profile[0]->siswa_ibu ?>"  >
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>ALAMAT</label>
                        <input type="text" class="form-control" disabled value="<?= $profile[0]->siswa_alamat ?>"  >
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>