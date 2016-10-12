<?php
	header("content-type:text/html; charset=utf-8");
	require_once 'mysql.class.php';
	require_once 'DB.class.php';
	$config = array(
			"dbhost" => "localhost",
			"dbuser" => "root",
			"dbpwd" => "1234",
			"dbname" => "test"
	);
	DB::init('mysql', $config);
	$res = DB::findAll("SELECT * FROM gps");
	var_dump($res);
	
?>