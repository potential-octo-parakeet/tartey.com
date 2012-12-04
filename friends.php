<?php
	include('session.php');
	include('global_vars.php');
	$sk			= isset($_GET['sk']) ? $_GET['sk'] : 'all';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Friends</title>
<link rel="stylesheet" type="text/css" href="css/header.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/dialog.css" />
<link rel="stylesheet" type="text/css" href="css/120520111355.css" />
<link rel="stylesheet" type="text/css" href="css/friends.css" />
<script type="text/javascript">
	var AUSER = {"uid":<?php echo isset($_REQUEST['id'])?$_REQUEST['id']:$_SESSION['id'];?>,"email":"<?PHP echo $SESS['email'];?>"};
</script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/global.js"></script>
<?PHP if($sk=='all'){?>
<script type="text/javascript" src="js/friends.all.js"></script>
<?PHP }?>
<?PHP if($sk=='incoming'){?>
<script type="text/javascript" src="js/friends.in.js"></script>
<?PHP }?>
<?PHP if($sk=='outgoing'){?>
<script type="text/javascript" src="js/friends.out.js"></script>
<?PHP }?>
<script type="text/javascript">
$(function(){
	$.ajax({
		url: 'json/friends.php?count=1',
		dataType: 'json',
		success: function(response){
			$('#f-all').text(response.friends);
			$('#f-incoming').text(response.incoming);
			$('#f-outgoing').text(response.outgoing);
		}
	});
});
</script>
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
    <?php include_once('inc.friends_subnav.php');?>
    <?php switch($sk){
		case 'all' 		: include_once('inc.friends.all.php');break;
		case 'incoming' : include_once('inc.friends.in.php');break;
		case 'outgoing' : include_once('inc.friends.out.php');break;
		default 	 	: include_once('inc.friends.all.php');break;
	}?>
  </div>
</div>
</body>
</html>