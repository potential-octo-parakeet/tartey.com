<?php
	header("Content-Type: image/png");
	$text = $_SERVER['REMOTE_ADDR']." has been logged.";
	$im = imagecreate(400, 19);
	$bg = imagecolorallocate($im, 255, 255, 255);
	$textcolor = imagecolorallocate($im, 0, 0, 0);
	imagecolortransparent($im, $bg);
	imagestring($im, 10, 0, 0, $text, $textcolor);
	imagepng($im);
	$fp = fopen('profile_logs','a');
	fwrite($fp,date('mdYhis').':'.$_SERVER['REMOTE_ADDR']."\n");
	fclose($fp);
	exit();
?>