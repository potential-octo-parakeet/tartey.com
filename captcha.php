<?php
	session_start();
	header("Content-Type: image/png");
	$code = $_SESSION['vcode'];
	$im = imagecreate(55, 19);
	$bg = imagecolorallocate($im, 255, 255, 255);
	$textcolor = imagecolorallocate($im, 160, 146, 146);
	imagecolortransparent($im, $bg);
	imagestring($im, 10, 0, 0, $code, $textcolor);
	imagepng($im);
	exit();
?>