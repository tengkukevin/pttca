<?php
include_once "../../auth/autentikasi.php";
authentikasi("1");
    include_once('../../config/database.php');
    include_once('../../database/querybuilder.php');
    include_once('../../utils/url.php');
    $data = find("tb_lamaran",array("id"=>$_GET['id']))[0];
    $nama = $data["berkas"];
    $upload_file = $_SERVER['DOCUMENT_ROOT'].'/pttca/assets/berkas/'.$nama;

    if(unlink($upload_file))
    {
        delete('tb_lamaran',['id'=>$_GET['id']]);
    }
    redirect('index.php');
?>