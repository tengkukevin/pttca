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


$sql = 'SELECT a.*, b.nama, b.jenis_kelamin FROM tb_pengajuan_pinjaman_borongan as a 
    JOIN tb_borongan as b ON a.id_borongan = b.id';
$list_permohonan = raw($sql);
?>

<section class="content-header">
    <h1>
        Permohonan Pinjaman
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">Permohonan Pinjaman</li>
    </ol>
</section>

<section class="content">
    <div class="row" style="margin-bottom:10px">
        <div class="col-md-12">
            <a class="btn btn-success" href="<?= $base_url ?>supervisor/pinjaman/create.php"><i class="fa fa-plus"></i> Buat Pengajuan Pinjaman</a>
        </div>
    </div>

    <div class="row">

        <form action="" method="post">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Permohonan Pinjaman Borongan</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Jumlah Pinjaman</th>
                                        <th>Tanggal Pengajuan</th>
                                        <th>Status</th>
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