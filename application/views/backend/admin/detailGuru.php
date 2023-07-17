<section class="content">
  <div class="row">

    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">
            Detail Guru
          </h3>
        </div>
        <div >
          <div class="box-body">
            <?php if ($this->session->flashdata("error")) : ?>
              <div class="alert alert-danger">
                <?= $this->session->flashdata("error"); ?>
              </div>
            <?php endif; ?>
            <?php if ($this->session->flashdata("success")) : ?>
              <div class="alert alert-success">
                <?= $this->session->flashdata("success"); ?>
              </div>
            <?php endif; ?>

            <div class="form-group row">
              <label for="nip" class=" col-sm-2">NIP/NUPTK</label>
              <div class="col-sm-10">
                <h5><?= $user['nip']; ?></h5>
              </div>
            </div>
            <div class="form-group row">
              <label for="nama" class=" col-sm-2">Nama Lengkap</label>
              <div class="col-sm-10">
                <h5><?= $user['nama']; ?></h5>
              </div>
            </div>
            <div class="form-group row">
              <label for="username" class=" col-sm-2">Username</label>
              <div class="col-sm-10">
                <h5><?= $user['username']; ?></h5>
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
                $id_status = $user['id_status'];
                $mapels = $this->db->query("SELECT * FROM mapel_guru WHERE user_id = '$id_users'")->result_array();
                
                $agama = $this->db->query("SELECT * FROM agama WHERE id_agama = '$id_agama'")->row_array();
                $status = $this->db->query("SELECT * FROM status WHERE id_status = '$id_status'")->row_array();
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
              <label for="status" class=" col-sm-2">Status</label>
              <div class="col-sm-10">
                <h5><?= $status['status']; ?></h5>
              </div>
            </div>
            <div class="form-group row">
              <label for="mapel" class=" col-sm-2">Mata Pelajaran</label>
              <div class="col-sm-10">
                <?php foreach($mapels as $row):  ?>
                  
                  <?php 
                  $nos = $row['mapel_id'];
                    $pelajaran_satu = $this->db->query("SELECT * FROM mapel WHERE id_mapel = '$nos'")->row_array();
                    ?>
                  <h5><?= $pelajaran_satu['nama_mapel']; ?></h5>
                  <?php endforeach; ?>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12">
                <label class="col-sm-4 "></label>
                <div class="row">
                  <div class="col-sm-2">
                    <a href="<?= site_url('data-guru'); ?>" class="btn btn-danger btn-block">Kembali <i class="fa fa-chevron-left"></i></a>
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
