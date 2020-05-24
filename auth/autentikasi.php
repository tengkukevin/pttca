<?php 

// Butuh inisialisasi base_url()
function authentikasi($posisi_akun = "") 
{
    if (session_status() == PHP_SESSION_NONE) 
    {
		session_start();
	}

  // Jika tidak ada session
    if(!isset($_SESSION["jabatan"])) 
    {
        $base_url = "http://localhost/pttca/";
		$_SESSION = array();
		session_destroy();
		header("Location:" . $base_url);
		exit();
	}

	// Jika session ada tapi membuka halaman diluar akses
    if($_SESSION["jabatan"] != $posisi_akun) 
    {
		$halaman = "";
        switch ($_SESSION["jabatan"]) 
        {
			case '1':
				$halaman = "direktur";
				break;
			case '2':
				$halaman = "areamanager";
				break;
			case '3':
				$halaman = "supervisor";
				break;
			case '4':
				$halaman = "staff";
				break;
			default:
				// Jika isi session bukan salah satu dari keempat diatas maka pengguna langsung logout
				$_SESSION = array();
				session_destroy();
				header("Location:" . base_url());
				break;
		}
		header("Location:" . base_url(). $halaman);
		exit();
	}
}
