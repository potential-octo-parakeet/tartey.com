<?php
	include 'facebook_config.php';	
	include 'db.php';
	$db = new db;
	$user = $facebook->getUser();//get user id
	$fb = $facebook->api('/me');
	$fb_fname = $fb['first_name'];
	$fb_lname = $fb['last_name'];
	$fb_name = $fb['name'];
	$fb_email = $fb['email'];
	$fb_img = "http://graph.facebook.com/$user/picture";
	$fb_gender = ucfirst($fb['gender']);
	$fb_bday = date('Y-m-d',strtotime($fb['birthday']));
	$fb_pass = md5($_SESSION['fb_252337718167395_access_token']);
	$location = "Connected via Facebook";
	$ip_addr = $_SERVER['REMOTE_ADDR'];
	if($user):
		try{
			$db->connect();
			$sql = mysql_query("SELECT id FROM user WHERE fb_id='$user'");
			if(!mysql_num_rows($sql)){				
				$sql = sprintf("INSERT INTO user(fb_id,firstname,lastname,name,birthday,gender,email,password,img50,location,regipaddress)
							 	VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",$user,$fb_fname,$fb_lname,$fb_name,$fb_bday,
								$fb_gender,$fb_email,$fb_pass,$fb_img,$location,$ip_addr);
				mysql_query($sql);
			}
			$sql = mysql_query("SELECT id FROM user WHERE email='$fb_email'");
			$_SESSION['id'] = mysql_result($sql,0);
			header("location:home.php");
			$logoutURL = $facebook->getLogoutUrl(array('next'=>'http://0.tartey.com/'));
		}catch(FacebookApiException $e){
			$user = null;
		}
	endif;
?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>Facebook => Tartey Migration</title>
    <style>
      body {
        font-family: 'Lucida Grande', Verdana, Arial, sans-serif;
      }
      h1 a {
        text-decoration: none;
        color: #3b5998;
      }
      h1 a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <h1>Welcome to Facebook => Tartey Migration</h1>
    <?php if ($user): ?>
      <a href="<?php echo $logoutURL; ?>"><img src="http://static.ak.fbcdn.net/rsrc.php/z2Y31/hash/cxrz4k7j.gif"></a>

	<h2>We're currently working on it!</h2>

      <h3>This is you: </h3>
      <img src="https://graph.facebook.com/<?php echo $user; ?>/picture?type=large">
      <div>
	  	Name: <?php echo $fb['name'];?><br/>
        Email: <?php echo $fb['email'];?><br/>
        Birthday: <?php echo $fb['birthday'];?><br/>
	  </div>
    <?php endif ?>
  </body>
</html>