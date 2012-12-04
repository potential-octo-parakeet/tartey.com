<?php 
	include('session.php');
	include('class.php');	
	$igb	= new igobig;
	$ses_id	= $_SESSION['id'];
	$acct 	= $igb->get_user_basic_information($ses_id);
	$pic_small = "/user_images/".$acct['picture50'];
	$user_name = $acct['name'];
	$title = "Edit Profile";
	if(!isset($_GET['sk'])){//if no parameter set then redirect to
		header("location:/editprofile.php?sk=basic");
	}	
	if((isset($_POST['sk']) && $_POST['sk']==='picture') && !empty($_FILES['picture']['name'])){//update profile picture
		$path		= dirname(__FILE__)."/user_images/";
		$image		= preg_replace('/ /','',$_FILES['picture']['name']);
		$image_ext	= explode(".",$image);
		$tmp_image	= $_FILES['picture']['tmp_name'];
		$pic50		= md5(date('mdyhis').$ses_id."50").".".$image_ext[1];
		$pic180		= md5(date('mdyhis').$ses_id."180").".".$image_ext[1];
		if(preg_match("/(image\/)/",$_FILES['picture']['type'])){
			include('SimpleImage.php');
			$image = new SimpleImage;			
			$image->load($tmp_image);
			$image->resizeToWidth(180);
			$image->save($path.$pic180);
			$image->resizeTo(50,50);
			$image->save($path.$pic50);		 
			$igb->connect();
			mysql_query("UPDATE user SET picture50='$pic50',picture180='$pic180' WHERE id='$ses_id'");			
		}
	}//update profile profile
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="lib/css/common.css" />
<link rel="stylesheet" type="text/css" href="lib/css/header.css" />
<link rel="stylesheet" type="text/css" href="lib/css/column_left.css" />
<link rel="stylesheet" type="text/css" href="lib/css/jquery-ui.css" />
<script type="text/javascript" src="lib/js/jquery.min.js"></script>
<script type="text/javascript" src="lib/js/jquery-ui.min.js"></script>
<title><?php echo $title;?></title>
<script type="text/javascript" src="lib/js/script.js"></script>
<script type="text/javascript" src="lib/js/autoresize.jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#editProfileBasic').load('editprofile_basic_inc.php');
	$('#editProfilePhotos').load('editprofile_picture_inc.php');	
});
</script>
</head>

<body>
<div id="headerContainer">
<?php //include('header.php');?>
</div>
<div id="container">
	<div class="leftCol" id="leftNavContainerEditProfile">
    <?php //include('editprofile_sidebar.php');?>
	</div>
	<div class="rightCol rightContainer">
    	<div id="editprofileheader"><?php echo $user_name;?> &nbsp;<img src="lib/images/arrowPointRight.png" />&nbsp; Edit Profile</div>    
   		<div id="editprofile">
        <?php if(isset($_GET['sk']) && $_GET['sk']==='basic'):?>
        <div id="editProfileBasic">
        <?php //include('editprofile_basic_inc.php');?>
        </div>
        <?php endif;//edit basic info?>
        
        <?php if(isset($_GET['sk']) && $_GET['sk']==='picture'):?>
        <div id="editProfilePhotos">
        <?php //include('editprofile_picture_inc.php');?>
        </div>
        <?php endif;//edit picture?>
        </div>
    </div>    
	<?php include('footer.php');?>
</div>
</body>
</html>