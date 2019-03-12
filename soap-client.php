<?php
  $soapUrl = "https://mcintire.emscloudservice.com/mc-api/MCAPIService.asmx/GetEvent";

  $xml_post_string = '<?xml version="1.0" encoding="utf-8"?><soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope"><soap12:Body><GetEvent xmlns="http://DEA.Web.Service.MasterCalendar.API"><userName>web@comm.virginia.edu</userName><password>P@ssword123!!</password><eventDetailId>1144</eventDetailId></GetEvent></soap12:Body></soap12:Envelope>';

  $headers = array(
  "POST /mc-api/MCAPIService.asmx HTTP/1.1",
  "Host: mcintire.emscloudservice.com",
  "Content-Type: text/xml; charset=utf-8",
  "Content-Length: ".strlen($xml_post_string),
  );



  $url = $soapUrl;

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  $response = curl_exec($ch);
  curl_close($ch);

  $response1 = str_replace("<soap:Body>","",$response);
  $response2 = str_replace("</soap:Body>","",$response1);

  $parser = simplexml_load_string($response2);
var_dump($response);
