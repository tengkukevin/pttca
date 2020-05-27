<?php
include_once "../../auth/autentikasi.php";
authentikasi("2");
include_once "../../config/database.php";
include_once "../../database/querybuilder.php";
include_once "../../utils/flashdata.php";
include_once "../../utils/formatter.php";
include_once "../../utils/input.php";
include_once "../../utils/url.php";
$base_url = base_url();
if (isset($_GET['id'])) {
    $data = [
        'status' => 'Ditolak Area Manager'
    ];
    $add = update('tb_pengajuan_pinjaman_borongan', $data, array("id" => $_GET['id']));
    echo "<script>alert('Pinjaman ditolak!')</script>";
}
redirect('index.php');