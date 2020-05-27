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
$gaji_sudah_ada = false;

if(isset($_GET["karyawan"]) && isset($_GET["tanggal"]))
{
    $karyawan = $_GET["karyawan"];
    $bulan = substr($_GET["tanggal"], 5, 2);
    $tahun = substr($_GET["tanggal"], 0, 4);

    $sql = "SELECT * FROM tb_gaji WHERE id_karyawan = '$karyawan' AND bulan = '$bulan' AND tahun = '$tahun'";
    $gaji_sudah_ada = count(raw($sql)) > 0;

    $sql = "SELECT tb_jabatan.gaji_pokok FROM tb_jabatan 
        JOIN tb_karyawan ON tb_karyawan.jabatan = tb_jabatan.id 
        WHERE tb_karyawan.nik = '$karyawan'";
    $gaji_pokok = raw($sql)[0]["gaji_pokok"];
}


if (count($_POST) > 0) 
{
    $total_gaji = $_POST["totalgaji"];
    $potongan = $_POST["potongan"];
    $total_gaji_dibayar = $_POST["dibayar"];

    // ID gaji karyawan yang belum dibayar
    $gaji_karyawan = find("tb_gaji", array("id_karyawan" => $karyawan, "bulan" => $bulan, "tahun" => $tahun));
    // Gaji pernah dibayar
    if(count($gaji_karyawan) > 0) {

    } else {
        $karyawan = $_POST["karyawan"];
        $bulan = substr($_POST["tanggal"], 5, 2);
        $tahun = substr($_POST["tanggal"], 0, 4);

        delete("tb_gaji", array("id_karyawan" => $karyawan, "bulan" => $bulan, "tahun" => $tahun));
        $id_gaji = insert_id("tb_gaji", array(
            "id_karyawan" => $karyawan, 
            "bulan" => $bulan, 
            "tahun" => $tahun,
            "tanggal" => date("Y-m-d"),
            "total_gaji" => $total_gaji,
            "dibayar" => $total_gaji_dibayar,
            "potongan" => $potongan)
        );
        if($potongan > 0)
        {
            urus_pembayaran_hutang($karyawan, $potongan);
        }
    }
}


function urus_pembayaran_hutang($id_karyawan, $dibayar)
{
    $sql = "SELECT * FROM tb_pinjaman WHERE id_karyawan = '$id_karyawan' AND status = '0' ORDER BY id ASC";
    $daftar_utang = raw($sql);
    $uang_dibayar = $dibayar;
    foreach ($daftar_utang as $utang) {
        $sisa_utang = $utang['jumlah'] - $utang['dibayar'];
        if(($uang_dibayar - $sisa_utang) > 0)
        {
            // Jika uang dibayar pas maka utang lunas
            update("tb_pinjaman", array("dibayar" => $utang["jumlah"]), array("id" => $utang["id"]));
            $sisa_utang -= $sisa_utang;
        }
        else
        {
            update("tb_pinjaman", array("dibayar" => $utang['dibayar'] + $uang_dibayar), array("id" => $utang["id"]));
            break;
        }
    }
}


$list_karyawan = find("tb_karyawan", array("status" => '1'));
?>
<section class="content-header">
    <h1>
        Form Pembayaran Gaji Karyawan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="<?= $base_url ?>direktur/cabang/index.php">Gaji Karyawan</a></li>
        <li class="active">Tambah</li>
    </ol>
</section>

<section class="content">

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Formulir Pembayaran Gaji Karyawan</h3>
                </div>
                    <div class="box-body">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="nama">Data Karyawan</label>
                                        <select name="karyawan" class="form-control">
                                            <?php foreach ($list_karyawan as $karyawan): ?>
                                                <option value="<?=$karyawan["nik"]?>" <?=isset($_GET['karyawan']) && $_GET["karyawan"] == $karyawan["nik"] ? "selected" : ""?>><?=$karyawan["nama_lengkap"]?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="alamat">Gaji Bulan</label>
                                        <input type="month" class="form-control" tabindex="2" name="tanggal" id="alamat" required value="<?=isset($_GET['tanggal']) ? $_GET['tanggal'] : date("Y-m")?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" style="margin-top: 26px">
                                        <button class="btn btn-primary"><i class="fa fa-search" style="margin-right: 10px"></i>Cari</button>
                                    </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
                
            <hr>

            <?php if (count($_GET) > 0 && !$gaji_sudah_ada): ?>
                
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Formulir Pembayaran Gaji Borongan</h3>
                    </div>
                    <form action="" method="POST">
                        <input type="hidden" value="<?=$_GET["karyawan"]?>" name="karyawan">
                        <input type="hidden" value="<?=$_GET["tanggal"]?>" name="tanggal">
                    <div class="box-body">
                        <div class="row">
                            <?php $total_gaji = $gaji_pokok ?>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Total Gaji Diperoleh</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="gaji-diperoleh" class="form-control" name="totalgaji" placeholder="" value="<?=$total_gaji?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Potongan</label>
                                    <div class="col-sm-10">
                                        <input type="number" id="potongan" class="form-control" name="potongan" placeholder="" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Total Dibayar</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="total-dibayar" class="form-control" name="dibayar" placeholder="" value="<?=$total_gaji?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="box-footer">
                        <a href="<?= $base_url ?>direktur/penggajian/index.php" tabindex="10">
                            <button type="button" class="btn btn-default"><i class="fa fa-angle-left"></i> Kembali</button>
                        </a>
                        <button type="submit" class="btn btn-success" tabindex="11"><i class="fa fa-plus"></i> Tambah</button>
                    </div>
                </form>
            </div>
        </div>
        <?php else: ?>
            <?php if ($gaji_sudah_ada): ?>
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Gaji telah dibayar</h3>
                        </div>
                        <div class="box-footer">
                            <a href="<?= $base_url ?>direktur/penggajian/index.php" tabindex="10">
                                <button type="button" class="btn btn-default"><i class="fa fa-angle-left"></i> Kembali</button>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif ?>
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