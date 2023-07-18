<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs (Pulled to the right) -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
          <li class="pull-left header"><i class="fa fa-th"></i> Kelas</li>
        </ul>
        <div class="tab-pane active">
            <?php if ($this->session->flashdata("error")) : ?>
              <div class="alert alert-danger " style="margin: 10px;">
                <?= $this->session->flashdata("error"); ?>
              </div>
            <?php endif ?>
            <?php if ($this->session->flashdata("success")) : ?>
              <div class="alert alert-success " style="margin: 10px;">
                <?= $this->session->flashdata("success"); ?>
              </div>
            <?php endif ?>
            <form method="post" action="<?= base_url("admin/DataRekap/prints"); ?>" style="margin: 10px;">
 
              <div class="row">
                <div class="col-md-6">
                  <label>kelas</label>
                  <select class="form-control" name="kelas" required>
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
                  <br>
                  <label>Pelajaran</label>
                  
                  <select name="mapel" id="mapel" class="form-control" required>
                    <?php foreach ($pelajaran as $row) : ?>
                      <option value="<?= $row['id_mapel']; ?>"><?= $row['nama_mapel']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="">Bulan</label>
                  <input type="month" class="form-control" required placeholder="" name="mulai">
                </div>
              </div>

              <br />
              <button type="submit" class="btn btn-success" style="margin-bottom: 10px;">Pilih</button>
              


            </form>
          </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->
    </div>

 
    <form method="post" action="<?= site_url('cetak-rekap');?>">
      <div class="col-md-12">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs pull-right">
            <li class="pull-left header"><i class="fa fa-users"></i> Data Rekap Absensi</li>
            <?php if($_SERVER['REQUEST_METHOD'] === 'POST') :?>
              <li class="pull-right header"><a href="<?= base_url("cetak_admin/$id_kelas/$mapel/$mulai"); ?>" class="btn btn-success bg-success " target="_blank"><i class="fa fa-print"></i> Cetak</a></li>
            <?php endif;?>
          </ul>
        <div class="tab-content">
          <div class="tab-pane active">
          <div class="table-responsive">
                <table class="table table-hover table-striped" style="width:100%">
                  <thead>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Sakit</th>
                    <th>Ijin</th>
                    <th>Alpha</th>
                    <th>Hadir</th>
                    <th>Waktu</th>
                  </thead>
                  <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
                    <tbody>
  
                      <?php
                      $no = 1;
                      foreach ($result as $val) :
                        $id_siswas = $val['siswa_id'];
                        $result_siswa = $this->db->query("SELECT * FROM siswa WHERE id_siswa = '$id_siswas'")->row_array();
                      ?>
                        <input type="hidden" name="kelas" value="<?= $id_kelas ?>">
                        <input type="hidden" name="mapel" value="<?= $mapel ?>">
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $result_siswa['nis']; ?></td>
                          <td><?= $result_siswa['nama']; ?></td>
                          <td><?= $val['sakit']; ?></td>
                          <td><?= $val['izin']; ?></td>
                          <td><?= $val['alpha']; ?></td>
                          <td><?= $val['hadir']; ?></td>
                          <td><?= date("F Y",strtotime($val['created'])); ?></td>
                        </tr>
                      <?php endforeach; ?>
  
                    </tbody>
                  <?php } else { ?>
                    <tbody>
                      <tr>
                        <td colspan="8">
                            <center>
                              <small class=" text-muted text-center"><i>Data Tidak Ada</i></small>
                          </center>
                        </td>
                      </tr>
                    </tbody>
                  <?php } ?>
                </table>
              </div>
                <br />

                <!-- <button class="btn btn-primary" disabled>Kirim Absensi</button> -->

            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->
      </div>
    </form>

  </div>
</section>