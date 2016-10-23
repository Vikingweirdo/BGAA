<?php
//课程相关模块
class CourseModel {
	private $courseName = '';
	private $ncourseName ='';
	private $link;
	private $username='';
	
	function __construct() {
		global $config;
		$this->link = new mysql ( $config );
		if (isset ( $_POST ['courseName'] ))
			$this->courseName = $this->link->real_escape_string ( $_POST ['courseName'] );
		if(isset($_POST['ncousreName']))
			$this->ncourseName = $this->link->real_escape_string($_POST['ncourseName']);
		$this->username = $_SESSION ['username'];
	}
	private function find() {
		$res = $this->link->query ( "SELECT * FROM `course` WHERE `courseName`='$this->courseName' AND `teacherName`='$this->username'" );
		return $this->link->num_rows ( $res );
	}
	function add() {
		if ($this->find () == 0) {
			$sql = "INSERT INTO `course` (`courseName`, `teacherName`) VALUES ('$this->courseName', '$this->username')";
			$res = $this->link->query ($sql);
			if ($res)
				return $this->link->insert_id ();
		}
	}
	
	private function getUid() {
		$uid = $this->link->query("SELECT `uid` FROM `user` WHERE `username`='$username' AND `flag`=$flag");
		return $this->link->findOne($uid)[0];
	}
	private function getCid() {
		$cid = $this->link->query("SELECT `cid` FROM `course` WHERE `courseName`='$courseName'");
		return $this->link->findOne($cid)[0];
	}
	function join() {
		$uid = getUid();
		$gid = getCid();
	}
	function leave() {
		$uid = getUid();
		$cid = getCid();
		$res = $this->link->query("DELETE FROM `coursehash` WHERE uid=$uid AND cid=$cid");
		return $res;
	}
	
	function modify() {
		if(!empty($this->courseName) && !empty($this->ncourseName)) {
			$res = $this->link->query("UPDATE `course` SET `courseName`='$ncourseName' WHERE `courseName`='$courseName' AND `teacherName`='$username' LIMIT 1");
			return $res;
		}
		return false;
	}
	
	function delete() {
		$res = $link->query ( "DELETE FROM `course` WHERE `courseName`='$courseName' AND `teacherName`='$userName' LIMIT 1" );
		return $res;
	}
}
?>