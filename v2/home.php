<?php
	include_once('session.php');
	include_once('class.php');
	$f = new cejas;
	$SESS		= $f->me($_SESSION['id']);
	$SESSID 	= $SESS['id'];
	$SESSNAME 	= $SESS['name'];
	$SESSIMG	= "http://tartey.com/user_images/".$SESS['img50'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link rel="stylesheet" type="text/css" href="css/header.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/dialog.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript">
$(document).ready(function(){	
	var offset = 0;
	var rowset = 0;	
	setInterval(function(){
		$.get('ajax/qdb.php',{rowset:'true'},function(r){
			if(r!=rowset){
				$('#thread-msgs-wrapper').fadeIn().load('ajax/threads.php');
			}
			rowset=r;
		})
	},5000);
	$('#people_umwtk').load('ajax/people_umwtk.php');
	setInterval(function(){$('#people_umwtk').load('ajax/people_umwtk.php');},60000);
	$('.edit-quote').click(function(){
		$('#ui-dialog').show().load('ajax/quote.php');
		return false;
	});
});
</script>
</head>

<body>
<div id="ui-dialog"><div class="ui-dialog-wrapper"><h2 class="ui-dialog-title">Loading...</h2></div></div>
<?php include_once('inc.header.php');?>
<div id="container" class="cf">
	<?php include_once('inc.mod_sidebar.php');?>
    <div class="cr">
    	<?php include_once('inc.nav.php');?>
        <div class="wrapper">
        	<p>Welcome to slamAdvice.com (now tartey.com). We are now in beta test 2.0 and are making changes and daily updates. 
               We will add some features in the coming weeks. Check back frequently, tell your friends and watch for the release of our 
               Social Network.</p>
           	<p>Enjoy posting and connecting to your friends around the world.</p>
            <p>- TARTEY </p>
        </div>
        <div class="wrapper">
        	<div class="wc l">
            	<h2 class="head-small">What's on your mind?</h2>
                <div id="form-wrapper">
                	<form method="post" action="#" name="post_status">
                    	<input type="hidden" name="post_status" value="true" />
                        <input type="hidden" name="uid" value="<?php echo $SESSID;?>" />
                    	<div id="textarea-wrapper"><textarea cols="2" rows="2" name="status" class="textarea">Write something...</textarea></div>
                        <div id="option-wrapper">
                        	<button type="submit" class="button-post" id="post_button">post</button>
                            <span id="post-throbber">Posting message...</span>
                      	</div>
                	</form>
                </div>
                <div id="threads-wrapper">
                	<h2>Recent Threads</h2>
                    <div id="thread-msgs-wrapper">
                    	
                    </div>
                </div>
            </div>
        	<div class="wr r">
            	<div class="right-block-item">
                	<?php include_once('inc.redeem_mobile_load.php');?>
              	</div>
               	<div class="right-block-item" id="people_umwtk">
                 	<?php //include_once('ajax/people_umwtk.php');?>
         		</div>
            </div>
        </div>    
    </div>
</div>
</body>
</html>