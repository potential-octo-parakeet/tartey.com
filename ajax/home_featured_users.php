<?php
	include_once('../class.php');
	function featured_users(){
		db::connect();
		$sql = mysql_query("SELECT * FROM user WHERE img50!='small_pic.gif' ORDER BY RAND() LIMIT 10");
		$a=array();$i=0;
		while($row=mysql_fetch_assoc($sql)){
			$a[$i]['uri']	= "http://tartey.com/profile.php?id=".$row['id'];
			$a[$i]['pic'] 	= "http://tartey.com/user_images/".$row['img50'];
			$a[$i]['name']	= $row['name'];
			$a[$i]['nick']	= substr($row['name'],0,8);
			$i++;
		}
		return $a;
	}	
	function user_count(){
		db::connect();
		$sql = mysql_query("SELECT COUNT(1) FROM user");		
		return mysql_result($sql,0);
	}
	
	if(isset($_GET['c'])){
		echo "There are ".number_format(10000+user_count(),0)." people inside.";
	}
?>
<?php if(isset($_GET['u'])){?>
<ul class="grid-view">
<?php foreach(featured_users() as $user){?>
    <li>
		<a href="<?php echo $user['uri'];?>">
        	<img src="<?php echo $user['pic'];?>" alt="" class="img50" title="<?php echo $user['name'];?>"/>
       		<div class="name"><?php echo substr($user['name'],0,8);?></div>
		</a>
	</li>
<?php }?>
</ul>
<?php }?>

<?php 
if(isset($_GET['json'])){
	echo json_encode(featured_users());
}
?>