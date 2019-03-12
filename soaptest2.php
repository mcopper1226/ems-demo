<?php

$startDate = time();
$start= date('Y-m-d', strtotime('+0 day', $startDate));
$end = date('Y-m-d', strtotime('+30 day', $startDate));

      $wsdl = "https://mcintire.emscloudservice.com/mc-api/MCAPIService.asmx?WSDL";

      $client = new SoapClient($wsdl, array(
                              "trace"=>1,
                              "exceptions"=>0));
      $userName = "web@comm.virginia.edu";
      $password = "P@ssword123!!";
      $startDate = $start;
      $endDate = $end;
      $calendars = "<int>2</int>";



      $parameters= array(
        "userName"=>$userName,
        "password"=>$password,
        "startDate"=>$startDate,
        "endDate"=>$endDate,
        "calendars"=>array(
          1,
          2,
          3,
          4
        )
      );

      //Object
      $value = $client->GetEvents($parameters);


      //String
      $response = htmlspecialchars($client->__getLastResponse());
      //String
      $xml = $value->GetEventsResult;


      $test = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
      $body = $test->xpath('//Data');
      $array = json_encode((array)$body);

      echo $array;



?>
