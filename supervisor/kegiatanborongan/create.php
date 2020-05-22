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


$cabang = $_SESSION["id_cabang"];
$daftar_borongan = find("tb_borongan", array("cabang" => $cabang));
$daftar_kegiatan = all("tb_tarif_borongan");

if(isset($_POST["borongan"]))
{
    $id_borongan = $_POST["borongan"];
    $tanggal = $_POST["tanggal"];

    $cek_data_sudah_ada = find("tb_kegiatan", array(
        "id_borongan" => $id_borongan,
        "tanggal" => $tanggal
    ));

    if(count($cek_data_sudah_ada) > 0) {
        delete("tb_kegiatan", array("id" => $cek_data_sudah_ada[0]['id']));
        delete("tb_detail_kegiatan", array("id_kegiatan" => $cek_data_sudah_ada[0]['id']));
    }

    $id_kegiatan = insert_id("tb_kegiatan", array(
        "id_borongan" => $id_borongan,
        "tanggal" => $tanggal
    ));

    foreach ($daftar_kegiatan as $kegiatan) {
        $jumlah = $_POST[$kegiatan["id"]];
        insert("tb_detail_kegiatan", array(
            "id_kegiatan" => $id_kegiatan,
            "id_tarif_borongan" => $kegiatan["id"],
            "jumlah" => $jumlah
        ));
    }
    echo "<script>alert('Berhasil menyimpan kegiatan borongan!')</script>";
}

include_once "../layout/index.php";

?>
<section class="content-header">
    <h1>
        Tarif Borongan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="<?= $base_url ?>supervisor/tarif_borongan/index.php">Kegiatan Borongan</a></li>
        <li class="active">Tambah</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Input Kegiatan Borongan</h3>
                </div>
                <form action="" method="POST">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama">Pilih Borongan</label>
                                    <select name="borongan" id="borongan" class="form-control">
                                        <?php foreach ($daftar_borongan as $borongan): ?>
                                            <option value="<?=$borongan["id"]?>"><?=$borongan["nama"]?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" value="<?=date("Y-m-d")?>">
                                </div>
                            </div>
                        </div>
                        <hr>
                        
                        <h4>Daftar Kegiatan</h4>
                        <div class="row m-t-3">
                            <div class="col-md-12">
                                <?php foreach ($daftar_kegiatan as $kegiatan): ?>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label"><?=$kegiatan["nama"]?></label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control" name="<?=$kegiatan["id"]?>" placeholder="<?=$kegiatan["nama"]?>" value="0">
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?= $base_url ?>supervisor/kegiatanborongan/index.php" tabindex="10">
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

<script>
    
</script>