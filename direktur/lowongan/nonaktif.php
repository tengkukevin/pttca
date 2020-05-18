<?php
include_once "../../auth/autentikasi.php";
authentikasi("1");
    include_once('../../config/database.php');
    include_once('../../database/querybuilder.php');
    include_once('../../utils/url.php');
$data = array(
    'status' => 0
);
$update = update('tb_lowongan',$data,array('id'=>$_GET['id']));
redirect('index.php');

?>