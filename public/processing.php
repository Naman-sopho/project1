<?php
$curl = curl_init();
//Setting options for request
curl_setopt_array($curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => $_POST["input_url"],
	CURLOPT_USERAGENT => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.112 Safari/534.30"
));

//Sending request and saving response as a string
$resp = curl_exec($curl);

//Check for errors in curl req
if (!$resp)
	die("Error:" . curl_error($curl) . "Error-Code:" . curl_errno($curl));

else
	print $resp;

//Close request
curl_close($curl);
?>
