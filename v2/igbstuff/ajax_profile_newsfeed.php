<?php 
	include('session.php');
	include('class.php');
	$nf = new newsfeed;
	if(isset($_GET['pid'])){
		$pid=$_GET['pid'];
	}
	$igb	= new igobig;
	$ses_id	= $_SESSION['id'];
	$igb->connect();
	$sql = mysql_query("SELECT user.id,user.name,user.picture50,wall_message.context,wall_message.id AS 'wall_id',
	DATE_FORMAT(CONVERT_TZ(wall_message.`timestamp`,'+00:00','-02:00'),'%M %d at %h:%i%p') AS 'date' FROM wall_message 
	JOIN user ON wall_message.from_userid=user.id WHERE user.id='$pid' ORDER BY wall_message.id DESC limit 0,30");
?>
<script type="text/javascript">
$(document).ready(function(){
	$('.ui-comment-box').focus(function(){
		if($(this).val()=='Write a comment...'){
			$(this).val('')
		}
	});
	$('.ui-comment-box').blur(function(){
		if($(this).val()==''){
			$(this).val('Write a comment...')
		}
	});
	$('.post-comment').submit(function(){
		var wall_id = $(this).attr('id').replace('post_comment_','');;
			wall_id = parseInt(wall_id);
			$.post('ajax_request.php',$(this).serialize(),function(){
				$.get('ajax_wall_comment.php',{id:wall_id},function(response){$("#wall"+wall_id).html(response);});				
			});
			$('#comment-id-'+wall_id).val('');
		return false;
	});
	$('.action-comment').click(function(){
		var n = this.id
			n = n.replace('comment','');
			n = parseInt(n);
		$('#comment-box-'+n).toggle();
		return false;
	});
	$('.action-cool').click(function(){
		var n = this.id
			n = n.replace('cool','');
			n = parseInt(n);
			$.post('ajax_request.php',{action_cool:'true',msg_id:n});
			$(this).attr('style','color:#aaa;cursor:default;text-decoration:none;');
			return false;
	});
	$('.action-uncool').click(function(){
		var n = this.id
			n = n.replace('cool','');
			n = parseInt(n);
			$.post('ajax_request.php',{action_uncool:'true',msg_id:n});
			$(this).attr('style','color:#aaa;cursor:default;text-decoration:none;');
			return false;
	});
})
function load_action_data(id){
	$('#action-num-'+id).load('ajax_action.php?id='+id);
}
function load_wall_data(id){
	$('#wall'+id).load('ajax_wall_comment.php?id='+id);
}
</script>
<?php while($row=mysql_fetch_assoc($sql)){?>
<div class="dataContainer">
    <a href="/profile.php?id=<?php echo $row['id'];?>"><img src="<?php echo "/user_images/".$row['picture50'];?>" class="dataUserImage" alt=""/></a>
   	<div class="dataTextMessages">
    	<span class="username"><a href="/profile.php?id=<?php echo $row['id'];?>" class="username"><?php echo $row['name'];?></a></span>
        <span class="userstatus"></span>
        <div style="padding-left:2px;"><?php echo stripslashes(nl2br(htmlentities($row['context'],ENT_QUOTES)));?></div>
        <div style="padding-left:2px;margin-top:12px;color:#aaa;"><?php echo $row['date'];?> PST</div>
        <div class="ui-action-wrapper">
        <?php if($nf->action_cool_user($ses_id,$row['wall_id'])){?>
        <a href="" class="action-uncool" id="cool<?php echo $row['wall_id'];?>">Uncool</a> &middot; 
        <?php }else{?>
        <a href="" class="action-cool" id="cool<?php echo $row['wall_id'];?>">Cool</a> &middot; 
        <?php }?>
        <a href="" class="action-comment" id="comment<?php echo $row['wall_id'];?>">Comment</a>
        </div>
        <div class="ui-comment-box-wrapper<?php if(!$nf->wall_has_comment($row['wall_id'])){echo ' hide';}?>" id="comment-box-<?php echo $row['wall_id'];?>">
        	<div class="ui-comment-box-wrapper-arrow"></div>
            <div class="ui-data-comment-wrapper action-wrapper<?php echo $nf->wall_cool($row['wall_id'])?'':' hide';?>" id="action-num-<?php echo $row['wall_id'];?>">
			<script>load_action_data(<?php echo $row['wall_id'];?>);</script></div>
            <div class="ui-data-comment-wrapper">
            	<form action="" method="post" class="post-comment" id="post_comment_<?php echo $row['wall_id'];?>">
                <input type="hidden" name="post_comment" value="true" />
                <input type="hidden" name="wall_id" value="<?php echo $row['wall_id'];?>" />                
            	<input type="text" name="comment" class="ui-comment-box" value="Write a comment..." autocomplete="off" id="comment-id-<?php echo $row['wall_id'];?>"/>     
            	</form>
            </div>
            <div id="wall<?php echo $row['wall_id'];?>"><script>load_wall_data(<?php echo $row['wall_id'];?>);</script></div>			
    	</div>
    </div>
	<div class="clear"></div>
</div>
<?php }?>