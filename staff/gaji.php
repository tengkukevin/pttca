<?php
include_once "../config/database.php";
include_once "../database/querybuilder.php";
include_once "../utils/flashdata.php";
include_once "../utils/formatter.php";
include_once "../utils/input.php";
include_once "../utils/url.php";
include_once "../auth/autentikasi.php";
authentikasi("4");

$base_url = base_url();
$id_karyawan = $_SESSION["nik"];
$sql = "SELECT * FROM tb_gaji WHERE id_karyawan = '$id_karyawan' ORDER BY id DESC";
$list_gaji = raw($sql);

include_once "layout/index.php";

?>
<section class="content-header">
    <h1>
        Data Gaji
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li class="active">Data Gaji</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Data Gaji</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover dataTable" id="datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Gaji Dibayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 0;
                                foreach ($list_gaji as $k) : ?>
                                    <tr>
                                        <td><?= ++$i ?></td>
                                        <td><?= $k['tanggal'] ?></td>
                                        <td><?= $k['gaji'] ?></td>
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
include_once "layout/footer.php";
?>