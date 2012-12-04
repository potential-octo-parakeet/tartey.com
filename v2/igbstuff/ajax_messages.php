<?php 
	include('session.php');
	$ses_id = $_SESSION['id'];
	include('class.php');
	$igb = new igobig;
?>
<?php foreach($igb->get_messages($ses_id) as $count=>$row){?>
<a href="/messages.php?action=read&id=<?php echo $row['id'];?>&token=<?php echo $row['token'];?>" id="ui-inline-container">
<div class="messageDataUI" id="message_<?php echo $row['id'];?>">
	<img src="<?php echo $row['pic'];?>" class="userImage" alt=""/>
    <div class="messageContainer">
    	<span class="username"><?php echo $row['name'];?></span>
        <div class="usertext" <?php if($row['read']){echo 'style="color:#aaa;"';}?>>
		<?php echo strlen($row['text'])>70 ? htmlentities(substr($row['text'],0,70),ENT_QUOTES).'...' : htmlentities($row['text'],ENT_QUOTES);?>
        <span class="right" style="color:#aaa;"><?php echo $row['date'];?> PST</span>
       	</div>        
   	</div>
    <div class="clear"></div>
</div>
</a>
<?php }//end messages?>