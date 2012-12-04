<?php
	include('session.php');
	include('global_vars.php');
	$sk			= isset($_GET['sk']) ? $_GET['sk'] : 'all';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Games</title>
<link rel="stylesheet" type="text/css" href="css/header.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/dialog.css" />
<link rel="stylesheet" type="text/css" href="css/120520111355.css" />
<script type="text/javascript">
	var AUSER = {"uid":<?php echo isset($_REQUEST['id'])?$_REQUEST['id']:$_SESSION['id'];?>,"email":"<?PHP echo $SESS['email'];?>"};
</script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/global.js"></script>
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
    <?php include_once('inc.games_subnav.php');?>
    <?php switch($sk){
		case 'all' : include_once('inc.games_list.php');break;
		case 'submit' : include_once('inc.games_submit.php');break;
		default 	 : include_once('inc.games_list.php');break;
	}?>
  </div>
</div>
</body>
</html>