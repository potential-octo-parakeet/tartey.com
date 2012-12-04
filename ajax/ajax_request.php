<?php
	session_start();
	$ses_id = $myid = $_SESSION['id'];
	include('class.php');
	$igb = new igobig;
	
	if(isset($_POST['action_cool']) && $_POST['action_cool']==='true'){
		$msg_id	= $_POST['msg_id'];
		$user_id= $ses_id;
		$igb->connect();
		$sql	= sprintf("SELECT 1 FROM wall_message_cool WHERE msg_id='%d' AND user_id='%d'",$msg_id,$user_id);
		$sql	= mysql_query($sql);
		if(!mysql_num_rows($sql)){
			$sql2	= sprintf("INSERT INTO wall_message_cool(msg_id,user_id) VALUES('%d','%d')",$msg_id,$user_id);
			mysql_query($sql2);
			mysql_query("INSERT INTO notification(from_userid,action,object_id) VALUES('$ses_id','found cool on post','$msg_id')");
		}
	}
	if(isset($_POST['action_uncool']) && $_POST['action_uncool']==='true'){
		$msg_id	= $_POST['msg_id'];
		$user_id= $ses_id;
		$igb->connect();
		$sql	= sprintf("DELETE FROM wall_message_cool WHERE msg_id='%d' AND user_id='%d'",$msg_id,$user_id);
		mysql_query($sql);
	}
	if(isset($_POST['post_comment']) && $_POST['post_comment']==='true'){
		$user_id	= $ses_id;
		$wall_id	= $_POST['wall_id'];
		$comment	= $_POST['comment'];
		if(!empty($user_id) && !empty($wall_id) && !empty($comment)){
			$igb->connect();
			$sql		= sprintf("INSERT INTO wall_message_comment(msg_id,user_id,comment) VALUES('%d','%d','%s')",
						$wall_id,$user_id,mysql_real_escape_string($comment));
			mysql_query($sql);
		}
	}	
	if(isset($_POST['friendrequest']) && $_POST['friendrequest']==='true'){
		$uid = $_POST['user_id'];
		$igb->connect();	
		$sql=mysql_query("SELECT id FROM friends WHERE user_id='$myid' AND friends_id='$uid'");
		if(mysql_num_rows($sql)==0){	
			$sql=mysql_query("SELECT id FROM friendrequest WHERE from_userid='$myid' AND to_userid='$uid'");
			if(mysql_num_rows($sql)==0){
				$sql=sprintf("INSERT INTO friendrequest(from_userid,to_userid) VALUES('%d','%d')",$myid,$uid);
				mysql_query($sql);	
			}
		}			
	}//friend request
	
	if(isset($_POST['addfriend']) && $_POST['addfriend']==='true'){
		$uid = $_POST['user_id'];
		$igb->connect();
		mysql_query("INSERT INTO friends(user_id,friends_id) VALUES('$uid','$myid')") or die(mysql_error());
		mysql_query("INSERT INTO friends(user_id,friends_id) VALUES('$myid','$uid')") or die(mysql_error());
		mysql_query("DELETE FROM friendrequest WHERE from_userid='$uid' AND to_userid='$myid'") or die(mysql_error());
		mysql_query("DELETE FROM friendrequest WHERE from_userid='$myid' AND to_userid='$uid'") or die(mysql_error());
	}//add friend
	
	if(isset($_POST['ignorefriend']) && $_POST['ignorefriend']==='true'){
		$uid = $_POST['user_id'];
		$igb->connect();
		mysql_query("DELETE FROM friendrequest WHERE from_userid='$uid' AND to_userid='$myid'") or die(mysql_error());
		mysql_query("DELETE FROM friendrequest WHERE from_userid='$myid' AND to_userid='$uid'") or die(mysql_error());
	}//ignore friend
	
	if(isset($_POST['removefriend']) && $_POST['removefriend']==='true'){
		$uid = $_POST['user_id'];
		$igb->connect();
		mysql_query("DELETE FROM friends WHERE user_id='$myid' AND friends_id='$uid'");
		mysql_query("DELETE FROM friends WHERE friends_id='$myid' AND user_id='$uid'");
	}//remove friend
	
	if(isset($_POST['wallmessage']) && $_POST['wallmessage']==='true'){
		$from_userid= $myid;
		$to_userid	= $_POST['to_userid'];
		$text		= $_POST['text'];
		$igb->connect();
		$sql=sprintf("INSERT INTO wall_message(from_userid,to_userid,context) VALUES('%d','%d','%s')",
					$from_userid,$to_userid,mysql_real_escape_string($text));
		mysql_query($sql) or die(mysql_error());
	}//wall message	
	if(isset($_POST['sk']) && $_POST['sk']==='basic'){//update basic information
		$email		= $_POST['email'];
		$firstname	= $_POST['firstname'];
		$lastname 	= $_POST['lastname'];
		$gender	  	= $_POST['gender'];
		$birthday 	= $_POST['birthday'];
		$location 	= $_POST['location'];
		$hometown 	= $_POST['hometown'];
		$bio  	  	= $_POST['bio'];
		$mobile		= $_POST['mobile'];
		$filterEmail= "/^(.{3,})+\@+(.{2,})+\.+(.{2,4})$/";
		$filterNum	= "/^[0-9]{3,6}$/";
		$filterSex	= "/Male|Female/";
		$filterBday	= "/^[0-9]{4}+\-+[0-9]{2}+\-+[0-9]{2}$/";
		$filterMob	= "/^[0-9]{10}$/";
		$mobprefix	= array('904','905','906','907','908','909','910','912','914','915','916','917','918','919',
							'920','921','921','922','923','924','926','927','928','929','930','932','933','934',
							'935','936','937','938','939','940','942','943','944','946','947','948','949','999');
		if(!preg_match($filterEmail,$email)){
			echo $errorMessage = "Please enter a valid email address.";
		}elseif($igb->userEmailExist($email,$ses_id)){
			echo "Email already in used by other user.";
		}elseif(strlen($firstname)<2){
			echo $errorMessage = "Please enter your first name.";
		}elseif(strlen($lastname)<2){
			echo $errorMessage = "Please enter your last name.";
		}elseif(!preg_match($filterSex,$gender)){
			echo $errorMessage = "Please select your sex.";
		}elseif(!preg_match($filterBday,$birthday)){
			echo $errorMessage = "Please select your birthday.";
		}elseif(!empty($mobile) && !preg_match($filterMob,$mobile)){
			echo $errorMessage = "Please enter a valid mobile number. Example valid format: 905xxxxxxx";
		}elseif(!empty($mobile) && preg_match($filterMob,$mobile) && !in_array(substr($mobile,0,3),$mobprefix)){
			echo $errorMessage = "Unknown mobile network. Example valid format: 905xxxxxxx for Globe network";
		}else{
			$igb->connect();
			$sql=sprintf("UPDATE user SET email='%s',firstname='%s',lastname='%s',name=CONCAT(firstname,0x20,lastname),
						gender='%s',birthday='%s',mobile='%s',location='%s',hometown='%s',bio='%s' WHERE id='%d'",
						mysql_real_escape_string($email),mysql_real_escape_string($firstname),mysql_real_escape_string($lastname),
						$gender,$birthday,$mobile,mysql_real_escape_string($location),mysql_real_escape_string($hometown),
						mysql_real_escape_string($bio),$ses_id);
			mysql_query($sql);
			echo $errorMessage = "Your profile has been updated.";
		}	
	}//update basic information
	
	if((isset($_POST['user']) && !empty($_POST['user'])) && (isset($_POST['message']) && !empty($_POST['message']))){
		$igb->connect();
		$user = $_POST['user'];
		$msg  = $_POST['message'];		
		foreach($user as $u){
			$tkn  = md5(rand(0,99999)+microtime());
			mysql_query("INSERT INTO user_message(from_userid,to_userid,`text`,token) VALUES('$ses_id','$u','$msg','$tkn')");
		}
		echo "Message was successfully sent.";
	}
?>