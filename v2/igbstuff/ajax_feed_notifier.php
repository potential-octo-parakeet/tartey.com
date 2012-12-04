<?php
	include('class.php');
	db::connect();
	$sql=mysql_query("SELECT id FROM wall_message ORDER BY id DESC LIMIT 1");
	echo mysql_result($sql,0);	
?>