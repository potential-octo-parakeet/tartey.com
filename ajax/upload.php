<?php
	session_start();
	$id = $_SESSION['id'];
	$path = $_SERVER['DOCUMENT_ROOT']."/user_images/";
	if(isset($_POST['upload']) && isset($_FILES['profile_img']['name'])){
		$img = $_FILES['profile_img'];
		$img_file = array('image/jpeg');
		$response = array();
		$filename = md5($id.time());
		if(in_array($img['type'],$img_file)){
			if($img['size']<=4000000){
				require('../image_crop.php');
				$crop_img = new image_cropper;
				$crop_img->load($img['tmp_name']);
				$crop_img->resizeTo(50,50);
				$crop_img->save($path.$filename);
				//saving to database
				include_once('../class.php');
				$db = new db;
				$db->connect();
				mysql_query("UPDATE user SET img50='$filename' WHERE id='$id'");			
				$response['result']  = true;
				$response['message'] = "File successfully uploaded.";				
			}else{
				$response['result']	 = false;
				$response['message'] = "Image upload limited to 4MB max size.";
			}
		}else{
			$response['result'] = false;
			$response['message'] = "Please choose acceptable type of image: jpeg.";
		}		
	}
?>