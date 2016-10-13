<?php
require_once 'mysql.class.php';
require_once 'function.php';
require_once './Model/UserModel.class.php';
require_once './Model/BaseModel.class.php';

if (isset ( $_REQUEST ['model'] ))
	$model = daddslashes ( trim ( $_REQUEST ['model'] ) );
if (isset ( $_REQUEST ['method'] ))
	$method = daddslashes ( trim ( $_REQUEST ['method'] ) );
if (isset ( $model ) && isset ( $method )) {
	$object = M($model, $method);
	$view = V("Main");
	$view->request($object);
}

?>