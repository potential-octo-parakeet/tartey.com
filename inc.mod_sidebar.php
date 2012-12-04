<div class="cl colorize" style="clear:left;">
	<div id="info_wrap">
		<a class="l" href="profile.php?id=<?php echo $SESSID;?>&sk=photos"><img src="<?php echo $SESSIMG;?>" alt="" class="img50"/></a>
		<div class="welcome">
        	<a href=""><?php echo stripslashes($SESSNAME);?></a>
            <?PHP if($SESSID==$_SESSION['id']){//IF USER $_GET['id'] IS EQUAL TO SESSION ID THEN DISPLAY EDIT PROFILE BUTTON?>
        	<a href="profile.php?sk=photos" class="edit_pic">Edit Picture</a>
            <?PHP }?>
       	</div>       
	</div>
    <?PHP if(!empty($SESSQUOTE)){//IF NOT EMPTY USER QUOTE, DISPLAY QUOTE?>
	<div class="quote">
    	&#8220;<span id="quote-text"><?php echo stripslashes($SESSQUOTE);?></span>&#8221;
    	<?php if($SESSID==$_SESSION['id']){?> - <a href="#" class="edit-quote">edit</a><?php }?>
   	</div>
    <?PHP }?>
    <?PHP if($SESSID==$_SESSION['id']){//IF USER $_GET['id'] IS EQUAL TO SESSION ID THEN DISPLAY THE FF. ICONS?>
	<div id="notif">
		<ul id="notif_icons">
			<li><a href="messages.php"><i class="ico_msg"></i></a></li>
			<li><a href="friends.php?sk=incoming"><i class="ico_frn"></i></a></li>
		</ul>
	</div>
    <?PHP }?>
	<div id="friendlist">
		<h2><a href="friends.php" title="view all friends">
        	Friends (<span id="friends_in_total"><img src="images/throbber-circle.gif"/></span>)
      	</a></h2>
		<ul class="grid-view" id="friends-grid-display"></ul>
	</div>
    
    <div class="ads250px" style="display:none;">
		<img src="images/adsense_185666_adformat-display_250x250_en.jpg" />
	</div>
</div>