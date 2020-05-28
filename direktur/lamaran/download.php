<?php
    $nama = $_GET['berkas'];
    $ekstensi = substr($nama,-3);
    $upload_file = $_SERVER['DOCUMENT_ROOT'].'/pttca/assets/berkas/'.$nama;
    if (!file_exists($upload_file)) 
    {
        echo "<script>alert(Access forbidden!)</script><h1></h1>";
        exit;
    }
    else
    {
        header("Content-Type: ".$ekstensi);
        header("Content-Disposition: attachment"); 
        $fp = fopen($upload_file,"r");
        $data = fread($fp,filesize($upload_file));
        fclose($fp);
        print $data;
    }
  
?>