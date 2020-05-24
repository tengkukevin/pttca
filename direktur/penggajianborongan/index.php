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


$sql = "SELECT a.*, b.nama_lengkap, b.jenis_kelamin FROM tb_pengajuan_pinjaman as a 
    JOIN tb_karyawan as b ON a.id_karyawan = b.nik WHERE a.status = 'Diterima Area Manager'";
$list_permohonan = raw($sql);
?>

<section class="content-header">
    <h1>
        Pembayaran gaji Borongan
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
            <a class="btn btn-success" href="<?= $base_url ?>direktur/penggajianborongan/create.php"><i class="fa fa-plus"></i> Input Gaji</a>
        </div>
    </div>

    <div class="row">

        <form action="" method="post">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Pembayaran</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Gaji</th>
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
                                            <td><?= $k['nama'] ?></td>
                                            <td><?= $k['jenis_kelamin'] ?></td>
                                            <td><?= $k['biaya'] ?></td>
                                            <td><?= $k['tanggal'] ?></td>
                                            <td><?= $k['status'] ?></td>
                                            <td>
                                                <a href="<?= $base_url ?>areamanager/permohonanpinjaman/terima.php?id=<?= $k['id'] ?>" class="btn btn-success btn-sm">
                                                    <i class="fa fa-check"></i> Terima
                                                </a>
                                                <a onclick="return confirm('Apakah anda yakin?')" href="<?= $base_url ?>areamanager/permohonanpinjaman/tolak.php?id=<?= $k['id'] ?>" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-close"></i> Tolak
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