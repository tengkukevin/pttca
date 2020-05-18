<?php
include_once "../utils/url.php";
session_start();
session_unset("user");
// hapus semua session
session_destroy();
header("Location: " . base_url() . "login.php");
?>