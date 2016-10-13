<?php
require_once 'BaseModel.class.php';

class UserModel extends BaseModel{
	function __construct() {
		parent::__construct(); 
	}
	
	function login() {
		if(isset($_POST['userName']) && isset($_POST['password'])) {
			$username = mysqli_real_escape_string($link, $_POST['username']);
			$password = mysqli_real_escape_string($link, $_POST['password']);
			$res = $link->query("SELECT `password` FROM `user` WHERE `username`='$username'");
			if($password == $link->findOne($res))
				return true;
			else
				return false;
		} else {
			return false;
		}
	}
	
	function register() {
		
	}
}
?>