<section class="content">
  <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Kelas</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form action="<?= base_url("admin/Kelas/edit") ?>" method="post" id="form-kelas">
      <input type="hidden" name="id" value="<?= $id; ?>">
        <div class="form-group row">
            <label for="kelas" class=" col-sm-2 text-center">Kelas</label>
          <div class="col-sm-5">  
          <input type="text" class="form-control" name="kelas" required id="kelas" placeholder="Kelas" value="<?= $room['kelas']; ?>">
          <br>
          <div class="col-sm-3 " style="margin-left: -15px;">
            <button type="submit" class="btn btn-warning btn-block" id="save">Simpan <i class="fa fa-send"></i></button>
          </div>
        </div>
      </form>
    </div>
      </form>
    </div>
    </div>
  </section>
