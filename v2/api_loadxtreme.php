<?php
	$ID		= "test";
	$PIK	= "1234";
	$PCODE	= "G100";
	$MOBILE = "09052772871";
	$prod	= array(
				"G100"=>"Globe Call & Text 100",
				"G300"=>"Globe Call & Text 300",
				"G500"=>"Globe Call & Text 500",
				"GIDD100"=>"Globe Tipid IDD 100",
				"GIDD200"=>"Globe Tipid IDD 200",
				"GIDD25"=>"Globe Tipid IDD 25",
				"S100"=>"Smart Call & Text 100",
				"S300"=>"Smart Call & Text 300",
				"S500"=>"Smart Call & Text 500",
				"SHELLOW30"=>"Smart Reloadable IDD Card",
				"SU150"=>"Sun Call & Text Regular 150",
				"SU20"=>"Sun Call & Text 20",
				"SU30"=>"Sun Call & Text 30",
				"SU300"=>"Sun Call & Text Regular 300",
				"SU50"=>"Sun Call & Text Regular 50",
				"SU500"=>"Sun Call & Text Regular 500",
				);
	$url	= "https://loadxtreme.ph/cgi-bin/member.cgi";
	$param	= array(
				"state"=>"webload3",
				"step"=>"1",
				"webtype"=>"",
				"pc_detail"=>"a",
				"uid"=>$ID,
				"pik"=>$PIK,
				"category"=>"Cellphone",
				"pcode"=>$PCODE,
				"cellno"=>$MOBILE,
				"email"=>"mvcejas@gmail.com",
				"pc_detail"=>"b",
				);
	$http_q	= http_build_query($param);
	$data	= array(
				"http"=>array(
					"method"=>"post",
					"content"=>$http_q,
					"header"=>"Content-Type: application/x-www-form-urlencoded\r\nContent-Length:".strlen($http_q)."\r\n"
					)
				);
	$data	= stream_context_create($data);
	$fp		= @fopen($url,'r',false,$data);
	$res	= @stream_get_contents($fp);
			  @fclose($fp);
	echo $res;
				
?>