<?php 
	include('session.php');
	include('class.php');
	$igb	= new igobig;
	$ses_id		= $_SESSION['id'];
	$acct 	= $igb->get_user_basic_information($ses_id);
	$pic_small = "/user_images/".$acct['picture50'];
	$user_name = $acct['name'];
	$title	= "slamAdvice";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="lib/css/common.css" />
<link rel="stylesheet" type="text/css" href="lib/css/header.css" />
<link rel="stylesheet" type="text/css" href="lib/css/column_left.css" />
<link rel="stylesheet" type="text/css" href="lib/css/column_right.css" />
<script type="text/javascript" src="lib/js/jquery.min.js"></script>
<title><?php echo $title;?></title>
<script type="text/javascript" src="lib/js/script.js"></script>
<script type="text/javascript" src="lib/js/jquery.appear-1.1.1.min.js"></script>
<script type="text/javascript" src="lib/js/autoresize.jquery.min.js"></script>
<script type="text/javascript" src="lib/js/jquery.timeago.js"></script>
<script type="text/javascript">
$(document).ready(function(){	
	var offset_val = 0;
	var newcomment = <?php $igb->last_wall_row();?>;
	$("#feedStreaming").load('/ajax_newsfeed.php?offset=0');
	$('#loadmore').click(function(){
		$('#jQLoading').ajaxStart(function(){$('#loadmore').hide();$(this).show();
		}).ajaxStop(function(){$(this).hide();$('#loadmore').show();$(this).unbind();});
		offset_val +=25;
		$.ajax({
			url: '/ajax_newsfeed.php',
			type: 'get',
			data: {offset:offset_val},
			success: function(response){$('#morefeeds').append(response);}
		});		
	});	
	setInterval(function(){$.get('/ajax_feed_notifier.php',function(response){if(newcomment!=response){
	$('#feedStreaming').load('/ajax_newsfeed.php?offset=0');}newcomment=response;});},5000);	
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
	$('#poststatus_form').submit(function(){
		$('#post_throbber').ajaxStart(function(){$(this).show();}).ajaxStop(function(){$(this).hide().unbind();});
		var txtarea = $('#UItxtArea');
		if(txtarea.val()!=''){
			$.post('/ajax_request.php',$(this).serialize(),function(response){
				txtarea.val('');$('#feedStreaming').load('ajax_newsfeed.php?offset=0');newcomment++;
			});
		}else{
			txtarea.focus();
		}
		return false;
	});		
	$('#closeNotif').click(function(){$('#notificationAlert').fadeOut();return false;});
	$('#text_msgr').load('ajax_text_messenger.php');
	$('#people_umk').load('ajax_people_umk.php');
	setInterval(function(){$('#people_umk').load('ajax_people_umk.php')},120000);
	$('#people_voting').load('ajax_people_voting.php');
	setInterval(function(){$('#people_voting').load('ajax_people_voting.php')},60000);
	$('#ajax_meet_our_boys').load('ajax_meet_our_boys.php');
	setInterval(function(){$('#ajax_meet_our_boys').load('ajax_meet_our_boys.php')},90000);
});
</script>
<style type="text/css">
#notificationAlert{padding:10px;padding-bottom:0px;border-bottom:1px solid #B3B3B3;color:#333;font-size:11px;background:#fdfdfd;}
#closeNotif{text-decoration:none;font-weight:bold;color:#aaa;}
#closeNotif:hover{color:#333;}
</style>
</head>

<body>
<div id="headerContainer">
<?php //include('header.php');?>
</div>
<div id="container">
	<div class="leftCol" id="leftNavContainer">
    <?php //include('home_sidebar.php');?>
	</div>
	<div class="rightCol rightContainer">
    	<!--//NOTIFICATION STARTED-->
    	<div id="notificationAlert">
            <p align="justify">
            	Welcome to slamAdvice.com (now tartey.com). We are currently in Beta Test 1.0 mode and are making changes and daily updates. 
                We will add some features in the coming weeks. 
                Check back frequently, tell your friends and watch for the release of our Social Network.            
          	</p>
            <p>Enjoy posting and connecting to your friends around the world.</p>
            <p>- tartey crews<span class="right"><a href="" id="closeNotif">[close]</a></span></p>
        </div>
        <!--//END OF NOTIF-->
    	<div class="left mainContainer">        	
        	<div id="uiComposerContainer">
                <div id="newsfeedHeader">
                    <div class="updateStatus"><i class="statusIcon"></i><span class="statusTxt">Update Status</span></div>
                    <span id="post_throbber" class="right hidden" style="margin-top:-10px;"><img src="lib/images/GsNJNwuI-UM.gif" /></span>
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
            	<div class="StreamHeader">RECENT THREADS</div>
                <div id="feedStreaming"><span><img src="lib/images/jKEcVPZFk-2.gif" /></span></div>
                <div id="morefeeds"></div>                
                <div id="loadmore">Load More</div>
                <div id="jQLoading"><img src="lib/images/GsNJNwuI-UM.gif"/></div>
            </div>            
        </div>        
        <div class="right eventsContainer">
        	<div class="column_right_box_wrapper" id="text_msgr">
            	<?php //include('ajax_text_messenger.php');?>
            </div>
            <div class="clear"></div>  
        	<div class="column_right_box_wrapper" id="people_voting">
            	<?php //include('ajax_people_voting.php');?>
            </div>        	
            <div class="clear"></div>
            <div class="column_right_box_wrapper" id="ajax_meet_our_boys">
            	<?php //include('ajax_people_voting.php');?>
            </div>        	
            <div class="clear"></div>
        	<div class="column_right_box_wrapper" id="people_umk">
            	<?php //include('ajax_people_umk.php');?>
            </div>
        </div>      
	</div>   
	<?php include('footer.php');?>
</div>
</body>
</html>