<?php 
	include('class.php');
	$common = new common;
	$index = new indexPage;
	$footer_copyright_text = $common->footer('txt');
	$footer_links = $common->footer('lnk');	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="lib/css/common.css" />
<link rel="stylesheet" type="text/css" href="lib/css/index.css" />
<script type="text/javascript" src="lib/js/script.js"></script>
<title><?php $index->title();?></title>
</head>

<body>
<div id="header_wrapper">
	<div id="header">
    	<div id="logo"><h1><a href="/">iGoBig</a></h1></div>
        <div id="login">
        	<table>
            	<tbody>
                	<tr><td><label>Email</label></td><td><label>Password</label></td><td></td></tr>
                    <tr><td><input type="text" name="email"/></td><td><input type="password" name="password" /></td><td><button>Log In</button></td></tr>
                    <tr><td>&nbsp;</td><td><a href="">Forgot your password?</a></td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="container_wrapper">
	<div id="container">
       
    </div>
</div>
<div id="footer">
	<p><span class="left"><?php echo $footer_copyright_text;?></span><span class="right"><?php foreach($footer_links as $row=>$link):if($row>0):echo " &middot; ";endif;echo "<a href=\"$link[url]\">$link[text]</a>";endforeach;?></span></p>
</div>
</body>
</html>