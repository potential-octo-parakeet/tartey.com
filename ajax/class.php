<?php
	include('../db.php');
	class newsfeed extends db{
		function wall_has_comment($msg_id){
			$this->connect();
			$sql = sprintf("SELECT 1 FROM wall_message_comment WHERE msg_id='%d'",$msg_id);
			$sql = mysql_query($sql);
			if(mysql_num_rows($sql)){
				return true;
			}else{
				return false;
			}
		}
		function wall_cool($msg_id){
			$this->connect();
			$sql = sprintf("SELECT 1 FROM wall_message_cool WHERE msg_id='%d'",$msg_id);
			$sql = mysql_query($sql);
			if(mysql_num_rows($sql)){
				return true;
			}else{
				return false;
			}
		}
		function action_cool_user($user_id,$msg_id){
			$this->connect();
			$sql = sprintf("SELECT 1 FROM wall_message_cool WHERE user_id='%d' AND msg_id='%d'",$user_id,$msg_id);
			$sql = mysql_query($sql);
			if(mysql_num_rows($sql)){
				return true;
			}else{
				return false;
			}
		}
		function wall_message_comment($wall_id,$limit=10){
			$this->connect();
			$sql = sprintf("SELECT user.id,user.name,user.img50,wall_message_comment.`comment`,
						CONVERT_TZ(wall_message_comment.`timestamp`,'-07:00','+06:00') AS 'date' 
						FROM wall_message_comment JOIN user ON wall_message_comment.user_id=user.id 
						WHERE wall_message_comment.msg_id='%d' ORDER BY wall_message_comment.id DESC limit %d",$wall_id,$limit);
			$sql=mysql_query($sql);
			$a=array();$i=0;
			while($row=mysql_fetch_assoc($sql)){
				$a[$i]['user_id'] 	= $row['id'];
				$a[$i]['user_name'] = $row['name'];
				$a[$i]['picture']	= "http://tartey.com/user_images/".$row['img50'];
				$a[$i]['comment']	= $row['comment'];
				$a[$i]['date']		= $row['date'];
				$i++;
			}
			return $a;
		}
		function wall_message($offset){
			$this->connect();
			$sql = sprintf("SELECT user.id AS 'uid',user.name,user.img50,wall_message.id,wall_message.context,
						CONVERT_TZ(wall_message.`timestamp`,'-07:00','+06:00') AS 'date' 
						FROM wall_message JOIN user ON wall_message.from_userid=user.id ORDER BY wall_message.id DESC limit %d,15",$offset);
			$sql=mysql_query($sql);
			$a=array();$i=0;
			while($row=mysql_fetch_assoc($sql)){
				$a[$i]['wall_id']	= $row['id'];
				$a[$i]['user_id'] 	= $row['uid'];
				$a[$i]['user_name'] = $row['name'];
				$a[$i]['picture']	= "http://tartey.com/user_images/".$row['img50'];
				$a[$i]['text']		= $row['context'];
				$a[$i]['date']		= $row['date'];
				$i++;
			}
			return $a;
		}
	}
	class cejas extends db{
		function me($user_id){
			$this->connect();
			$sql = sprintf("SELECT * FROM user WHERE id='%d'",$user_id);
			$sql = mysql_query($sql);
			return mysql_fetch_assoc($sql);
		}
		function last_wall_row(){
			$this->connect();
			$sql=mysql_query("SELECT id FROM wall_message ORDER BY id DESC LIMIT 1");
			return print(mysql_result($sql,0));	
		}
		function get_userid_from_messages($msg_id){
			$this->connect();
			$sql=sprintf("SELECT from_userid FROM user_message WHERE id='%d'",$msg_id);
			$sql=mysql_query($sql);
			return mysql_result($sql,0);
		}
		function get_messages($id){
			$this->connect();
			$sql=sprintf("SELECT user_message.id,user.img50,user.name,user_message.from_userid,user_message.`text`,user_message.token,
				DATE_FORMAT(CONVERT_TZ(user_message.`timestamp`,'+00:00','-02:00'),'%%M %%d, %%Y at %%h:%%i%%p') AS 'date',user_message.read 
				FROM user_message JOIN user ON user_message.from_userid=user.id WHERE user_message.to_userid='%d' ORDER BY id DESC LIMIT 30",$id);
			$sql=mysql_query($sql) or die(mysql_error());
			$a=array();$i=0;
			while($row=mysql_fetch_assoc($sql)){
				$a[$i]['id']	= $row['id'];
				$a[$i]['pic']	= "/user_images/".$row['img50'];
				$a[$i]['name']	= $row['name'];
				$a[$i]['from']	= $row['from_userid'];
				$a[$i]['text']	= $row['text'];
				$a[$i]['date']	= $row['date'];
				$a[$i]['token']	= $row['token'];
				$a[$i]['read']	= $row['read'];
				$i++;
			}
			return $a;			
		}
		function get_profile_summary_info($id){
			$this->connect();
			$sql=mysql_query("SELECT location,DATE_FORMAT(birthday,'%M %d, %Y') AS 'birthday' FROM user WHERE id='$id'");
			return mysql_fetch_assoc($sql);
		}		
		
		function search_people($q,$offset=0,$limit=8){
			$this->connect();
			$sql=sprintf("SELECT id,name,img50 FROM user WHERE name LIKE '%s%%' LIMIT %d,%d",mysql_real_escape_string($q),$offset,$limit);
			$sql=mysql_query($sql);
			$a=array();$i=0;
			while($row=mysql_fetch_assoc($sql)){
				$a[$i]['id']	= $row['id'];
				$a[$i]['name']	= $row['name'];
				$a[$i]['pic']	= "/user_images/".$row['img50'];
				$i++;
			}
			return $a;
		}
		function searchCount($q){
			$this->connect();
			$sql=sprintf("SELECT id FROM user WHERE name LIKE '%s%%'",mysql_real_escape_string($q));
			$sql=mysql_query($sql);
			$i=0;
			while($row=mysql_fetch_assoc($sql)){
				$i++;
			}
			return $i;
		}
		function user_id_exist($id){
			$this->connect();
			$sql=sprintf("SELECT id FROM user WHERE id='%d'",$id);
			$sql=mysql_query($sql);
			if(mysql_num_rows($sql)){
				return true;
			}else{
				return false;
			}
		}
		function get_user_basic_information($id){
			$this->connect();
			$sql=sprintf("SELECT * FROM user WHERE id='%d'",$id);
			$sql=mysql_query($sql);
			return mysql_fetch_assoc($sql);
		}
		function user_login($email,$password){
			$this->connect();
			$sql=sprintf("SELECT 1 FROM user WHERE email='%s' AND password='%s'",$email,md5($password));
			$sql=mysql_query($sql);
			if(mysql_num_rows($sql)){
				return true;
			}else{
				return false;
			}
		}
		function user_token($email,$token){
			$this->connect();
			$sql=sprintf("SELECT 1 FROM user WHERE email='%s' AND token='%s'",$email,$token);
			$sql=mysql_query($sql);
			if(mysql_num_rows($sql)){
				return true;
			}else{
				return false;
			}
		}
		function get_user_token($email){
			$this->connect();
			$sql=sprintf("SELECT token FROM user WHERE email='%s'",$email);
			$sql=mysql_query($sql);
			return mysql_result($sql,0);
		}
		function get_user_id($email){
			$this->connect();
			$sql=sprintf("SELECT id FROM user WHERE email='%s'",$email);
			$sql=mysql_query($sql);
			return mysql_result($sql,0);
		}
		function get_user_name($email){
			$this->connect();
			$sql=sprintf("SELECT name FROM user WHERE email='%s'",$email);
			$sql=mysql_query($sql);
			return mysql_result($sql,0);
		}
		function get_user_picture_small($email){
			$this->connect();
			$sql=sprintf("SELECT img50 FROM user WHERE email='%s'",$email);
			$sql=mysql_query($sql);
			return mysql_result($sql,0);
		}
		function emailExist($email){
			$this->connect();
			$sql=sprintf("SELECT 1 FROM user WHERE email='%s'",mysql_real_escape_string($email));
			$sql=mysql_query($sql);
			if(mysql_num_rows($sql)){
				return true;
			}else{
				return false;
			}
		}
		function userEmailExist($email,$userid){
			$this->connect();
			$sql=sprintf("SELECT 1 FROM user WHERE email='%s' AND id!='%d'",mysql_real_escape_string($email),$userid);
			$sql=mysql_query($sql);
			if(mysql_num_rows($sql)){
				return true;
			}else{
				return false;
			}
		}
		function location(){
			include("geoip/geoipcity.inc");
			include("geoip/geoipregionvars.php");
			$gi = geoip_open($_SERVER['DOCUMENT_ROOT']."/geoip/GeoLiteCity.dat",GEOIP_STANDARD);
			$ip	= $_SERVER['REMOTE_ADDR']!='127.0.0.1' ? $_SERVER['REMOTE_ADDR'] : '69.171.228.248';
			$record = geoip_record_by_addr($gi,$ip);				
			if(empty($record->city) && empty($GEOIP_REGION_NAME[$record->country_code][$record->region]) && empty($record->country_name)){
				return "Unidentified Place";	
			}elseif(empty($record->city) && empty($GEOIP_REGION_NAME[$record->country_code][$record->region]) && $record->country_name){
				return $record->country_name;	
			}elseif(empty($record->city) && $GEOIP_REGION_NAME[$record->country_code][$record->region] && $record->country_name){
				return $GEOIP_REGION_NAME[$record->country_code][$record->region].", ".$record->country_name;	
			}elseif($record->city && empty($GEOIP_REGION_NAME[$record->country_code][$record->region]) && $record->country_name){
				return $record->city.", ".$record->country_name;	
			}else{
				return $record->city.", ".$GEOIP_REGION_NAME[$record->country_code][$record->region].", ".$record->country_name;	
			}
		}
	}
	class profile extends db{
		function isFriend($user_id,$friends_id){
			$this->connect();
			$sql=sprintf("SELECT 1 FROM friends WHERE user_id='%d' AND friends_id='%d'",$user_id,$friends_id);
			$sql=mysql_query($sql);
			if(mysql_num_rows($sql)){
				return true;
			}else{
				return false;
			}
		}
		function onRequest($from_userid,$to_userid){
			$this->connect();
			$sql=sprintf("SELECT 1 FROM friendrequest WHERE from_userid='%d' AND to_userid='%d'",$from_userid,$to_userid);
			$sql=mysql_query($sql);
			if(mysql_num_rows($sql)){
				return true;
			}else{
				return false;
			}
		}
		function isRequesting($from_userid,$to_userid){
			$this->connect();
			$sql=sprintf("SELECT 1 FROM friendrequest WHERE from_userid='%d' AND to_userid='%d'",$from_userid,$to_userid);
			$sql=mysql_query($sql);
			if(mysql_num_rows($sql)){
				return true;
			}else{
				return false;
			}
		}
	}
	class notifications extends db{
		function friendrequest($id,$offset=0,$limit=8){
			$this->connect();
			$sql=sprintf("SELECT user.id,user.name,user.img50 FROM user JOIN friendrequest ON user.id=friendrequest.from_userid WHERE friendrequest.to_userid='%d' LIMIT %d,%d",$id,$offset,$limit);
			$sql=mysql_query($sql);
			$a=array();$i=0;
			while($row=mysql_fetch_assoc($sql)){
				$a[$i]['id']	= $row['id'];
				$a[$i]['name']	= $row['name'];
				$a[$i]['pic']	= "/user_images/".$row['img50'];
				$i++;
			}
			return $a;
		}
		function friendRequestCounter($id){
			$this->connect();
			$sql=sprintf("SELECT user.id,user.name,user.img50 FROM user JOIN friendrequest ON user.id=friendrequest.from_userid WHERE friendrequest.to_userid='%d'",$id);
			$sql=mysql_query($sql);
			$i=0;
			while($row=mysql_fetch_assoc($sql)){
				$i++;
			}
			return $i;
		}
		function messagesCounter($ses_id){
			$this->connect();
			$sql=mysql_query("SELECT 1	FROM user_message JOIN user ON user_message.from_userid=user.id 
				WHERE user_message.read='0' AND user_message.to_userid='$ses_id'");
			$i=0;
			while($row=mysql_fetch_assoc($sql)){
				$i++;
			}
			return $i;
		}		
	}	
?>