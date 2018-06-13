<?php
$access_token = 'EzgAlxIOWuvQE7ARrLvkdJclnDnkifxd0zVOgZ8DTvUm8HxrUcLcWhk9luK5+mra+zFZ7FrYjjbrFvQw84+Axi+P1zWPnxSCTl/lF5gVTDYBjp+XEJ8EjeyUYVhuvRlTscnsKgQN+zlfy+lk8jL9ywdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v2/oauth/verify';

$headers = array('Authorization: Bearer ' . 'EzgAlxIOWuvQE7ARrLvkdJclnDnkifxd0zVOgZ8DTvUm8HxrUcLcWhk9luK5+mra+zFZ7FrYjjbrFvQw84+Axi+P1zWPnxSCTl/lF5gVTDYBjp+XEJ8EjeyUYVhuvRlTscnsKgQN+zlfy+lk8jL9ywdB04t89/1O/w1cDnyilFU=');

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
