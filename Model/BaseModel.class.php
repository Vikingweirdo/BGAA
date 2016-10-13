<?php
class BaseModel {
	protected $link;

	function __construct() {
		$config = array (
				"dbhost" => "localhost",
				"dbuser" => "root",
				"dbpwd" => "1234",
				"dbname" => "test"
		);
		$link = new mysql($config);
	}
}
?>