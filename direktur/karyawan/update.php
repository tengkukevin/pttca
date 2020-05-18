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
$jabatan = all("tb_jabatan");
$cabang = all("tb_cabang");
if (count($_POST) > 0) {
    $data = [
        'nama_lengkap' => $_POST['nama'],
        'kata_sandi' => $_POST['password'],
        'nomor_telepon' => $_POST['nomor_telepon'],
        'alamat' => $_POST['alamat'],
        'id_cabang' => $_POST['id_cabang'],
        'jabatan' => $_POST['jabatan'],
        'jenis_kelamin' => $_POST['jenis_kelamin'],
        'agama' => $_POST['agama'],
        'status_pernikahan' => $_POST['status_pernikahan'],
        'status' => 1
    ];
    $check = FALSE;
    if ($_GET['nik'] != $_POST['nik']) {
        $data['nik'] = $_POST['nik'];
        $check = !empty(find('tb_karyawan', ['nik' => $data['nik']]));
    }
    if ($check) {
        echo "<script>alert('NIK sudah dipakai!')</script>";
    } else {
        $edit = update('tb_karyawan', $data,['nik'=>$_GET['nik']]);
        if ($edit > 0) {
            echo "<script>alert('Berhasil mengedit karyawan!')</script>";
            $nik = !empty($_POST['nik'])?$_POST['nik']:$_GET['nik'];
            echo "<Script>window.location = '".$base_url."direktur/karyawan/update.php?nik=".$nik."'</script>";
        } else {
            echo "<script>alert('Gagal mengedit karyawan!')</script>";
        }
    }
}
$karyawan = find('tb_karyawan', ['nik' => $_GET['nik']])[0];
?>
<section class="content-header">
    <h1>
        Karyawan
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="<?= $base_url ?>views/karyawan/index.php">Karyawan</a></li>
        <li class="active">Edit</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Formulir Karyawan</h3>
                </div>
                <form action="" method="POST">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" tabindex="1" name="nama" id="nama" value="<?= $karyawan['nama_lengkap'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="nik">NIK</label>
                                    <input type="number" class="form-control" tabindex="2" name="nik" id="nik" value="<?= $karyawan['nik'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" tabindex="3" name="password" id="password" value="<?= $karyawan['kata_sandi'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="nomor_telepon">Nomor Telepon</label>
                                    <input type="text" class="form-control" tabindex="4" name="nomor_telepon" id="nomor_telepon" value="<?= $karyawan['nomor_telepon'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" tabindex="5" name="alamat" id="alamat" value="<?= $karyawan['alamat'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_cabang">Cabang</label>
                                    <select class="form-control" tabindex="6" name="id_cabang" id="id_cabang" required>
                                        <?php foreach ($cabang as $j) : ?>
                                            <option <?= $j['id'] == $karyawan['id_cabang'] ? "selected" : "" ?> value="<?= $j['id'] ?>"><?= $j['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jabatan">Jabatan</label>
                                    <select class="form-control" tabindex="7" name="jabatan" id="jabatan" required>
                                        <?php foreach ($jabatan as $j) : ?>
                                            <option <?= $j['id'] == $karyawan['jabatan'] ? "selected" : "" ?> value="<?= $j['id'] ?>"><?= $j['nama'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" tabindex="8" name="jenis_kelamin" id="jenis_kelamin" required>
                                        <option value="Pria" <?= $karyawan['jenis_kelamin'] == "Pria" ? "selected" : "" ?>>Pria</option>
                                        <option value="Wanita" <?= $karyawan['jenis_kelamin'] == "Wanita" ? "selected" : "" ?>>Wanita</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <select class="form-control" tabindex="9" name="agama" id="agama" required>
                                        <option value="Buddha" <?= $karyawan['agama'] == "Buddha" ? "selected" : "" ?>>Buddha</option>
                                        <option value="Hindu" <?= $karyawan['agama'] == "Hindu" ? "selected" : "" ?>>Hindu</option>
                                        <option value="Islam" <?= $karyawan['agama'] == "Islam" ? "selected" : "" ?>>Islam</option>
                                        <option value="Katolik" <?= $karyawan['agama'] == "Katolik" ? "selected" : "" ?>>Katolik</option>
                                        <option value="Kristen" <?= $karyawan['agama'] == "Kristen" ? "selected" : "" ?>>Kristen</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status_pernikahan">Status Pernikahan</label>
                                    <select name="status_pernikahan" id="status_pernikahan" tabindex="10" class="form-control" required>
                                        <option value="0" <?= $karyawan['status_pernikahan'] == "0" ? "selected" : "" ?>>Belum Menikah</option>
                                        <option value="1" <?= $karyawan['status_pernikahan'] == "1" ? "selected" : "" ?>>Sudah Menikah</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?= $base_url ?>direktur/karyawan/index.php" tabindex="11">
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