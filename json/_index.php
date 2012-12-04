<?php
	require('../db.php');
	function featured_users(){		
		$db = new db;
		$db->connect();
		$fImg1 = 'small_pic.gif';
		$fImg2 = '9c297f653c3469b0b52a1321aea02acf.gif';
		$fImg3 = 'fec703a89d4b5603443e1dc19721e208.gif';
		$sql   = mysql_query("SELECT * FROM user WHERE img50 NOT LIKE '%$fImg1' AND img50 NOT LIKE '%$fImg2' AND img50 NOT LIKE '%$fImg3' ORDER BY RAND() LIMIT 10");
		$a=array();$i=0;
		while($row=mysql_fetch_assoc($sql)){
			$a[$i]['uri']	= "http://tartey.com/profile.php?id=".$row['id'];
			$a[$i]['img'] 	= $row['img50'];
			$a[$i]['name']	= stripslashes($row['name']);
			$a[$i]['nick']	= ucwords(strtolower(substr(stripslashes($row['name']),0,8)));
			$i++;
		}
		return $a;
	}	
	function user_count(){
		db::connect();
		$sql = mysql_query("SELECT COUNT(1) FROM user");		
		return mysql_result($sql,0);
	}
		
	$json = array();
	$json['total']	= number_format(user_count(),0);
	$json['users']	= featured_users();
	echo json_encode($json);
?>