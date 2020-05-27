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


$sql = "SELECT a.*, b.nama_lengkap, b.jenis_kelamin FROM tb_gaji as a 
    JOIN tb_karyawan as b ON a.id_karyawan = b.nik";
$list_permohonan = raw($sql);
?>

<section class="content-header">
    <h1>
        Pembayaran gaji karyawan
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">Pembayaran Gaji</li>
    </ol>
</section>

<section class="content">
    <div class="row" style="margin-bottom:10px">
        <div class="col-md-12">
            <a class="btn btn-success" href="<?= $base_url ?>direktur/penggajian/create.php"><i class="fa fa-plus"></i> Input Gaji</a>
        </div>
    </div>

    <div class="row">

        <form action="" method="post">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Pembayaran Gaji</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Total Gaji</th>
                                        <th>Potongan</th>
                                        <th>Gaji Diterima</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0 ?>
                                    <?php foreach ($list_permohonan as $k) : ?>
                                        <tr>
                                            <td><?= $i + 1 ?></td>
                                            <td><?= $k['nama_lengkap'] ?></td>
                                            <td><?= $k['jenis_kelamin'] ?></td>
                                            <td><?= $k['total_gaji'] ?></td>
                                            <td><?= $k['potongan'] ?></td>
                                            <td><?= $k['dibayar'] ?></td>
                                            <td>
                                                <a href="<?= $base_url ?>direktur/penggajian/detail.php?karyawan=<?= $k['id_karyawan'] ?>&tanggal=<?=$k['tahun'] . "-" . str_pad($k['bulan'], 2, "0", STR_PAD_LEFT)?>" class="btn btn-success btn-sm">
                                                    <i class="fa fa-eye"></i> Lihat Detail
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<?php include_once('../layout/footer.php'); ?>