<?php 
	session_start();
	if(isset($_SESSION['id'])){header("location:/home.php");}
	include('class.php');
	$f = new cejas;	
	
	if((isset($_POST['recover']) && $_POST['recover']==='true') && isset($_POST['email'])):
		$email = $_POST['email'];
		$vcode = $_POST['vcode'];
		if($f->emailExist($email)):
			$name	= $f->get_user_name($email);
			$pic	= "/user_images/".$f->get_user_picture_small($email);
			$validE = true;
			if($vcode===$_SESSION['vcode']):
								
				$valid	= "A reset link has been sent to your email.";				
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
<title>Login</title>
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
            <input type="text" name="vcode" autocomplete="off" /><span class="vc"><?php echo $verification;?></span>
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