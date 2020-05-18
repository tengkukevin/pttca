<?php
include_once "../../auth/autentikasi.php";
authentikasi("3");
    include_once('../../config/database.php');
    include_once('../../database/querybuilder.php');
    include_once('../../utils/url.php');

    update('tb_borongan', array('status' => '0'), array('id' => $_GET['id']));
    // delete('tb_borongan',['id'=>$_GET['id']]);
    redirect('index.php');
?>