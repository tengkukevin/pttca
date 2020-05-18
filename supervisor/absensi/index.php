<?php 
include_once "../../config/database.php";
include_once "../../database/querybuilder.php";
include_once "../../utils/flashdata.php";
include_once "../../utils/formatter.php";
include_once "../../utils/input.php";
include_once "../../utils/session.php";
include_once "../../utils/url.php";
$base_url = base_url();
include_once('../layout/index.php');

$borongan = all('tb_borongan');

if(count($_POST)) 
{
    $list_borongan = $_POST["list_borongan"];
    $list_kehadiran = $_POST["list_kehadiran"];
    $tanggal_sekarang = isset($_GET["tanggal"]) ? $_GET["tanggal"] : date("Y-m-d");

    for($i = 0; $i < count($list_borongan); $i++) {
        $data_absen = [
            'id_borongan' => $list_borongan[$i],
            'tanggal' => $tanggal_sekarang,
            'status' => absen_builder($list_kehadiran[$i])
        ];
        insert('tb_absensi_borongan', $data_absen);
    }
}

function absen_builder($status) {
    switch($status) {
        case "H":
            return "Hadir";
            break;
        case "I":
            return "izin";
            break;
        case "A":
            return "Alpa";
            break;
        default:
            return "Alpa";
            break;
    }
}

?>

<section class="content-header">
    <h1>
        Absensi
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">Absensi</li>
    </ol>
</section>

<section class="content">
    <form action="">
        <div class="row" style="margin-bottom:10px">
            <div class="col-md-6">
                <input type="date" name="tanggal" class="form-control"/>
            </div>
            <div class="col-md-6">
                <a class="btn btn-success" href="<?= $base_url ?>supervisor/borongan/create.php"><i class="fa fa-search"></i> Cari</a>
            </div>
        </div>
    </form>
    <div class="row">

        <form action="" method="post">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Borongan</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Alamat</th>
                                        <th>Nomor Telepon</th>
                                        <th>Status</th>
                                        <th width="30%">Kehadiran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0 ?>
                                    <?php foreach ($borongan as $k) : ?>
                                        <tr>
                                            <td><?= $k['id'] ?></td>
                                            <td><?= $k['nama'] ?></td>
                                            <td><?= $k['jenis_kelamin'] ?></td>
                                            <td><?= $k['alamat'] ?></td>
                                            <td><?= $k['nomor_telepon'] ?></td>
                                            <td><?= $k['status'] == 1 ? "<div class='label label-success'>Aktif</div>" : "<div class='label label-danger'>Tidak Aktif</div>" ?></td>
                                            <td>
                                                <input type="hidden" class="form-check-input" name="list_borongan[]" value="<?=$k['id']?>">
                                                <label class="radio-inline"><input type="radio" name="list_kehadiran[<?=$i?>]" value="H">H</label>
                                                <label class="radio-inline"><input type="radio" name="list_kehadiran[<?=$i?>]" value="I">I</label>
                                                <label class="radio-inline"><input type="radio" name="list_kehadiran[<?=$i?>]" value="A" checked>A</label>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <p align="right">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<?php include_once('../layout/footer.php'); ?>