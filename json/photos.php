<?php
	require('../db.php');
	$db = new db;
	$json	= array();	
	if(isset($_REQUEST['uid']) && isset($_REQUEST['offset']) && isset($_REQUEST['limit'])){
		$UID 	= $_REQUEST['uid'];
		$OFFSET = $_REQUEST['offset'];
		$LIMIT	= $_REQUEST['limit'];
		
		//get images
		$db->connect();
		$sql = sprintf("SELECT * FROM photos WHERE uid='%d'",$UID);
		$sql = mysql_query($sql) or die(mysql_error());
		$photo	= array(); $i = 0;
		while($row = mysql_fetch_assoc($sql)){
			$photo[$i]['id']			= $row['id'];			
			$photo[$i]['image_small']	= $row['img50'];
			$photo[$i]['thumbnail']		= $row['img162'];
			$photo[$i]['zoom']			= $row['img'];
			$i++;			
		}
		$json['result']	= true;
		$json['total']	= $i;
		$json['photos'] = $photo;
	}else{
		$json['result']	= false;
		$json['error']	= "An error has occured.";
	}
	echo json_encode($json);
?>