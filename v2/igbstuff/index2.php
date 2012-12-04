<?php 
	session_start();
	if(isset($_SESSION['id'])){header("location:/home.php");}
	$title = "slamAdvice - The world connects";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="slamAdvice helps you share, connect, update, post your problems and ask an advice from your friends around the world. Sign up now! It's easy, fast and secure." />
<link rel="stylesheet" type="text/css" href="lib/css/common.css" />
<link rel="stylesheet" type="text/css" href="lib/css/index.css" />
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
    	<div id="logo"><h1><a href="/"><img src="lib/images/logo.png" border="0" /></a></h1></div>
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
        	
            <div id="map">
            	
            	<img src="lib/images/nokia-e63 copy.png" style="height:350px;float:left;border:none;" />
                </div>
                <div style="width:370px; float:right;color: #510000; font-size:22px;font-weight: bold;">slamAdvice helps you share, connect, update, post your problems and ask an advice from your friends around the world!</div>
        <div style="width:370px; margin-top:30px; float:right;color: #510000; font-size:15px;font-weight: bold;">The more friends you add, the more cellphone load you have. </div>
           <div style="width:370px; margin-top:10px; float:right;color: #666; font-size:16px;font-weight: bold; ">
           Easy steps as 1 2 3!<br />
           <ul>
           	<li>1. Sign up</li>
            <li class="desc" >Create a slamAdvice account. It's easy, fast & secure.</li>
            <li>2. Add as a friend</li>
            <li class="desc" >The more friends you add, the more advice you ask. Tell your friends that there's a new social network in town.</li>
            <li>3. Receive cellphone load</li>
            <li class="desc" >Claim your cellphone load as easy as you can. <a href="incentives.php" style="color:#510000">[Read Incentives]</a> </li>
           </ul>
           
           </div>      
            <div style="width:370px; float:right;color: #203360; font-size:22px;font-weight: bold;border-top: 2px solid #CCC; padding-top:5px">
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
                    <tr><td align="right"><label>Mobile:</label></td><td><input type="mobile" name="mobile" autocomplete="off"/></td></tr>
                    <tr><td></td><td><button type="submit">Sign Up</button>
                    <img src="lib/images/GsNJNwuI-UM.gif" alt="" class="jqloading"/></td></tr>
                </tbody>
            </table>
            </form>
            <div style="position:absolute;width:315px;" id="callBackMessage"></div>
            <div style="margin-top:20px;float:right;margin-right:2px;width:262px;color:#510000;font-size:12px;" id="user_count"></div>
            <div class="clear"></div>
            <div style="float:right;margin-right:2px;width:262px;" id="featured_users"></div>
        </div>
    </div>
</div>
<?php include('footer_public.php');?>
</body>
</html>