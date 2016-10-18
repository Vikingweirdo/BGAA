<?php
class mysql {
	private  $link;
	function err($error) {
		die ( "Error:" . $error );
	}
	function __destruct() {
		mysqli_close ( $this->link );
	}
	function __construct($config) {
		extract ( $config );
		if (! $this->link = mysqli_connect ( $dbhost, $dbuser, $dbpwd, $dbname ))
			$this->err ( mysqli_error ( $this->link ) );
		mysqli_set_charset ( $this->link, 'UTF8' );
	}
	function query($sql) {
		if (! $query = mysqli_query ( $this->link, $sql )) {
			$this->err ( $sql . "<br / >" . mysqli_error ( $this->link ) );
		} else {
			return $query;
		}
	}
	function findAll($query) {
		while ( $row = mysqli_fetch_array ( $query ) ) {
			$list [] = $row;
		}
		return isset ( $list ) ? $list : "";
	}
	function findOne($query) {
		return mysqli_fetch_array ( $query );
	}
	function insert($table, $arg) {
		foreach ( $arg as $key => $value ) {
			$value = mysqli_real_escape_string ( $this->link, $value );
			$keyArr [] = '`' . $key . '`';
			$valueArr [] = "'" . $value . "'";
		}
		$keys = implode ( ",", $keyArr );
		$values = implode ( ",", $valueArr );
		$sql = "INSERT INTO " . $table . " (" . $keys . ") VALUES (" . $values . ")";
		$this->query ( $sql );
		return mysqli_insert_id ( $this->link );
	}
	
	function update($table, $arg, $condition) {
		
	}
	
	function num_rows($res) {
		return mysqli_num_rows($res);
	}
	
	function insert_id() {
		return mysqli_insert_id($link);
	}
}
?>