<?php 
	include('session.php');
	include('class.php');
	$igb	= new igobig;
	$ses_id	= $_SESSION['id'];
	$acct 	= $igb->get_user_basic_information($ses_id);
	$pic_small = "/user_images/".$acct['picture50'];
	$user_name = $acct['name'];
?>
<div id="pagelet_welcome_box">
    <a href="profile.php" class="uLnk"><img src="<?php echo $pic_small;?>" alt="" class="square"/></a>
	<span class="uWrap"><a class="uLnk" href="profile.php"><?php echo $user_name;?></a></span>
</div>

<div class="clear"></div>
    
<div id="homeSideNav">
    <div class="navHeader">EDIT INFORMATIONS</div>
   	<ul class="navUI">
        <li><a href="/editprofile.php?sk=basic"><i class="navIcon iconBasicInfo"></i><span class="wrapLnkTxt wrapNewsFeedTxt">Basic Information</span></a></li>
        <li><a href="/editprofile.php?sk=picture"><i class="navIcon iconProfilePic"></i><span class="wrapLnkTxt">Profile Picture</span></a></li>
	</ul>
</div>