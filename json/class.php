<?php
	include('../db.php');
	class user extends db{
		function details($uid){
			$this->connect();
			$sql = sprintf("SELECT *,CONCAT('http://tartey.com/user_images/',img50) AS img50 FROM user WHERE id='%d'",$uid);
			$sql = mysql_query($sql);
			return mysql_fetch_assoc($sql);
		}
		function outgoing_friends($id,$offset=0,$limit=10){
			$this->connect();
			$sql=sprintf("SELECT u.id,u.name,u.img50 FROM user AS u JOIN friendrequest AS f ON u.id=f.to_userid 
							WHERE f.from_userid='%d' ORDER BY u.id DESC LIMIT %d,%d",$id,$offset,$limit);
			$sql=mysql_query($sql);
			$a=array();$i=0;
			while($row=mysql_fetch_assoc($sql)){
				$a[$i]['uri']	= "http://tartey.com/profile.php?id=".$row['id'];
				$a[$i]['name']	= stripslashes($row['name']);
				$a[$i]['img']	= $row['img50'];
				$a[$i]['nick']	= substr(stripslashes($row['name']),0,8);
				$i++;
			}
			return $a;			
		}
		function incoming_friends($id,$offset=0,$limit=10){
			$this->connect();
			$sql=sprintf("SELECT u.id,u.name,u.img50 FROM user AS u JOIN friendrequest AS f ON u.id=f.from_userid 
							WHERE f.to_userid='%d' ORDER BY id DESC LIMIT %d,%d",$id,$offset,$limit);
			$sql=mysql_query($sql);
			$a=array();$i=0;
			while($row=mysql_fetch_assoc($sql)){
				$a[$i]['uri']	= "http://tartey.com/profile.php?id=".$row['id'];
				$a[$i]['name']	= stripslashes($row['name']);
				$a[$i]['img']	= $row['img50'];
				$a[$i]['nick']	= substr(stripslashes($row['name']),0,8);
				$i++;
			}
			return $a;			
		}
		function friends($id,$offset=0,$limit=10){
			$this->connect();
			$sql=sprintf("SELECT u.id,u.name,u.img50 FROM user AS u JOIN friends AS f ON u.id=f.friends_id WHERE f.user_id='%d'
			 ORDER BY u.name ASC LIMIT %d,%d",$id,$offset,$limit);
			$sql=mysql_query($sql);
			$a=array();$i=0;
			while($row=mysql_fetch_assoc($sql)){
				$a[$i]['uri']	= "http://tartey.com/profile.php?id=".$row['id'];
				$a[$i]['name']	= stripslashes($row['name']);
				$a[$i]['img']	= $row['img50'];
				$a[$i]['nick']	= substr(stripslashes($row['name']),0,8);
				$i++;
			}
			return $a;			
		}
		function friends_in_total($id){
			$this->connect();
			$sql=sprintf("SELECT COUNT(f.id) FROM friends AS f JOIN user AS u ON u.id=f.friends_id WHERE f.user_id='%d'",$id);
			$sql=mysql_query($sql);			
			return mysql_result($sql,0);			
		}
		function total_incoming_request($id){
			$this->connect();
			$sql=sprintf("SELECT COUNT(u.id) FROM user AS u JOIN friendrequest AS f ON u.id=f.from_userid WHERE f.to_userid='%d'",$id);
			$sql=mysql_query($sql);			
			return mysql_result($sql,0);			
		}
		function total_outgoing_request($id){
			$this->connect();
			$sql=sprintf("SELECT COUNT(u.id) FROM user AS u JOIN friendrequest AS f ON u.id=f.to_userid WHERE f.from_userid='%d'",$id);
			$sql=mysql_query($sql);			
			return mysql_result($sql,0);			
		}
	}
?>