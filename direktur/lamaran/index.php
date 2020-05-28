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

$sql = "SELECT * FROM tb_lamaran JOIN tb_lowongan ON tb_lamaran.id_lowongan = tb_lowongan.id";
$query = raw($sql);

?>

<section class="content-header">
    <h1>
        Lamaran Kerja
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">Lamaran Kerja</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Data Lamaran Kerja</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover dataTable" id="datatable">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>No. Telepon</th>
                                    <th>Alamat</th>
                                    <th>Berkas</th>
                                    <th>Tanggal</th>
                                    <th>Judul Lowongan</th>

                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($query as $k) : ?>
                                    <tr>
                                        <td><?= $k['nama'] ?></td>
                                        <td><?= $k['nomor_telepon'] ?></td>
                                        <td><?= $k['alamat'] ?></td>
                                        <td><a href="<?php echo $base_url?>direktur/lamaran/download.php?berkas=<?= $k['berkas']?>"><button class="btn btn-primary">Download Berkas</button></a></td>
                                        <td><?= $k['tanggal'] ?></td>
                                        <td><?= $k['judul'] ?></td>

                                        <td>
                                            <a onclick="return confirm('Apakah anda yakin?')" href="<?= $base_url ?>direktur/lamaran/delete.php?id=<?= $k['id'] ?>">
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