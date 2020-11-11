<?php

//header('Content-Type: charset=utf-8');

//$json = file_get_contents('http://49.231.247.41/LineBot/line1.php');
    //$obj = json_decode($json);
    //$fname= $obj[0]->fname;

//echo "fname1 = ".tis_utf8($fname)."<br/>";


//echo "OK";

// echo "fname = ".$fname;


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://49.231.247.41/LineBot/line1.php"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$temp = trim(curl_exec($ch));
curl_close($ch);

//echo $temp;
$obj = json_decode($temp);
$fname= $obj[0]->fname;
echo "fname1 = ".($fname);






function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

function tis_utf8($tis)
{
    $max = strlen($tis);
    $utf8 = "";
    for ($i = 0; $i < $max; $i++) {
        $s = substr($tis, $i, 1);
        $val = ord($s);
        if ($val < 0x80) {
            $utf8 .= $s;
        } elseif ((0xA1 <= $val and $val <= 0xDA) or (0xDF <= $val and $val <= 0xFB)) {
            $unicode = 0x0E00 + $val - 0xA0;
            $utf8 .= chr(0xE0 | ($unicode >> 12));
            $utf8 .= chr(0x80 | (($unicode >> 6) & 0x3F));
            $utf8 .= chr(0x80 | ($unicode & 0x3F));
        }
    }
    return $utf8;
}

function utf8_tis($string)
{
    $str = $string;
    $res = "";
    for ($i = 0; $i < strlen($str); $i++) {
        if (ord($str[$i]) == 224) {
            $unicode = ord($str[$i + 2]) & 0x3F;
            $unicode |= (ord($str[$i + 1]) & 0x3F) << 6;
            $unicode |= (ord($str[$i]) & 0x0F) << 12;
            $res .= chr($unicode - 0x0E00 + 0xA0);
            $i += 2;
        } else {
            $res .= $str[$i];
        }
    }
    return $res;
}



?>
