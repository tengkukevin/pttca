<?php
    $base_url = "http://localhost/pttca/";

    include_once "config/database.php";
    include_once "database/querybuilder.php";
    $pesan_gagal = "";
    function simpan_data($data)
    {
      if(session_status() == PHP_SESSION_NONE)
      {
        session_start();
      }
      $_SESSION['nik'] = $data['nik'];
      $_SESSION['nama_lengkap'] = $data['nama_lengkap'];
      $_SESSION['jabatan'] = $data['jabatan'];
      $_SESSION['jenis_kelamin'] = $data['agama'];
      $_SESSION['agama'] = $data['alamat'];
      $_SESSION['alamat'] = $data['alamat'];
      $_SESSION['nomor_telepon'] = $data['nomor_telepon'];
      $_SESSION['status_pernikahan'] = $data['status_pernikahan'];
      $_SESSION['status'] = $data['status'];
      $_SESSION['id_cabang'] = $data['id_cabang'];
    }

      // aksi login

      if(isset($_POST["nik"]) && isset($_POST["kata_sandi"]))
      {
        $nik = addslashes(htmlentities($_POST['nik']));
        $password = addslashes(htmlentities($_POST['kata_sandi']));

        //cek nik
        $sql = find('tb_karyawan',array('nik' => $nik))[0];
        if(count($sql) > 0)
        {
          if($sql['kata_sandi'] == $password)
          {
            //login berhasil
            switch($sql['jabatan'])
            {
              case '1':
                simpan_data($sql);
                header("Location:" . $base_url. "direktur");
                break;
              case '2':
                simpan_data($sql);
                header("Location:" . $base_url. "areamanager");
                break;
              case '3':
                simpan_data($sql);
                header("Location:" . $base_url. "supervisor");
                break;
              case '4':
                simpan_data($sql);
                header("Location:" . $base_url. "staff");
                break;
              default:
              //jenis akun tidak diketahui
              break;
            }
          }
          else
          {
            $pesan_gagal = "Username / password salah";
          }
        }
        else
        {
          $pesan_gagal = "Akun Tidak Ditemukan";
        }
      }
    $_POST = array();
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form  method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="nik" placeholder="Masukkan NIK anda">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="kata_sandi" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <!-- <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div> -->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    
    <!-- <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

    <!-- <a href="#">I forgot my password</a><br> -->
    <!-- <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?= $base_url?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= $base_url?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= $base_url?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
