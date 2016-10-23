<?php
//入口部分 主要负责分配模块
require_once 'mysql.class.php';
require_once 'function.php';
require_once './Model/UserModel.class.php';
require_once './Model/CourseModel.class.php';

header("Content-Type: text/html; charset=utf8");

$config = array (
		'hostname' => 'localhost',
		'username' => 'root',
		'password' => '1234',
		'dbname' => 'app'
);

if (isset ( $_REQUEST ['model'] ))
	$model = daddslashes ( trim ( $_REQUEST ['model'] ) );
if (isset ( $_REQUEST ['method'] ))
	$method = daddslashes ( trim ( $_REQUEST ['method'] ) );

if (isset ( $model ) && isset ( $method )) {
	
	session_start();
	$view = V("Main");
	if(!($model == 'User' && ($method == 'login' || $method == 'register' || $method == 'logout' ))) {
		if(!sessionCheck()) {
			$view->request(array('info' => 'Please Login First!'));
			die;
		}
	}
	$res = M($model, $method);
	$view->request($res);
}

?>