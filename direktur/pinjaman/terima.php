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

if (isset($_GET['id'])) {
    $data = [
        'status' => 'Diterima Direktur'
    ];
    $add = update('tb_pengajuan_pinjaman', $data, array("id" => $_GET['id']));

    $karyawan = find("tb_pengajuan_pinjaman", array("id" => $_GET['id']))[0];

    insert("tb_pinjaman", array("id_karyawan" => $karyawan["id_karyawan"],
		"jumlah" => $karyawan["biaya"],
		"tanggal" => $karyawan["tanggal"],
		"dibayar" => "0",
		"status" => "0"
	));

    echo "<script>alert('Pinjaman disetujui!')</script>";
}
redirect('index.php');