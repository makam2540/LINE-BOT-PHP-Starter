<?php
$strAccessToken = "Rz8z1ee8jjPGKgYsiVruxdBDpWA4ryYEh5QKu7KLtb4o1HN3h38LHyWUEoWYOGVolNmGP1fFw7UbxocelHU/0Y/j+b2/jch/cpqEW6dhyi8smlFI+vsQVttuzLtCZPHm5K7MNg39sFK7Z8jWxhv7ngdB04t89/1O/w1cDnyilFU=";
$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);
$strUrl = "https://api.line.me/v2/bot/message/reply";
$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
$_msg = $arrJson['events'][0]['message']['text'];

$api_key="7wjZz1XxwnIgY8jDYbPDa_XpDZTtNWsp";
$url = 'https://api.mlab.com/api/1/databases/sangster-bot/collections/q_sangster?apiKey='.$api_key.'';
$json = file_get_contents('https://api.mlab.com/api/1/databases/sangster/collections/q_sangster?apiKey='.$api_key.'&q={"question":"'.$_msg.'"}');
$data = json_decode($json);
$isData=sizeof($data);

//echo "==".$data;

if (strpos($_msg, 'คุณแซงค์จำนะ') !== false) {
        if (strpos($_msg, 'คุณแซงค์จำนะ') !== false) {
          $x_tra = str_replace("คุณแซงค์จำนะ","", $_msg);
          $pieces = explode(",", $x_tra);
          $_question=str_replace(" ","",$pieces[0]);
          $_answer=str_replace("","",$pieces[1]); 
          //Post New Data
          $newData = json_encode(  
            array(
             'question' => $_question,
              'answer'=> $_answer
            )
          );//exit();
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
          $arrPostData['messages'][0]['text'] = 'ขอบคุณนะครับ';
        } //exit();
        }else{
//  if($isData>0){
//   foreach($data as $rec){
//    $arrPostData = array();
//    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//        if( sizeof($rec->answer) > 0){
//                $arrPostData['messages'][0]['type'] = "text";
//                $arrPostData['messages'][0]['text'] = $rec->answer;
//        }
//        else{
            $arrPostData = array();
            $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
            $arrPostData['messages'][0]['type'] = "text";
            $arrPostData['messages'][0]['text'] = 'บอกว่าไม่รู้เรื่องไงครับ สอนผมสิๆ';
//        }
//    }
//  }else{
//    $arrPostData = array();
//    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
//    $arrPostData['messages'][0]['type'] = "text";
//    $arrPostData['messages'][0]['text'] = 'อันนี้ไม่รู้เรื่องครับ สอนหน่อย';
    

//    $nonData = json_encode(  
//        array(
//          'question' => $_msg,
//        )
//      );
//      $opts = array(
//        'http' => array(
//            'method' => "POST",
//            'header' => "Content-type: application/json",
//            'content' => $nonData
//         )
//      );
//      $context = stream_context_create($opts);
//      $returnValue = file_get_contents($url,false,$context);
      //$arrPostData = array();
   
//  }
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
