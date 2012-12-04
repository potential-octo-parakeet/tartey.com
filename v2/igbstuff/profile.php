<?php 
	include('session.php');	
	include('class.php');
	$igb	= new igobig;
	$account= new profile;
	if(isset($_GET['id']) && $igb->user_id_exist($_GET['id'])){
		$p_id = $_GET['id'];
	}//PARAM USER ID
	else{
		$p_id = $_SESSION['id'];
	}
	$ses_id		= $_SESSION['id'];	
	$acct		= $igb->get_user_basic_information($ses_id);
	$pic_small 	= "/user_images/".$acct['picture50'];
	$pic_big   	= "/user_images/".$acct['picture180'];
	$user_name 	= $acct['name'];	
	$profile	= $igb->get_user_basic_information($p_id);
	$p_name		= $profile['name'];
	$p_pic_big	= "/user_images/".$profile['picture180'];
	$p_pic_small= "/user_images/".$profile['picture50'];
	$p_user		= $igb->get_profile_summary_info($p_id);
	$page_title	= $p_name;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="lib/css/common.css" />
<link rel="stylesheet" type="text/css" href="lib/css/header.css" />
<link rel="stylesheet" type="text/css" href="lib/css/column_left.css" />
<link rel="stylesheet" type="text/css" href="lib/css/column_right.css" />
<link rel="stylesheet" type="text/css" href="lib/css/profile.css" />
<script type="text/javascript" src="lib/js/jquery.min.js"></script>
<script type="text/javascript" src="lib/js/jquery-ui.min.js"></script>
<title><?php echo $page_title;?></title>
<script type="text/javascript" src="lib/js/autoresize.jquery.min.js"></script>
<script type="text/javascript" src="lib/js/script.js"></script>
<script type="text/javascript">
var p_id = <?php echo $p_id;?>;
var offset_val = 0;
var newcomment = <?php $igb->last_wall_row();?>;
$(document).ready(function(){	
	<?php if(!isset($_GET['sk']) || (isset($_GET['sk']) && $_GET['sk']==='wall')){?>
	$("#feedStreaming").load('/ajax_profile_newsfeed.php?pid='+p_id);	
	setInterval(function(){$.get('/ajax_feed_notifier.php',function(response){if(newcomment!=response){
	$('#feedStreaming').load('/ajax_profile_newsfeed.php?pid='+p_id);}newcomment=response;});},5000);
		
	$('#poststatus_form').submit(function(){
		var txtarea = $('#UItxtArea');
		if(txtarea.val()!=''){
		$.post('/ajax_request.php',$(this).serialize(),function(response){txtarea.val('');$('#feedStreaming').load('ajax_profile_newsfeed.php?pid='+p_id);});
		}else{
			txtarea.focus();
		}
		return false;
	});	
	
	$('#UItxtArea').autoResize({
		onResize : function() {
			$(this).css({opacity:0.8});
		},
		animateCallback : function() {
			$(this).css({opacity:1});
		},
		animateDuration : 300,
		extraSpace : 0
	});
	<?php }//end js wall condition?>	
	<?php if(isset($_GET['sk']) && $_GET['sk']==='friends'){//if sk friends?>
	var limit_val = 0;
	var offset_val = 0;
	$('#friendlistContainer').load('/ajax_user_friendlist.php?pid='+p_id);	
	$(document).scroll(function(){
		$('#loadMoreResults').appear(function(){
			limit_val += 10;
			offset_val +=10;
			$.post('/ajax_user_friendlist.php?pid='+p_id,{offset:offset_val,limit:limit_val},function(response){$('#friendlistContainer').append(response);})
		});
	});
	$('#jQfriendsLoading').ajaxStart(function(){
		$(this).show();
	}).ajaxStop(function(){
		$(this).hide();
		$(this).unbind();
	});
	<?php }//end of sk friends?>
	
	$('#addfriendbutton').click(function(){
		$(this).hide();
		$.post('/ajax_request.php',{friendrequest:true,user_id:p_id});		
		$('#friendrequestbutton').show();
	});
	$('#confirmfriendbutton').click(function(){
		$(this).hide();
		$.post('/ajax_request.php',{addfriend:true,user_id:p_id});
		$('#friendsbutton').show();
	});
	$('#people_umk').load('ajax_people_umk.php');
	setInterval(function(){$('#people_umk').load('ajax_people_umk.php')},60000);
});
</script>
</head>

<body>
<div id="headerContainer">
<?php //include('header.php');?>
</div>
<div id="container">
	<div class="leftCol" id="leftNavContainerProfile">
    <?php include('profile_sidebar.php');?>
	</div>
	<div class="rightCol rightContainer">
    	<div class="left mainContainer">
        <?php if(!isset($_GET['sk']) || (isset($_GET['sk']) && $_GET['sk']==='wall')){?>
        	<div id="uiComposerContainer">
            	<h1 id="profileName"><?php echo $p_name;?></h1>
                <div id="user-info">
                 <?php if($p_user['location']){?>
                 <span class="infoline"><i class="ico satteline"></i>Located at <?php echo $p_user['location'];?></span>
				 <?php }//location?>
                 <?php if($p_user['birthday']){?>
               	 <span class="infoline"><i class="ico birthday"></i>Born on <?php echo $p_user['birthday'];?></span>
                 <?php }//birthday?>
                </div>
                <div id="newsfeedHeader">
                    <div class="updateStatus"><i class="statusIcon"></i><span class="statusTxt">Update Status</span></div>
                </div>
               <div id="messageContainer">
                	<form action="" method="post" id="poststatus_form">
                    <input type="hidden" name="wallmessage" value="true" />
                    <input type="hidden" name="to_userid" value="0" />
                	<div class="txtAreaUI">                    
                    	<textarea class="txtArea" id="UItxtArea" name="text"></textarea>                    
                    </div>
                    <div id="uiComposerFooter">  
                    	<span class="right"><button type="submit">Post</button></span>                  
                    </div>
                    </form>
                </div>                
        	</div>
            
            <div id="UIStream">
            	<div class="StreamHeader">RECENT POSTS</div>
                <div id="feedStreaming"></div>
            </div>
       	<?php }//end sk wall condition?>	
        
        
        <?php if(isset($_GET['sk']) && $_GET['sk']==='friends'){?>
        <div id="friendListHeader"><?php echo $p_name;?> &nbsp;<img src="lib/images/arrowPointRight.png">&nbsp; Friends</div>
        	<div id="friendlistContainer">
            	
            </div>
            <div id="jQfriendsLoading"><img src="lib/images/GsNJNwuI-UM.gif"/></div>
            <div id="loadMoreResults"></div>
        <?php }//end sk friends condition?>
        </div>
        <div class="right eventsContainer">
        	<?php if(isset($p_id) && $p_id!=$ses_id){?>
        	<div id="buttonsWrapper">
            <?php if(!$account->isRequesting($p_id,$ses_id)){?>
            <?php if(!$account->onRequest($ses_id,$p_id)){?>
            <?php if($account->isFriend($ses_id,$p_id)){?>
            <button type="button" id="friendsbutton" class="button">Friends</button>
            <?php }else{?>
            <button type="button" id="addfriendbutton" class="button">Add Friend</button>
            <button type="button" id="friendrequestbutton" class="button hide">Friend Request</button>
			<?php }//end of isFriend?>
           	<?php }else{?>
            <button type="button" id="friendrequestbutton" class="button">Friend Request</button>
            <?php }//end of onRequest?>
            <?php }else{//check if profile is friend requesting?>
            <button type="button" id="confirmfriendbutton" class="button">Accept Button</button>
            <button type="button" id="friendsbutton" class="button hide">Friends</button>
            <?php }//accept button if friend requesting?>
            <button type="button" id="messagebutton" class="button">Message</button>            
            </div>
            <?php }//check if profile is you?>     
            
            <div class="column_right_box_wrapper" id="people_umk">
            	<?php //include('ajax_people_umk.php');?>
            </div>          
            <div class="clear" style="height:50px;"></div>       
        </div>        
	</div>   
    <div class="clear"></div>
	<?php include('footer.php');?>
</div>
</body>
</html>