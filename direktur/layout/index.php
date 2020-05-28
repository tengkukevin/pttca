<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PTTCA | PT Tri Canis Aurum</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= $base_url ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= $base_url ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= $base_url ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= $base_url ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= $base_url ?>assets/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?= $base_url ?>assets/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?= $base_url ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?= $base_url ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= $base_url ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?= $base_url ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= $base_url ?>assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini" style="font-size: 12px">PTTCA</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>PT</b> Tri Canis Aurum</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= $base_url ?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= $base_url ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=$base_url?>direktur/profile.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?=$base_url?>direktur/logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-building-o"></i> <span>Cabang</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= $base_url ?>direktur/cabang/index.php"><i class="fa fa-circle-o"></i> Lihat Cabang</a></li>
            <li><a href="<?= $base_url ?>direktur/cabang/create.php"><i class="fa fa-circle-o"></i> Tambah Cabang</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-tasks"></i> <span>Jabatan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= $base_url ?>direktur/jabatan/index.php"><i class="fa fa-circle-o"></i> Lihat Jabatan</a></li>
            <li><a href="<?= $base_url ?>direktur/jabatan/create.php"><i class="fa fa-circle-o"></i> Tambah Jabatan</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Karyawan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="<?= $base_url ?>direktur/karyawan/index.php"><i class="fa fa-circle-o"></i> Kelola Karyawan</a></li>
            <li class=""><a href="<?= $base_url ?>direktur/absensi/index.php"><i class="fa fa-circle-o"></i> Absensi</a></li>
            <li class=""><a href="<?= $base_url ?>direktur/penggajian"><i class="fa fa-circle-o"></i> Penggajian Karyawan</a></li>
            <li><a href="<?php echo $base_url?>direktur/pinjaman/index.php"><i class="fa fa-circle-o text-aqua"></i> <span> Perm. Pinjaman Karyawan</span></a></li>
            <li><a href="<?php echo $base_url?>direktur/pelanggaran/index.php"><i class="fa fa-circle-o text-aqua"></i> <span>Pelanggaran</span></a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Borongan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a href="<?= $base_url ?>direktur/borongan/index.php"><i class="fa fa-circle-o"></i> Kelola Borongan</a></li>
            <li class=""><a href="<?= $base_url ?>direktur/tarifborongan/index.php"><i class="fa fa-circle-o"></i> Kelola Tarif Borongan</a></li>
            <li><a href="<?= $base_url ?>direktur/penggajianborongan"><i class="fa fa-circle-o"></i> Penggajian Borongan</a></li>
            <li><a href="<?php echo $base_url?>direktur/pinjamanborongan/index.php"><i class="fa fa-circle-o text-aqua"></i> <span>Perm. Pinjaman Borongan</span></a></li>
          </ul>
        </li>
        <li><a href="<?php echo $base_url?>direktur/lowongan/index.php"><i class="fa fa-circle-o text-aqua"></i> <span>Lowongan Kerja</span></a></li>
        <li><a href="<?php echo $base_url?>direktur/lamaran/index.php"><i class="fa fa-circle-o text-aqua"></i> <span>Lamaran Kerja</span></a></li>
        <li><a href="<?php echo $base_url?>direktur/pengumuman/index.php"><i class="fa fa-circle-o text-aqua"></i> <span>Pengumuman</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      
