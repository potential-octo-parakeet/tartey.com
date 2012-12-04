<?php
	include_once('../session.php');
	include_once('../class.php');
	$_SESSID = $_SESSION['id'];
	if(isset($_POST['comment']) && isset($_POST['pid']) && isset($_SESSID)){
		$user_id	= $_SESSID;
		$wall_id	= $_POST['pid'];
		$comment	= $_POST['comment'];
		if(!empty($user_id) && !empty($wall_id) && !empty($comment)){
			db::connect();
			$sql	= sprintf("INSERT INTO wall_message_comment(msg_id,user_id,comment) VALUES('%d','%d','%s')",
						$wall_id,$user_id,mysql_real_escape_string($comment));
			mysql_query($sql);
		}
	}	
?>