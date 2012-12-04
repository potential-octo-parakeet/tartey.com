<?php
	session_start();
	include('class.php');
	$u = new user;	
	echo json_encode($u->details($_SESSION['id']));
?>