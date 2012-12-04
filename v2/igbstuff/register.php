<?php 
	session_start();
	if(isset($_SESSION['id'])){header("location:/home.php");}
	include('class.php');
	$igb = new igobig;
	$title = "Create a slamAdvice account";	
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
<style type="text/css">.betaSign{font-size:42px;position:absolute;margin-top:-60px;font-weight:bold;color:#E6E6EC;margin-left:180px;}</style>
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
    <div id="loginHeader">Create an account</div>    
    <div id="reg_form" style="margin:0;">
    <form action="" method="post" id="createAccount">
    <input type="hidden" name="createAccount"  value="true" />
    <table>
    	<tbody>    
        	<tr><td align="right" class="labeltxt">First Name : </td><td><input type="text" name="firstname" class="text" /></td></tr>
            <tr><td align="right" class="labeltxt">Last Name : </td><td><input type="text" name="lastname" class="text" /></td></tr>    	
            <tr><td align="right" class="labeltxt">Email : </td><td><input type="text" name="email" class="text" /></td></tr> 
            <tr><td align="right" class="labeltxt">Password : </td><td><input type="password" name="password" class="text" /></td></tr>
            <tr><td align="right" class="labeltxt">I am:</td>
                    <td><select name="gender">
                    	<option>Select Sex:</option>
                        <option>Male</option>
                        <option>Female</option>
                        </select>
                    </td></tr>
                    <tr><td align="right" class="labeltxt">Birthday:</td>
                    <td><select name="birthday[m]" style="width:75px;">
                    	<option>Month:</option> 
                        <option value="01">Jan</option> 
                        <option value="02">Feb</option>
                        <option value="03">Mar</option>
                        <option value="04">Apr</option>
                        <option value="05">May</option>
                        <option value="06">Jun</option>
                        <option value="07">Jul</option>
                        <option value="08">Aug</option>
                        <option value="09">Sep</option>
                        <option value="10">Oct</option>
                        <option value="11">Nov</option>  
                        <option value="12">Dec</option>                     
                        </select>
                        <select name="birthday[d]" style="width:60px;">
                    	<option>Day:</option>
                        <?php for($day=1;$day<=31;$day++){?>
                        <option><?php echo sprintf('%02d',$day);?></option>
                        <?php }?>
                        </select>
                        <select name="birthday[y]" style="width:65px;">
                    	<option>Year:</option>  
                        <?php for($year=date('Y');$year>=1905;$year--){?>
                        <option><?php echo $year;?></option>
                        <?php }?>                      
                        </select>
                    </td></tr>
            <tr><td></td><td><button type="submit">Sign Up</button>
            <img src="lib/images/GsNJNwuI-UM.gif" alt="" class="jqloading"/></td></tr>
        </tbody>
    </table>
    </form>
   	<div id="callBackMessage"></div>
    </div>
    </div>
</div>
<?php include('footer_public.php');?>
</body>
</html>