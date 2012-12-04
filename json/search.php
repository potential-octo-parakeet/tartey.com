<?php
	include('../db.php');
	$db = new db;
	
	if(isset($_REQUEST['q'])){
		$q = $_REQUEST['q'];
		$db->connect();
		$sql = sprintf("SELECT id,name,img50 FROM user WHERE name LIKE '%%%s%%' OR email='%s' LIMIT 10",
						mysql_real_escape_string($q),mysql_real_escape_string($q));
		$sql = mysql_query($sql) or die(mysql_error());
		$res = array();
		while($row = mysql_fetch_object($sql)){
			$res[] = array('id'=>$row->id,'name'=>$row->name,'img'=>$row->img50,'uri'=>'http://tartey.com/profile.php?id='.$row->id);
		}
		$json = array();
		if($res){
			$json['result'] = true;
			$json['data']	= $res;
		}else{
			$json['result'] = false;
		}
		echo json_encode($json);
	}
?>