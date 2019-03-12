<?php
//The url you wish to send the POST request to
$url = 'https://mcintire.test.emscloudservice.com/platform/api/v1/public/parameters';

//The data you want to send via POST
$fields = [
    'clientId'      => 'p6D2aFlORVWPYOHtgMZ8Eg',
    'secret'        => 'Y9ZdE9BqMinxnXUzc5cF58UE8BWLBmRIs-GtkAPiuCs'
];

//url-ify the data for the POST
$fields_string = http_build_query($fields);

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

//So that curl_exec returns the contents of the cURL; rather than echoing it
curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
//execute post
$result = curl_exec($ch);
curl_close($ch);
echo $result;
?>
