<?php

    $url = "https://mcintire.emscloudservice.com/mc-api/MCAPIService.asmx";

    $soap_request = '<?xml version="1.0" encoding="utf-8"?>
    <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
    <GetEvent xmlns="http://DEA.Web.Service.MasterCalendar.API/">
      <userName>web@comm.virginia.edu</userName>
      <password>P@ssword123!!</password>
      <eventDetailId>1144</eventDetailId>
    </GetEvent>
    </soap:Body>
    </soap:Envelope>';

    $header = array(
        "Content-type: text/xml;charset=\"utf-8\"",
        "Accept: text/xml",
        "Cache-Control: no-cache",
        "Pragma: no-cache",
        "SOAPAction: \"http://DEA.Web.Service.MasterCalendar.API/GetEvent\"",
        "Content-length: ".strlen($soap_request),
    );

    $soap_do = curl_init();

    curl_setopt($soap_do, CURLOPT_URL, $url );
    curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt($soap_do, CURLOPT_POST, true );
    curl_setopt($soap_do, CURLOPT_POSTFIELDS, $soap_request);
    curl_setopt($soap_do, CURLOPT_HTTPHEADER, $header);

    $result = curl_exec($soap_do);

    if($result === false) {
        $err = 'Curl error: ' . curl_error($soap_do);
        curl_close($soap_do);
        print $err;
    } else {
        curl_close($soap_do);
        echo $result;

    }



?>
