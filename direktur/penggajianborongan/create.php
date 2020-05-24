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

// $tanggal_dipilih = isset()

include_once "../layout/index.php";
if (count($_POST) > 0) {
    $data = [
        'nama' => $_POST['nama'],
        'alamat' => $_POST['alamat'],
    ];
    $add = insert('tb_cabang', $data);
    if($add>0){
        echo "<script>alert('Berhasil menambahkan cabang!')</script>";
    }else{
        echo "<script>alert('Gagal menambahkan cabang!')</script>";
    }
}


$list_borongan = find("tb_borongan", array("status" => '1'));
$list_tarif = all("tb_tarif_borongan");
?>
<section class="content-header">
    <h1>
        Form Pembayaran Gaji Borongan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="<?= $base_url ?>direktur/cabang/index.php">Gaji Borongan</a></li>
        <li class="active">Tambah</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Formulir Pembayaran Gaji Borongan</h3>
                </div>
                <form action="" method="POST">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Data Borongan</label>
                                    <select name="borongan" class="form-control">
                                        <?php foreach ($list_borongan as $borongan): ?>
                                            <option value="<?=$borongan["id"]?>"><?=$borongan["nama"]?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat">Gaji Bulan</label>
                                    <input type="month" class="form-control" tabindex="2" name="tanggal" id="alamat" required>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <?php foreach ($list_tarif as $tarif): ?>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><?=$tarif["nama"]?></label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" name="<?=$tarif["id"]?>" placeholder="<?=$tarif["nama"]?>" value="0">
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Potongan</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" name="potongan" placeholder="" value="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <a href="<?= $base_url ?>direktur/cabang/index.php" tabindex="10">
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