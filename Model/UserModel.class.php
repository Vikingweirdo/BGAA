<?php
//用户模块 主要负责处理用户的登录注册功能
class UserModel {
	private $username = '';
	private $password = '';
	private $flag = - 1;
	private $npassword = '';
	private $link;
	function __construct() {
		global $config;
		$this->link = new mysql ( $config );
		if (sessionCheck ())
			$this->username = $_SESSION ['username'];
		else if (isset ( $_POST ['username'] ))
			$this->username = $this->link->real_escape_string ( $_POST ['username'] );
		
		if (isset ( $_POST ['password'] ))
			$this->password = $this->link->real_escape_string ( $_POST ['password'] );
		if (isset ( $_POST ['flag'] ))
			$this->flag = ( int ) $_POST ['flag'];
		if (isset ( $_POST ['npassword'] ))
			$this->npassword = $this->link->real_escape_string ( $_POST ['npassword'] );
	}
	function login($islogin = true) {
		if (! empty ( $this->username ) && $this->flag != - 1) {
			
			$res = $this->link->query ( "SELECT `password` FROM `user` WHERE `username`='$this->username' && `flag`=$this->flag" );
			if ($islogin == false && $this->link->num_rows ( $res ) != 0)
				return true;
			
			if (! empty ( $this->password ) && $this->password == $this->link->findOne ( $res ) [0]) {
				$_SESSION ['username'] = $this->username;
				$_SESSION ['timeout'] = time () + timeout;
				return true;
			}
		}
		return false;
	}
	function register() {
		if (login ( false ) == false) {
			if (! empty ( $this->username ) && ! empty ( $this->password ) && $this->flag != - 1) {
				$res = $this->link->query ( "INSERT INTO `user` (`username`, `password`) VALUES ('$this->username', '$this->password'" );
				return $res;
			}
		}
		return false;
	}
	function modify() {
		if (! empty ( $this->username ) && ! empty ( $this->password ) && ! empty ( $this->npassword )) {
			$res = $this->link->query ( "UPDATE `user` SET `password`='$this->npassword' WHERE `username`='$this->username' LIMIT 1" );
			return $res;
		}
		return false;
	}
	function logout() {
		$_SESSION = array ();
		session_destroy ();
		return true;
	}
}
?>