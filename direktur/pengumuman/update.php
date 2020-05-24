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

if (count($_POST) > 0) 
{
    $data = 
    [
        'judul' => $_POST['judul'],
        'isi' => $_POST['editor1'],
        'tanggal' => $_POST['tanggal'],
      
    ];
    $edit = update('tb_pengumuman', $data,['id'=>$_GET['id']]);
    if ($edit > 0) 
    {
        echo "<script>alert('Berhasil mengupdate pengumuman!')</script>";
    } 
    else 
    {
        echo "<script>alert('Gagal mengupdate Pengumuman!')</script>";
    }
    
}
$pengumuman = find('tb_pengumuman',['id'=>$_GET['id']])[0];

?>
<section class="content-header">
    <h1>
        Pengumuman
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
        <li><a href="<?= $base_url ?>direktur/karyawan/index.php">Pengumuman</a></li>
        <li class="active">Tambah</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Formulir Pengumuman</h3>
                </div>
                <form action="" method="POST">
                    <div class="box-body">
                        <div class="form-group has-feedback">
                            <label for="">Judul Pengumuman :</label>
                            <input type="text" class="form-control" name="judul" value="<?php echo $pengumuman['judul']?>" placeholder="Masukkan Judul anda">
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                            <label for="isi">Isi Pengumuman :</label>

                                <div class="box-body pad">
                                        <textarea id="editor1" name="editor1" rows="10" cols="80">
                                            <?php echo $pengumuman['isi']?>
                                        </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="">Tanggal :</label>
                            <input type="date" class="form-control" value="<?php echo $pengumuman['tanggal']?>" name="tanggal" >
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="<?= $base_url ?>direktur/pengumuman/index.php" tabindex="11">
                            <button type="button" class="btn btn-default"><i class="fa fa-angle-left"></i> Kembali</button>
                        </a>
                        <button type="submit" class="btn btn-success" tabindex="12"><i class="fa fa-pencil"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo $base_url?>assets/bower_components/jquery/dist/jquery.min.js"></script>

<script src="<?php echo $base_url?>assets/bower_components/ckeditor/ckeditor.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
<?php
include_once "../layout/footer.php";
?>