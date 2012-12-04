<?php 
	session_start();
	if(isset($_SESSION['id'])){header("location:/home.php");}
	include('class.php');
	$igb = new igobig;
	$title = "Login";
	
	if(isset($_POST['password'])){
		$password = $_POST['password'];
	}
	if(isset($_SESSION['password'])){
		$password = $_SESSION['password'];
	}
	
	if((isset($_REQUEST['user']) && $_REQUEST['user']==='true') && isset($_REQUEST['email'])):
		$email = $_REQUEST['email'];
		if($igb->emailExist($email)):
			$name	= $igb->get_user_name($email);
			$pic	= "/user_images/".$igb->get_user_picture_small($email);
			$valid	= true;		
			if(isset($password)):	
				if($igb->user_login($email,$password)){
					$_SESSION['id'] = $igb->get_user_id($email);
					header("location:/home.php");
				}else{
						$passwordError = true;
				}
			endif;//setting password
		else:
			$emailError = true;
		endif;//email exist
	endif;//param user and email
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="lib/css/common.css" />
<link rel="stylesheet" type="text/css" href="lib/css/index.css" />
<link rel="stylesheet" type="text/css" href="lib/css/style.css" />
<script type="text/javascript" src="lib/js/script.js"></script>
<title><?php echo $title;?></title>
<style type="text/css">.betaSign{font-size:42px;position:absolute;margin-top:-60px;font-weight:bold;color:#E6E6EC;margin-left:180px;}</style>
</head>

<body>
<div id="header_wrapper">
	<div id="header">
    	<div id="logo"><h1><a href="/"><img src="lib/images/logo.png" border="0" /></a></h1></div>        
    </div>
</div>
<div id="container">
	<div id="login_form">
    <div id="loginHeader">Login</div>
    <?php if(isset($_GET['session_timeout']) && !isset($passwordError)):?>
    <div id="loginError">
        <h3>Your session has timeout.</h3>
        <p>Please enter your password to login back.</p>
    </div>
    <?php endif;//session timeout?>
    <?php if(isset($passwordError)):?>
    <div id="loginError">
        <h3>Please re-enter your password</h3>
        <p>The password you entered is incorrect. Please try again (please check your caps lock).</p>
        <p>Forgot your password? <a href="forgotpassword.php">Request a new one.</a></p>
    </div>
    <?php endif;//password error?>
    <?php if(isset($emailError)):?>
    <div id="loginError">
        <h3>Please re-enter your e-mail address</h3>
        <p>The email you entered is incorrect. Please try again.</p>
    </div>
    <?php endif;//password error?>
    <form action="" method="post">
    <input type="hidden" name="user"  value="true" />
    <table>
    	<tbody>
        	<?php if(isset($valid)):?>
        	<tr><td class="label" valign="top">Login as: </td><td>
            <div id="userAcctWrapper">
            <div class="imgholder"><img src="<?php echo $pic;?>" alt=""/></div>
            <div class="acctholder"><span class="username"><?php echo $name;?></span><br /><?php echo $email;?><br /><br /><a href="/login.php">Not You?</a></div>
            <div class="clear"></div>
            </div>
            <input type="hidden" name="email" value="<?php echo $email;?>" />
            </td></tr>
            <?php else:?>
            <tr><td class="label">Email: </td><td><input type="text" name="email" class="inputxt" /></td></tr>
            <?php endif;//login new user?>
            <tr><td class="label">Password: </td><td><input type="password" name="password" class="inputxt" /></td></tr>
            <tr><td></td><td><button type="submit" class="loginbutton">Login</button>
            <span class="createone">or <a href="/register.php">Create an account</a></span></td></tr>
            <tr><td></td><td><a href="/forgotpassword.php">Forgot your password?</a></td></tr>
        </tbody>
    </table>
    </form>
    </div>
</div>
<?php include('footer_public.php');?>
</body>
</html>