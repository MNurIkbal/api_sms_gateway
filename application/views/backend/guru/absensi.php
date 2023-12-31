<?php $id_mapel = $this->session->userdata('id_mapel'); ?>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
          <li class="pull-left header"><i class="fa fa-th"></i> Kelas</li>
        </ul>
        <?php if($this->session->flashdata("success")) : ?>
          <div class="alert alert-success " style="margin: 20px;">
            Data Berhasil Di Kirim
          </div>
          <?php endif; ?>
        <div class="tab-content">
          <div class="tab-pane active">
            <form method="post">
              <center>
                <b>Absensi Siswa</b>
                <p class="text-muted">Pilih kelas</p>
                <select class="form-control" name="kelas" required style="width:30%">
                  <?php foreach ($kelas as $val) :
                    if ($this->input->post('kelas') == $val->id_kelas) {
                      $selected = "selected";
                    } else {
                      $selected = '';
                    }
                  ?>
                    <option value="<?= $val->id_kelas ?>" <?= $selected ?>><?= $val->kelas; ?></option>
                  <?php endforeach; ?>
                </select>
                <br />
                <select name="mapel" class="form-control" required id="select2" style="width: 30%;">
                  <?php foreach($mapel as $sho) : ?>
                    <?php 
                    $id_mapels = $sho['mapel_id'];
                      $nama_mapel = $this->db->query("SELECT * FROM mapel WHERE id_mapel = '$id_mapels'")->row_array();
                      ?>
                    <option value="<?= $sho['mapel_id']; ?>">
                    <?= $nama_mapel['nama_mapel'] ?>
                  </option>
                    <?php endforeach; ?>
                </select>
                <br>
                <button class="btn btn-success">Pilih</button>
              </center>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
          <li class="pull-left header"><i class="fa fa-users"></i> Absensi</li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active">
            <form action="<?= site_url('guru/absensi/saveAbsensi'); ?>" method="post" id="absen">
              <table class="table table-hover table-striped">
                <thead>
                  <th>Tanggal</th>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Aksi</th>
                </thead>
                
                <tbody>
                  <?php foreach ($siswa as $sis) : ?>
                    <input type="hidden" name="id_siswa[]" value="<?= $sis->id_siswa; ?>">
                    <input type="hidden" name="id_kelas" value="<?= $id_kelas; ?>">
                    <input type="hidden" name="id_mapel" value="<?= $pelajaran; ?>">
                    <tr>
                      <td><?= date("d-m-Y") ?></td>
                      <td><?= $sis->nis; ?></td>
                      <td><?= $sis->nama; ?></td>
                      <td>
                        <select class="form-control" name="keterangan[]">
                          <option value="Hadir">Hadir</option>
                          <option value="Alpha">Alpha</option>
                          <option value="Ijin">Ijin</option>
                          <option value="Sakit">Sakit</option>
                        </select>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <br />
              <?php if ($this->input->post('kelas') == "") { ?>
                <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Pilih kelas dahulu" disabled>Kirim Absensi</button>
              <?php } else { ?>
                <button class="btn btn-primary">Kirim Absensi</button>
              <?php } ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>