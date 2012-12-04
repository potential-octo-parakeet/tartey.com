<?php
	session_start();
	require('../db.php');
	$db = new db;
	$result = array();
	if(isset($_REQUEST['del_photo']) && isset($_REQUEST['photo_id'])){
		if(isset($_SESSION['id'])){
			$id	 = $_REQUEST['photo_id'];
			$uid = $_SESSION['id'];
			$db->connect();
			$pp_query = sprintf("SELECT img50 FROM user WHERE id='%d'",$uid);
			$pp_query = mysql_query($pp_query);
			$pp_query = mysql_fetch_assoc($pp_query);
			$sql = sprintf("SELECT * FROM photos WHERE id='%d' AND uid='%d'",$id,$uid);
			$sql = mysql_query($sql);
			$row = mysql_fetch_assoc($sql);
			if($row['img50']){
				if($row['img50']!==$pp_query['img50']){
					@unlink(preg_replace('/http:\/\/'.$_SERVER['HTTP_HOST'].'/','..',$row['img']));
					@unlink(preg_replace('/http:\/\/'.$_SERVER['HTTP_HOST'].'/','..',$row['img50']));
					@unlink(preg_replace('/http:\/\/'.$_SERVER['HTTP_HOST'].'/','..',$row['img162']));
					$sql = sprintf("DELETE FROM photos WHERE id='%d' AND uid='%d'",$id,$uid);
					mysql_query($sql) or die(mysql_error());
					$result['result']	= true;
					$result['message']	= "Photo ID #$id deleted.";
				}else{
					$result['result'] = false;
					$result['message']= "Primary photo cannot be deleted.";
				}
			}else{
				$result['result'] = false;
				$result['message']= "You are not authorized to delete the image.";
			}
		}else{
			$result['result']	= false;
			$result['message']	= "An authorized access.";
		}
	}else{
		$result['result']	= false;
		$result['message']	= "Invalid parameter.";
	}
	
	if(isset($_REQUEST['make_primary']) && isset($_REQUEST['photo_id'])){
		if(isset($_SESSION['id'])){
			$id	 = $_REQUEST['photo_id'];
			$uid = $_SESSION['id'];
			$db->connect();
			$pp_query = sprintf("SELECT img50 FROM user WHERE id='%d'",$uid);
			$pp_query = mysql_query($pp_query);
			$pp_query = mysql_fetch_assoc($pp_query);
			$sql = sprintf("SELECT * FROM photos WHERE id='%d' AND uid='%d'",$id,$uid);
			$sql = mysql_query($sql);
			$row = mysql_fetch_assoc($sql);
			if($row['img50']){
				if($row['img50']!==$pp_query['img50']){
					$sql = sprintf("UPDATE user SET img='%s',img50='%s',img162='%s' WHERE id='%d'",$row['img'],$row['img50'],$row['img162'],$uid);
					mysql_query($sql) or die(mysql_error());
					$result['result']	= true;
					$result['message']	= "New primary image set.";
				}else{
					$result['result'] = false;
					$result['message']= "Photo selected already your primary image.";
				}
			}else{
				$result['result'] = false;
				$result['message']= "You are not authorized to use the image.";
			}
		}else{
			$result['result']	= false;
			$result['message']	= "Unauthorized access.";
		}
	}
	echo json_encode($result);
?>