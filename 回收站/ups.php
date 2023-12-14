<?php
// USPS API Endpoint
$apiUrl = 'https://secure.shippingapis.com/ShippingAPI.dll';

// USPS API Credentials
$userId = '9SIMPL93B2765';
$password = 'XXXXXXX';

// Barcode Number of the original label
$barcodeNumber = '420322579200190353014500000024';

// Build the XML request payload
$xmlRequest = <<<XML
<eVSCancelRequest USERID="{$userId}" PASSWORD="{$password}">
    <BarcodeNumber>{$barcodeNumber}</BarcodeNumber>
</eVSCancelRequest>
XML;

// Build the full API request URL
$requestUrl = $apiUrl . '?API=eVSCancel&XML=' . urlencode($xmlRequest);

// Set up cURL request
$ch = curl_init($requestUrl);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    // Process the response
    echo 'Response: ' . $response;
}

// Close cURL session
curl_close($ch);