<?php
// 通知相关的模型
class Notice {
	private $link;
	private $username;
	private $info;
	private $time;
	
	function __construct($modelType) {
		global $config;
		$this->link = new mysql ( $config );
		$this->username = $_SESSION ['username'];
		
		if(isset($_POST['info'])) 
			$this->info = $this->link->real_escape_string($_POST['info']);
		if(isset($_POST['time']))
			$this->time = (int)$_POST['time'];
	}
	
	function add() {
		$res = $this->link->query("INSERT INTO `msg` (`msgBody`, `username`, `time`) VALUES ('$this->info', '$this->username', $this->time)");
		return $res;
	}
	
	function getMSg() {
		
	}
}