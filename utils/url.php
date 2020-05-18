<?php
function redirect($url) 
{
	header('Location: ' . $url);
	exit();
}

function base_url()
{
	return "http://localhost/pttca/";
}