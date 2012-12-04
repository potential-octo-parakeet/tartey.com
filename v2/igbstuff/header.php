<?php
	include('session.php');
	include('class.php');
	$igb	= new igobig;
	$ses_id		= $_SESSION['id'];
	$acct 	= $igb->get_user_basic_information($ses_id);
	$pic_small = "/user_images/".$acct['picture50'];
	$user_name = $acct['name'];
?>
<script type="text/javascript">
$(document).ready(function(){
	setInterval(function(){$.ajax({url:'session_check.php',success:function(response){if(response){window.location.href='login.php?user=true&email=<?php echo $acct['email'];?>&session_timeout=true'}}})},10000);
	$('#uiComposeNewMessage').click(function(){
		$('#msgDropDown').hide();
		$('#uiComposeMessageContainer').load('/ajax_message_composer.php').show();
		return false;
	});	
	$('#accountNav,#navAccountDropHanger').click(function(){
		$('#friendDropDown,#msgDropDown,#actDropDown,#searchSuggest').hide();
		$('#navAccountDrop').toggle();
		return false;
	});
	$('.navFriendDropDown').click(function(){
		$('#navAccountDrop,#msgDropDown,#actDropDown,#searchSuggest').hide();
		$('#friendDropDown').toggle();
		if($('#friendDropDown').is(':visible')){
			$('#friendRequestsAlert').load('/ajax_notif_friendrequests.php');
		}
		return false;
	});
	$('.navMsgDropDown').click(function(){
		$('#friendDropDown,#navAccountDrop,#actDropDown,#searchSuggest').hide();
		$('#msgDropDown').toggle();
		if($('#msgDropDown').is(':visible')){
			$('#messagesAlert').load('/ajax_notif_messages.php');
		}
		return false;
	});
	$('.navActDropDown').click(function(){
		$('#friendDropDown,#msgDropDown,#navAccountDrop,#searchSuggest').hide();
		$('#actDropDown').toggle();
		if($('#actDropDown').is(':visible')){
			$('#notifAlert').load('/ajax_notif_notifications.php');
		}
		return false;
	});
	$('#search input').focus(function(){
		$('#friendDropDown,#msgDropDown,#actDropDown,#navAccountDrop').hide();
		$(this).val('');	
			
	});
	$('#search input').keyup(function(){
		$('#searchSuggest').show();
		$.ajax({
			url: 'ajax_search.php',
			type: 'post',
			data: $(this).serialize(),
			success: function(response){
				$('#searchSuggest').html(response).show();
				var str=$('#queryString').text();
				var strl = parseInt(str.length);
				if(strl==0){$('#searchSuggest').hide();}
			}
		});
	});	
	$.ajax({
		url: '/ajax_notif_counter.php',
		type: 'get',
		data: {friendrequest: <?php echo $ses_id;?>},
		success: function(response){var r=parseInt(response);if(r!=0){$('.friendRequestCountValue').text(response).show();}}
	});
	$.ajax({
		url: '/ajax_notif_counter.php',
		type: 'get',
		data: {messages: <?php echo $ses_id;?>},
		success: function(response){var r=parseInt(response);if(r!=0){$('.messagesCountValue').text(response).show();}}
	});	
});
</script>
<div id="header_wrapper">
	<div id="header">
    	<div class="leftCol">
        	<h1 id="logo"><a href="/"><img src="lib/images/logo.png" border="0" width="94"/></a></h1>
            <div id="notificationPanel">
            	<ul>
                	<li>
                    	<a href="" class="navFriendDropDown lnk">
                        	<span id="notifFriend" class="navIcon">
                            	<span class="notifCounter friendRequestCountValue">0</span>
                           	</span>
                        </a>
                    	<div class="dropBox" id="friendDropDown">
                        	<div class="boxHolder"><a href="" class="navFriendDropDown"><span class="icon friendIcon"></span></a></div>
                            <div class="boxHead">
                            	<span class="left frTitle">Friend Requests</span><span class="right frTitle"><a href="" class="frLnkFF">Find Friends</a></span>
                                <div class="clear"></div>
                            </div>
                            <div id="friendRequestsAlert">
                            	<div class="jQnotifloading"><img src="lib/images/GsNJNwuI-UM.gif" /></div>
                           	</div>                            
                            <div class="boxFoot">
                            	<a href="/friendrequest.php">See All Friend Requests (<span class="friendRequestCountValue">0</span>)</a>
                            </div>
                        </div>
                    </li>
                    <li>
                    	<a href="" class="navMsgDropDown lnk">
                        	<span id="notifMsg" class="navIcon">
                            	<span class="notifCounter messagesCountValue">0</span>
                           	</span>
                       	</a>
                    	<div class="dropBox" id="msgDropDown">
                        	<div class="boxHolder"><a href="" class="navMsgDropDown"><span class="icon msgIcon"></span></a></div>
                            <div class="boxHead">
                            	<span class="left frTitle">Messages</span><span class="right frTitle">
                                <a href="" class="frLnkFF" id="uiComposeNewMessage">Compose New Message</a></span>
                                <div class="clear"></div>
                            </div>
                            <div id="messagesAlert">
                            	<div class="jQnotifloading"><img src="lib/images/GsNJNwuI-UM.gif" /></div>
                            </div>                            
                            <div class="boxFoot">
                            	<a href="/messages.php">See All Messages (<span class="messagesCountValue">0</span>)</a>
                            </div>
                        </div>
                    </li>
                    <li>
                    	<a href="" class="navActDropDown lnk">
                        	<span id="notifAct" class="navIcon">
                            	<span class="notifCounter" id="notifCountValue">0</span>
                            </span>
                        </a>
                    	<div class="dropBox" id="actDropDown">
                        	<div class="boxHolder"><a href="" class="navActDropDown"><span class="icon actIcon"></span></a></div>
                            <div class="boxHead">
                            	<span class="left frTitle">Notifications</span>
                                <div class="clear"></div>
                            </div>
                            <div id="notifAlert">
                            	<div class="jQnotifloading"><img src="lib/images/GsNJNwuI-UM.gif" /></div>
                            </div>                            
                            <div class="boxFoot">
                            	<a href="">See All Notifications</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="rightCol" id="headnav_wrapper">
        	<div class="left">
            	<form action="" method="post" id="q">
                    <div id="search">
                    <input type="text" name="q" value="Search" autocomplete="off"/>
                    <button type="submit" title="Search">Search</button>
                    </div>              	
                </form>		
           		<div id="searchSuggest">
                	<div id="loadingResults"><img src="lib/images/GsNJNwuI-UM.gif" /></div>
                </div>                
            </div>
        	<div id="topLeftNav" class="right">
            	<ul>
                	<li><a href="/" id="homeNav" class="navLnk">Home</a></li>
                    <li id="navAccount">
                    	<a href="" id="accountNav" class="navLnk">Account <i></i></a>
                        <div id="navAccountDrop">
                        	<div id="navAccountDropHanger"><div id="navAccountDropTxt"><a href="">Account <i></i></a></div></div>
                            <div id="profileImgContainer">
                            	<a href="profile.php"><img src="<?php echo $pic_small;?>" id="profileImg" alt=""/></a>
                                <a href="profile.php" id="navAccountName"><?php echo $user_name;?></a>
                            	<div class="clear"></div>
                           	</div>
                            <ul id="navAccountLinks">
                            	<li><a href="editprofile.php">Edit Profile</a></li>                                
                                <li><a href="/logout.php">Logout</a></li>
                           	</ul>             
                        </div>
                    </li>
                </ul>
        	</div>
        </div>
    </div>
</div>

<div id="uiComposeMessageContainer"></div>