<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- Custom Tabs (Pulled to the right) -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs pull-right">
          <li class="pull-left header"><i class="fa fa-th"></i> Rekap Bulanan</li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active">
            <?php if ($this->session->flashdata("error")) : ?>
              <div class="alert alert-danger">
                <?= $this->session->flashdata("error"); ?>
              </div>
            <?php endif ?>
            <?php if ($this->session->flashdata("success")) : ?>
              <div class="alert alert-success">
                <?= $this->session->flashdata("success"); ?>
              </div>
            <?php endif ?>
            <form method="post" action="<?= base_url("guru/DataRekap/prints"); ?>">

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
                      <?php
                      $id_mapels = $row['mapel_id'];
                      $pel = $this->db->query("SELECT * FROM mapel WHERE id_mapel = '$id_mapels'")->row_array();
                      ?>
                      <option value="<?= $row['mapel_id']; ?>"><?= $pel['nama_mapel']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <label for="">Tanggal Mulai</label>
                  <input type="date" class="form-control" required placeholder="" name="mulai">
                  <br>
                  <label for="">Tanggal Akhir</label>
                  <input type="date" class="form-control" required placeholder="" name="akhir">
                </div>
              </div>

              <br />
              <button type="submit" class="btn btn-success">Pilih</button>


            </form>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->
    </div>


    <form method="post" action="<?= site_url('cetak-rekap'); ?>">
      <div class="col-md-12">

        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs pull-right">
            <li class="pull-left header"><i class="fa fa-users"></i> Data Rekap Absensi</li>
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
              <li class="pull-right header"><button class="btn btn-success btn-sm" formtarget="_blank"><i class="fa fa-print"></i> Cetak</button></li>
            <?php endif; ?>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active">
              <table class="table table-hover table-striped" style="width:100%">
                <thead>
                  <th>Waktu</th>
                  <th>NIS</th>
                  <th>Nama</th>
                  <th>Sakit</th>
                  <th>Ijin</th>
                  <th>Alpha</th>
                  <th>Hadir</th>
                </thead>
                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
                  <tbody>

                    <?php
                    foreach ($absensi as $val) :
                      $tot = $val->tSakit + $val->tIjin + $val->tAlpha;
                    ?>
                      <input type="hidden" name="kelas" value="<?= $kelask ?>">
                      <input type="hidden" name="mapel" value="<?= $mapelk ?>">
                      <tr>
                        <td><?= $val->bulan . '/' . $val->tahun; ?></td>
                        <td><?= $val->tSakit; ?></td>
                        <td><?= $val->tIjin; ?></td>
                        <td><?= $val->tAlpha; ?></td>
                        <td><?= $tot; ?></td>
                      </tr>
                    <?php endforeach; ?>

                  </tbody>
                <?php } else { ?>
                  <tbody>
                    <tr>
                      <td colspan="7>
                          <center>
                            <small class=" text-muted text-center"><i>Pilih Kelas dan Mata Pelajaran</i></small>
                        </center>
                      </td>
                    </tr>
                  </tbody>
                <?php } ?>
              </table>
              <br />



            </div>

          </div>

        </div>

      </div>
    </form>

  </div>
</section>