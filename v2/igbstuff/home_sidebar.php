<?php
	include('session.php');
	include('class.php');
	$igb	= new igobig;
	$ses_id		= $_SESSION['id'];
	$acct 	= $igb->get_user_basic_information($ses_id);
	$pic_small = "/user_images/".$acct['picture50'];
	$user_name = $acct['name'];
?>
<div id="pagelet_welcome_box">
    <a href="profile.php" class="uLnk"><img src="<?php echo $pic_small;?>" alt="" class="square"/></a>
	<span class="uWrap"><a class="uLnk" href="/profile.php"><?php echo $user_name;?></a></span>
</div>

<div class="clear"></div>
    
<div id="homeSideNav">
    <div class="navHeader">FAVORITES</div>
   	<ul class="navUI">
        <li><a href="/"><i class="navIcon iconNewsFeed"></i><span class="wrapLnkTxt wrapNewsFeedTxt">News Feed</span></a></li>
        <li><a href="/messages.php"><i class="navIcon iconMessages"></i><span class="wrapLnkTxt">Messages</span></a></li>
    	<li><a href="/friends.php"><i class="navIcon iconFriends"></i><span class="wrapLnkTxt wrapFriendsTxt">Friends</span></a></li>
	</ul>
    
    <div style="clear:both;height:25px;"></div>
    <!--TEMPORARY HIDDEN FOR ADVERTISING PURPOSE
    <div class="navHeader">DEFAULT APPLICATION</div>
   	<ul class="navUI">
        <li><a href="http://store.igobig.org"><i class="navIcon icoStore"></i><span class="wrapLnkTxt wrapNewsFeedTxt">IGOBIG STORE</span></a></li>
	</ul>
    -->
</div>