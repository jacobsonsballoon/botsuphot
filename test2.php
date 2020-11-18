<?php


$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'nCXfhyVz7WOkQbF8tV2bs9SS8DjyBUCjqu+bInq3g7tFcXrQEQZpJ8YfJwNuDhrAffrtu3HmyVe8JCC+Oro6XFb5NnJDpAOzkZTYbNhBhR1umHsYnkHcDjUqJde7n5j6k4L1m93bQgUdWgA7yu+ksgdB04t89/1O/w1cDnyilFU='; 
$channelSecret = 'c1ae6e4972f811d72185c99d1abdbc03';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array

//$fname=tis_utf8(getDataICT());

if ( sizeof($request_array['events']) > 0 ) {

    foreach ($request_array['events'] as $event) {

        // $reply_message = '';
        // $reply_token = $event['replyToken'];
        // $data = [
        //     'replyToken' => $reply_token,
        //     'messages' => [['type' => 'text', 'text' => json_encode($request_array)]]
        // ];
        // $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

        //$send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);
        $reply_message = '';
        $reply_token = $event['replyToken'];
        $text = $event['message']['text'];
	
	//$fname=tis_utf8(getDataICT());.
	$fname=tis_utf8(getDataICT($text));
	    
        $data = [
            'replyToken' => $reply_token,
            'messages' => [['type' => 'text', 'text' => $fname ]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
        $send_result = send_reply_message($API_URL.'/reply',      $POST_HEADER, $post_body);



        echo "Result: ".$send_result."\r\n";
        //echo "Result: ".$fname."\r\n";
    }
}

//echo "Result: ".$fname."\r\n";

echo "OK";




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

function httpPost($url, $data){
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
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


function getDataICT($comid){
    $response = httpPost("http://49.231.247.45:5001/repair/getComByComCode",
	array("id"=>"$comid")
    );
    //echo "response == ".$response;
    $obj = json_decode($response,true);

    $ii=0;
    foreach($obj['data'] as $pss_json)
    {   
            $ii++;
 
        foreach($pss_json[0] as $pss_json2){
            $aData=$pss_json2['serial'];//iconv('TIS-620', 'UTF-8', $pss_json2['serial']);

            $fname =  utf8_tis($aData);
            return $fname;
            //echo "f==".utf8_tis($aData)."<br/>";
            exit; 

        }

        
    }
} // end function

?>
