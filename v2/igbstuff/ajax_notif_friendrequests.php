<?php 
	session_start();
	$id = $_SESSION['id'];
	include('class.php');
	$notf = new notifications;
?>
<script type="text/javascript">
$(document).ready(function(){
	$('.acceptButton').click(function(){$.post('/ajax_request.php',{addfriend:true,user_id:this.id});$('#reqrow'+this.id).fadeOut();});
	$('.notnowButton').click(function(){$.post('/ajax_request.php',{ignorefriend:true,user_id:this.id});$('#reqrow'+this.id).fadeOut();});
});
</script>
<ul>
	<?php foreach($notf->friendrequest($id) as $count=>$row){?>
	<li>
    	<div class="friendRowContainer" id="reqrow<?php echo $row['id'];?>">
            <a href="/profile.php?id=<?php echo $row['id'];?>"><img src="<?php echo $row['pic'];?>" class="thumbnail-small left" alt=""/></a>
            <span class="left username"><a href="/profile.php?id=<?php echo $row['id'];?>" class="userlink"><?php echo $row['name'];?></a></span>
            <span class="right"><button type="button" class="acceptButton" id="<?php echo $row['id'];?>">Confirm</button><button type="button" class="notnowButton" id="<?php echo $row['id'];?>">Confirm</button></span>
            <div class="clear"></div>
 		</div>
  	</li>    
    <?php }//end friendrequest?>  
</ul>
<?php if(!isset($count)){?>
<div class="noNotif">No new requests.</div>
<?php }//end no id?>