<?php
function session_set($keyorarray, $val = "")
{
	if(is_array($keyorarray)) {
		foreach ($keyorarray as $key => $value) {
			$_SESSION[$key] = $value;
		}
	} else {
		$_SESSION[$keyorarray] = $val;
	}
}

function session_has_data($key)
{
	return (isset($_SESSION[$key]));
}

function session_get($key, $default = "")
{
	return (isset($_SESSION[$key])) ? $_SESSION[$key] : $default;
}

function session_pop($key)
{
	unset($_SESSION[$key]);
}