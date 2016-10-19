<?php
class CourseModel {
	private $courseName = '';
	private $link;
	private $username;
	function __construct() {
		global $config;
		$this->link = new mysql ( $config );
		if (isset ( $_POST ['courseName'] ))
			$this->courseName = $this->link->real_escape_string ( $_POST ['courseName'] );
		$this->username = $_SESSION ['username'];
	}
	private function find($name) {
		$res = $this->link->query ( "SELECT COUNT(*) FROM `course` WHERE `courseName`='$name'" );
		return $this->link->num_rows ( $res );
	}
	function add() {
		$this->courseName = mysqli_real_escape_string ( $this->link, $_POST ['courseName'] );
		if (find ( $this->courseName ) == 0) {
			$res = $this->link->query ( "INSERT INTO `course` SET (`courseName`, `teacherName`) VALUES ('$this->courseName', '$this->userName')" );
			if ($res)
				return $this->link->insert_id ();
		}
	}
	function join() {
	}
	function leave() {
	}
	function modify() {
	}
	function delete() {
		$res = $link->query ( "DELETE FROM `course` WHERE `courseName`='$courseName' AND `teacherName`='$userName' LIMIT 1" );
		return $res;
	}
}
?>