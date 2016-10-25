<?php
//用户组相关类
class Group extends BaseModel{
	private $groupName = '';
	private $link;
	
	function __construct() {
		parent::__construct("group");
	}

}
?>