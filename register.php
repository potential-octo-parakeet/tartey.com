<?php 
	session_start();
	if(isset($_SESSION['id'])){header("location:/home.php");}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/public.css" />
<title>Register</title>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/reg-dec-06-2011-04-51-pm.js"></script>
<script type="text/javascript" src="js/pub-dec-06-2011-01-22-pm.js"></script>
</head>

<body>
<?php include_once('inc.public_header.php');?>

<div class="register_form">
	<h2 class="heading-text">Fill-up registration form</h2>
   <form action="#" method="post" id="register">
    <input type="hidden" name="createAccount"  value="true" />
    <table class="tabularize">
    	<tbody>    
        	<tr><td align="right"><label>First Name : &nbsp;&nbsp;</label></td><td><input type="text" name="firstname" class="text" /></td></tr>
            <tr><td align="right"><label>Last Name : &nbsp;&nbsp;</label></td><td><input type="text" name="lastname" class="text" /></td></tr>    	
            <tr><td align="right"><label>Email : &nbsp;&nbsp;</label></td><td><input type="text" name="email" class="text" /></td></tr> 
            <tr><td align="right"><label>Password : &nbsp;&nbsp;</label></td><td><input type="password" name="password" class="text" /></td></tr>
            <tr><td align="right"><label>I am : &nbsp;&nbsp;</label></td>
                    <td><select name="gender">
                    	<option>Select Sex:</option>
                        <option>Male</option>
                        <option>Female</option>
                        </select>
                    </td></tr>
                    <tr><td align="right"><label>Birthday : &nbsp;&nbsp;</label></td>
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
            <tr><td></td><td><button type="submit">Sign Up</button> <span class="throbber_sq"></span></td></tr>
        </tbody>
    </table>
    </form>
   	<div class="error"></div>    
</div>
<?php include_once('inc.public_footer.php');?>
</body>
</html>