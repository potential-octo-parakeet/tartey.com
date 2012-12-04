<?php 
	session_start();
	if(isset($_SESSION['data'])){header("location:/home.php");}
	include('class.php');
	$f = new cejas;	
	$domain = $_SERVER['HTTP_HOST'];
	$uri	= $_SERVER['REQUEST_URI'];
	if((isset($_POST['recover']) && $_POST['recover']==='true') && isset($_POST['email'])):
		$email = $_POST['email'];
		$vcode = $_POST['vcode'];
		if($f->emailExist($email)):
			$f->tokenize($email);
			$user	= $f->forgot_password($email);
			$pic	= $user['img50'];
			$name	= $user['name'];
			$pass	= $user['password'];
			$token	= $user['token'];
			$validE = true;
			if($vcode===$_SESSION['vcode']):								
				$valid	= "A reset link has been sent to your email.";		
				$to		= $email;
				$subject= "Your Tartey password reset link";
				$msg	= "Hi $name,<br/><br/>";
				$msg   .= "You recently asked to reset your Tartey password. To complete your request, please follow this link:<br/><br/>";
				$msg   .= "http://$domain/reset_password.php?e=$email&s=$pass&t=$token<br/><br/>";
				$msg   .= "Regards,<br/>The Tartey Team";
				$headers= "From: Tartey <cservice@tartey.com>\r\nReply-to: support@tartey.com\r\nContent-type:text/html\r\n";
				mail($to,$subject,$msg,$headers);
			else:
				$error = "Please enter the corresponding verification code.";
			endif;//VERIFICATION
		else:
			$error = "The email you entered was not found or not yet registered.";
		endif;//emailExist();
	endif;//param user and email
	$verification = $_SESSION['vcode'] = generate_verification();

	function generate_verification(){
		$char = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';	
		$code =	'';
		for($i=0;$i<6;$i++){
			$code .= $char[rand(0,strlen($char)-1)];
		}
		return $code;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/public.css" />
<title>Reset Password</title>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/pub-dec-06-2011-01-22-pm.js"></script>
</head>

<body>
<?php include_once('inc.public_header.php');?>

<div class="recover_form">
	<h2 class="heading-text">Recover your account</h2>
    <?php if(isset($error)):?>
    <div class="error">
        <p><?php echo $error;?></p>
    </div>
    <?php endif;//$emailError?>  
    
    <?php if(isset($valid)):?>
    <div class="valid">
        <p><?php echo $valid;?></p>
    </div>
    <?php endif;//$emailError?>  
    
    <form action="" method="post">
    <input type="hidden" name="recover" value="true">
    <table class="tabularize">
    	<tbody>
        	<?php if(isset($validE)):?>
        	<tr><td valign="top" align="right"><label>This is you : &nbsp;&nbsp;</label></td><td>
            <div id="userAcctWrapper">
            <div class="imgholder"><img src="<?php echo $pic;?>" alt=""/></div>
            <div class="acctholder">
            	<span class="username"><?php echo $name;?></span><br /><?php echo $email;?><br /><br />
                <a href="/forgot_password.php">Not You?</a></div>
            <div class="clear"></div>
            </div>
            <input type="hidden" name="email" value="<?php echo $email;?>" />
            </td></tr>
            <?php else:?>
            <tr><td align="right"><label>Your Email Address : &nbsp;&nbsp;</label></td><td><input type="text" name="email"/></td></tr>
            <?php endif;//$valid?>
      		<tr><td align="right"><label>Verification Code : &nbsp;&nbsp;</label></td><td>
            <input type="text" name="vcode" autocomplete="off" /><span class="vc"><img src="captcha.php" /></span>
            </td></tr>
            <tr><td></td><td>
            <div class="option_wrapper">
            <button type="submit" class="retrievebutton">Retrieve</button>
            &nbsp;&nbsp;&nbsp;or&nbsp;&nbsp;<a href="/register.php">Create an account</a>
            </div></td></tr>
        </tbody>
    </table>
    </form>
</div>
<?php include_once('inc.public_footer.php');?>
</body>
</html>