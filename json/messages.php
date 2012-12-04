<?php
	session_start();
	require('../db.php');
	$db = new db;
	$result = array();
	if(isset($_REQUEST['offset']) && isset($_REQUEST['limit']) && isset($_REQUEST['read'])){
		$db->connect();
		$sql = sprintf("SELECT messages.id,user.name,user.img50,messages.from_uid,messages.message,messages.timestamp,messages.read 
						FROM messages JOIN user ON user.id=messages.from_uid WHERE messages.to_uid='%d' ORDER BY id DESC LIMIT %d,%d",
						$_SESSION['id'],$_REQUEST['offset'],$_REQUEST['limit']);
		$sql = mysql_query($sql) or die(mysql_error());
		$a = array();$i = 0;
		while($row = mysql_fetch_object($sql)){
			$a[$i] = array('id'=>$row->id,'name'=>$row->name,'img'=>$row->img50,'uri'=>'http://tartey.com/profile.php?id='.$row->from_uid,
							'message'=>stripslashes(nl2br($row->message)),'timestamp'=>$row->timestamp);
			$i++;
		}
		$COUNT = mysql_query("SELECT COUNT(*) FROM messages");
		$COUNT = mysql_result($COUNT,0,0);
		$result['result']	= true;
		$result['data'] 	= $a;
		$messages 			= array();
		$paging				= array();
		$messages['count']	= $i;
		$messages['total']	= $COUNT;
		$paging['next']		= $_REQUEST['offset'] + $_REQUEST['limit'] >= $COUNT ? $COUNT : $_REQUEST['offset'] + $_REQUEST['limit'];
		$paging['prev']		= $_REQUEST['offset'] - $_REQUEST['limit'] <= 0 ? 0 : $_REQUEST['offset'] - $_REQUEST['limit'];
		$result['messages']	= $messages;
		$result['paging']	= $paging;
	}elseif(isset($_REQUEST['del']) && isset($_REQUEST['msg_id']) && isset($_REQUEST['receiver'])){
		$db->connect();
		$sql = sprintf("DELETE FROM messages WHERE id='%d' AND to_uid='%d'",$_REQUEST['msg_id'],$_SESSION['id']);
		$sql = mysql_query($sql);
		if(!$sql){
			$result['result']	= false;
			$result['message']	= "Message cannot be deleted.";
		}else{
			$result['result']	= true;
		}
	}elseif(isset($_REQUEST['send']) && isset($_REQUEST['to_uid']) && isset($_REQUEST['msg'])){
		if(!is_numeric($_REQUEST['to_uid'])){
			$result['result'] = false;
			$result['message']= "Invalid user ID.";
		}elseif(empty($_REQUEST['msg'])){
			$result['result'] = false;
			$result['message']= "Message is empty.";
		}else{
			$db->connect();
			$sql = sprintf("INSERT INTO messages(from_uid,to_uid,message) VALUES('%d','%d','%s')",
					$_SESSION['id'],$_REQUEST['to_uid'],mysql_real_escape_string($_REQUEST['msg']));
			$sql = mysql_query($sql) or die(mysql_error());
			$result['result'] = true;
			$result['message']= "Message sent!";
		}
	}else{
		$result['result']	= false;
		$result['message']	= "Invalid parameters.";
	}
	$json = json_encode($result);
	echo $json;
?>