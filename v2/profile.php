<?php
	include_once('session.php');
	include_once('class.php');
	$f = new cejas;
	$SESS		= $f->me($_SESSION['id']);
	$SESSID 	= $SESS['id'];
	$SESSNAME 	= $SESS['name'];
	$SESSIMG	= "http://tartey.com/user_images/".$SESS['img50'];
	$sk			= isset($_GET['sk']) ? $_GET['sk'] : 'basic';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
<link rel="stylesheet" type="text/css" href="css/header.css" />
<link rel="stylesheet" type="text/css" href="css/common.css" />
<link rel="stylesheet" type="text/css" href="css/dialog.css" />
<link rel="stylesheet" type="text/css" href="css/120520111355.css" />
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
    <?php include_once('inc.profile_subnav.php');?>
    <?php switch($sk){
		case 'basic' : include_once('inc.profile_basic.php');break;
		case 'diary' : include_once('inc.profile_diary.php');break;
		case 'note'	 : include_once('inc.profile_note.php');break;
		case 'edit'	 : include_once('inc.profile_basic.php');break;
		default 	 : include_once('inc.profile_basic.php');break;
	}?>
  </div>
</div>
</body>
</html>