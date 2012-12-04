<?php
	header("Content-Type: image/png");
	$text = "Testing lang kung possible ba to. -".$_SERVER['REMOTE_ADDR'];
	$im = imagecreate(400, 19);
	$bg = imagecolorallocate($im, 255, 255, 255);
	$textcolor = imagecolorallocate($im, 0, 0, 0);
	imagecolortransparent($im, $bg);
	imagestring($im, 2, 0, 0, $text, $textcolor);
	imagepng($im);
	exit();
?>