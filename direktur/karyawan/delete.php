<?php
include_once "../../auth/autentikasi.php";
authentikasi("1");
    include_once('../../config/database.php');
    include_once('../../database/querybuilder.php');
    include_once('../../utils/url.php');
    delete('tb_karyawan',['nik'=>$_GET['nik']]);
    redirect('index.php');
?>