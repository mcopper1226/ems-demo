<?php
  $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
  $f = fopen("./soap-request.xml", "w");
  fwrite($f, $HTTP_RAW_POST_DATA);
  fclose($f);
?>
