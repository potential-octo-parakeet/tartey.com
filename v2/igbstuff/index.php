<?php 
	session_start();
	if(isset($_SESSION['id'])){header("location:/home.php");}
	$title = "Tartey";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="slamAdvice helps you share, connect, update, post your problems and ask an advice from your friends around the world. Sign up now! It's easy, fast and secure." />
<link rel="stylesheet" type="text/css" href="lib/css/common.css" />
<link rel="stylesheet" type="text/css" href="lib/css/i.css" />
<script type="text/javascript" src="lib/js/jquery.min.js"></script>
<title><?php echo $title;?></title>
<script type="text/javascript" src="lib/js/2011-a.js"></script>
<style type="text/css">.betaSign{font-size:34px;position:absolute;margin-top:-60px;font-weight:bold;color:#E6E6EC;margin-left:178px;}</style>
<script type="text/javascript">
$(document).ready(function(){
	$('#featured_users').load('ajax_featured_users.php?f');
	$('#user_count').load('ajax_featured_users.php?c');
	setInterval(function(){$('#featured_users').load('ajax_featured_users.php?f')},60000);
	setInterval(function(){$('#user_count').load('ajax_featured_users.php?c')},30000);
});
</script>
<style type="text/css">
	ul{list-style-type:none; display:block; margin:5}
	li{margin-left:-40px;}
	.desc{margin-left:-20px; font-weight:normal; font-size:12px; padding-bottom:10px}
</style>

</head>

<body>
<div id="header_wrapper">
	<div id="header">
    	<div id="logo" style="position:absolute; margin-top:-12px"><h1><a href="/"><img src="lib/images/logo.png" border="0" height="120px" /></a></h1></div>
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



<div id="container_wrapper">
	<div id="container">
        <div class="left" id="leftContainer">
          <div style="width:100%; margin-top:20px; float:right;color: #fff; font-size:26px; font-weight:normal; font-family:Arial, Helvetica, sans-serif;text-shadow: 0 1px 0 rgba(0, 0, 0, 0.6),0 0 6px rgba(143, 181, 200, 1),0 0 30px rgba(143, 181, 200, .7);">The world connect, update and share with different lifestyle.</div>
        <div style="width:100%; margin-top:30px; float:left;color: #fff; font-size:15px; font-family:Arial, Helvetica, sans-serif">The more friends you add, the more cellphone load you have. </div>
           <div style="width:370px; margin-top:10px; float:left;color: #fff; font-size:16px;font-family:Arial, Helvetica, sans-serif ">
           Easy steps as 1 2 3!<br />
           <ul>
           	<li><strong>1. Sign up</strong></li>
            <li class="desc" >Create a tartey account.</li>
            <li><strong>2. Collect friends</strong></li>
            <li class="desc" >Add more friends and multiply. Tell your friends that there's a new social network in town.</li>
            <li><strong>3. Receive cellphone load</strong></li>
            <li class="desc" >Claim your cellphone load as easy as you can. <br /><a href="incentives.php" style="color:#fff">[Read Incentives]</a> </li>
           </ul>
           
           </div>      
            <div style="width:370px; float:left;color: #203360; font-size:22px;font-weight: bold; padding-top:5px; margin-top:40px">
            	<img src="lib/images/smart.png" />&nbsp;&nbsp;&nbsp;&nbsp;
                <img src="lib/images/globe.png" />
                <img src="lib/images/sun.png" />
                
            </div>
            <div class="clear"></div>
        </div>
        <div class="right" id="reg_form">
        	<div id="reg_caption">
            	<div class="mainTitle">Sign Up Now!</div>
                <div class="subTitle">It's easy, fast & secure</div>
                <div class="betaSign">Beta 1.0</div>
            </div>
            <form action="" method="post" id="createAccount">
            <input type="hidden" name="createAccount" value="true" />
            <table>
                <tbody>
                    <tr><td align="right"><label>First Name:</label></td><td><input type="text" name="firstname" autocomplete="off"/></td></tr>
                    <tr><td align="right"><label>Last Name:</label></td><td><input type="text" name="lastname" autocomplete="off"/></td></tr>
                    <tr><td align="right"><label>Email:</label></td><td><input type="text" name="email" autocomplete="off"/></td></tr>
                    <tr><td align="right"><label>Password:</label></td><td><input type="password" name="password" autocomplete="off"/></td></tr>
                    <tr><td align="right"><label>I am:</label></td>
                    <td><select name="gender">
                    	<option>Select Sex:</option>
                        <option>Male</option>
                        <option>Female</option>
                        </select>
                    </td></tr>
                    <tr><td align="right"><label>Birthday:</label></td>
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
            <div style="position:absolute;width:315px;" id="callBackMessage"></div>
            <div style="margin-top:40px;float:right;margin-right:2px;width:262px;color:#014546;font-size:12px;" id="user_count"></div>
            <div class="clear"></div>
            <div style="float:right;margin-right:2px;width:262px;" id="featured_users"></div>
        </div>
    </div>
</div>
<?php include('footer_public.php');?>
</body>
</html>