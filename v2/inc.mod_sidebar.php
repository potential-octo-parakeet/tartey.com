<div class="cl colorize" style="clear:left;">
	<div id="info_wrap">
		<a class="l" href=""><img src="<?php echo $SESSIMG;?>" alt="" class="img50"/></a>
		<div class="welcome"><a href=""><?php echo $SESSNAME;?></a></div>            
	</div>
	<div class="quote">&#8220;The quick little brown fox jumps over the lazy dog.&#8221; - <a href="#" class="edit-quote">edit</a></div>
	<div id="notif">
		<ul id="notif_icons">
			<li><a href="messages.php"><i class="ico_msg"></i></a></li>
			<li><a href="friends.php"><i class="ico_frn"></i></a></li>
		</ul>
	</div>
	<div id="friendlist">
		<h2><a href="" title="view all friends">Friends ({CNT_FRNDS})</a></h2>
		<?php include_once('inc.friendlist.php');?>
	</div>
</div>