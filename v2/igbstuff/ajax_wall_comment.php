<?php 
	include('class.php');
	$nf = new newsfeed;
	if(isset($_GET['id'])){
		$wall_id = $_GET['id'];
?>
<script type="text/javascript">$(document).ready(function(){$(".ui-comment-date").timeago();});</script>
<style type="text/css">.ui-comment-date{color:#AAA;margin-top:7px;}</style>
<?php foreach($nf->wall_message_comment($wall_id,10) as $c){?>
	<div class="ui-data-comment-wrapper">
    	<a href="/profile.php?id=<?php echo $c['user_id'];?>"><img src="<?php echo $c['picture'];?>" class="comment-user-image"/> </a>       
    	<span class="comment-content">
        <a href="/profile.php?id=<?php echo $c['user_id'];?>" class="username"><?php echo $c['user_name'];?></a> 
		<?php echo stripslashes(nl2br(htmlentities($c['comment'],ENT_QUOTES)));?>
        <div class="ui-comment-date" title="<?php echo $c['date'];?>"></div></span>             
        <div class="clear"></div>
   	</div>
<?php }//end of comment?>     
<?php }//end of if?>