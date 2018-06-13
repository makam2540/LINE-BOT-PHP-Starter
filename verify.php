<?php
$access_token = 'QV4Z3GwTNAwu+MVcwGCGAALxv9W/lHMLm6J/tvZvdS8eBf6A2nRlC1QdFvLI28iZ+zFZ7FrYjjbrFvQw84+Axi+P1zWPnxSCTl/lF5gVTDYFM8sdYtwxA1PVP5Tir5WzkwwsuzPxbs9IkWqxEvvcvQdB04t89/1O/w1cDnyilFU=
';


$url = 'https://api.line.me/v2/bot/verify';
//$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
