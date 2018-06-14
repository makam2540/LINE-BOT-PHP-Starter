<?php
$strAccessToken = "7YR60AJ855Zu1Etxsc7aCdFqhip1o8yAKj7PzLe90ClE9Po0fz5o81BeghtpCki4+zFZ7FrYjjbrFvQw84+Axi+P1zWPnxSCTl/lF5gVTDaDqdC5IHk30qnjo7GQ1hHKizexgGNpBPn/Fwz3slJqkQdB04t89/1O/w1cDnyilFU=";
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
$strUrl = "https://api.line.me/v2/bot/message/reply";
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
$_msg = $arrJson['events'][0]['message']['text'];
$api_key="c-9iVt7OvlHt_HeJci-4E3dL-PpBhF77";
$url = 'https://api.mlab.com/api/1/databases/junebot/collections/question?apiKey='.$api_key.'';
$json = file_get_contents('https://api.mlab.com/api/1/databases/junebot/collections/question?apiKey='.$api_key.'&q={"question":"'.$_msg.'"}');
$data = json_decode($json);
$isData=sizeof($data);


$url2 = 'https://api.mlab.com/api/1/databases/junebot/collections/answer?apiKey='.$api_key.'';
$json2 = file_get_contents('https://api.mlab.com/api/1/databases/junebot/collections/answer?apiKey='.$api_key.'&q={"question":"'.$_msg.'"}');
$data2 = json_decode2($json2);
$isData2=sizeof($data2);

if (strpos($_msg, 'สอน') !== false) {
  if (strpos($_msg, 'สอน') !== false) {
    $x_tra = str_replace("สอน","", $_msg);
    $pieces = explode(",", $x_tra);
    $_question=str_replace("[","",$pieces[0]);
    $_answer=str_replace("]","",$pieces[1]);
    //Post New Data
    $newData = json_encode(  
      array(
        'question' => $_question,
        'answer'=> $_answer
      )
    );
    $opts = array(
      'http' => array(
          'method' => "POST",
          'header' => "Content-type: application/json",
          'content' => $newData
       )
    );
    $context = stream_context_create($opts);
    $returnValue = file_get_contents($url,false,$context);
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = 'ขอบคุณที่สอนผม';
  }
}else{
  if($isData >0){
   foreach($data as $rec){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = $rec->answer;
   }
  }else{
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = 'เดี๋ยวๆ อันนี้ไม่รู้เรื่องอ่ะ';
    //แต่คุณสามารถสอนผมให้ฉลาดได้แค่พิมพ์ : สอน[คำถาม,คำตอบ]

    $newData2 = json_encode2(  
        array2(
          'question' => $_question2,
        )
      );
      $opts2 = array2(
        'http' => array2(
            'method' => "POST",
            'header' => "Content-type: application/json",
            'content' => $newData2
         )
      );
      $context2 = stream_context_create($opts2);
      $returnValue = file_get_contents($url,false,$context2);
      $arrPostData = array2();


  }
}
$channel = curl_init();
curl_setopt($channel, CURLOPT_URL,$strUrl);
curl_setopt($channel, CURLOPT_HEADER, false);
curl_setopt($channel, CURLOPT_POST, true);
curl_setopt($channel, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($channel, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($channel, CURLOPT_RETURNTRANSFER,true);
curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($channel);
curl_close ($channel);
?>
