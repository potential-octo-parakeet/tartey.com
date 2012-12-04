<?php 
	include_once('../session.php');
	include_once('../class.php');
	$nf = new newsfeed;
	if(isset($_GET['id'])){
		$wall_id = $_GET['id'];
?>
<script type="text/javascript">$(document).ready(function(){$(".ui-comment-date").timeago();});</script>
<ul class="ui-comment-text">
<?php foreach($nf->wall_message_comment($wall_id,10) as $c){?>
	<li class="cf">
		<a href="#" class="a32 l"><img src="<?php echo $c['picture'];?>" class="img32" alt=""/></a>
		<div class="ui-comment-text-wrapper l">
        	<a href="#" class="userName"><?php echo stripslashes(htmlspecialchars_decode($c['user_name'],ENT_QUOTES));?></a>
            <?php echo nl2br(htmlspecialchars(stripslashes(htmlspecialchars_decode($c['comment'],ENT_QUOTES)),ENT_QUOTES));?>
		</div>
	</li>
<?php }//end of comment?>     
</ul>
<?php }//end of if?>