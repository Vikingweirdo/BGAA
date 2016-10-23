<?php
//数据库接口
class mysql {
	private $link;
	
	function err($error) {
		die ( "Error:" . $error );
	}
	
	function __construct($config) {
		extract ( $config );
		if (! $this->link = mysqli_connect ( $hostname, $username, $password, $dbname ))
			$this->err ( mysqli_error ( $this->link ) );
			mysqli_set_charset ( $this->link, 'UTF8' );
			
	}
	
	function __destruct() {
		mysqli_close($this->link);	
	}
	
	function query($sql) {
		if (! $query = mysqli_query ( $this->link, $sql )) {
			$this->err ( $sql . "<br / >" . mysqli_error ( $this->link ) );
		} else {
			return $query;
		}
	}
	
	function real_escape_string($string) {
		return mysqli_real_escape_string ( $this->link, $string );
	}
	
	function findAll($res) {
		while ( $row = mysqli_fetch_array ( $res ) ) {
			$list [] = $row;
		}
		return isset ( $list ) ? $list : "";
	}
	
	function findOne($res) {
		if(!empty($res))
			return mysqli_fetch_array ( $res );
		else
			return null;
	}
	
	function num_rows($res) {
		return mysqli_num_rows ( $res );
	}
	
	function insert_id() {
		return mysqli_insert_id ( $this->link );
	}

}
?>