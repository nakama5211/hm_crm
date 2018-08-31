<?php

$handle = fopen("log.txt","a+");
var_dump($_REQUEST);
$data = json_decode(file_get_contents('php://input'), true);
var_dump($data);
$raw = json_encode($data);
fwrite($handle,json_encode($raw)."\n\t");
fclose($handle);
echo "</br>Here</br>";
/*
$ch = curl_init("http://crm.tavicosoft.com:3000/call");

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
curl_setopt($ch, CURLOPT_POSTFIELDS, $raw);                                                                  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
    'Content-Type: application/json'                                                                
));                                            

$result = curl_exec($ch);

var_dump($result);
*/

?>