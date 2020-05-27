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

if(isset($_GET["borongan"]) && isset($_GET["tanggal"]))
{
    $borongan = $_GET["borongan"];
    $bulan = substr($_GET["tanggal"], 5, 2);
    $tahun = substr($_GET["tanggal"], 0, 4);
    $sql = "SELECT tb_tarif_borongan.id, tb_tarif_borongan.nama, SUM(tb_detail_kegiatan.jumlah) as jumlah FROM tb_detail_kegiatan
        JOIN tb_kegiatan ON tb_kegiatan.id = tb_detail_kegiatan.id_kegiatan
        JOIN tb_tarif_borongan ON tb_detail_kegiatan.id_tarif_borongan = tb_tarif_borongan.id
        WHERE tb_kegiatan.id_borongan = '$borongan' AND MONTH(tb_kegiatan.tanggal) = '$bulan' AND YEAR(tb_kegiatan.tanggal) = '$tahun'
        GROUP BY tb_detail_kegiatan.id_tarif_borongan";
    $data_kegiatan = raw($sql);

    $sql = "SELECT * FROM tb_gaji_borongan WHERE id_borongan = '$borongan' AND bulan = '$bulan' AND tahun = '$tahun'";
    $info_gaji = raw($sql)[0];
}

$list_borongan = find("tb_borongan", array("status" => '1'));
$list_tarif = all("tb_tarif_borongan");
?>
<section class="content-header">
    <h1>
        Detail Pembayaran Gaji Borongan
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
                    <div class="box-body">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Data Borongan</label>
                                        <select name="borongan" class="form-control" readonly>
                                            <?php foreach ($list_borongan as $borongan): ?>
                                                <option value="<?=$borongan["id"]?>" <?=isset($_GET['borongan']) && $_GET["borongan"] == $borongan["id"] ? "selected" : ""?>><?=$borongan["nama"]?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="alamat">Gaji Bulan</label>
                                        <input type="month" class="form-control" tabindex="2" name="tanggal" id="alamat" required value="<?=isset($_GET['tanggal']) ? $_GET['tanggal'] : date("Y-m")?>" readonly>
                                    </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
                
            <hr>

            <?php if (count($_GET) > 0): ?>
                
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Formulir Pembayaran Gaji Borongan</h3>
                    </div>
                    <form action="" method="POST">
                        <input type="hidden" value="<?=$_GET["borongan"]?>" name="borongan">
                        <input type="hidden" value="<?=$_GET["tanggal"]?>" name="tanggal">
                    <div class="box-body">
                        <div class="row">
                            <?php $total_gaji = 0 ?>
                            <?php for ($i = 0; $i < count($list_tarif); $i++): ?>
                                <?php foreach ($data_kegiatan as $kegiatan): ?>
                                    <?php if ($list_tarif[$i]['id'] == $kegiatan['id']): ?>
                                        <?php $total_gaji += $kegiatan["jumlah"] * $list_tarif[$i]["tarif"]?>

                                        <input type="hidden" value="<?=$list_tarif[$i]["nama"]?>" name="nama[]">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label"><?=$list_tarif[$i]["nama"]?></label>
                                                    <div class="col-sm-3">

                                                        <input type="text" class="form-control" name="kegiatan[]" placeholder="<?=$kegiatan["jumlah"]?>" value="<?=$kegiatan["jumlah"]?>" readonly>
                                                    </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="tarif[]" placeholder="<?=$list_tarif[$i]["tarif"]?>" value="<?=$list_tarif[$i]["tarif"]?>" readonly>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="totalharga[]" value="<?=$kegiatan["jumlah"]*$list_tarif[$i]["tarif"]?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endfor ?>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Total Gaji Diperoleh</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="gaji-diperoleh" class="form-control" name="totalgaji" placeholder="" value="<?=$info_gaji["total_gaji"]?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Potongan</label>
                                    <div class="col-sm-10">
                                        <input type="number" id="potongan" class="form-control" name="potongan" placeholder="" value="<?=$info_gaji["potongan"]?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Total Dibayar</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="total-dibayar" class="form-control" name="dibayar" placeholder="" value="<?=$info_gaji["dibayar"]?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <a href="<?= $base_url ?>direktur/penggajianborongan/index.php" tabindex="10">
                            <button type="button" class="btn btn-default"><i class="fa fa-angle-left"></i> Kembali</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <?php endif ?>

    </div>
</section>


<?php include_once('../layout/footer.php'); ?>
<script>
    $("#potongan").change(function() {
        var gaji_diperoleh = $("#gaji-diperoleh").val();
        var potongan = $("#potongan").val();
        $("#total-dibayar").val(gaji_diperoleh - potongan);
    });
</script>