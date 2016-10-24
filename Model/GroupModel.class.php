<?php
//用户组相关类
class Group {
	private $groupName = '';
	private $link;
	
	function __construct() {
		global $config;
		$this->link = new mysql ( $config );
		if (isset ( $_POST ['groupName'] ))
			$this->groupName = $this->link->real_escape_string ( $_POST ['groupName'] );
		$this->username = $_SESSION ['username'];
	}
}
?>