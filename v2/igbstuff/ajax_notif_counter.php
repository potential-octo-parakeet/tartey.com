<?php
	include('class.php');
	$igb = new notifications;
	
	if(isset($_GET['friendrequest'])){
		$id		= $_GET['friendrequest'];
		$count 	= $igb->friendRequestCounter($id);
		echo $count;
	}
	
	if(isset($_GET['messages'])){
		$id		= $_GET['messages'];
		$count 	= $igb->messagesCounter($id);
		echo $count;
	}
?>