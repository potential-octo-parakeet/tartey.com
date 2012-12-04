<?php
	include_once('../session.php');
	include_once('../class.php');
	if(isset($_POST['post_status']) && $_POST['post_status']==='true'){
		$TID	= 0;
		$UID	= $_SESSION['id'];
		$MSG	= $_POST['status'];
		$fUID	= "/[0-9]/";
		$fMSG	= "Write something...";
		if(!preg_match($fUID,$UID)){
			$rc	= 'uid';
		}elseif(empty($MSG) || $MSG==$fMSG){
			$rc = 'msg';
		}else{
			db::connect();
			$sql=sprintf("INSERT INTO wall_message(from_userid,to_userid,context) VALUES('%d','%d','%s')",
					$UID,$TID,mysql_real_escape_string($MSG));
			mysql_query($sql) or die(mysql_error());
			$rc = 'ok';
		}
		echo $rc;
	}
?>