<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>assets/gambar/logo/fav/fav.png" type="image/x-icon">
  <link rel="icon" href="<?= base_url() ?>assets/gambar/logo/fav/fav.png" type="image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/jQueryMonth/demo/MonthPicker.css"> -->
  <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/backend/bower_components/jquery-ui/jquery-ui.css"> -->

  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- Datatables -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/backend/bower_components/datatables/datatables.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
<style>
    
    @media print {
        #poweredbyLogo{
            width:213px;
        }
        #logoframe{
            height:80px;
            margin-top:6px;
        }

        .space{
            padding-left:20px;
        }

        .col-md-6.a1{
            background-color: #0000f6!important;
        }
        .col-md-6.a2{
            background-color: #d3d3d3!important;
        }
    }
/*How they look like on the screen*/
@media screen {
    #poweredbyLogo{
        width:47%;
    }

    #logoframe{
        height:80px;
        margin-top:6px;
    }

    .space{
        padding-left:20px;
    }
}
</style>

</head>
<body style="margin: 10px !important;">
    <br/>
    <h4 style="text-align: center;">Laporan Absensi Bulanan</h4>
    <div class="text-center">
        <img src="<?= base_url() ?>assets/gambar/logo/logo.png" id="poweredbyLogo" style="max-width:7%;">
    </div>
    <div class="">
        <div class="form-group">
            <label>Kelas : </label>
            
            <input type="text" class="form-control" value="<?= $kelas['kelas'];?>" disabled>
        </div>
        <div class="form-group">
            <label>Mata Pelajaran : </label>
            <input type="text" class="form-control" value="<?= $mapel['nama_mapel'];?>" disabled>
        </div>
        <div class="form-group">
            <label>Bulan : </label>
            <input type="text" class="form-control" value="<?= date("F Y",strtotime($bulans));?>" disabled>
        </div>
        <div class="table-responsive">  
            <table class="table table-bordered table-hover">
                <thead>
                    
                    <tr>
                        <th>No</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Sakit</th>
                        <th>Izin</th>
                        <th>Alpha</th>
                        <th>Hadir</th>
                    </tr>
                </thead>
                
                    <tbody>
                      <?php
                      $no =1;
                      foreach ($result as $val) :
                        $id_user = $val['siswa_id'];
                        $sis = $this->db->query("SELECT * FROM siswa WHERE id_siswa = '$id_user'")->row_array();
                      ?>
                        <tr>
                          <td><?= $no++; ?></td>
                          <td><?= $sis['nis']; ?></td>
                          <td><?= $sis['nama']; ?></td>
                          <td><?= $val['sakit']; ?></td>
                          <td><?= $val['izin']; ?></td>
                          <td><?= $val['alpha']; ?></td>
                          <td><?= $val['hadir']; ?></td>
                        </tr>
                      <?php endforeach; ?>

                    </tbody>
                  
            </table>
        </div>
    </div>
<script>
    window.print();
</script>
</body>
</html>