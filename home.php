<?php
	include('session.php');
	include('global_vars.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link rel="stylesheet" type="text/css" href="css/header.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/dialog.css" />
<script type="text/javascript">
	var AUSER = {"uid":<?php echo isset($_REQUEST['id'])?$_REQUEST['id']:$_SESSION['id'];?>,"email":"<?PHP echo $SESS['email'];?>"};
</script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/script.index.js"></script>
<script type="text/javascript" src="js/global.js"></script>
</head>

<body>
<div id="ui-dialog"><div class="ui-dialog-wrapper"><h2 class="ui-dialog-title">Loading...</h2></div></div>
<?php include_once('inc.header.php');?>
<div id="container" class="cf">
	<?php include_once('inc.mod_sidebar.php');?>
    <div class="cr">
    	<?php include_once('inc.nav.php');?>
        <div class="wrapper">
        <p>It's been a fun and exciting 2011 and we're looking forward to spending time with family and loved ones as we close out the year.</p>
		<p>We wish you and your family good things now and throughout the upcoming year. Here's to celebrating the holidays with family and 
        friends...</p>
		<p>We wish you and your family Seasons Greetings and Happy New Year!</p>
       	<p>- Tartey.com </p>
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