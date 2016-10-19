<?php
class mysql {
	static  $link;
	static function err($error) {
		die ( "Error:" . $error );
	}
	
	static function connnect($config) {
		extract ( $config );
		if (! $self->link = mysqli_connect ( $dbhost, $dbuser, $dbpwd, $dbname ))
			$self->err ( mysqli_error ( $self->link ) );
		mysqli_set_charset ( $self->link, 'UTF8' );
	}
	static function query($sql) {
		if (! $query = mysqli_query ( $self->link, $sql )) {
			$self->err ( $sql . "<br / >" . mysqli_error ( $self->link ) );
		} else {
			return $query;
		}
	}
	
	static function real_escape_string($string) {
		return mysqli_real_escape_string($self->link, $string);
	}
	
	static function findAll($query) {
		while ( $row = mysqli_fetch_array ( $query ) ) {
			$list [] = $row;
		}
		return isset ( $list ) ? $list : "";
	}
	static function findOne($query) {
		return mysqli_fetch_array ( $query );
	}
	static function insert($table, $arg) {
		foreach ( $arg as $key => $value ) {
			$value = mysqli_real_escape_string ( $self->link, $value );
			$keyArr [] = '`' . $key . '`';
			$valueArr [] = "'" . $value . "'";
		}
		$keys = implode ( ",", $keyArr );
		$values = implode ( ",", $valueArr );
		$sql = "INSERT INTO " . $table . " (" . $keys . ") VALUES (" . $values . ")";
		$self->query ( $sql );
		return mysqli_insert_id ( $self->link );
	}
	
	static function update($table, $arg, $condition) {
		
	}
	
	static function num_rows($res) {
		return mysqli_num_rows($res);
	}
	
	static function insert_id() {
		return mysqli_insert_id($self->link);
	}
}
?>