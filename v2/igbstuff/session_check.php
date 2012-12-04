<?php 
	session_start();
	if(!isset($_SESSION['id'])){
		echo 'timeout';
	}//end of session
?>