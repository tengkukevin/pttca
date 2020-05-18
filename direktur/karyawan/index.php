<?php
include_once "../../config/database.php";
include_once "../../database/querybuilder.php";
include_once "../../utils/flashdata.php";
include_once "../../utils/formatter.php";
include_once "../../utils/input.php";
include_once "../../utils/session.php";
include_once "../../utils/url.php";
$base_url = base_url();
include_once "../layout/index.php";

$karyawan = raw('SELECT k.*,j.nama as nama_jabatan,c.nama as nama_cabang FROM tb_karyawan as k JOIN tb_jabatan as j ON k.jabatan = j.id JOIN tb_cabang as c ON k.id_cabang = c.id');
?>
<section class="content-header">
    <h1>
        Karyawan
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">Karyawan</li>
    </ol>
</section>

<section class="content">
    <div class="row" style="margin-bottom:10px">
        <div class="col-md-12">
            <a class="btn btn-success" href="<?= $base_url ?>direktur/karyawan/create.php"><i class="fa fa-plus"></i> Tambah Karyawan</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Data Karyawan</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover dataTable" id="datatable">
                            <thead>
                                <tr>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Cabang</th>
                                    <th>Jabatan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Agama</th>
                                    <th>Nomor Telepon</th>
                                    <th>Status Pernikahan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($karyawan as $k) : ?>
                                    <tr>
                                        <td><?= $k['nik'] ?></td>
                                        <td><?= $k['nama_lengkap'] ?></td>
                                        <td><?= $k['nama_cabang'] ?></td>
                                        <td><?= $k['nama_jabatan'] ?></td>
                                        <td><?= $k['jenis_kelamin'] ?></td>
                                        <td><?= $k['agama'] ?></td>
                                        <td><?= $k['nomor_telepon'] ?></td>
                                        <td><?= $k['status_pernikahan'] == 1 ? "Menikah" : "Belum Menikah" ?></td>
                                        <td><?= $k['status'] == 1 ? "<div class='label label-success'>Aktif</div>" : "<div class='label label-danger'>Tidak Aktif</div>" ?></td>
                                        <td>
                                            <a href="<?= $base_url ?>direktur/karyawan/update.php?nik=<?= $k['nik'] ?>">
                                                <button class="btn btn-warning btn-sm">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </a>
                                            <a onclick="return confirm('Apakah anda yakin?')" href="<?= $base_url ?>direktur/karyawan/delete.php?nik=<?= $k['nik'] ?>">
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

<?php
include_once "../layout/footer.php";
?>