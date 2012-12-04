<?php
	session_start();
	if(!isset($_SESSION['id'])){header("location:register.php");}
	include('global_vars.php');
	$sk			= isset($_GET['sk']) ? $_GET['sk'] : 'basic';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?PHP echo $SESS['name'];?></title>
<link rel="stylesheet" type="text/css" href="/css/header.css" />
<link rel="stylesheet" type="text/css" href="/css/common.css" />
<link rel="stylesheet" type="text/css" href="/css/dialog.css" />
<link rel="stylesheet" type="text/css" href="/css/120520111355.css" />
<script type="text/javascript">
	var AUSER = {"uid":<?php echo isset($_REQUEST['id'])?$_REQUEST['id']:$_SESSION['id'];?>,"email":"<?PHP echo $SESS['email'];?>"};
</script>
<script type="text/javascript" src="/js/jquery.min.js"></script>
<script type="text/javascript" src="/js/global.js"></script>
<?php if($sk=='photos'){?>
<link rel="stylesheet" type="text/css" href="/css/colorbox.css" />
<script type="text/javascript" src="/js/jquery.colorbox.js"></script>
<script type="text/javascript" src="/js/profile-photos.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".photo-gallery").live('mouseover',function(){
		$(".photo-gallery").colorbox({rel:'photo-gallery'});
		return false;
	});

<?PHP if($SESSID==$_SESSION['id']){//IF $_GET['id'] IS EQUAL TO SESSION ID THEN DISPLAY THIS JS?>
	$('#delSelected').click(function(){
		$('.selectedImg').each(function(){
			if(this.checked){
				var pid = this.value;
				$.ajax({
					url: 'json/action.php',
					data: {del_photo:true,photo_id:pid},
					type: 'post',
					dataType: 'json',
					success: function(response){
							if(response.result){
								$('#'+pid).fadeOut();
							}else{
								$('#error_msg').html('<span style="float:left">'+response.message+'</span>');
							}
						}
				})
				
			}
		});
		return false;
	});
	$('#makePrimary').click(function(){
		$('.selectedImg').each(function(){
			if(this.checked){
				var pid = this.value;
				$.ajax({
					url: 'json/action.php',
					data: {make_primary:true,photo_id:pid},
					type: 'post',
					dataType: 'json',
					success: function(response){
							if(response.result){
								$('#'+pid).css({'opacity':'.6'});
								$('#error_msg').html('<span style="float:left">'+response.message+'</span>');
							}else{
								$('#error_msg').html('<span style="float:left">'+response.message+'</span>');
							}
						}
				})
				
			}
		});
		return false;
	});
<?PHP }?>
});
</script>
<?php }?>
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
		case 'photos': include_once('inc.profile_photos.php');break;
		case 'diary' : include_once('inc.profile_diary.php');break;
		case 'note'	 : include_once('inc.profile_note.php');break;
		//case 'edit'	 : include_once('inc.profile_edit.php');break;
		default 	 : include_once('inc.profile_basic.php');break;
	}?>
  </div>
</div>
</body>
</html>