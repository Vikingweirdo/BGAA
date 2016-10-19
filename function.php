<?php
define('timeout', 90 * 60);

function M($name, $method) {
	require_once './Model/' . $name . 'Model.class.php';
	eval ( '$obj = new ' . $name . 'Model();' );
	eval ( '$res = $obj->' . $method . '();' );
	return $res;
}
function V($name) {
	require_once './View/' . $name . 'View.class.php';
	eval ( '$obj = new ' . $name . 'View();' );
	return $obj;
}
function daddslashes($str) {
	return (! get_magic_quotes_gpc ()) ? addslashes ( $str ) : $str;
}

function sessionCheck() {
	if (!isset($_SESSION['username']))
		return false;
	if(isset($_SESSION['timeout'])) {
		if($_SESSION['timeout'] < time()) {
			unset($_SESSION['timeout']);
			return false;
		}
		$_SESSION['timeout'] = time() + timeout; 
	}
	else
		return false;
	return true;
}

function logout() {
	$_SESSION = array();
	session_destroy();
}
?>