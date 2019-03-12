<?php
$url = 'https://mcintire.emscloudservice.com/mc-api/MCAPIService.asmx/GetEvent';
$data = array('userName' => 'web@comm.virginia.edu', 'password' => 'P@ssword123!!', 'eventDetailId' => '1144');

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) { echo 'This is an error!'; }

var_dump($result);
