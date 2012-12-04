<?php
	include('class.php');
	if(isset($_POST['save'])){
		$quote 	= $_POST['quote'];
		$uid	= $_POST['uid'];
		$db = new db;
		$db->connect();
		$sql = sprintf("UPDATE user SET quote='%s' WHERE id='%d'",mysql_real_escape_string($quote),$uid);
		mysql_query($sql);
	}
	
	$f = new cejas;	
	$SESS		= $f->user_basic_info($_SESSION['id']);
	$SESSID 	= $SESS['id'];
	$SESSNAME 	= $SESS['name'];
	$SESSIMG	= $SESS['img50'];
	$SESSQUOTE	= stripslashes(htmlspecialchars_decode($SESS['quote'],ENT_QUOTES));
	
	if($_SERVER['PHP_SELF']=='/profile.php' && isset($_GET['id'])){// IF USING PARAMETERS $_GET['id']
		$SESSID = isset($_GET['id']) ? $_GET['id'] : $SESSID;//APPLY ONLY ON PROFILE PAGE
		$SESS		= $f->user_basic_info($SESSID);
		$SESSID 	= $SESS['id'];
		$SESSNAME 	= $SESS['name'];
		$SESSIMG	= $SESS['img50'];
		$SESSQUOTE	= stripslashes(htmlspecialchars_decode($SESS['quote'],ENT_QUOTES));
	}
?>