<?php 
	session_start();
	if(isset($_SESSION['id'])){header("location:/home.php");}
	include('class.php');
	$f = new cejas;	
	$domain = $_SERVER['HTTP_HOST'];
	$uri	= $_SERVER['REQUEST_URI'];
	if(isset($_POST['email']) && isset($_POST['secret']) && isset($_POST['token'])):
		$email = $_POST['email'];
		$pass  = $_POST['secret'];
		$token = $_POST['token'];		
		if(isset($_POST['newpwd'])):
			$newpwd = $_POST['newpwd'] ;
			if(CredentialExist($email,$pass,$token)):			
				$user	= $f->forgot_password($email);
				$name	= $user['name'];
				if(strlen($newpwd)>=6):		
					$f->chpwd($email,$newpwd);				
					$_SESSION['id'] = $f->get_user_id($email);
					header("location:home.php");
					$to		= $email;
					$subject= "Your Tartey password sucessfully changed";
					$msg	= "Hi $name,<br/><br/>";
					$msg   .= "You have successfully changed your Tartey password. <br/><br/>";
					$msg   .= "Your new password is: $newpwd<br/><br/>";
					$msg   .= "If you're having trouble with your password, ";
					$msg   .= "don't hesitate to generate new one by visiting http://$domain/forgot_password.php<br/><br/><br/>";
					$msg   .= "Regards,<br/>The Tartey Team";
					$headers= "From: TARTEY.COM <cservice@tartey.com>\r\nContent-type:text/html\r\n";
					mail($to,$subject,$msg,$headers);
				else:
					$error = "Please enter your password atleast 6 characters.";
				endif;//PASSWORD LENGTH
			else:
				$error = "Error: Link has expired or invalid. <a href='forgot_password.php'>Please generate new one here.</a>";
			endif;//CredentialExist();
		else:
			$error = "Error: Please set your new password.";
		endif;//$_POST['newpwd']
	endif;//POST
	
	function CredentialExist($email,$pass,$token){
		db::connect();
		$sql=sprintf("SELECT 1 FROM user WHERE email='%s' AND password='%s' AND token='%s'",
				mysql_real_escape_string($email),mysql_real_escape_string($pass),mysql_real_escape_string($token));
		$sql=mysql_query($sql) or die(mysql_error());
		if(mysql_num_rows($sql)){
			return true;
		}else{
			return false;
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/public.css" />
<title>Set your new password</title>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/pub-dec-06-2011-01-22-pm.js"></script>
</head>

<body>
<?php include_once('inc.public_header.php');?>

<div class="login_form">
	<h2 class="heading-text">Set your new password</h2>
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
    <input type="hidden" name="email" value="<?php echo isset($_GET['e'])?$_GET['e']:'';?>" />
    <input type="hidden" name="secret" value="<?php echo isset($_GET['s'])?$_GET['s']:'';?>" />
    <input type="hidden" name="token" value="<?php echo isset($_GET['t'])?$_GET['t']:'';?>" />
    <table class="tabularize">
    	<tbody>
        	<?php if(isset($_GET['e'])):
					$user = $f->forgot_password($_GET['e']);
			?>
        	<tr><td valign="top" align="right"><label>This is you : &nbsp;&nbsp;</label></td><td>
            <div id="userAcctWrapper">
            <div class="imgholder"><img src="user_images/<?php echo $user['img50'];;?>" alt=""/></div>
            <div class="acctholder">
            	<span class="username"><?php echo $user['name'];?></span></div>
            <div class="clear"></div>
            </div>
            </td></tr>
            <?php endif;?>
      		<tr><td align="right"><label>Password : &nbsp;&nbsp;</label></td>
            <td><input type="password" name="newpwd" autocomplete="off" /></td></tr>
            <tr><td></td><td><button type="submit" style="padding:4px 6px;">Save Password and Continue</button></td></tr>
        </tbody>
    </table>
    </form>
</div>
<?php include_once('inc.public_footer.php');?>
</body>
</html>