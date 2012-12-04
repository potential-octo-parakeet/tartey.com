<?php
	session_start();
	$UID = $_SESSION['id'];
	include('class.php');
	$user = new user;		
	$json	= array();	
	
	if(isset($_REQUEST['uid']) && isset($_REQUEST['offset']) && isset($_REQUEST['limit'])){
		$UID 	= $_REQUEST['uid'];
		$OFFSET = $_REQUEST['offset'];
		$LIMIT	= $_REQUEST['limit'];
		$json['total']	= $user->friends_in_total($UID);
		$json['friends']= $user->friends($UID,$OFFSET,$LIMIT);
	}
	if(isset($UID) && isset($_REQUEST['incoming']) && isset($_REQUEST['offset']) && isset($_REQUEST['limit'])){
		$OFFSET = $_REQUEST['offset'];
		$LIMIT	= $_REQUEST['limit'];
		$json['friends']= $user->incoming_friends($UID,$OFFSET,$LIMIT);
	}
	if(isset($UID) && isset($_REQUEST['outgoing']) && isset($_REQUEST['offset']) && isset($_REQUEST['limit'])){
		$OFFSET = $_REQUEST['offset'];
		$LIMIT	= $_REQUEST['limit'];
		$json['friends']= $user->outgoing_friends($UID,$OFFSET,$LIMIT);
	}
	if(isset($_REQUEST['count'])){
		$json['friends'] = $user->friends_in_total($UID);
		$json['incoming'] = $user->total_incoming_request($UID);
		$json['outgoing'] = $user->total_outgoing_request($UID);
	}
	echo json_encode($json);
?>