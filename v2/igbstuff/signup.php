<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign Up</title>
<script type="text/javascript" src="http://beta2.igobig.org/lib/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#createAccount').submit(function(){		
		$.post('/ajax_register.php',$(this).serialize(),function(response){$('#callBackMessage').html(response).fadeIn();});
		return false;
	});
	$('.jqloading').ajaxStart(function(){$(this).show()}).ajaxStop(function(){$(this).hide();});
});
</script>
<style type="text/css">
 body{font-size:11px;font-family:"lucida grande",tahoma,verdana,arial,sans-serif;margin:0 20px;}
 #reg_caption{border-bottom:1px solid #9AAFCA;margin-bottom:10px;}
 #reg_form{margin-top:50px;}
 #reg_form label{color:#1D2A5B;font-size:13px;}
 #reg_form input,select{border:1px solid #96A6C5;padding:6px;font-size:14px;width:250px;}
 #reg_form input:focus,select:focus{background:#f5fafe;}
 #reg_form select{width:105px;font-size:13px;padding-left:2px;}
 #reg_form button{background:url(/lib/images/signup_button.png) 0 0;width:111px;height:31px;border:none;text-indent:-100000px;cursor:pointer;margin-top:10px;}
 #reg_form button:hover{background:url(/lib/images/signup_button.png) 0 31px;}
 #reg_form .retrievebutton{background:url(/lib/images/retrieve_button.png) 0 -31px;margin-top:10px;}
 #reg_form .retrievebutton:hover{background:url(/lib/images/retrieve_button.png);}
 #reg_form .loginbutton{background:url(/lib/images/retrieve_button.png) 0 31px;margin-top:10px;}
 #reg_form .loginbutton:hover{background:url(/lib/images/retrieve_button.png)0 62px;}
 #callBackMessage{border:1px solid #dd3c10;background:#ffebe8;color:#333;padding:10px;text-align:center;margin:10px auto;display:none;}
 .mainTitle{color:#0E385F;font-size:18px;margin-bottom:10px;font-weight:bold;}
 .mainTitle a{color:#0E385F;text-decoration:none;}
 .mainTitle a:hover{color:#3B5998;}
 .subTitle{color:#0E385F;font-size:15px;margin-bottom:10px;}
 .jqloading{margin-left:10px;display:none;}
 .betaSign{font-size:34px;position:absolute;margin-top:-60px;font-weight:bold;color:#E6E6EC;margin-left:178px;}
</style>
</head>

<body>
<div class="right" id="reg_form">
        	<div id="reg_caption">
            	<div class="mainTitle">Sign Up Now!</div>
                <div class="subTitle">It's better than free!</div>
                <div class="betaSign">Beta 2.0</div>
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
            <div id="callBackMessage"></div>
        </div>
</body>
</html>