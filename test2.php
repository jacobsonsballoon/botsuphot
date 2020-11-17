<?php

error_reporting(E_ALL);
//$url = 'http://49.231.247.41/LineBot/line1.php';
$url='http://49.231.247.45:5001/repair/getComByComCode';
//$ch = curl_init();
//curl_setopt($ch, CURLOPT_URL, "http://49.231.247.41/LineBot/line1.php"); 
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//$temp = trim(curl_exec($ch));
//curl_close($ch);

//echo "temp == ".$temp;



//$response = httpPost("http://mywebsite.com/update.php",
	//array("first_name"=>"Bob","last_name"=>"Dillon")
//);


$response = httpPost("http://49.231.247.45:5001/repair/getComByComCode",
	array("id"=>"1")
);
echo "response == ".$response;

//using php curl (sudo apt-get install php-curl) 
function httpPost($url, $data){
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}



?>
