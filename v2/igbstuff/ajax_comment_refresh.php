<?php
	include('class.php');
	db::connect();
	if(isset($_GET['a'])){
		$sql=mysql_query("SELECT id FROM wall_message_comment ORDER BY id DESC LIMIT 1");
		echo mysql_result($sql,0);
	}
	if(isset($_GET['b'])){
		$sql=mysql_query("SELECT msg_id FROM wall_message_comment ORDER BY id DESC LIMIT 1");
		echo mysql_result($sql,0);
	}
?>