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
include_once('../layout/index.php');

$sql = "SELECT b.nik, b.nama_lengkap, a.id, a.tingkat, a.tanggal FROM tb_pelanggaran as a
    JOIN tb_karyawan as b ON b.nik = a.id_karyawan";
$list_pelanggaran = raw($sql);

?>

<section class="content-header">
    <h1>
        Pelanggaran
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">Pelanggaran</li>
    </ol>
</section>

<section class="content">
    <div class="row" style="margin-bottom:10px">
        <div class="col-md-12">
            <a class="btn btn-success" href="<?= $base_url ?>direktur/pelanggaran/create.php"><i class="fa fa-plus"></i> Input Pelanggaran</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Data Pelanggaran</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover dataTable" id="datatable">
                            <thead>
                                <tr>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Tingkat</th>
                                    <th>Tanggal</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list_pelanggaran as $k) : ?>
                                    <tr>
                                        <td><?= $k['nik'] ?></td>
                                        <td><?= $k['nama_lengkap'] ?></td>
                                        <td><?= $k['tingkat'] ?></td>
                                        <td><?= $k['tanggal'] ?></td>
                                        <td>
                                            <a href="<?= $base_url ?>direktur/pelanggaran/update.php?id=<?= $k['id'] ?>">
                                                <button class="btn btn-warning btn-sm">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </a>
                                            <a onclick="return confirm('Apakah anda yakin?')" href="<?= $base_url ?>direktur/pelanggaran/delete.php?id=<?= $k['id'] ?>">
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once('../layout/footer.php'); ?>