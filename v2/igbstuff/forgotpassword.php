<?php 
	session_start();
	date_default_timezone_set("UTC");
	if(isset($_SESSION['id'])){header("location:/home.php");}
	include('class.php');	
	$igb = new igobig;
	$current_loc = $igb->location();
	$title = "Recover your account";
	$date = date('F d, Y h:ia');
	if(isset($_POST['recoverAccount']) && $_POST['recoverAccount']==='true'){
		$email = $_POST['email'];
		if($igb->emailExist($email)){
			$errorMessage = "A secret key has been sent to your email.";
			$pic 	= "/user_images/".$igb->get_user_picture_small($email);
			$name 	= $igb->get_user_name($email);
			$valid 	= true;
			//GENERATE NEW TOKEN
			$token	= md5(rand(0,99999)+microtime());
			db::connect();
			mysql_query("UPDATE user SET token='$token' WHERE email='$email'");
			//EMAIL USER
			$token	= $igb->get_user_token($email);
			$header	= "From: TARTEY.COM <security@tartey.com>\r\n";
			$header.= "content-type: text/html\r\n";
			$message= "Hello $name,<br/><br/>";
			$message.= "You recently requested us to reset your password.<br/><br/>";
			$message.= "Your secret key is: $token<br/><br/>";
			$message.="If you&rsquo;re having trouble entering the secret key, please ";
			$message.="click this link<br/>http://".$_SERVER['HTTP_HOST']."/forgotpassword.php?retrieveAccount=true&email=$email&secret_key=$token";
			$message.="<br/><br/>";
			$message.="The request was made on $date PST at $current_loc";
			$message.="<br/><br/>Best regards,<br/>";
			$message.="TARTEY.COM";
			//mail($email,$subject="Reset your password",$message=stripslashes($message),$headers=$header);
                        $subject="Reset your password";
                        $message=stripslashes($message);
                        $headers=$header;
                        include_once('api.mailer.php');

		}else{
			$errorMessage = "Please enter a valid email address.";
		}
	}
	if(isset($_REQUEST['retrieveAccount']) && $_REQUEST['retrieveAccount']==='true' && isset($_REQUEST['email'])){
		$email = $_REQUEST['email'];
		
		if($igb->emailExist($email)){			
			$pic 	= "/user_images/".$igb->get_user_picture_small($email);
			$name 	= $igb->get_user_name($email);
			$valid 	= true;			
			if((isset($_REQUEST['secret_key']) && $token = $_REQUEST['secret_key']) && strlen($token)==32 && $igb->user_token($email,$token)){
					
				if(isset($_POST['password'])){
					if(strlen($_POST['password'])>5){
						$newpwd = md5($_POST['password']);
						$igb->connect();
						mysql_query("UPDATE user SET password='$newpwd',location='$current_loc' WHERE email='$email'");
						$_SESSION['id'] = $igb->get_user_id($email);
						header("location:/home.php");
					}else{
						$errorMessage = "Please enter your new password. (atleast 6 characters)";
						$set_new_password 	= true;
					}
				}else{
					$successMessage		= "Please set your new password.";
					$set_new_password 	= true;
				}
			}else{
				$errorMessage = "Invalid secret code. Please try again.";
			}
		}else{
			$errorMessage = "Please enter a valid email address.";
		}
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="lib/css/common.css" />
<link rel="stylesheet" type="text/css" href="lib/css/index.css" />
<link rel="stylesheet" type="text/css" href="lib/css/style.css" />
<script type="text/javascript" src="lib/js/jquery.min.js"></script>
<script type="text/javascript" src="lib/js/2011-a.js"></script>
<title><?php echo $title;?></title>
</head>

<body>
<div id="header_wrapper">
	<div id="header">
    	<div id="logo"><h1><a href="/"><img src="lib/images/logo.png" border="0"/></a></h1></div>   
        <div id="login">
        	<form action="login.php" method="post">
            <input type="hidden" name="user" value="true" />
        	<table>
            	<tbody>
                	<tr><td><label>Email</label></td><td><label>Password</label></td><td></td></tr>
                    <tr><td><input type="text" name="email"/></td><td><input type="password" name="password" /></td>
                    <td><button>Log In</button></td></tr>
                    <tr><td>&nbsp;</td><td><a href="/forgotpassword.php">Forgot your password?</a></td></tr>
                </tbody>
            </table>
            </form>
        </div>     
    </div>
</div>
<div id="container">
	<div id="login_form">
    <div id="loginHeader">Recover your account</div>    
    <?php if(isset($errorMessage)):?>
    <div id="loginError"><?php echo $errorMessage;?></div>
    <?php endif;//error message?>
    <?php if(isset($successMessage)):?>
    <div id="successMessage"><?php echo $successMessage;?></div>
    <?php endif;//success message?>
    <div id="reg_form" style="margin:0;">
    <form action="" method="post">
    <?php if(isset($valid)){?>
    <input type="hidden" name="retrieveAccount" value="true" />
    <input type="hidden" name="email" value="<?php echo $email;?>" />
    <?php }else{?>
    <input type="hidden" name="recoverAccount"  value="true" />
    <?php }?>  
    <?php if(isset($token)){?>
    <input type="hidden" name="secret_key"  value="<?php echo $token;?>" />
    <?php }?>          
    <table>
    	<tbody>     
        	<?php if(isset($valid)):?>
        	<tr><td class="labeltxt" valign="top">This is you: </td><td>
            <div id="userAcctWrapper">
            <div class="imgholder"><img src="<?php echo $pic;?>" alt=""/></div>
            <div class="acctholder"><span class="username"><?php echo $name;?></span><br /><?php echo $email;?></div>
            <div class="clear"></div>
            </div>
            </td></tr>	
            <?php if(!isset($set_new_password)):?>
            <tr><td class="labeltxt">Secret Key : </td>            
            <td><input type="text" name="secret_key" class="text" autocomplete="off"/></td></tr>          
            <?php endif;//ask secret code?>  
            <?php endif;//user validation?>
            <?php if(isset($set_new_password)):?>
            <tr><td class="labeltxt">New Password : </td>            
            <td><input type="password" name="password" class="text"/></td></tr>
            <?php endif;//set new password?>
            <?php if(!isset($valid)):?>
            <tr><td class="labeltxt">Your Email : </td>            
            <td><input type="text" name="email" class="text"/></td></tr>
            <?php endif;//not valid?>
            <?php if(isset($set_new_password)):?>
            <tr><td></td><td><button type="submit" class="loginbutton">Login</button>
            <?php else:?>
            <tr><td></td><td><button type="submit" class="retrievebutton">Retrieve</button>
            <span class="createone">or <a href="/register.php">Create an account</a></span>
            <?php endif;//login and retrieve button?>
            </td></tr>
        </tbody>
    </table>
    </form>   	
    </div>
    </div>
</div>
<?php include('footer_public.php');?>
</body>
</html>