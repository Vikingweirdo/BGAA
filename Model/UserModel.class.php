<?php
require_once 'BaseModel.class.php';

class UserModel extends BaseModel{
	
	private $username = '';
	private $password = '';
	private $flag = -1;
	private $npassword = '';
	
	function __construct() {
		parent::__construct();
		if(isset($_POST['username']))
			$userName = mysqli_real_escape_string($link, $_POST['username']);
		if(isset($_POST['password']))
			$password = mysqli_real_escape_string($link, $_POST['password']);
		if(isset($_POST['flag']))
			$flag = (int)$_POST['flag'];
		if(isset($_POST['npassword']))
			$npassword = mysqli_real_escape_string($link, $_POST['npassword']);
	}
	
	function login($islogin = true) {
		if(!empty($username) && $flag != -1) {
			$res = $link->query("SELECT `password` FROM `user` WHERE `username`='$username' && `flag`=$flag");
			if($islogin == flase && $link->num_rows($res) != 0)
				return true;
			if(!empty($password) && $password == $link->findOne($res))
				return true;
		}
		return false;
	}
	
	function register() {
		if(login(false) == false) {
			if(!empty($username) && !empty($password) && $flag != -1) {
				$res = $link->query("INSERT INTO `user` (`username`, `password`) VALUES ('$username', '$password'");
				return $res;
			}
		}
		return false;
	}
	
	function modify() {
		if(!empty($username) && !empty($password) && !empty($npassword)) {
			$res = $link->query("UPDATE `user` SET `password`='$npassword' WHERE `username`='$username' LIMIT 1");
			return $res;
		}
		return false;
	}
}
?>