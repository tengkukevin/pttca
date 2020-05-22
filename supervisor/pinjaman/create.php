<?php
include_once "../../auth/autentikasi.php";
authentikasi("3");
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
        'id_borongan' => $_POST['id_borongan'],
        'biaya' => $_POST['biaya'],
        'tanggal' => date('Y-m-d'),
        'status' => 'Diterima Supervisor'
    ];
    $add = insert('tb_pengajuan_pinjaman_borongan', $data);
    if($add>0){
        echo "<script>alert('Berhasil menambahkan Borongan!')</script>";
    }else{
        echo "<script>alert('Gagal menambahkan Borongan!')</script>";
    }
}

// TODO : id bawahan supervisor saja
$sql = "SELECT * FROM tb_borongan WHERE status = '1'";
$daftar_borongan = raw($sql);

?>
<section class="content-header">
    <h1>
        Borongan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="<?= $base_url ?>supervisor/borongan/index.php">Borongan</a></li>
        <li class="active">Tambah</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Formulir Pengajuan Pinjaman</h3>
                </div>
                <form action="" method="POST">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama Borongan</label>
                                    <select name="id_borongan" class="form-control">
                                        <?php foreach ($daftar_borongan as $borongan): ?>
                                            <option value="<?=$borongan['id']?>"><?=$borongan['nama']?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat">Jumlah Pinjaman</label>
                                    <input type="number" class="form-control" name="biaya" id="biaya" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?= $base_url ?>supervisor/pinjaman/index.php" tabindex="10">
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