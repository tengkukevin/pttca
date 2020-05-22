<?php
include_once "../../auth/autentikasi.php";
authentikasi("1");
include_once "../../config/database.php";
include_once "../../database/querybuilder.php";
include_once "../../utils/flashdata.php";
include_once "../../utils/formatter.php";
include_once "../../utils/input.php";
include_once "../../utils/url.php";
$base_url = base_url();

include_once "../layout/index.php";
if (count($_POST) > 0) {
    $data = [
        'nama' => $_POST['nama'],
        'tarif' => $_POST['tarif'],
    ];
    $add = insert('tb_tarif_borongan', $data);
    if($add>0){
        echo "<script>alert('Berhasil menambahkan Tarif Borongan!')</script>";
    }else{
        echo "<script>alert('Gagal menambahkan Tarif Borongan!')</script>";
    }
}

?>
<section class="content-header">
    <h1>
        Tarif Borongan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="<?= $base_url ?>direktur/tarifborongan/index.php">Tarif Borongan</a></li>
        <li class="active">Tambah</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Formulir Tarif Borongan</h3>
                </div>
                <form action="" method="POST">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" tabindex="1" name="nama" id="nama" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tarif">Tarif</label>
                                    <input type="number" class="form-control" tabindex="5" name="tarif" id="tarif" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?= $base_url ?>direktur/tarifborongan/index.php" tabindex="10">
                            <button type="button" class="btn btn-default"><i class="fa fa-angle-left"></i> Kembali</button>
                        </a>
                        <button type="submit" class="btn btn-success" tabindex="11"><i class="fa fa-plus"></i> Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<?php include_once('../layout/footer.php'); ?>