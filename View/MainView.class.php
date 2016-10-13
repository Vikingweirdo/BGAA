<?php
class MainView {
	function request($data) {
		if($data == false)
			echo json_encode(array("status" => false));
		else if($data == true)
			echo json_encode(array("status" => true));
		else
			echo json_encode($data);
	}
}
?>