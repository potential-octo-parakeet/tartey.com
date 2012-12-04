<?php 
	session_start();
	if(isset($_SESSION['id'])){header("location:/home.php");}
	include('class.php');
	$f = new cejas;

	if(isset($_POST['password'])){
		$password = $_POST['password'];
	}
	if(isset($_SESSION['password'])){
		$password = $_SESSION['password'];
	}
	
	if((isset($_REQUEST['user']) && $_REQUEST['user']==='true') && isset($_REQUEST['email'])):
		$email = $_REQUEST['email'];
		if($f->emailExist($email)):
			$name	= $f->get_user_name($email);
			$pic	= $f->get_user_picture_small($email);
			$valid	= true;		
			if(isset($password)):	
				if($f->login($email,$password)){
					$_SESSION['id'] = $f->get_user_id($email);
					header("location:home.php");
				}else{
					$passwordError = true;
				}
			endif;//setting password
		else:
			$emailError = true;
		endif;//email exist
	endif;//param user and email
	
	if(isset($_GET['timeout']) && $_GET['timeout']==='true'):$SESSTIMEOUT=true;endif;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/public.css" />
<title>Login</title>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/pub-dec-06-2011-01-22-pm.js"></script>
</head>

<body>
<?php include_once('inc.public_header.php');?>

<div class="login_form">
	<h2 class="heading-text">Login</h2>
    <?php if(isset($emailError)):?>
    <div class="error">
    	<h3>Please re-enter your e-mail address</h3>
        <p>The email you entered is incorrect. Please try again.</p>
    </div>
    <?php endif;//$emailError?>
    <?php if(isset($passwordError)):?>
    <div class="error">
        <h3>Please re-enter your password</h3>
        <p>The password you entered is incorrect. Please try again (please check your caps lock).</p>
        <p>Forgot your password? <a href="forgotpassword.php">Request a new one.</a></p>
    </div>
    <?php endif;//$passwordError?>
     <?php if(isset($SESSTIMEOUT) && !isset($passwordError)):?>
    <div class="error">
        <h3>Your session has timed out.</h3>
        <p>Please enter your password to login back.</p>
    </div>
    <?php endif;//$SESSTIMEOUT?>
    
    <form action="" method="post">
    <input type="hidden" name="user" value="true">
    <table class="tabularize">
    	<tbody>
        	<?php if(isset($valid)):?>
        	<tr><td valign="top" align="right"><label>Login as : &nbsp;&nbsp;</label></td><td>
            <div id="userAcctWrapper">
            <div class="imgholder"><img src="<?php echo $pic;?>" alt=""/></div>
            <div class="acctholder"><span class="username"><?php echo $name;?></span><br /><?php echo $email;?><br /><br /><a href="/login.php">Not You?</a></div>
            <div class="clear"></div>
            </div>
            <input type="hidden" name="email" value="<?php echo $email;?>" />
            </td></tr>
            <?php else:?>
            <tr><td align="right"><label>Email : &nbsp;&nbsp;</label></td><td><input type="text" name="email"/></td></tr>
            <?php endif;//$valid?>
      		<tr><td align="right"><label>Password : &nbsp;&nbsp;</label></td><td><input type="password" name="password"></td></tr>
            <tr><td></td><td>
            <div class="option_wrapper">
            <button type="submit" class="loginbutton">Login</button>
            &nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;<a href="/register.php">Create an account</a>
            </div></td></tr>
            <tr><td></td><td><a href="/forgot_password.php">Forgot your password?</a></td></tr>
        </tbody>
    </table>
    </form>
</div>
<?php include_once('inc.public_footer.php');?>
</body>
</html>