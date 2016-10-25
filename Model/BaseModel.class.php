<?php
// 课程和用户组的行为一样，所以对其创建基类
class BaseModel {
	private $name = '';
	private $nName = '';
	private $id;
	private $flag = -1;
	private $modelType;
	private $link;
	private $username = '';
	
	function __construct($modelType) {
		global $config;
		$this->link = new mysql ( $config );
		$this->modelType = $modelType;
		$this->username = $_SESSION ['username'];
		$this->flag = $_SESSION['flag'];
		if (isset ( $_POST [$this->modelType.'name'] ))
			$this->name = $this->link->real_escape_string ( $_POST [$this->modelType.'Name'] );
	}
	
	private function find() {
		$sql = "SELECT * FROM `".$this->modelType."` WHERE `".$this->modelType."Name`='$this->name' AND `managerName`='$this->username'";
		$res = $this->link->query ( $sql );
		return $this->link->num_rows ( $res );
	}
	function add() {
		if ($this->find () == 0) {
			$sql = "INSERT INTO `".$this->modelType."` (`".$this->modelType."Name`, `managerName`) VALUES ('$this->name', '$this->username')";
			$res = $this->link->query ( $sql );
			if ($res)
				return $this->link->insert_id ();
		}
	}
	
	private function getUid() {
		$uid = $this->link->query ( "SELECT `uid` FROM `user` WHERE `username`='$this->username' AND `flag`=$this->flag" );
		return $this->link->findOne ( $uid ) [0];
	}
	private function getid() {
		$cid = $this->link->query ( "SELECT `cid` FROM `".$this->modelType."` WHERE `".$this->modelType."Name`='$this->name'" );
		return $this->link->findOne ( $cid ) [0];
	}
	function join() {
		$uid = getUid ();
		$id = getCid ();
		$res = $this->link->query("INSERT INTO `".$this->modelType."hash` (`uid`, `id`) VALUES ($uid, $id)");
		return $res;
	}
	function leave() {
		$uid = getUid ();
		$id = getCid ();
		$res = $this->link->query ( "DELETE FROM `".$this->modelType."hash` WHERE uid=$uid AND id=$id" );
		return $res;
	}
	function modify() {
		if (! empty ( $this->name ) && ! empty ( $this->nName )) {
			$res = $this->link->query ( "UPDATE `".$this->modelType."` SET `".$this->modelType."Name`=$this->nName' WHERE `".$this->modelType."Name`='$this->name' AND `managerName`='$this->username' LIMIT 1" );
			return $res;
		}
		return false;
	}
	function delete() {
		$res = $link->query ( "DELETE FROM `".$this->modelType."` WHERE `".$this->modelType."Name`='$this->name' AND `managerName`='$userName' LIMIT 1" );
		return $res;
	}
}
?>