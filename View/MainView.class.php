<?php
//视图文件 主要根据参数类型输出不同的json格式
class MainView {
	function request($data) {
		if (gettype ( $data ) == 'array')
			echo json_encode ( $data );
		else if (gettype ( $data ) == 'integer')
			echo json_encode ( array (
					'id' => $data 
			) );
		else if ($data == true)
			echo json_encode ( array (
					"status" => true 
			) );
		else
			echo json_encode ( array (
					"status" => false 
			) );
	}
}
?>