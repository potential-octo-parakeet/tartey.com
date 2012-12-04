<?php
	session_start();
	$SESSID = 33;
	include_once('../class.php');
	$_user = new profile;
	function people_umwtk(){
		global $SESSID;
		db::connect();
		$sql=mysql_query("SELECT DISTINCT user.id,user.name,user.img50,user.location 
							FROM user WHERE user.id!='$SESSID' ORDER BY RAND() LIMIT 10");
		$a=array();$i=0;
		while($row=mysql_fetch_assoc($sql)){
			$a[$i]['id']	= $row['id'];
			$a[$i]['uri']	= "profile.php?id=".$row['id'];
			$a[$i]['name']	= stripslashes($row['name']);
			$a[$i]['img']	= "http://tartey.com/user_images/".$row['img50'];
			$a[$i]['addr']	= $row['location'];
			$i++;
		}
		return $a;
	}
?>
<h2 class="head-small">People You May Want To Know</h2>
	<ul class="roster-view">
	<?php foreach(people_umwtk() as $umwtk){?>
		<li>
			<a href="<?php echo $umwtk['uri'];?>" title="<?php echo $umwtk['name'];?>">
           		<img src="<?php echo $umwtk['img'];?>" class="img50 l"/>
        		<div class="name inline-block"><?php echo substr($umwtk['name'],0,30);?><span class="view-profile">View Profile</span></div>
    		</a>
		</li>
	<?php }?>
</ul>