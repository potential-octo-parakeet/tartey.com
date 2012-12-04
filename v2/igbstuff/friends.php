<?php 
	include('session.php');
	include('class.php');
	$igb	= new igobig;
	$ses_id	= $_SESSION['id'];
	$acct 	= $igb->get_user_basic_information($ses_id);
	$pic_small = "/user_images/".$acct['picture50'];
	$user_name = $acct['name'];
	$title	= "Friends";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="lib/css/common.css" />
<link rel="stylesheet" type="text/css" href="lib/css/header.css" />
<link rel="stylesheet" type="text/css" href="lib/css/column_left.css" />
<script type="text/javascript" src="lib/js/jquery.min.js"></script>
<script type="text/javascript" src="lib/js/jquery.appear-1.1.1.min.js"></script>
<title><?php echo $title;?></title>
<script type="text/javascript" src="lib/js/script.js"></script>
<script type="text/javascript" src="lib/js/autoresize.jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var limit_val = 0;
	var offset_val = 0;
	$('#friendlistContainer').load('/ajax_friendlist.php');	
	$(document).scroll(function(){
		$('#loadMoreResults').appear(function(){
			limit_val += 10;
			offset_val +=10;
			$.post('/ajax_friendlist.php',{offset:offset_val,limit:limit_val},function(response){$('#friendlistContainer').append(response);})
		});
	});
	$('#jQfriendsLoading').ajaxStart(function(){
		$(this).show();
	}).ajaxStop(function(){
		$(this).hide();
		$(this).unbind();
	});
});
</script>
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
    	<div class="left mainContainer">
        	<div id="friendListHeader">Friends</div>
        	<div id="friendlistContainer">
            	
            </div>
            <div id="jQfriendsLoading"><img src="lib/images/GsNJNwuI-UM.gif"/></div>
            <div id="loadMoreResults"></div>
        </div>
        <div class="right eventsContainer">
        </div>      
	</div>   
	<?php include('footer.php');?>
</div>
</body>
</html>