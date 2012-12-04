<?php 
	session_start();
	isset($_GET['pid']) ? $pid=$_GET['pid'] : $pid = $_SESSION['id'];
	include('class.php');
	$igb = new igobig;
	if(isset($_POST['offset']) && isset($_POST['limit'])){
		$offset = $_POST['offset'];
		$limit 	= $_POST['limit'];
	}else{
		$offset = 0;
		$limit	= 10;
	}
?>
<script type="text/javascript">
$(document).ready(function(){
	$('.removeButton').click(function(){
		$.post('/ajax_request.php',{removefriend:true,user_id:this.id});
		$('#friendlist_'+this.id).fadeOut();
	});
});
</script>
<?php foreach($igb->friends($pid,$offset,$limit) as $count=>$row){?>
<div class="friendsContainer" id="friendlist_<?php echo $row['id'];?>">
	<a href="/profile.php?id=<?php echo $row['id'];?>"><img src="<?php echo $row['pic'];?>" class="userImage"/></a>
	<div class="userData">
		<span><a href="/profile.php?id=<?php echo $row['id'];?>" class="username"><?php echo $row['name'];?></a></span>
		<div class="right hide"><button type="button" class="removeButton" id="<?php echo $row['id'];?>">Remove</button></div>
	</div>
	<div class="clear"></div>
</div>
<?php }//end of friends?>
<?php if(!isset($count)){?>
<div class="friendsContainer">No friends yet.</div>
<?php }?>