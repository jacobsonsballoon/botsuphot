<?php

error_reporting(E_ALL);
//$url = 'http://49.231.247.41/LineBot/line1.php';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://49.231.247.41/LineBot/line1.php"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$temp = trim(curl_exec($ch));
curl_close($ch);

echo "temp == ".$temp;



?>
