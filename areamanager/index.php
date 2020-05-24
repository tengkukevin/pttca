<?php
include_once "../config/database.php";
include_once "../database/querybuilder.php";
include_once "../utils/flashdata.php";
include_once "../utils/formatter.php";
include_once "../utils/input.php";
include_once "../utils/url.php";
include_once "../auth/autentikasi.php";
authentikasi("2");
$base_url = base_url();
include_once "layout/index.php";

?>
<section class="content-header">
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Selamat Datang Area Manager</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include_once "layout/footer.php";
?>