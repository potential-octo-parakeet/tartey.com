<?php
	$url = "http://api.igobig.com/mail.php";
	$data= array(
				'email'=>$email,
				'subject'=>$subject,
				'message'=>$message,
				'headers'=>$headers
			);
	$data=http_build_query($data);		
	$param= array(
			'http' => array(
					"method"=>"POST",
					"content"=>$data,
					"header"=>"Content-type: application/x-www-form-urlencoded\r\nContent-Length:".strlen($data)."\r\n"
				)
			);
			
	$context = stream_context_create($param);
	$fp = fopen($url,'r',false,$context);
	$response = stream_get_contents($fp);
	fclose($fp);
?>