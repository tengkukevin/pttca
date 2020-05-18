<?php 
function set_flashdata($key, $value)
{
	$_SESSION[$key] = $value;
}

function get_flashdata($key)
{
	$value = "";
	if(has_flashdata($key)) {
		$value = $_SESSION[$key];
		unset($_SESSION[$key]);
	}
	return $value;
}

function has_flashdata($key)
{
	return isset($_SESSION[$key]);
}