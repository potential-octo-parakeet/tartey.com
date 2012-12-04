<?php 
	session_start();
	if(isset($_SESSION['id'])){header("location:/home.php");}
	include 'facebook_config.php';
	$loginUrl = $facebook->getLoginUrl(array('scope' => 'email,user_birthday','redirect_uri'=>'http://'.$_SERVER['HTTP_HOST'].'/facebook_login.php'));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="Tartey is an online utility that connects people through-out the world. Play online games and blog."/>
<meta property="og:title" content="Meet New People on Tartey">
<meta property="og:description" content="Tartey is an online utility that connects people through-out the world. Play online games and blog.">
<meta property="og:site_name" content="Tartey">
<meta property="og:image" content="http://tartey.com/images/logo_198x71.png">
<link rel="stylesheet" type="text/css" href="css/index.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/pub-dec-06-2011-01-22-pm.js"></script>
<script type="text/javascript" src="js/reg-dec-06-2011-04-51-pm.js"></script>
<script type="text/javascript" src="js/ind-dec-06-2011-04-53-pm.js"></script>
<title>Tartey</title>
</head>

<body>
<img src="images/logo_198x71.png" style="display:none;" />
<div id="global">
    <div id="header">
        <h2 id="logo">
<a href="">TARTEY</a>
        </h2>
       	<div style="position:absolute;margin:10px 0 0 810px;">
        	<a href="<?PHP echo $loginUrl;?>"><img src="http://static.ak.fbcdn.net/rsrc.php/zB6N8/hash/4li2k73z.gif"></a>
       	</div>
        <form action="login.php" method="post">
        <input type="hidden" name="user" value="true" />
        <table id="form">
            <tbody>
                <tr>
                    <td><input type="text" name="email" class="login-email"/><span class="label dum-email">Email</span></td>
                    <td><input type="password" name="password" class="login-passwd"/><span class="label dum-passwd">Password</span></td>
                    <td><button type="submit">Sign In</button></td></tr>
                <tr>
                    <td></td>
                    <td>&nbsp;&nbsp;&nbsp;<a href="forgot_password.php">Forgot your password?</a></td>
                    <td></td>
                    </tr>
            </tbody>
        </table>
        </form>
    </div>
    <div id="container">
    	<div id="content">
        <h2>The world connect, update and share with different lifestyle.</h2>
        <p>The more friends you add, the more cellphone load you have.</p>
        <h3>Easy steps as 1 2 3!</h3>
        <ul>
        	<li>Sign up<span>Create a tartey account.</span></li>
            <li>Collect friends<span>Add more friends and multiply. Tell your friends that there's a new social network in town.</span></li>
            <li>Receive cellphone load<span>Claim your cellphone load as easy as you can.</span><span><a href="#">[Read Incentives]</a></span></li>
        </ul>
        </div>
        <div class="register_form">
          <div class="error">Error Message Goes Here</div>   
          <div class="heading-text">
          	<span class="version">Beta 2.0</span>
            <h2>Sign Up Now!</h2>
            <h3>It&rsquo;s free, and always will be.</h3>            
          </div>          
          <form action="#" method="post" id="register">
          <input type="hidden" name="createAccount"  value="true" />
          <table class="tabularize">
           <tbody>    
            <tr><td>
             <input type="text" name="firstname" class="text reg-fname" autocomplete="off"/><span class="label reg-lab-fname">First Name</span>
            </td></tr>
            <tr><td>
             <input type="text" name="lastname" class="text reg-lname" autocomplete="off"/><span class="label reg-lab-lname">Last Name</span>
            </td></tr>    	
            <tr><td>
             <input type="text" name="email" class="text reg-email" autocomplete="off"/><span class="label reg-lab-email">E-mail</span>
            </td></tr> 
            <tr><td>
             <input type="password" name="password" class="text reg-passwd" autocomplete="off"/><span class="label reg-lab-passwd">Password</span>
            </td></tr>
            <tr><td><select name="gender">
                      <option>Select Sex:</option>
                      <option>Male</option>
                      <option>Female</option>
                     </select>
                </td></tr>
            <tr><td><select name="birthday[m]" style="width:75px;">
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
                <tr><td><button type="submit">Sign Up</button> <span class="throbber_circle">Validating...</span></td></tr>
              </tbody>
           </table>
           </form>          
      </div>
    </div>
</div>
<div id="subContent">
	<div class="left">
    	<a href="">
		<h2>Play Online Games</h2>
       	<div>
  			<img src="images/369989_1496394629_1086562233_n.jpg" class="img50 left"/>
          	<div class="desc left">
          		<h3>Angry Birds</h3>
     			<p>The survival of the angry birds is at stake.</p>
  			</div>
		</div>
        </a>
   	</div>
    
    <div class="userlist right">
    	<h2 id="ftcount">These people are enjoying inside!</h2>
        <div id="ftusers">
        	<ul class="grid-view" id="people-grid-view">
            </ul>
        </div>
    </div>
</div>
<?php include_once('inc.public_footer.php');?>
</body>
</html>