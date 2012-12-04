<?php
	session_start();
	$json = array();
	if(isset($_SESSION['id'])){
		$json['status'] = true; 
		$json['message'] = 'session is active';
	}else{
		$json['status'] = false;
		$json['message'] = 'session has timeout';
	}
	echo json_encode($json);
?>