<?php include('class.php');?>



<?php if(isset($_GET['id']) && $msg_id=$_GET['id']){?>
<i class="cool"></i> 
<?php if(count_cool($msg_id)>1){
	echo count_cool($msg_id).' people';
}else{
	$a = count_cool_person($msg_id);
	echo "<a href='/profile.php?id=$a[id]' class='username' style='font-weight:normal;'>$a[name]</a>";
}?> found this cool.
<?php }?>





<?php
	function count_cool($msg_id){
		db::connect();
		$sql=sprintf("SELECT COUNT(id) FROM wall_message_cool WHERE msg_id='%d'",$msg_id);
		$sql=mysql_query($sql);
		return mysql_result($sql,0);
	}
	function count_cool_person($msg_id){
		db::connect();
		$sql=sprintf("SELECT user.id,user.name FROM user JOIN wall_message_cool ON user.id=wall_message_cool.user_id 
					WHERE wall_message_cool.msg_id='%d' LIMIT 1",$msg_id);
		$sql=mysql_query($sql);
		return mysql_fetch_assoc($sql);
	}
?>