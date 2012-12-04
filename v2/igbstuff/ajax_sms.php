<?php
	session_start();
	$ses_id = $_SESSION['id'];
	if(isset($_POST['sms']) && $_POST['sms']==='true'){
		$mymobile	= $_POST['mynumber'];
		$tomobile	= $_POST['mobile'];
		$sms		= $_POST['message'];
		$numFilter	= "/^[0-9]{10}$/";
		$mobprefix	= array('904','905','906','907','908','909','910','912','914','915','916','917','918','919',
							'920','921','921','922','923','924','926','927','928','929','930','932','933','934',
							'935','936','937','938','939','940','942','943','944','946','947','948','949','999');
		
		if(!preg_match($numFilter,$mymobile)){
			echo "Your mobile number is invalid. Please update your profile and set the correct mobile number.";
		}elseif(!preg_match($numFilter,$tomobile)){
			echo "Recipient mobile number is invalid.";
		}elseif(!in_array(substr($mymobile,0,3),$mobprefix)){
			echo "Unregistered mobile network.<br/>(Your mobile #)";
		}elseif(!in_array(substr($tomobile,0,3),$mobprefix)){
			echo "Unregistered mobile network.<br/>(Recipient mobile #)";
		}elseif(empty($sms)){
			echo "Message is empty.";
		}else{
			if(credits($ses_id)<1){
				echo "You have insufficient credits to use sms";
			}else{				
				include('sms_gateway.php');				
			}
		}
	}
	
	if(isset($_GET['credit'])){
		$cdt = credits($ses_id);
		if(empty($cdt)){givecredits($ses_id);$cdt = credits($ses_id);}
		echo $cdt<2?"Credit: <span id='ac'>$cdt</span>":"Credits: <span class='ac'>$cdt</span>";
	}
	
	
	function credits($user_id){
		include_once('class.php');
		$cxn = new db;
		$cxn -> connect();
		$uid = (int)$user_id;
		$sql = mysql_query("SELECT (COUNT(friends.id)-sentout) 'c' FROM text_credit 
							JOIN friends ON friends.user_id=text_credit.user_id WHERE text_credit.user_id='$uid'");
		$row = mysql_fetch_assoc($sql);
		return $row['c'];
	}
	
	if(isset($_GET['cint'])){
		$cdt = credits($ses_id);
		echo $cdt;
	}
	
	function sentout($user_id){
		include_once('class.php');
		$cxn = new db;
		$cxn -> connect();
		$uid = (int)$user_id;
		$sql = mysql_query("INSERT INTO text_credit(user_id,sentout) VALUES('$user_id','1') ON DUPLICATE KEY UPDATE sentout=sentout+1");
	}
	
	function givecredits($user_id){
		include_once('class.php');
		$cxn = new db;
		$cxn -> connect();
		$uid = (int)$user_id;
		$sql = mysql_query("INSERT INTO text_credit(user_id,sentout) VALUES('$user_id','0')");
	}	
	
	 if(isset($_GET['mobile'])){
		include_once('class.php');
		$cxn = new db;
		$cxn -> connect();
		$uid = (int)$ses_id;
		$sql = mysql_query("SELECT mobile FROM user WHERE id='$uid'");
		$row = mysql_fetch_assoc($sql);
		echo $row['mobile'];
	}	
?>