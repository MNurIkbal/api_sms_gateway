<section class="content">
  <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Guru</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
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
      <form action="<?= site_url('admin/DataGuru/saveEdit') ?>" method="post" id="form-guru">
        <input type="hidden" name="id_user" value="<?= $dataGuru->id_user; ?>">
        <div class="form-group row">

          <label for="nip" class=" col-sm-2">NIP/NUPTK</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="nip" required placeholder="NIP/NUPTK 18 digit" value="<?= $dataGuru->nip; ?>">
            <small class="nip"><i class="text-muted">Jika NUPTK kurang dari 18, tambahkan digit 0 di bagian depan.</i></small>
          </div>
        </div>
        <div class="form-group row">
          <label for="nama" class=" col-sm-2">Nama Lengkap</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="nama" required placeholder="Nama Lengkap" value="<?= $dataGuru->nama; ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="username" class=" col-sm-2">Username</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="username" required onblur="userNameAvail()" placeholder="Username" value="<?= $dataGuru->username; ?>">
            <small class="uname"></small>
          </div>
        </div>
        <div class="form-group row">
          <label for="no_hp" class=" col-sm-2">Nomor HP</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="no_hp" required placeholder="+62-800-0000-0000" value="<?= $dataGuru->no_hp; ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="alamat" class=" col-sm-2">Alamat</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="alamat" required placeholder="Alamat Lengkap" value="<?= $dataGuru->alamat; ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="agama" class=" col-sm-2">Agama</label>
          <div class="col-sm-10">
            <select class="form-control" required name="agama">
              <option value="" selected hidden>--Pilih Agama--</option>
              <?php foreach ($agama as $val) : ?>
                <option value="<?= $val->id_agama ?>" <?php if ($dataGuru->id_agama == $val->id_agama) {
                                                        echo 'selected';
                                                      } ?>><?= $val->agama; ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="tempat_lahir" class=" col-sm-2">Tempat/Tanggal Lahir</label>
          <div class="col-sm-5">
            <input type="text" required class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" value="<?= $dataGuru->tempat_lahir; ?>">
          </div>
          <div class="col-sm-5">
            <div class="input-group">
              <input type="text" required class="form-control" id="lahirGuru" name="tanggal_lahir" placeholder="08-08-1998" value="<?= $dataGuru->tanggal_lahir; ?>" readonly>
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="gender" class=" col-sm-2">Jenis Kelamin</label>
          <div class="col-sm-10">
            <select class="form-control" required name="gender">
              <option value="" selected hidden>--Pilih Gender--</option>
              <option value="Laki-laki" <?php if ($dataGuru->jenis_kelamin == 'Laki-laki') {
                                          echo 'selected';
                                        } ?>>Laki-laki</option>
              <option value="Perempuan" <?php if ($dataGuru->jenis_kelamin == 'Perempuan') {
                                          echo 'selected';
                                        } ?>>Perempuan</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="status" class=" col-sm-2">Status</label>
          <div class="container row">
            <div class="col-sm-4">
              <input type="radio" required name="status" value="2" <?= ($dataGuru->id_status == "2") ? "checked" : ""; ?>> PNS
              &nbsp;
              <input type="radio" required name="status" vlaue="3" <?= ($dataGuru->id_status == "3") ? "checked" : ""; ?>> Honorer
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="mapel" class=" col-sm-2">Mata Pelajaran</label>
          <div class="col-sm-10">

            <select class="form-control" required id="select2" name="mapel[]" multiple>
              <?php foreach ($mapel as $val) : ?>
                <?php $isSelected = false; ?>
                <?php foreach ($mapels as $rows) : ?>
                  <?php if ($val->id_mapel == $rows['mapel_id']) {
                    $isSelected = true;
                    break;
                  } ?>
                <?php endforeach; ?>
                <option value="<?= $val->id_mapel ?>" <?= $isSelected ? "selected" : ""; ?>><?= $val->nama_mapel ?></option>
              <?php endforeach; ?>
            </select>

          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-12">
            <label class="col-sm-4 "></label>
            <div class="row">
              <div class="col-sm-2">
                <button type="submit" href="#" class="btn btn-success btn-block">Simpan <i class="fa fa-send"></i></button>
              </div>
              <div class="col-sm-2">
                <a href="<?= site_url('data-guru'); ?>" class="btn btn-danger btn-block">Kembali <i class="fa fa-chevron-left"></i></a>
              </div>
            </div>
          </div>
        </div>
    </div>
    </form>
  </div>
  </div>
  </div>
  </form>
  </div>
  </div>
</section>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
  $('#lahirGuru').datepicker({
    locale: {
      format: "dd-mm-yyyy"
    }
  });


  $("#nip").inputFilter(function(value) {
    return /^\d*$/.test(value) && (value === "" || parseInt(value.length) <= 10);
  });

  function save() {
    var data = new FormData($('#form-guru')[0]);
    $.ajax({
      type: 'post',
      url: '<?= site_url('admin/DataGuru/saveEdit') ?>',
      contentType: false,
      processData: false,
      dataType: 'json',
      data: data,
      success: function(data) {
        console.log(data);
        if (data.status == true) {
          swal({
            title: 'Tambah Guru',
            text: 'Data guru berhasil diubah',
            icon: 'success'
          }).then(function() {
            window.location = "<?= site_url('admin/DataGuru'); ?>";
          });
        } else {
          swal({
            title: 'Gagal',
            text: 'Periksa lagi',
            icon: 'error',
            dangerMode: 'true'
          })
        }
      }

    })
  }
  $(document).ready(function() {
    $('#select2').select2();
  });
</script>