<?php
class courseModel extends BaseModel {
	function __construct() {
		parent::__construct();
		
	}
	
	private function find($name) {
		$res = $link->query("SELECT COUNT(*) FROM `course` WHERE `courseName`='$name'");
		return $link->num_rows($res);
	}
	
	function add() {
		$courseName = mysqli_real_escape_string($link, $_POST['courseName']);
		if(find($courseName) == 0) {
			$res = $link->query("INSERT INTO `course` SET (`courseName`, `teacherName`) VALUES ('$courseName', '$userName')");
			if($res) 
				return $link->insert_id();
		}
	}
	
	function join() {
		
	}
	
	function exit() {
		
	}
	
	function modify() {
		
	}
	
	function delete() {
		$res = $link->query("DELETE FROM `course` WHERE `courseName`='$courseName' AND `teacherName`='$userName' LIMIT 1");
		return $res;
	}
}
?>