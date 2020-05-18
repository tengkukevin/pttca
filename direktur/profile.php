<?php
    include_once "../config/database.php";
    include_once "../database/querybuilder.php";
    include_once "../utils/flashdata.php";
    include_once "../utils/formatter.php";
    include_once "../utils/input.php";
    include_once "../utils/session.php";
    include_once "../utils/url.php";
    $base_url = base_url();
    include_once('layout/index.php');
    if(!isset($_SESSION['karyawan']))
    {
        header("Location: login.php");
    }
    else
    {
        $data = find("tb_karyawan",array("nik" => $_SESSION['karyawan'][0]['nik']));
    }
?>
<style>
    .example-modal .modal {
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        display: block;
        z-index: 1;
    }

    .example-modal .modal {
        background: transparent !important;
    }
</style>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">About Me</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

          <div class="col-xs-2">
            <strong>NIK <strong>
          </div>
          <div class="col-xs-1">
            <h4>:</h4>
          </div>
          <h4 class="text-muted">
            <?=$data[0]['nik'];?>
          </h4>
          <hr>
          <div class="col-xs-2">
            <strong>Nama Lengkap </strong>
          </div>
          <div class="col-xs-1">
            <h4>:</h4>
          </div>
          <h4 class="text-muted">
            <?=$data[0]['nama_lengkap'];?>
          </h4>
          <hr>
          
          <div class="col-xs-2">
            <strong> Password</strong>
          </div>
          <div class="col-xs-1">
            <h4>:</h4>
          </div>
         <h4 class="text-muted"><?=$data[0]['kata_sandi'];?></h4> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                Ubah Kata Sandi
              </button>
          <hr>
          <div class="col-xs-2">
            <strong> Jabatan</strong>
          </div>
          <div class="col-xs-1">
            <h4>:</h4>
          </div>
          <h4 class="text-muted"><?=$data[0]['jabatan'];?></h4>
          <hr>
          <div class="col-xs-2">
            <strong>Jenis Kelamin</strong>
          </div>
          <div class="col-xs-1">
            <h4>:</h4>
          </div>
          <h4 class="text-muted"><?=$data[0]['jenis_kelamin'];?></h4>

          <hr>
          <div class="col-xs-2">
            <strong>Agama</strong>
          </div>
          <div class="col-xs-1">
            <h4>:</h4>
          </div>
          <h4 class="text-muted"><?=$data[0]['agama'];?></h4>
          <hr>
          <div class="col-xs-2">
            <strong></i>Alamat</strong>
          </div>
          <div class="col-xs-1">
            <h4>:</h4>
          </div>
          <h4 class="text-muted"><?=$data[0]['alamat'];?></h4>
          <hr>
          <div class="col-xs-2">
            <strong></i>Nomor Telepon</strong>
          </div>
          <div class="col-xs-1">
            <h4>:</h4>
          </div>
          <h4 class="text-muted"><?=$data[0]['nomor_telepon'];?></h4>
        </div>
        </div>

        <!-- /.box-body -->
    
      </div>

    </section>


    <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Kata Sandi Anda</h4>
              </div>
              <div class="modal-body">
              <form method="POST" onsubmit="return validasiUbahPassword()">
                <div class="form-group">
                        <label for="password_lama">Kata Sandi Lama :</label>
                        <input type="password" name="oldPassword" id="password_lama" placeholder="kata sandi Lama anda" class="form-control">
                </div>
                <div class="form-group">
                        <label for="password_baru">Kata Sandi Baru :</label>
                        <input type="password" name="newPassword" id="password_baru" placeholder="kata sandi baru anda" class="form-control">
                </div>
                <div class="form-group">
                        <label for="password_konfirmasi">Konfirmasi Kata Sandi Baru :</label>
                        <input type="password" name="confirmPassword" id="password_konfirmasi" placeholder="Konfirmasi kata sandi baru anda" class="form-control">
                </div>

              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

<script>
    function validasiUbahPassword()
    {
        let passwordLama = document.getElementById("password_lama");
        let passwordBaru = document.getElementById("password_baru");
        let passwordKonfirm = document.getElementById("password_konfirmasi");
        if(passwordLama.value == "")
        {
            window.alert("Kata sandi Lama harus diisi !");
            passwordLama.focus();
            return false;
        }
        if(passwordBaru.value == "")
        {
            window.alert("Kata sandi Baru harus diisi !");
            passwordBaru.focus();
            return false;
        }
        if(passwordKonfirm.value == "")
        {
            window.alert("Konfirmasi Kata sandi harus diisi !");
            passwordKonfirm.focus();
            return false;
        }
        if(passwordBaru.value != passwordKonfirm.value)
        {
            window.alert("Kata sandi tidak sama ! ");
            passwordBaru.focus();
            return false;
        }
        return true
    }
</script>
<?php
if(isset($_POST['oldPassword'])){
    $passwordLama = $_POST['oldPassword'];
    // if($passwordLama != $data[0]['kata_sandi'])
    // {
    //     echo("Kata Sandi Salah !");
    //     exit;
    // }
    // else
    // {
        $params = array('kata_sandi' => $_POST['newPassword']);
        update("tb_karyawan",$params, array('nik' => $data[0]['nik']));
    // }
    }
?>

    <?php include_once('layout/footer.php'); ?>