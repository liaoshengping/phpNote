<?php
include ("../../vendor/autoload.php");
$mobileNumber = new \Ofan\PhoneLocation();
print_r($mobileNumber->find(15900000767));
print_r($mobileNumber->find(15900008755));
print_r($mobileNumber->find(15919252188));
