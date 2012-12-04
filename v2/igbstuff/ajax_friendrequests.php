<?php 
	session_start();
	$id = $_SESSION['id'];
	include('class.php');
	$notf = new notifications;
?>
<script type="text/javascript">
$(document).ready(function(){
	$('.acceptButton').click(function(){
		$.post('/ajax_request.php',{addfriend:true,user_id:this.id});
		$('#friendsContainer_'+this.id).fadeOut();
	});
	$('.notnowButton').click(function(){
		$.post('/ajax_request.php',{ignorefriend:true,user_id:this.id});
		$('#friendsContainer_'+this.id).fadeOut();
	});
});
</script>
<?php foreach($notf->friendrequest($id,0,10) as $count=>$row){?>
<div class="friendsContainer" id="friendsContainer_<?php echo $row['id'];?>">
	<a href="/profile.php?id=<?php echo $row['id'];?>"><img src="<?php echo $row['pic'];?>" class="userImage"/></a>
    <div class="userData">
       	<span><a href="/profile.php?id=<?php echo $row['id'];?>" class="username"><?php echo $row['name'];?></a></span>
        <div class="right">
       	<button type="button" class="acceptButton" id="<?php echo $row['id'];?>">Confirm</button>
        <button type="button" class="notnowButton" id="<?php echo $row['id'];?>">Not Now</button>	
      	</div>
    </div>
	<div class="clear"></div>
</div>
<?php }//end friendrequest?>  
<?php if(!isset($count)){?>
<div class="noNotif">No new requests.</div>
<?php }//end no id?>