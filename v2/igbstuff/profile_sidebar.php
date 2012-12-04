<div id="pagelet_welcome_box">
    <a href="profile.php<?php echo isset($_GET['id'])?'?id='.$_GET['id']:'';?>" class="uLnk"><img src="<?php echo $p_pic_big;?>" alt="" class="big"/></a>
</div>

<div class="clear"></div>
    
<div id="homeSideNav">
   	<ul class="navUI">
    <?php if(isset($_GET['id'])){$id=$_GET['id'];?>
        <li><a href="/profile.php?id=<?php echo $id;?>&amp;sk=wall">
        	<i class="navIcon iconWall"></i><span class="wrapLnkTxt wrapNewsFeedTxt">Wall</span></a></li>
        <!--// THIS FEATURE IS COMING
        <li><a href="/profile.php?id=<?php echo $id;?>&amp;sk=info">
        	<i class="navIcon iconBasicInfo"></i><span class="wrapLnkTxt">Info</span></a></li>       	
        <li><a href="/profile.php?id=<?php echo $id;?>&amp;sk=photos">
        	<i class="navIcon iconProfilePic"></i><span class="wrapLnkTxt">Photos</span></a></li>
        -->
    	<li><a href="/profile.php?id=<?php echo $id;?>&amp;sk=friends">
        <i class="navIcon iconFriends"></i><span class="wrapLnkTxt wrapFriendsTxt">Friends</span></a></li>
  	<?php }else{?>
    	<li><a href="/profile.php?sk=wall"><i class="navIcon iconWall"></i><span class="wrapLnkTxt wrapNewsFeedTxt">Wall</span></a></li>
        <!--//THIS FEATURE IS COMING
        <li><a href="/profile.php?sk=info"><i class="navIcon iconBasicInfo"></i><span class="wrapLnkTxt">Info</span></a></li>        
        <li><a href="/profile.php?sk=photos"><i class="navIcon iconProfilePic"></i><span class="wrapLnkTxt">Photos</span></a></li>
    	-->
        <li><a href="/profile.php?sk=friends"><i class="navIcon iconFriends"></i><span class="wrapLnkTxt wrapFriendsTxt">Friends</span></a></li>
   	<?php }?>
	</ul>
    
    <div style="clear:both;height:25px;"></div>
    <!--TEMPORARY HIDDEN
    <div class="navHeader">DEFAULT APPLICATION</div>
   	<ul class="navUI">
        <li><a href="http://store.igobig.org"><i class="navIcon icoStore"></i><span class="wrapLnkTxt wrapNewsFeedTxt">IGOBIG STORE</span></a></li>
	</ul>
    -->
</div>