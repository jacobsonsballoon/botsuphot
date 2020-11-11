<?php

error_reporting(E_ALL);

//$json = file_get_contents('http://49.231.247.41/LineBot/line1.php');
$json = '[{"fname":"SUPHOT","lname":"SUPHOT"}]';
    $obj = json_decode($json);
    $fname= $obj[0]->fname;

 echo "fname1 === ".$fname." === Tกกกก";



?>
