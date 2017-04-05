<?php
$data = array('name' => 'optimus', 'php_master' => true);


$url = "http://localhost:8000/schedule/fire";
$handle = curl_init($url);
curl_setopt($handle, CURLOPT_POST, true);
curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
curl_exec($handle);