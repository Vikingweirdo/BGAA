<?php
class mysql {
	private static $link;
	function err($error) {
		die ( "Error:" . $error );
	}
	
	function __construct() {
	
		
	}
	
	function connect($config) {
		extract ( $config );
		if (! $this->con = mysqli_connect ( $dbhost, $dbuser, $dbpwd, $dbname ))
			$this->err ( mysqli_error ( $this->con ) );
		mysqli_set_charset ( $this->con, 'UTF8' );
	}
	function query($sql) {
		if (! $query = mysqli_query ( $this->con, $sql )) {
			$this->err ( $sql . "<br / >" . mysqli_error ( $this->con ) );
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
	function findRes($query, $row = 0, $field = 0) {
		return mysqli_result ( $query, $row, $field );
	}
	function insert($table, $arr) {
		foreach ( $arr as $key => $value ) {
			$value = mysqli_real_escape_string ( $this->con, $value );
			$keyArr [] = '`' . $key . '`';
			$valueArr [] = "'" . $value . "'";
		}
		$keys = implode ( ",", $keyArr );
		$values = implode ( ",", $valueArr );
		$sql = "INSERT INTO " . $table . " (" . $keys . ") VALUES (" . $values . ")";
		$this->query ( $sql );
		return mysqli_insert_id ( $this->con );
	}
}
?>