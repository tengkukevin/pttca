<?php
if(!session_has_data("id")) {
	redirect($base_url);
} else {
	coba_login();
}

function coba_login() {
	$id_konsumen = session_get("id");

	$akun = find("tb_konsumen", array("id" => $id_konsumen));
	if(count($akun) > 0) {
		session_set($akun[0]);
	} else {
		redirect($base_url);
	}
}