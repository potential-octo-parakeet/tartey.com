<?php
if (!empty($_FILES)){	
	$uid		= $_REQUEST['uid'];
	$folder		= $_REQUEST['dir'];
	$tempFile 	= $_FILES['Filedata']['tmp_name'];
	$domain		= $_SERVER['HTTP_HOST'];
	$imgName	= $_FILES['Filedata']['name'];
	$ext		= substr($imgName,-4,4);
	$fileName 	= md5(time()).$ext;
	$path		= $_SERVER['DOCUMENT_ROOT'].'/'.$folder.'/'.$uid.'/';	
	if(!is_dir($path)){mkdir($path);}
	
	if(@is_dir($path)){
	//save to folder
	include('../image_crop.php');
	$crop_img = new image_cropper;
	list($width,$height) = getimagesize($tempFile);
	if($width>700){
		$crop_img->load($tempFile);
		$crop_img->resizeToWidth(700);
		$crop_img->save($path.$fileName);
	}else{
		move_uploaded_file($tempFile,$path.$fileName);
	}
	$crop_img->load($path.$fileName);
	$crop_img->resizeTo(162,162);
	$crop_img->save($path.'162'.$fileName);
	$crop_img->load($path.$fileName);
	$crop_img->resizeTo(50,50);
	$crop_img->save($path.'50'.$fileName);
	//delete temp file
	@unlink($tempFile);
	
	//img url	
	$img	= "http://$domain/$folder/$uid/$fileName";
	$img50	= "http://$domain/$folder/$uid/50$fileName";
	$img162	= "http://$domain/$folder/$uid/162$fileName";
	
	//save to database
	require('../db.php');
	$db = new db;
	$db->connect();
	$SQL = sprintf("UPDATE `user` SET `img`='%s',`img50`='%s',`img162`='%s' WHERE `id`='%d'",$img,$img50,$img162,$uid);
	mysql_query($SQL);
	$SQL = sprintf("INSERT INTO photos(img,img50,img162,uid)  VALUES('%s','%s','%s','%d')",$img,$img50,$img162,$uid);
	mysql_query($SQL);
	}
}
?>