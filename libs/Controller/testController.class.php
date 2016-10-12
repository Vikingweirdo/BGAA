<?php
class testController {
	function show() {
		$objModel = M ( 'test' );
		$objView = V ( 'test' );
		$objView->display ( $objModel->get () );
	}
}
?>