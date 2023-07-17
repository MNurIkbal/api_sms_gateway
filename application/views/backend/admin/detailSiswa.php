<section class="content">
  <div class="row">

    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">
            Detail Siswa
          </h3>
        </div>
        <div >
          <div class="box-body">
            <div class="form-group row">
              <label for="nip" class=" col-sm-2">NIS</label>
              <div class="col-sm-10">
                <h5><?= $user['nis']; ?></h5>
              </div>
            </div>
            <div class="form-group row">
              <label for="nama" class=" col-sm-2">Nama Lengkap</label>
              <div class="col-sm-10">
                <h5><?= $user['nama']; ?></h5>
              </div>
            </div>
            <div class="form-group row">
              <label for="no_hp" class=" col-sm-2">Nomor HP</label>
              <div class="col-sm-10">
                <h5><?= $user['no_hp']; ?></h5>
              </div>
            </div>
            <div class="form-group row">
              <label for="alamat" class=" col-sm-2">Alamat</label>
              <div class="col-sm-10">
                <?= $user['alamat'] ?>
              </div>
            </div>
            <div class="form-group row">
              <label for="agama" class=" col-sm-2">Agama</label>
              <div class="col-sm-10">
                <?php 
                $id_agama= $user['id_agama'];
                
                $id_kelas = $user['id_kelas'];
                // $mapels = $this->db->query("SELECT * FROM mapel_guru WHERE user_id = '$id_users'")->result_array();
                $kelas = $this->db->query("SELECT * FROM kelas WHERE id_kelas = '$id_kelas'")->row_array();
                $agama = $this->db->query("SELECT * FROM agama WHERE id_agama = '$id_agama'")->row_array();
                ?>
                <h5><?= $agama['agama']; ?></h5>
              </div>
            </div>
            <div class="form-group row">
              <label for="tempat_lahir" class=" col-sm-2">Tempat/Tanggal Lahir</label>
              <div class="col-sm-10">
                <h5>
                <?= $user['tempat_lahir']; ?>, <?= $user['tanggal_lahir'] ?>
                </h5>
              </div>
            </div>
            <div class="form-group row">
              <label for="gender" class=" col-sm-2">Jenis Kelamin</label>
              <div class="col-sm-10">
                <h5><?= $user['jenis_kelamin']; ?></h5>
              </div>
            </div>
            <div class="form-group row">
              <label for="gender" class=" col-sm-2">Kelas</label>
              <div class="col-sm-10">
                <h5><?= $kelas['kelas']; ?></h5>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <label class="col-sm-4 "></label>
                <div class="row">
                  <div class="col-sm-2">
                    <a href="<?= site_url('data-siswa'); ?>" class="btn btn-danger btn-block">Kembali <i class="fa fa-chevron-left"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</section>
