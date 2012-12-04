<?php 
	include_once('../session.php');
	include_once('../class.php');
	$nf	= new newsfeed;
	$ses_id	= 0;//$_SESSION['id'];
	if(isset($_GET['offset'])){
		$offset = $_GET['offset'];
	}else{$offset=0;}
?>
<script type="text/javascript" src="../js/jquery.timeago.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.comment-input').focus(function(){
		if($(this).val()=='Write a comment...'){
			$(this).val('')
		}
	});
	$('.comment-input').blur(function(){
		if($(this).val()==''){
			$(this).val('Write a comment...')
		}
	});
	$('.form_post_comment').submit(function(){
		var n = $(this).attr('id').replace('form_comment_','');;
			n = parseInt(n);
		var t = $('#comment_throbber_'+n);
			t.ajaxStart(function(){$(this).show();}).ajaxStop(function(){$(this).hide().unbind();});
			$.post('ajax/post_comment.php',$(this).serialize(),function(){
				$.get('ajax/thread_comment.php',{id:n},function(response){$("#comment_"+n).html(response);});		
			});
			$('#form_comment_'+n+' .comment-input').val('');
		return false;
	});
	$('.action-comment').click(function(){
		var n = this.id
			n = n.replace('a_c_','');
			n = parseInt(n);
		$('#comment-box-'+n).show(1,function(){$('#comment-box-'+n+' .comment-input').val('').focus();});		
		return false;
	});	
	var record = 0;
	setTimeout(function(){$.ajax({url:'ajax/qdb.php?comment_id=true',success:function(r){record=r;}})},100);
	setInterval(function(){
		$.ajax({
			url:'ajax/qdb.php?comment_id=true',
			success:function(a){
				if(a!=record){
					$.ajax({
						url: 'ajax/qdb.php?comment_mid=true',
						success: function(b){
							load_wall_data(b);
							record = a;
						}
					});
				}
			}
		});
	},5000);
	$(".time-ago").timeago();	
})
function load_wall_data(id){
	$('#comment_'+id).load('ajax/thread_comment.php?id='+id);
}
</script>
<ul class="thread-roster-view">
<?php foreach($nf->wall_message($offset) as $row){?>
	<li class="cf">
		<a href="#" class="imgWrapper l"><img src="<?php echo $row['picture'];?>" class="img50" alt=""/></a>
		<div class="dataWrapper">
			<a class="nameWrapper" href="#"><?php echo stripslashes(htmlspecialchars_decode($row['user_name'],ENT_QUOTES));?></a>
			<div class="textWrapper">
				<?php echo nl2br(htmlspecialchars(stripslashes(htmlspecialchars_decode($row['text'],ENT_QUOTES)),ENT_QUOTES));?>
            </div>
			<div class="timeWrapper time-ago" title="<?php echo $row['date'];?>"><!--timeago--></div>
			<h3 class="h3h3Wrapper"><a href="#" class="action-comment" id="a_c_<?php echo $row['wall_id'];?>">Comment</a></h3>                                    
			<div class="ui-comment-box c<?php if(!$nf->wall_has_comment($row['wall_id'])){echo ' hidden';}?>" id="comment-box-<?php echo $row['wall_id'];?>">                           
			<i class="ui-comment-box-arrow"></i>  
            <form action="#" method="post" class="form_post_comment" id="form_comment_<?php echo $row['wall_id'];?>">
            <input type="hidden" name="pid" value="<?php echo $row['wall_id'];?>"/>
			<input type="text" name="comment" class="comment-input" value="Write a comment..." autocomplete="off"/>
            </form>
            <i class="comment-throbber" id="comment_throbber_<?php echo $row['wall_id'];?>" title="posting message..."></i>
			</div>
			<div class="ui-comment-wrapper" id="comment_<?php echo $row['wall_id'];?>">
                <script>load_wall_data(<?php echo $row['wall_id'];?>);</script>
  			</div>
		</div>
	</li>
<?php }?>
</ul>