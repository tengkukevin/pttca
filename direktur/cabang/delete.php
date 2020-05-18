<?php
    include_once('../../config/database.php');
    include_once('../../database/querybuilder.php');
    include_once('../../utils/url.php');
    delete('tb_cabang',['id'=>$_GET['id']]);
    redirect('index.php');
?>