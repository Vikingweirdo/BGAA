<?php
//课程相关模块
class CourseModel extends BaseModel{
	private $courseName = '';
	private $ncourseName ='';
	private $link;
	private $username='';
	
	function __construct() {
		parent::__construct("course");	
	}
}
?>