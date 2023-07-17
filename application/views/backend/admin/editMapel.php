<section class="content">
  <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Mapel</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form action="<?= base_url("admin/Mapel/update") ?>" method="post" id="form-kelas">
    <input type="hidden" name="id" value="<?= $id; ?>">
        <div class="form-group row">
            <label for="kelas" class=" col-sm-2 text-center">Mapel</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" name="mapel" id="mapel" required placeholder="Nama Mapel" value="<?= $mapel['nama_mapel']; ?>">
          </div>
          <div class="col-sm-3">
            <button type="submit" class="btn btn-warning btn-block" >Simpan <i class="fa fa-send"></i></button>
          </div>
        </div>
      </form>
    </div>
      </form>
    </div>
    </div>
</section>