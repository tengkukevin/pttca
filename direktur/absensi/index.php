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

if(count($_POST)) 
{
    $list_borongan = $_POST["list_borongan"];
    $list_kehadiran = $_POST["list_kehadiran"];
    $tanggal_sekarang = isset($_GET["tanggal"]) ? $_GET["tanggal"] : date("Y-m-d");

    delete("tb_absensi", ["tanggal" => $tanggal_sekarang]);

    for($i = 0; $i < count($list_borongan); $i++) {
        $data_absen = [
            'id_karyawan' => $list_borongan[$i],
            'tanggal' => $tanggal_sekarang,
            'status' => absen_builder($list_kehadiran[$i])
        ];
        insert('tb_absensi', $data_absen);
    }
}

// Load absen berdasarkan tanggal
if(isset($_GET['tanggal'])) {
    $tanggal = $_GET['tanggal'];
    $sql = "SELECT tb_absensi.status, tb_karyawan.nik, tb_karyawan.nama_lengkap, tb_karyawan.jenis_kelamin FROM tb_absensi 
        JOIN tb_karyawan ON tb_absensi.id_karyawan = tb_karyawan.nik
        WHERE tb_absensi.tanggal = '$tanggal'";
    $list_absen = raw($sql);
} else {
    $tanggal = date('Y-m-d');
    $sql = "SELECT tb_absensi.status, tb_karyawan.nik, tb_karyawan.nama_lengkap, tb_karyawan.jenis_kelamin FROM tb_absensi 
        JOIN tb_karyawan ON tb_absensi.id_karyawan = tb_karyawan.nik
        WHERE tb_absensi.tanggal = '$tanggal'";
    $list_absen = raw($sql);
}

// Jika tidak ada data maka tampilkan daftar karyawan yang ingin di absen
if(count($list_absen) == 0) {
    $sql = "SELECT nik, nama_lengkap, jenis_kelamin FROM tb_karyawan WHERE status = '1'";
    $list_absen = raw($sql);
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
                <input type="date" name="tanggal" value="<?=$tanggal?>" class="form-control"/>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> Cari</button>
            </div>
        </div>
    </form>
    <div class="row">

        <form action="" method="post">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Karyawan</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th width="30%">Kehadiran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0 ?>
                                    <?php foreach ($list_absen as $k) : ?>
                                        <tr>
                                            <td><?= $i + 1 ?></td>
                                            <td><?= $k['nama_lengkap'] ?></td>
                                            <td><?= $k['jenis_kelamin'] ?></td>
                                            <td>
                                                <input type="hidden" class="form-check-input" name="list_borongan[]" value="<?=$k['nik']?>">

                                                <label class="radio-inline"><input type="radio" name="list_kehadiran[<?=$i?>]" value="H" <?= isset($k['status']) && $k['status'] == 'Hadir' ? 'checked' : ''?> required>H</label>
                                                <label class="radio-inline"><input type="radio" name="list_kehadiran[<?=$i?>]" value="I" <?= isset($k['status']) && $k['status'] == 'Izin' ? 'checked' : ''?> required>I</label>
                                                <?php if (count($list_absen) != 0): ?>
                                                    <label class="radio-inline"><input type="radio" name="list_kehadiran[<?=$i?>]" value="A" <?= isset($k['status']) && $k['status'] == 'Alpa' ? 'checked' : ''?> required>A</label>
                                                <?php else: ?>
                                                    <label class="radio-inline"><input type="radio" name="list_kehadiran[<?=$i?>]" value="A" checked required>A</label>
                                                <?php endif ?>
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