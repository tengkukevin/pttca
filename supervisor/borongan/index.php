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
include_once('../layout/index.php');

$borongan = all('tb_borongan');

?>

<section class="content-header">
    <h1>
        Borongan
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">Borongan</li>
    </ol>
</section>

<section class="content">
    <div class="row" style="margin-bottom:10px">
        <div class="col-md-12">
            <a class="btn btn-success" href="<?= $base_url ?>supervisor/borongan/create.php"><i class="fa fa-plus"></i> Tambah Borongan</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Data Borongan</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover dataTable" id="datatable">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Nomor Telepon</th>
                                    <th>Status</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($borongan as $k) : ?>
                                    <tr>
                                        <td><?= $k['nama'] ?></td>
                                        <td><?= $k['jenis_kelamin'] ?></td>
                                        <td><?= $k['alamat'] ?></td>
                                        <td><?= $k['nomor_telepon'] ?></td>
                                        <td><?= $k['status'] == 1 ? "<div class='label label-success'>Aktif</div>" : "<div class='label label-danger'>Tidak Aktif</div>" ?></td>
                                        <td>
                                            <a href="<?= $base_url ?>supervisor/borongan/update.php?id=<?= $k['id'] ?>">
                                                <button class="btn btn-warning btn-sm">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </a>
                                            <!-- <a onclick="return confirm('Apakah anda yakin?')" href="<?= $base_url ?>supervisor/borongan/delete.php?id=<?= $k['id'] ?>">
                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </a> -->
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