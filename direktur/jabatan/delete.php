<?php
    include_once('../../config/database.php');
    include_once('../../database/querybuilder.php');
    include_once('../../utils/url.php');
    delete('tb_jabatan',['id'=>$_GET['id']]);
    redirect('index.php');
?>