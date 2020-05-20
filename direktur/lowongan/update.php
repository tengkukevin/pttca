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
include_once "../layout/index.php";
$jabatan = all("tb_jabatan");
$cabang = all("tb_cabang");
if (count($_POST) > 0) {
    $data = [
        'judul' => $_POST['judul'],
        'deskripsi' => $_POST['deskripsi'],
        'tanggal' => date('Y-m-d'),
        'berlaku_dari' => $_POST['berlaku_dari'],
        'berlaku_sampai' => $_POST['berlaku_sampai'],
    ];
    $update = update('tb_lowongan',$data,array('id' => $_GET['id']));
    if ($update > 0) {
        echo "<script>alert('Berhasil Mengedit Lowongan!')</script>";
        $id = !empty($_POST['id']) ? $_POST['id'] : $_GET['id'];

        echo "<Script>window.location = '".$base_url."direktur/lowongan/update.php?id=".$id."'</script>";

    } else {
        echo "<script>alert('Gagal Mengedit Lowongan!')</script>";
    }

}
$find = find('tb_lowongan',array('id'=>$_GET['id']))[0];

?>
<section class="content-header">
    <h1>
        Lowongan Kerja
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="<?= $base_url ?>direktur/karyawan/index.php">Lowongan</a></li>
        <li class="active">Edit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Formulir Lowongan Kerja</h3>
                </div>
                <form action="" method="POST">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="judul">Judul</label>
                                    <input type="text" class="form-control" value="<?php echo $find['judul']?>" name="judul" id="judul" required>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control"  name="deskripsi"  id="deskripsi" width="300px"required><?php echo $find['deskripsi']?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="berlaku_dari">Tangal Mulai Berlaku</label>
                                    <input type="date" class="form-control" value="<?php echo $find['berlaku_dari']?>" name="berlaku_dari" id="berlaku_dari" required>
                                </div>
                                <div class="form-group">
                                    <label for="berlaku_sampai">Tangal Akhir Berlaku</label>
                                    <input type="date" class="form-control" value="<?php echo $find['berlaku_sampai']?>" name="berlaku_sampai" id="berlaku_sampai" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?= $base_url ?>direktur/lowongan/index.php" tabindex="11">
                            <button type="button" class="btn btn-default"><i class="fa fa-angle-left"></i> Kembali</button>
                        </a>
                        <button type="submit" class="btn btn-warning" tabindex="12"><i class="fa fa-pencil"></i> Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include_once "../layout/footer.php";
?>