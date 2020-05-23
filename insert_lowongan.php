<?php
    $base_url = "http://localhost/pttca/";

    include_once "config/database.php";
    include_once "database/querybuilder.php";
    //cari lowongan
    $find = find('tb_lowongan',array('id'=>$_GET['id']))[0];
    if(count($_POST) > 0)
    {
        $nama         = $_FILES['berkas']['name'];
        $x            = explode('.',$nama);
        $ekstensi     = strtolower(end($x));
        $ukuran       = $_FILES['berkas']['size'];
        $file_tmp     = $_FILES['berkas']['tmp_name'];
        if($ukuran < 10485760)
        {
            $upload_file = $_SERVER['DOCUMENT_ROOT'].'/pttca/assets/berkas/'.$nama;
            move_uploaded_file($file_tmp,$upload_file);
            $data = array(
              'nama'        => $_POST['nama'],
              'berkas'      => $nama,
              'nomor_telepon'       =>$_POST['nomor_telepon'],
              'alamat'   => $_POST['alamat'],
              'tanggal'        => date('Y-m-d'),
              'id_lowongan' => $find['id'],
            );
            $sql = insert('tb_lamaran',$data);
            if($sql)
            {
                echo "<script>alert('Berhasil mendaftarkan lowongan!')</script>";

            }
        }
        else
        {
            echo "File yang diupload lebih dari 10MB !";
        }
    }
  ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= $base_url?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= $base_url?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= $base_url?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $base_url?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= $base_url?>assets/plugins/iCheck/square/blue.css">

  <!-- Google Font -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body style="background-color:	#DCDCDC;">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo $base_url?>">PT. Tri Canis Aurum</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     
     
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo $base_url?>">Beranda</a></li>
        <li><a href="<?php echo $base_url?>login.php">Login</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container">
  <div class="row">
    <div class="col-md-12">
        <h2>Lowongan Kerja</h2>
        <hr>
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                         <h3 class="box-title"><?php echo $find['judul']?>
                        </div>
                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <label for="">Nama :</label>
                                <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama anda">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="">Nomor Telepon :</label>
                                <input type="text" class="form-control" name="nomor_telepon" placeholder="Masukkan Nomor Telepon anda">
                            </div>
                            <div class="form-group has-feedback">
                                <label for="">Alamat :</label>
                                <textarea  class="form-control" name="alamat"></textarea>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="">Berkas :</label>
                                <input type="file" class="form-control" name="berkas" >
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
  </div>
</div>


</body>

<script src="<?php echo $base_url?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>
