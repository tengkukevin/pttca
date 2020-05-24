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

$list_karyawan = all("tb_karyawan");

include_once "../layout/index.php";
if (count($_POST) > 0) {
    $data = [
        'id_karyawan' => $_POST['nama'],
        'tingkat' => $_POST['tingkat'],
        'tanggal' => $_POST['tanggal']
    ];
    $add = insert('tb_pelanggaran', $data);
    if($add>0){
        echo "<script>alert('Pelanggaran berhasil diinput!')</script>";
    }else{
        echo "<script>alert('Gagal menyimpan pelanggaran!')</script>";
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
                <form action="" method="post">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Karyawan</label>
                                    <select name="nama" class="form-control">
                                        <?php foreach ($list_karyawan as $karyawan): ?>
                                            <option value="<?=$karyawan["nik"]?>"><?=$karyawan["nama_lengkap"]?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tarif">Tingkat Pelanggaran</label>
                                    <select name="tingkat" class="form-control">
                                        <option value="SP1">SP1</option>
                                        <option value="SP2">SP2</option>
                                        <option value="SP3">SP3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tarif">Tingkat Pelanggaran</label>
                                    <input type="date" name="tanggal" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?= $base_url ?>direktur/pelanggaran/index.php" tabindex="10">
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