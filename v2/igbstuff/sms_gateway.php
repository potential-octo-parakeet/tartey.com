<?php

function post_request($url, $data, $optional_headers = NULL){
	
	$data = http_build_query($data);
	$params = array(
				'http' => array(
							'method' => 'POST',
							'content' => $data,
							'header' => "Content-type: application/x-www-form-urlencoded\r\n". 'Content-Length: '.strlen($data)."\r\n"
						)
					);
	if($optional_headers !== NULL) {
		$params['http']['header'] .= $optional_headers;
	}
	$ctx = stream_context_create($params);
	$fp = @fopen($url, 'r', false, $ctx);
	if (!$fp) {
		throw new Exception("Problem with $url, $php_errormsg");
	}
	$response = stream_get_contents($fp);
	if ($response === false) {
		throw new Exception("Problem reading data from $url, $php_errormsg");
	}
	fclose($fp);
	return $response;
}

$post_data = array(
		'accountName' => 'markxuck',
		'key' => '93cffc8d-a876-4b2a-ae79-84c4d40b4f85',
		'phoneNumber' => $tomobile,
		'message' => $sms."\r\nSender: $mymobile\r\nvia tartey.com",
		'countryCode' => 'PH'
		);

try{
	$result = post_request('http://api.gateway160.com/client/sendmessage/', $post_data);
	if($result == "1"){
		echo "Message sent!";
		sentout($ses_id);
	}else{
		echo "Sorry, there's something wrong with our system. Sorry for the inconvenience.";
	}
}catch(Exception $e){
	echo "Exception: " . $e->getMessage();
}
?>