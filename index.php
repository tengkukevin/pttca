<?php
    $base_url = "http://localhost/pttca/";

    include_once "config/database.php";
    include_once "database/querybuilder.php";
    //cari lowongan
    $lowongan = all('tb_lowongan');
    $pengumuman = all('tb_pengumuman');
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
      <a class="navbar-brand" href="#">PT. Tri Canis Aurum</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
     
     
      <ul class="nav navbar-nav navbar-right">
        <li <?php $base_url?>><a href="<?php $base_url?>">Beranda</a></li>
        <li><a href="<?php $base_url?>login.php">Login</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>Lowongan Kerja</h2>
      <hr>
        <?php foreach($lowongan as $l):?>
            <form method="POST">
              <div class="row">
                <div class="col-md-3">
                  <div class="box box-success">
                    <div class="box-header with-border">
                      <h3 class="box-title"><a href=""><?php echo $l['judul']?></a></h3>
                      
                    </div>
                    <div class="box-body">
                      <?php echo $l['deskripsi']?>
                    </div>
                    <div class="box-footer">
                    Mulai dari <?php echo $l['berlaku_dari']?> - <?php echo $l['berlaku_sampai']?>
                    </div>
                  </div>
              </div>
            </form>
        <?php endforeach;?>
    </div>
    <div class="col-md-12">
      <h2>Pengumuman</h2>
        <hr>
        <?php foreach($pengumuman as $p):?>
          <form method="POST">
            <div class="row">
              <div class="col-md-3">
                <div class="box box-warning">
                  <div class="box-header with-border">
                    <h3 class="box-title"><a href=""><?php echo $p['judul']?></a></h3>
                  </div>
                  <div class="box-body">
                    <?php echo $p['isi']?>
                  </div>
                  <div class="box-footer">
                  <?php echo $p['tanggal']?>
                  </div>
                </div>
            </div>
          </form>
        <?php endforeach;?>
    </div>    
  </div>
</div>


</body>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>
