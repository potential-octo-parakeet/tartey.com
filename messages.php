<?php
	include('session.php');
	include('global_vars.php');
	$sk			= isset($_GET['sk']) ? $_GET['sk'] : 'inbox';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Messages</title>
<link rel="stylesheet" type="text/css" href="css/header.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/dialog.css" />
<link rel="stylesheet" type="text/css" href="css/120520111355.css" />
<link rel="stylesheet" type="text/css" href="css/messages.css" />
<script type="text/javascript">
	var AUSER = {"uid":"<?php echo isset($_REQUEST['id'])?$_REQUEST['id']:$_SESSION['id'];?>","email":"<?PHP echo $SESS['email'];?>"};
</script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<?PHP if($sk=='inbox'){?>
<script type="text/javascript" src="js/message.inbox.js"></script>
<?PHP }?>
<?PHP if($sk=='compose'){?>
<script type="text/javascript" src="js/message.compose.js"></script>
<?PHP }?>
</head>

<body>
<div id="ui-dialog">
  <div class="ui-dialog-wrapper">
    <h2 class="ui-dialog-title">Loading...</h2>
  </div>
</div>
<?php include_once('inc.header.php');?>
<div id="container" class="cf">
  <?php include_once('inc.mod_sidebar.php');?>
  <div class="cr">
    <?php include_once('inc.nav.php');?>
    <?php include_once('inc.msg_subnav.php');?>
    <?php switch($sk){
		case 'inbox' : include_once('inc.msg_inbox.php');break;
		case 'compose' : include_once('inc.msg_compose.php');break;
		default 	 : include_once('inc.msg_inbox.php');break;
	}?>
  </div>
</div>
</body>
</html>