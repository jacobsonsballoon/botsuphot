<?php

//header('Content-Type: charset=utf-8');
//header('Content-type:application/json;charset=utf-8');
$json = file_get_contents('http://49.231.247.41/LineBot/line1.php');
    $obj = json_decode($json);
    $fname= $obj[0]->fname;

//echo "fname1 = ".tis_utf8($fname)."<br/>";


//echo "OK";

 echo "fname1 === ".$fname." === Tกกกก";





?>
