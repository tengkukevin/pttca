<?php
include_once "../../auth/autentikasi.php";
authentikasi("1");
include_once "../../config/database.php";
include_once "../../database/querybuilder.php";
include_once "../../utils/flashdata.php";
include_once "../../utils/formatter.php";
include_once "../../utils/input.php";
include_once "../../utils/session.php";
include_once "../../utils/url.php";
$base_url = base_url();
include_once "../layout/index.php";
if (count($_POST) > 0) {
    $data = [
        'nama' => $_POST['nama'],
        'alamat' => $_POST['alamat'],
    ];
    $edit = update('tb_cabang', $data,['id'=>$_GET['id']]);
    if($edit>0){
        echo "<script>alert('Berhasil mengedit cabang!')</script>";
    }else{
        echo "<script>alert('Gagal mengedit cabang!')</script>";
    }
}
$cabang = find('tb_cabang',['id'=>$_GET['id']])[0];
?>
<section class="content-header">
    <h1>
        Cabang
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="<?= $base_url ?>direktur/cabang/index.php">Cabang</a></li>
        <li class="active">Edit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Formulir Cabang</h3>
                </div>
                <form action="" method="POST" onsubmit="return confirm('Apakah anda yakin?')">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" tabindex="1" name="nama" id="nama" value="<?= $cabang['nama'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" tabindex="2" name="alamat" id="alamat" value="<?= $cabang['alamat'] ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?= $base_url ?>direktur/cabang/index.php" tabindex="3">
                            <button type="button" class="btn btn-default"><i class="fa fa-angle-left"></i> Kembali</button>
                        </a>
                        <button type="submit" class="btn btn-warning" tabindex="4"><i class="fa fa-pencil"></i> Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include_once "../layout/footer.php";
?>