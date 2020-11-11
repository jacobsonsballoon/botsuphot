<?php

error_reporting(E_ALL);
$url = 'http://49.231.247.41/LineBot/line1.php';
$opts = array('http' => array(
    'method' => "GET",
    'header' => "Accept-language: en\r\n" . "Cookie: ".session_name()."=".session_id()."\r\n" ) 
);
$context = stream_context_create($opts);
session_write_close();   // this is the key
$html = file_get_contents($url, false, $context);       // <-- line 92  
echo $html;





//$json = file_get_contents('http://49.231.247.41/LineBot/line1.php');
//$json = '[{"fname":"SUPHOT","lname":"SUPHOT"}]';
    //$obj = json_decode($json);
    //$fname= $obj[0]->fname;

 //echo "fname1 === ".$json." === Tกกกก";



?>
