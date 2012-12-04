<?php 
	include('session.php');
	include('class.php');
	$igb	= new igobig;
	$ses_id	= $_SESSION['id'];
	$acct 	= $igb->get_user_basic_information($ses_id);
	$pic_small = "/user_images/".$acct['picture50'];
	$user_name = $acct['name'];
	$title = "Messages";
	if((isset($_GET['action']) && $_GET['action']=='read') && isset($_GET['id']) && isset($_GET['token'])){
		if(msgExist($_GET['id'],$_GET['token'])){
			$read_message = true;
		}else{
			header("location:/messages.php");
		}
	}
	if(isset($_POST['replyto']) && isset($_POST['replyto_message'])){
		$rtuid	= $_POST['replyto_userid'];		
		$msg	= $_POST['replyto_message'];
		$token	= $_POST['replyto_token'];
		$valid	= true;
		if(empty($msg)){
			$valid = false;
		}
		if($valid){
			db::connect();
			$sql=sprintf("INSERT INTO user_message(from_userid,to_userid,`text`,`token`) VALUES('%d','%d','%s','%s')",
			$ses_id,$rtuid,mysql_real_escape_string($msg),$token);
			mysql_query($sql) or die(mysql_error());
		}
	}
	function msgExist($ck_msgid,$ck_token){
		db::connect();
		$sql=sprintf("SELECT 1 FROM user_message WHERE id='%d' AND token='%s'",$ck_msgid,mysql_real_escape_string($ck_token));
		$sql=mysql_query($sql);
		if(mysql_num_rows($sql)){
			return true;
		}else{
			return false;
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="lib/css/common.css" />
<link rel="stylesheet" type="text/css" href="lib/css/header.css" />
<link rel="stylesheet" type="text/css" href="lib/css/column_left.css" />
<script type="text/javascript" src="lib/js/jquery.min.js"></script>
<title><?php echo $title;?></title>
<script type="text/javascript" src="lib/js/script.js"></script>
<script type="text/javascript" src="lib/js/autoresize.jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	<?php if(!isset($_GET['action'])):?>
	$('#MessageStream').load('/ajax_messages.php');
	<?php endif;//load messages?>
	<?php if(isset($read_message)):?>
	$('#MessageStream').load('/ajax_read_message.php?id=<?php echo $_GET['id'];?>&token=<?php echo $_GET['token'];?>');
	$('#uitxtarea').autoResize({
		onResize : function() {
			$(this).css({opacity:0.8});
		},
		animateCallback : function() {
			$(this).css({opacity:1});
		},
		animateDuration : 300,
		extraSpace : 0
	});
	<?php endif;//js for compose message?>
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
      <div id="homeMessageContainer">
      	<div id="homeMessageHeader"><i class="messageIcon"></i> <span class="messageTxt">Messages</span></div>
        <div id="MessageStream">
        	
        </div>
        <?php if(isset($read_message)):?>
        <div id="composeMessage">
        	<form action="" method="post">
            <input type="hidden" name="replyto" value="true" />
            <input type="hidden" name="replyto_userid" value="<?php echo $igb->get_userid_from_messages($_GET['id']);?>" />
            <input type="hidden" name="replyto_token" value="<?php echo md5(rand(1,99999)+microtime());?>" />
        	<textarea name="replyto_message" rows="3" cols="80" id="uitxtarea"></textarea>
            <div class="clear"></div>
            <div id="composeMessageFooter"><button type="submit">Send</button></div>       
            </form>     
        </div>
        <?php endif;//read?>
      </div>
	</div>    
	<?php include('footer.php');?>
</div>
</body>
</html>