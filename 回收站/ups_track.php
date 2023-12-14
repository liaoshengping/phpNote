<?php

$trackingNumber = '420322579200190353014500000024';

$row = rawurlencode("<TrackRequest USERID='9SIMPL93B2765'><TrackID ID='$trackingNumber'></TrackID></TrackRequest>");

$xml = simplexml_load_file('http://production.shippingapis.com/ShippingApi.dll?API=TrackV2&XML='.$row) or die('Error: Cannot create object');

var_dump(json_decode(json_encode($xml),true));exit;
//echo $xml->TrackInfo->TrackSummary->Event . "<br>";
//echo $xml->TrackInfo->TrackSummary->EventDate . "<br>";
//echo $xml->TrackInfo->TrackSummary->EventTime;