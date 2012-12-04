<?php
	include_once('../class.php');
	db::connect();
	if(isset($_GET['comment_id'])){
		$sql = mysql_query("SELECT id FROM wall_message_comment ORDER BY id DESC LIMIT 1");
		echo mysql_result($sql,0);
	}
	if(isset($_GET['comment_mid'])){
		$sql = mysql_query("SELECT msg_id FROM wall_message_comment ORDER BY id DESC LIMIT 1");
		echo mysql_result($sql,0);
	}
	if(isset($_GET['rowset'])){
		$sql = mysql_query("SELECT id FROM wall_message ORDER BY id DESC LIMIT 1");
		echo mysql_result($sql,0);		
	}
?>