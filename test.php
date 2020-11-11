<?php


$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'nCXfhyVz7WOkQbF8tV2bs9SS8DjyBUCjqu+bInq3g7tFcXrQEQZpJ8YfJwNuDhrAffrtu3HmyVe8JCC+Oro6XFb5NnJDpAOzkZTYbNhBhR1umHsYnkHcDjUqJde7n5j6k4L1m93bQgUdWgA7yu+ksgdB04t89/1O/w1cDnyilFU='; 
$channelSecret = 'c1ae6e4972f811d72185c99d1abdbc03';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array


$json = file_get_contents('http://49.231.247.41/LineBot/line1.php');
$obj = json_decode($json);
$fname= $obj[0]->fname;



if ( sizeof($request_array['events']) > 0 ) {

    foreach ($request_array['events'] as $event) {

       $reply_message = '';
        $reply_token = $event['replyToken'];
        $text = $event['message']['text'];
        $data = [
            'replyToken' => $reply_token,
            'messages' => [['type' => 'text', 'text' => $fname ]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);
        $send_result = send_reply_message($API_URL.'/reply',      $POST_HEADER, $post_body);

        echo "Result: ".$send_result."\r\n";
        
    }
}

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

?>
